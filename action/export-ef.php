<?php
require '../vendor/autoload.php';
require '../includes/Class-data.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

$id_estudio = $_POST['id_estudio'] ?? die('ID de estudio no proporcionado');

$dataHandler = new Data();
$estudio = $dataHandler->listarEF_IDFull($id_estudio);

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
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ]
];

// ================== CONFIGURACIÓN INICIAL ==================
$sheet->getStyle('B3:L3')->applyFromArray($borderStyle);

// Encabezado con logo y título
$sheet->mergeCells('C3:K5');
$sheet->setCellValue('C3', 'ESTUDIO DE FACTIBILIDAD')
      ->getStyle('C3:K5')->applyFromArray($headerStyle);

$drawing = new Drawing();
$drawing->setName('Logo');
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

$sheet->getStyle('K7')->getNumberFormat()->setFormatCode('dd/mm/yy');
$sheet->getStyle('D10')->getNumberFormat()->setFormatCode('#,##0');

// ================== FUNCIÓN PARA SECCIONES (MODIFICADA) ==================
function agregarSeccion($sheet, $row, $seccion, $items, $sectionHeaderStyle) {
    $sheet->mergeCells("C{$row}:K{$row}")
          ->setCellValue("C{$row}", $seccion['nombre'])
          ->getStyle("C{$row}:K{$row}")->applyFromArray($sectionHeaderStyle);
    $row++;
    
    $sheet->setCellValue("C{$row}", 'COD')
    ->setCellValue("D{$row}", 'DESCRIPCIÓN')
    ->mergeCells("D{$row}:F{$row}")
    ->setCellValue("G{$row}", 'UND')
    ->setCellValue("H{$row}", 'CANTIDAD')
    ->setCellValue("I{$row}", 'No PIEZAS')
    ->setCellValue("J{$row}", 'TARIFA')
    ->setCellValue("K{$row}", 'SUBTOTAL')
    ->getStyle("C{$row}:K{$row}")->applyFromArray([
        'font' => ['bold' => true, 'color' => ['rgb' => '000000']],
        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '92D050']],
        'borders' => ['bottom' => ['borderStyle' => Border::BORDER_THIN]],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
    ]);
    $row++;
    
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



    // Subtotales con dos colores
    $sheet->mergeCells("H{$row}:J{$row}")
    ->setCellValue("H{$row}", 'SUBTOTAL '.strtoupper($seccion['nombre']))
    ->setCellValue("K{$row}", "=SUM(K{$startRow}:K".($row-1).")");

    // Estilo para el texto del subtotal
    $sheet->getStyle("H{$row}:J{$row}")->applyFromArray([
    'font' => [
    'bold' => true,
    'color' => ['rgb' => 'FFFFFF'] // Texto blanco
    ],
    'fill' => [
    'fillType' => Fill::FILL_SOLID,
    'startColor' => ['rgb' => '000000'] // Azul corporativo
    ]
    ]);

    // Estilo para el valor del subtotal
    $sheet->getStyle("K{$row}")->applyFromArray([
    'font' => [
    'bold' => true,
    'color' => ['rgb' => '000000'] // Texto negro
    ],
    'fill' => [
    'fillType' => Fill::FILL_SOLID,
    'startColor' => ['rgb' => '92D050'] // Amarillo destacado
    ]
    ]);

    
    $subtotalCell = "K{$row}";
    $row++;

    return [
        'next_row' => $row + 2,
        'subtotal_cell' => $subtotalCell
    ];
}

// ================== GENERAR SECCIONES Y CAPTURAR SUBTOTALES ==================
$currentRow = 13;
$subtotalCells = [];

foreach ($estudio['secciones'] as $seccion) {
    $result = agregarSeccion($sheet, $currentRow, $seccion, $seccion['items'], $sectionHeaderStyle);
    $currentRow = $result['next_row'];
    $subtotalCells[] = $result['subtotal_cell'];
}

// ================== TABLA EPITOME ==================
$currentRow += 2; // Espacio antes de la tabla
$epitomeStartRow = $currentRow;

// Encabezado EPITOME
$sheet->mergeCells("C{$epitomeStartRow}:K{$epitomeStartRow}")
      ->setCellValue("C{$epitomeStartRow}", 'EPÍTOME')
      ->getStyle("C{$epitomeStartRow}:K{$epitomeStartRow}")->applyFromArray($sectionHeaderStyle);
$currentRow++;

$numSections = count($estudio['secciones']);
$costoAiuRow = $epitomeStartRow + 1 + $numSections + 2;

// Filas de cada sección en EPITOME
foreach ($estudio['secciones'] as $index => $seccion) {
    $subtotalCell = $subtotalCells[$index];
    $sheet->mergeCells("C{$currentRow}:H{$currentRow}")
          ->setCellValue("C{$currentRow}", $seccion['nombre'])
          ->setCellValue("I{$currentRow}", "={$subtotalCell}")
          ->setCellValue("J{$currentRow}", "=I{$currentRow}/\$I\${$costoAiuRow}*100");
    $currentRow++;
}

// TOTAL COSTOS DIRECTOS
$totalDirectosRow = $currentRow;
$sheet->mergeCells("C{$totalDirectosRow}:H{$totalDirectosRow}")
      ->setCellValue("C{$totalDirectosRow}", 'TOTAL COSTOS DIRECTOS')
      ->setCellValue("I{$totalDirectosRow}", "=SUM(" . implode(',', $subtotalCells) . ")")
      ->setCellValue("J{$totalDirectosRow}", "=I{$totalDirectosRow}/\$I\${$costoAiuRow}*100");
$currentRow++;

// AIU
$aiuRow = $currentRow;
$sheet->mergeCells("C{$aiuRow}:H{$aiuRow}")
      ->setCellValue("C{$aiuRow}", 'AIU')
      ->setCellValue("I{$aiuRow}", "=I{$totalDirectosRow}*0.3")
      ->setCellValue("J{$aiuRow}", "=I{$aiuRow}/\$I\${$costoAiuRow}*100");
$currentRow++;

// COSTO + AIU
$costoAiuRow = $currentRow;
$sheet->mergeCells("C{$costoAiuRow}:H{$costoAiuRow}")
      ->setCellValue("C{$costoAiuRow}", 'COSTO + AIU')
      ->setCellValue("I{$costoAiuRow}", "=I{$totalDirectosRow} + I{$aiuRow}")
      ->setCellValue("J{$costoAiuRow}", "=100");
$currentRow++;

// Estilos para EPITOME
$epitomeEndRow = $costoAiuRow;
$sheet->getStyle("C{$epitomeStartRow}:K{$epitomeEndRow}")->applyFromArray([
    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
]);

$sheet->getStyle("I{$epitomeStartRow}:I{$epitomeEndRow}")->getNumberFormat()->setFormatCode('$#,##0.00');
$sheet->getStyle("J{$epitomeStartRow}:J{$epitomeEndRow}")->getNumberFormat()->setFormatCode('0.00%');

// Estilos para filas especiales
$totalStyle = [
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D9D9D9']],
    'font' => ['bold' => true]
];
$sheet->getStyle("C{$totalDirectosRow}:J{$totalDirectosRow}")->applyFromArray($totalStyle);
$sheet->getStyle("C{$aiuRow}:J{$aiuRow}")->applyFromArray($totalStyle);

$costoAiuStyle = [
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '92D050']],
    'font' => ['bold' => true]
];
$sheet->getStyle("C{$costoAiuRow}:J{$costoAiuRow}")->applyFromArray($costoAiuStyle);

// Ajustar anchos de columnas
$sheet->getColumnDimension('C')->setWidth(40);
$sheet->getColumnDimension('I')->setWidth(15);
$sheet->getColumnDimension('J')->setWidth(15);

// ================== CONFIGURACIÓN FINAL ==================
$lastRow = $sheet->getHighestRow();
$sheet->getStyle("J15:K{$lastRow}")->getNumberFormat()->setFormatCode('$#,##0.00');

$sheet->getProtection()->setSheet(true);
$sheet->getStyle('C15:J'.($lastRow - 1))->getProtection()->setLocked(false);

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