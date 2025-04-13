<?php
require '../vendor/autoload.php';
require '../includes/Class-data.php'; // Asegúrate de incluir tu clase

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

// Obtener ID del estudio
$id_estudio = $_POST['id_estudio'] ?? die('ID de estudio no proporcionado');

// Instanciar clase y obtener datos
$dataHandler = new Data();
$estudio = $dataHandler->listarEF_IDFull($id_estudio);

// Crear nuevo documento
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// ================== ESTILOS GLOBALES ==================
$borderStyle = [
    'borders' => [
        'outline' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
];

$headerStyle = [
    'font' => [
        'bold' => true, 
        'color' => ['rgb' => '000000'], 
        'size' => 14
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'ffffff']
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER
    ]
];

$sectionHeaderStyle = [
    'font' => [
        'bold' => true, 
        'color' => ['rgb' => 'ffffff'], 
        'size' => 12
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '000000']
    ]
];

// ================== CONFIGURACIÓN INICIAL ==================
// Configurar área global
$sheet->getStyle('B3:L3')->applyFromArray($borderStyle);

// Encabezado con logo y título
$sheet->mergeCells('C3:K5');
$sheet->setCellValue('C3', 'ESTUDIO DE FACTIBILIDAD')
      ->getStyle('C3:K5')->applyFromArray($headerStyle);

// Insertar logo
$drawing = new Drawing();
$drawing->setName('Logo');
$drawing->setDescription('Logo empresa');
$drawing->setPath('../assets/images/logo-talleres-unidos.png');
$drawing->setCoordinates('C3');
$drawing->setOffsetX(10);
$drawing->setOffsetY(10);
$drawing->setWorksheet($sheet);

// ================== DATOS DEL ESTUDIO ==================
$sheet->setCellValue('C7', 'Cliente:')
      ->setCellValue('D7', $estudio['cliente'])
      ->mergeCells('D7:H7')
      ->setCellValue('J7', 'Fecha:')
      ->setCellValue('K7', date('d/m/y', strtotime($estudio['fecha_estudio'])))
      ->setCellValue('C8', 'Alcance:')
      ->mergeCells('D8:H8')
      ->setCellValue('D8', $estudio['alcance'])
      ->setCellValue('J8', 'Cotización:')
      ->setCellValue('K8', $estudio['cotizacion'])
      ->setCellValue('C9', 'Dimensiones:')
      ->mergeCells('D9:E9')
      ->setCellValue('D9', $estudio['dimensiones'])
      ->setCellValue('F9', 'Tipo:')
      ->mergeCells('G9:H9')
      ->setCellValue('G9', $estudio['tipo'])
      ->setCellValue('J9', 'Cod. Fabricación:')
      ->setCellValue('K9', $estudio['cod_fabricacion'])
      ->setCellValue('C10', 'Cantidad:')
      ->mergeCells('D10:E10')
      ->setCellValue('D10', $estudio['cantidad'])
      ->setCellValue('C11', 'Documento Referencia:')
      ->mergeCells('D11:H11')
      ->setCellValue('D11', $estudio['doc_referencia']);

// Formatear celdas
$sheet->getStyle('K7')->getNumberFormat()->setFormatCode('dd/mm/yy');
$sheet->getStyle('D10')->getNumberFormat()->setFormatCode('#,##0');

// ================== FUNCIÓN PARA SECCIONES ==================
function agregarSeccion($sheet, $row, $seccion, $items, $sectionHeaderStyle) {
    // Encabezado de sección
    $sheet->mergeCells("C{$row}:K{$row}")
          ->setCellValue("C{$row}", $seccion['nombre'])
          ->getStyle("C{$row}:K{$row}")->applyFromArray($sectionHeaderStyle);
    
    $row++;
    
    // Encabezados de tabla con color
    $sheet->setCellValue("C{$row}", 'COD')
    ->setCellValue("D{$row}", 'DESCRIPCIÓN')
    ->mergeCells("D{$row}:F{$row}")
    ->setCellValue("G{$row}", 'UND')
    ->setCellValue("H{$row}", 'CANTIDAD')
    ->setCellValue("I{$row}", 'No PIEZAS')
    ->setCellValue("J{$row}", 'TARIFA')
    ->setCellValue("K{$row}", 'SUBTOTAL')
    ->getStyle("C{$row}:K{$row}")->applyFromArray([
        'font' => [
            'bold' => true,
            'color' => ['rgb' => '000000'] // Texto blanco
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['rgb' => '92D050'] // Mismo azul que el encabezado principal
        ],
        'borders' => [
            'bottom' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['rgb' => '000000']
            ]
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER
        ]
    ]);
        
    $row++;
    
    // Items de la sección
    $startRow = $row;
    foreach ($items as $item) {
        $sheet->setCellValue("C{$row}", $item['codigo_item'])
              ->setCellValue("D{$row}", $item['descripcion'])
              ->mergeCells("D{$row}:F{$row}")
              ->setCellValue("G{$row}", $item['unidad'])
              ->setCellValue("H{$row}", $item['cantidad'])
              ->setCellValue("I{$row}", $item['no_piezas'])
              ->setCellValue("J{$row}", $item['tarifa'])
              ->setCellValue("K{$row}", "=H{$row}*I{$row}*J{$row}");
        $row++;
    }
    
    // Subtotales
    $sheet->mergeCells("H{$row}:J{$row}")
          ->setCellValue("H{$row}", 'SUBTOTAL '.strtoupper($seccion['nombre']))
          ->setCellValue("K{$row}", "=SUM(K{$startRow}:K".($row-1).")")
          ->getStyle("H{$row}:K{$row}")->applyFromArray([
              'font' => ['bold' => true],
              'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F8CBAD']]
          ]);
    
    return $row + 2;
}

// ================== GENERAR SECCIONES ==================
$currentRow = 13;
foreach ($estudio['secciones'] as $seccion) {
    $currentRow = agregarSeccion(
        $sheet, 
        $currentRow, 
        $seccion, 
        $seccion['items'],
        $sectionHeaderStyle // Pasamos el estilo como parámetro
    );
}

// ================== CONFIGURACIÓN FINAL ==================
// Formato monetario
$lastRow = $sheet->getHighestRow();
$sheet->getStyle("J15:K{$lastRow}")->getNumberFormat()->setFormatCode('$#,##0.00');

// Proteger celdas
$sheet->getProtection()->setSheet(true);
$sheet->getStyle('C15:J'.($lastRow - 1))->getProtection()->setLocked(false);

// Autoajustar columnas
foreach (range('C', 'K') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// ================== EXPORTAR ARCHIVO ==================
$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Estudio_'.$estudio['codigo_estudio'].'.xlsx"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
?>