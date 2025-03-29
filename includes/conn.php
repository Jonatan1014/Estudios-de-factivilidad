<?php
    require_once ('settings.php');
    
    if (!class_exists('conectarDB')) {
        class conectarDB {	
            protected $conexion_db;
            public function __construct(){		
                try{  
                    $this->conn_db = new PDO(DB_HOST, DB_USER, DB_PASS);
                    $this->conn_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    return $this->conn_db;
                } catch(Exception $e) {				
                    echo "Error al conectar: " . $e->getCode();			
                }			
            }
        }
    }
?>
