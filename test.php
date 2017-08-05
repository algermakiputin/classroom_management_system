<?php require_once('Classes/PHPExcel.php') ?>
<?php
$data = $_GET['data'];
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->SetCellValue('A1','test');
?>