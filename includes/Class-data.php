<?php
require('conn.php');

class Data extends conectarDB {
    public function __construct() {
        parent::__construct();
    }

    // Verificar si el correo ya existe
    public function listarEF_ID($id_estudio) {
        $sql = "SELECT * FROM estudios_factibilidad WHERE id_estudio = :id_estudio";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':id_estudio', $id_estudio, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultado;

        
    }

    public function listarEF_IDFull($id_estudio) {
        $sql = "SELECT 
                    ef.*,
                    s.id_seccion,
                    s.nombre AS nombre_seccion,
                    s.subtotal AS subtotal_seccion,
                    s.porcentaje,
                    i.id_item,
                    i.codigo_item,
                    i.descripcion,
                    i.unidad,
                    i.cantidad AS cantidad_item,
                    i.no_piezas,
                    i.tarifa,
                    i.subtotal AS subtotal_item
                FROM estudios_factibilidad ef
                LEFT JOIN secciones s ON ef.id_estudio = s.id_estudio
                LEFT JOIN items i ON s.id_seccion = i.id_seccion
                WHERE ef.id_estudio = :id_estudio
                ORDER BY s.id_seccion, i.id_item";
        
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':id_estudio', $id_estudio, PDO::PARAM_INT);
        $stmt->execute();
        
        $resultado = array();
        $secciones = array();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Primera iteración: llenar datos base del estudio
            if (empty($resultado)) {
                $resultado = array(
                    'id_estudio' => $row['id_estudio'],
                    'codigo_estudio' => $row['codigo_estudio'],
                    'cliente' => $row['cliente'],
                    'fecha_estudio' => $row['fecha_estudio'],
                    'alcance' => $row['alcance'],
                    'cotizacion' => $row['cotizacion'],
                    'dimensiones' => $row['dimensiones'],
                    'tipo' => $row['tipo'],
                    'cod_fabricacion' => $row['cod_fabricacion'],
                    'cantidad' => $row['cantidad'],
                    'doc_referencia' => $row['doc_referencia'],
                    'secciones' => array()
                );
            }
            
            // Procesar secciones
            if (!empty($row['id_seccion'])) {
                $id_seccion = $row['id_seccion'];
                
                if (!isset($secciones[$id_seccion])) {
                    $secciones[$id_seccion] = array(
                        'id_seccion' => $id_seccion,
                        'nombre' => $row['nombre_seccion'],
                        'subtotal' => $row['subtotal_seccion'],
                        'porcentaje' => $row['porcentaje'],
                        'items' => array()
                    );
                }
                
                // Procesar items
                if (!empty($row['id_item'])) {
                    $secciones[$id_seccion]['items'][] = array(
                        'id_item' => $row['id_item'],
                        'codigo_item' => $row['codigo_item'],
                        'descripcion' => $row['descripcion'],
                        'unidad' => $row['unidad'],
                        'cantidad' => $row['cantidad_item'],
                        'no_piezas' => $row['no_piezas'],
                        'tarifa' => $row['tarifa'],
                        'subtotal' => $row['subtotal_item']
                    );
                }
            }
        }
        
        // Agregar secciones al resultado final
        $resultado['secciones'] = array_values($secciones);
        
        $stmt->closeCursor();
        return $resultado;
    }

}
?>
