<?php 

include_once('../Conexion/Conexion.php');
    $sql= "SELECT * FROM contacto ;";
    $consulta =null;
    try {
        $comandose = Conexion::getInstance()->getDb()->prepare($sql);
        $comandose->execute();
        $consulta = $comandose->fetchAll();
    } catch (Exception $exxx) {
        echo $exxx->getMessage();
    }
//$consulta = $wpdb->get_results($sql);

require_once 'PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$sheet = $objPHPExcel->getActiveSheet();
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


/* Add some data
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:M1');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:M2');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:M3');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A7:A8');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B7:B8');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C7:C8');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D7:D8');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E7:H7');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('I7:I8');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('J7:J8');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('K7:K8');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('L7:M7');*/

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nombre')
            ->setCellValue('B1', 'Apellido')
            ->setCellValue('C1', 'Negocio')
            ->setCellValue('D1', 'Dirección')
            ->setCellValue('E1', 'Correo')
            ->setCellValue('F1', 'Teléfono')
            ->setCellValue('G1', 'Nacionalidad')
            ->setCellValue('H1', 'URL');
$dia=date("d") ;
$mes=date("m");
$anyo=date("Y");
$hora=date("H:i:s");  
$codigo=date("dmY");
$c=2;
foreach ($consulta as $lista) {

	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$c, $lista['nombre'])
            ->setCellValue('B'.$c, $lista['apellido'])
            ->setCellValue('C'.$c, $lista['negocio'])
            ->setCellValue('D'.$c, $lista['direccion'])
            ->setCellValue('E'.$c, $lista['correo'])
            ->setCellValue('F'.$c, $lista['tel'])
            ->setCellValue('G'.$c, $lista['nacionalidad'])
            ->setCellValue('H'.$c, $lista['url']);
            $c++;
}
$BStyle = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);
 $estilo = array(
    'font'  => array(
        'bold'  => false,
        'size'  => 18,
        'name'  => 'Calibri'
    ));
  $estilo2 = array(
    'font'  => array(
        'bold'  => false,
        'size'  => 11,
        'name'  => 'Calibri'
    ));

$sheet->getStyle('A1:H1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A7:M8'.$objPHPExcel->getActiveSheet()->getHighestRow())
    ->getAlignment()->setWrapText(true); 

$objPHPExcel->getActiveSheet()->getStyle('A2:H'.$c)->applyFromArray($BStyle);

$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($estilo);
$objPHPExcel->getActiveSheet()->getStyle('A2:H'.$c)->applyFromArray($estilo2);
/*for ($i=0; $i < 8; $i++) { 
	$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($i)->setAutoSize(true);
}*/
$sheet->getColumnDimension('A')->setWidth(20);
$sheet->getColumnDimension('B')->setWidth(20);
$sheet->getColumnDimension('C')->setWidth(20);
$sheet->getColumnDimension('D')->setWidth(50);
$sheet->getColumnDimension('E')->setWidth(50);
$sheet->getColumnDimension('F')->setWidth(20);
$sheet->getColumnDimension('G')->setWidth(30);
$sheet->getColumnDimension('H')->setWidth(100);
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Detalle Contactos');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$codigo.'_contactos.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

 ?>