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
        'size' => 20
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'ffffff']
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
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


// Encabezado con logo y título
$sheet->mergeCells('C3:K5');
$sheet->setCellValue('C3', 'ESTUDIO DE FACTIBILIDAD')
      ->getStyle('C3:K5')->applyFromArray($headerStyle);
// Agregar bordes al encabezado
$sheet->getStyle('C3:K5')->applyFromArray($borderStyle);

// ======== NUEVO CÓDIGO PARA ALTO DE FILA ========
$sheet->getRowDimension(3)->setRowHeight(40); // Fila 3
$sheet->getRowDimension(4)->setRowHeight(40); // Fila 4
$sheet->getRowDimension(5)->setRowHeight(40); // Fila 5





$drawing = new Drawing();
$drawing->setName('Logo');
$drawing->setPath('../assets/images/logo-talleres-unidos.png');
$drawing->setCoordinates('C3');
$drawing->setOffsetX(5);
$drawing->setOffsetY(25);
$drawing->setWorksheet($sheet);

// ================== DATOS DEL ESTUDIO ==================
// Cliente
$sheet->setCellValue('C7', 'Cliente:')
      ->setCellValue('D7', $estudio['cliente'])
      ->mergeCells('D7:I7')
      ->setCellValue('J7', 'Fecha:')
      ->setCellValue('K7', date('d/m/y', strtotime($estudio['fecha_estudio'])));
// Bordes para Cliente y Fecha
$sheet->getStyle('C7')->applyFromArray($borderStyle);
$sheet->getStyle('D7:I7')->applyFromArray($borderStyle);
$sheet->getStyle('J7:K7')->applyFromArray($borderStyle);

// Alcance
$sheet->setCellValue('C8', 'Alcance:')
      ->mergeCells('D8:I8')
      ->setCellValue('D8', $estudio['alcance'])
      ->setCellValue('J8', 'Cotización:')
      ->setCellValue('K8', $estudio['cotizacion']);
// Bordes para Alcance y Cotización
$sheet->getStyle('C8')->applyFromArray($borderStyle);
$sheet->getStyle('D8:I8')->applyFromArray($borderStyle);
$sheet->getStyle('J8:K8')->applyFromArray($borderStyle);

// Dimensiones y Tipo
$sheet->setCellValue('C9', 'Dimensiones:')
      ->mergeCells('D9:E9')
      ->setCellValue('D9', $estudio['dimensiones'])
      ->setCellValue('F9', 'Tipo:')
      ->mergeCells('G9:I9')
      ->setCellValue('G9', $estudio['tipo'])
      ->setCellValue('J9', 'Cod. Fabricación:')
      ->setCellValue('K9', $estudio['cod_fabricacion']);
// Bordes para Dimensiones, Tipo y Cod. Fabricación
$sheet->getStyle('C9')->applyFromArray($borderStyle);
$sheet->getStyle('D9:E9')->applyFromArray($borderStyle);
$sheet->getStyle('F9:H9')->applyFromArray($borderStyle);
$sheet->getStyle('J9:K9')->applyFromArray($borderStyle);

// Cantidad
$sheet->setCellValue('C10', 'Cantidad:')
      ->mergeCells('D10:K10')
      ->setCellValue('D10', $estudio['cantidad']);
// Bordes para Cantidad
$sheet->getStyle('C10')->applyFromArray($borderStyle);
$sheet->getStyle('D10:K10')->applyFromArray($borderStyle);

// Documento Referencia
$sheet->setCellValue('C11', 'Documento Referencia:')
      ->mergeCells('D11:K11')
      ->setCellValue('D11', $estudio['doc_referencia']);
// Bordes para Documento Referencia
$sheet->getStyle('C11')->applyFromArray($borderStyle);
$sheet->getStyle('D11:K11')->applyFromArray($borderStyle);

// Formatos de fecha y número (sin cambios)
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
$currentRow += 2;
$epitomeStartRow = $currentRow;

// Encabezado EPITOME (Amarillo FFC000)
$sheet->mergeCells("I{$epitomeStartRow}:J{$epitomeStartRow}")
      ->setCellValue("I{$epitomeStartRow}", 'EPÍTOME')
      ->getStyle("I{$epitomeStartRow}:J{$epitomeStartRow}")
      ->applyFromArray([
          'font' => ['bold' => true, 'color' => ['rgb' => '000000']],
          'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'FFC000']],
          'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
      ]);

$currentRow++;
$numSections = count($estudio['secciones']);
$costoAiuRow = $epitomeStartRow + $numSections + 3;

// Filas de cada sección en EPITOME
foreach ($estudio['secciones'] as $index => $seccion) {
    $subtotalCell = $subtotalCells[$index];
    $sheet->setCellValue("I{$currentRow}", $seccion['nombre'])
          ->setCellValue("J{$currentRow}", "={$subtotalCell}")
          ->setCellValue("K{$currentRow}", "=J{$currentRow}/\$J\${$costoAiuRow}*100");
    
    // Color verde 92D050 para la columna de precios (I)
    $sheet->getStyle("J{$currentRow}")->applyFromArray([
        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '92D050']]
    ]);
    
    $currentRow++;
}

// TOTAL COSTOS DIRECTOS
$totalDirectosRow = $currentRow;
$sheet->setCellValue("I{$totalDirectosRow}", 'TOTAL COSTOS DIRECTOS')
      ->setCellValue("J{$totalDirectosRow}", "=SUM(" . implode(',', $subtotalCells) . ")")
      ->setCellValue("K{$totalDirectosRow}", "=J{$totalDirectosRow}/\$J\${$costoAiuRow}*100");

// Aplicar estilo al total
$sheet->getStyle("I{$totalDirectosRow}:J{$totalDirectosRow}")->applyFromArray([
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D9D9D9']],
    'font' => ['bold' => true]
]);
$sheet->getStyle("J{$totalDirectosRow}")->applyFromArray([
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '92D050']]
]);

$currentRow++;
// AIU
$aiuRow = $currentRow;
$sheet->setCellValue("I{$aiuRow}", 'AIU')
      ->setCellValue("J{$aiuRow}", "=J{$totalDirectosRow}*0.3")
      ->setCellValue("K{$aiuRow}", "=J{$aiuRow}/\$J\${$costoAiuRow}*100");
$sheet->getStyle("J{$aiuRow}")->applyFromArray([
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '92D050']]
]);

$currentRow++;
// COSTO + AIU
$costoAiuRow = $currentRow;
$sheet->setCellValue("I{$costoAiuRow}", 'COSTO + AIU')
      ->setCellValue("J{$costoAiuRow}", "=J{$totalDirectosRow} + J{$aiuRow}")
      ->setCellValue("K{$costoAiuRow}", "=100");
$sheet->getStyle("I{$costoAiuRow}:J{$costoAiuRow}")->applyFromArray([
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '92D050']],
    'font' => ['bold' => true]
]);

// Ajustar bordes y formato
$epitomeEndRow = $costoAiuRow;
$sheet->getStyle("I{$epitomeStartRow}:J{$epitomeEndRow}")->applyFromArray([
    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
]);
$sheet->getStyle("J{$epitomeStartRow}:J{$epitomeEndRow}")->getNumberFormat()->setFormatCode('$#,##0.00');
$sheet->getStyle("K{$epitomeStartRow}:K{$epitomeEndRow}")->getNumberFormat()->setFormatCode('0.00%');

// Ajustar anchos de columnas
$sheet->getColumnDimension('I')->setWidth(30); // Nombre de sección
$sheet->getColumnDimension('J')->setWidth(15); // Subtotal
$sheet->getColumnDimension('K')->setWidth(15); // Porcentaje
$sheet->getColumnDimension('L')->setWidth(15); // Reserva (si es necesario)

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