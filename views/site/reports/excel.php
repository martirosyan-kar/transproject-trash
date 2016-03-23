<?php
$exportFileName = date("mdY");
ob_clean();
ob_start();
$objPHPExcel = new PHPExcel();

ob_get_clean();
$sheets = [];
$sheets[] = $objPHPExcel->getSheet(0);
$i = 0;
foreach ($tabs as $tab) {
    if ($i == 0) {
        $sheets[$i]->setTitle($tab['value']);
    } else {
        $sheets[$i] = new PHPExcel_Worksheet($objPHPExcel, $tab['value']);
        $objPHPExcel->addSheet($sheets[$i]);
    }
    $i++;
}


header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
header("Content-Type: application/vnd.ms-excel; name='excel'");
header("Content-disposition: attachment; filename=" . $exportFileName . ".xlsx");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
Yii::$app->end();