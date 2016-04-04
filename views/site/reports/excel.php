<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);
use app\components\ExcelHelper;
use app\models\Main;
use app\models\MainSearch;

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

    $sheets[$i]->mergeCells('A1:A2');
    $sheets[$i]->setCellValue('A1', 'Համայնքի անուն');
    $sheets[$i]->mergeCells('A3:A4');
    $sheets[$i]->setCellValue('A3', 'Community name');
    $sheets[$i]->mergeCells('B1:B2');
    $sheets[$i]->setCellValue('B1', 'Տնային տնտեսությունները ուսումնասիրության ընթացքում');
    $sheets[$i]->mergeCells('B3:B4');
    $sheets[$i]->setCellValue('B3', 'Households covered by the survey');
    extract($tabs[$i]['params']);
    //@todo change mergeCells and setCellValues to ExcelHelper::mergeBothLanguages and ExcelHelper::setBothLanguages
    //@todo create functions for each tab

    $startColumn = 'C';
    if ($i == 0) {
        $endColumn = ExcelHelper::moveColumn($startColumn, 5);

        $sheets[$i] = ExcelHelper::mergeBothLanguages($startColumn, $endColumn, $sheets[$i]);
        $sheets[$i] = ExcelHelper::setBothLanguages(
            $startColumn,
            $sheets[$i],
            true,
            'Տնային տնտեսության քանակը ըստ բնակիչների քանակի',
            'Number of households with number of members'
        );

        $sheets[$i] = ExcelHelper::setBothLanguages(
            $startColumn,
            $sheets[$i],
            false,
            '1 բնակիչ',
            '1 member'
        );
        $startColumn++;

        $sheets[$i] = ExcelHelper::setBothLanguages(
            $startColumn,
            $sheets[$i],
            false,
            '2 բնակիչ',
            '2 member'
        );
        $startColumn++;

        $sheets[$i] = ExcelHelper::setBothLanguages(
            $startColumn,
            $sheets[$i],
            false,
            '3 բնակիչ',
            '3 member'
        );
        $startColumn++;
        $sheets[$i] = ExcelHelper::setBothLanguages(
            $startColumn,
            $sheets[$i],
            false,
            '4 բնակիչ',
            '4 member'
        );
        $startColumn++;

        $sheets[$i] = ExcelHelper::setBothLanguages(
            $startColumn,
            $sheets[$i],
            false,
            '5 և ավելի բնակիչ-ներ',
            'Above 5 members'
        );

        $startColumn = ++$endColumn;
        $sheets[$i]->mergeCells($startColumn . '1:' . $startColumn . '2');
        $sheets[$i]->mergeCells($startColumn . '3:' . $startColumn . '4');

        $sheets[$i] = ExcelHelper::setBothLanguages(
            $startColumn,
            $sheets[$i],
            true,
            'Կնոջ գլխավորու-թյամբ տնային տնտեսության քանակը',
            'Number of female headed households'
        );

        $startColumn = ++$endColumn;
        $endColumn = ExcelHelper::moveColumn($startColumn, 5);

        $sheets[$i] = ExcelHelper::mergeBothLanguages($startColumn, $endColumn, $sheets[$i]);
        $sheets[$i] = ExcelHelper::setBothLanguages(
            $startColumn,
            $sheets[$i],
            true,
            'Տնային տնտեսության քանակ ըստ երեխաների քանակի',
            'Number of households with number of children'
        );

        $sheets[$i] = ExcelHelper::setBothLanguages(
            $startColumn,
            $sheets[$i],
            false,
            '1 երեխա',
            '1 child'
        );
        $startColumn++;

        $sheets[$i] = ExcelHelper::setBothLanguages(
            $startColumn,
            $sheets[$i],
            false,
            '2 երեխա',
            '2 child'
        );
        $startColumn++;

        $sheets[$i] = ExcelHelper::setBothLanguages(
            $startColumn,
            $sheets[$i],
            false,
            '3 երեխա',
            '3 child'
        );
        $startColumn++;

        $sheets[$i] = ExcelHelper::setBothLanguages(
            $startColumn,
            $sheets[$i],
            false,
            '4 երեխա',
            '4 child'
        );
        $startColumn++;

        $sheets[$i] = ExcelHelper::setBothLanguages(
            $startColumn,
            $sheets[$i],
            false,
            '5 և ավելի երեխաներ',
            '5 and more children'
        );
        $startColumn++;

        $data = $members;
    } elseif ($i == 1) {
        $endColumn = ExcelHelper::moveColumn($startColumn, 3);
        $sheets[$i]->mergeCells($startColumn . '1:' . $endColumn . '1');
        $sheets[$i]->mergeCells($startColumn . '3:' . $endColumn . '3');

        $sheets[$i]->setCellValue($startColumn . '1', 'Տնային տնտեսության քանակը ըստ աշխատավարձ ստացողների քանակի');
        $sheets[$i]->setCellValue($startColumn . '3', 'Number of households with number of members');

        $sheets[$i]->setCellValue($startColumn . '2', '1 բնակիչ');
        $sheets[$i]->setCellValue($startColumn . '4', '1 person');
        $startColumn++;
        $sheets[$i]->setCellValue($startColumn . '2', '2 բնակիչ');
        $sheets[$i]->setCellValue($startColumn . '4', '2 persons');
        $startColumn++;
        $sheets[$i]->setCellValue($startColumn . '2', '3 և ավելի բնակիչներ');
        $sheets[$i]->setCellValue($startColumn . '4', '3 and more persons');
        $startColumn++;

        $startColumn = ++$endColumn;
        $endColumn = ExcelHelper::moveColumn($startColumn, 3);
        $sheets[$i]->mergeCells($startColumn . '1:' . $endColumn . '1');
        $sheets[$i]->mergeCells($startColumn . '3:' . $endColumn . '3');

        $sheets[$i]->setCellValue($startColumn . '1',
            'Տնային տնտեսության քանակը ըստ թոշակ/կրթաթոշակ ստացողների քանակի');
        $sheets[$i]->setCellValue($startColumn . '3', 'Number of households with number of children');

        $sheets[$i]->setCellValue($startColumn . '2', '1 բնակիչ');
        $sheets[$i]->setCellValue($startColumn . '4', '1 person');
        $startColumn++;
        $sheets[$i]->setCellValue($startColumn . '2', '2 բնակիչ');
        $sheets[$i]->setCellValue($startColumn . '4', '2 persons');
        $startColumn++;
        $sheets[$i]->setCellValue($startColumn . '2', '3 և ավելի բնակիչներ');
        $sheets[$i]->setCellValue($startColumn . '4', '3 and more persons');
        $startColumn++;

        $data = $incomes;
    } elseif ($i == 2) {
        $endColumn = ExcelHelper::moveColumn($startColumn, count($trashPlaceArm));

        $sheets[$i]->mergeCells($startColumn . '1:' . $endColumn . '1');
        $sheets[$i]->mergeCells($startColumn . '3:' . $endColumn . '3');
        $sheets[$i]->setCellValue($startColumn . '1', 'Տնային տնտեսության քանակը ըստ աղբի նետման տեսակի');
        $sheets[$i]->setCellValue($startColumn . '3', 'Number of households as per typical waste disposal practice');
        foreach ($trashPlaceArm as $key => $value) {
            $sheets[$i]->setCellValue($startColumn . '2', $value);
            $sheets[$i]->setCellValue($startColumn . '4', $trashPlaceEng[$key]);
            $startColumn++;
        }

        $data = $disposals;
    } elseif ($i == 3) {
        $endColumn = ExcelHelper::moveColumn($startColumn, count($trashManArm));
        $sheets[$i]->mergeCells($startColumn . '1:' . $endColumn . '1');
        $sheets[$i]->mergeCells($startColumn . '3:' . $endColumn . '3');
        $sheets[$i]->setCellValue($startColumn . '1', 'Ով է սովորաբար նետում աղբը Ձեր տանը');
        $sheets[$i]->setCellValue($startColumn . '3', 'Who typically takes out waste from your household?');

        foreach ($trashManArm as $key => $value) {
            $sheets[$i]->setCellValue($startColumn . '2', $value);
            $sheets[$i]->setCellValue($startColumn . '4', $trashManEng[$key]);
            $startColumn++;
        }

        $startColumn = ++$endColumn;
        $endColumn = ExcelHelper::moveColumn($startColumn, 3);

        $sheets[$i]->mergeCells($startColumn . '1:' . $endColumn . '1');
        $sheets[$i]->mergeCells($startColumn . '3:' . $endColumn . '3');
        $sheets[$i]->setCellValue($startColumn . '1', 'Քանի անգամ է հանվում աղբը');
        $sheets[$i]->setCellValue($startColumn . '3', 'Times a week your household takes the waste out');

        $sheets[$i]->setCellValue($startColumn . '2', '1 կամ 1-ից քիչ');
        $sheets[$i]->setCellValue($startColumn . '4', '1 or less');
        $startColumn++;
        $sheets[$i]->setCellValue($startColumn . '2', '2-3 անգամ');
        $sheets[$i]->setCellValue($startColumn . '4', '2-3 times');
        $startColumn++;
        $sheets[$i]->setCellValue($startColumn . '2', 'ամեն օր');
        $sheets[$i]->setCellValue($startColumn . '4', 'every day or so');
        $startColumn++;

        $data = $who;
    } elseif ($i == 4) {
        $endColumn = ExcelHelper::moveColumn($startColumn, 4);
        $sheets[$i]->mergeCells($startColumn . '1:' . $endColumn . '1');
        $sheets[$i]->mergeCells($startColumn . '3:' . $endColumn . '3');
        $sheets[$i]->setCellValue($startColumn . '1',
            'Տնային տնտեսության քանակը ըստ շաբաթում թափված աղբի քանակի (դույլ կամ տոպրակ)');
        $sheets[$i]->setCellValue($startColumn . '3',
            'Number of households per number of bags/buckets of household waste disposed of per week');

        $sheets[$i]->setCellValue($startColumn . '2', '1');
        $sheets[$i]->setCellValue($startColumn . '4', '1');
        $startColumn++;
        $sheets[$i]->setCellValue($startColumn . '2', '2-3 հատ');
        $sheets[$i]->setCellValue($startColumn . '4', '2-3 pcs');
        $startColumn++;
        $sheets[$i]->setCellValue($startColumn . '2', '4-5 հատ');
        $sheets[$i]->setCellValue($startColumn . '4', '4-5 pcs');
        $startColumn++;
        $sheets[$i]->setCellValue($startColumn . '2', '6 և ավելի');
        $sheets[$i]->setCellValue($startColumn . '4', '6 or more pcs');
        $startColumn++;

        $startColumn = ++$endColumn;
        $endColumn = ExcelHelper::moveColumn($startColumn, count($trashCountSummerArm));

        $sheets[$i]->mergeCells($startColumn . '1:' . $endColumn . '1');
        $sheets[$i]->mergeCells($startColumn . '3:' . $endColumn . '3');
        $sheets[$i]->setCellValue($startColumn . '1',
            'Տնային տնտեսության քանակը ըստ շաբաթում գեներացված աղբի (Ամռանը)');
        $sheets[$i]->setCellValue($startColumn . '3',
            'Number of households per number of packaging waste
            items generated per week
            in summer');

        foreach ($trashCountSummerArm as $key => $value) {
            $sheets[$i]->setCellValue($startColumn . '2', $value);
            $sheets[$i]->setCellValue($startColumn . '4', $trashCountSummerEng[$key]);
            $startColumn++;
        }

        $startColumn = ++$endColumn;
        $endColumn = ExcelHelper::moveColumn($startColumn, count($trashCountWinterArm));

        $sheets[$i]->mergeCells($startColumn . '1:' . $endColumn . '1');
        $sheets[$i]->mergeCells($startColumn . '3:' . $endColumn . '3');
        $sheets[$i]->setCellValue($startColumn . '1',
            'Տնային տնտեսության քանակը ըստ շաբաթում գեներացված աղբի (Ձմռանը)');
        $sheets[$i]->setCellValue($startColumn . '3',
            'Number of households per number of packaging waste
            items generated per week
            in winter');

        foreach ($trashCountWinterArm as $key => $value) {
            $sheets[$i]->setCellValue($startColumn . '2', $value);
            $sheets[$i]->setCellValue($startColumn . '4', $trashCountWinterEng[$key]);
            $startColumn++;
        }

        $startColumn = ++$endColumn;
        $endColumn = ExcelHelper::moveColumn($startColumn, 2);

        $sheets[$i]->mergeCells($startColumn . '1:' . $endColumn . '1');
        $sheets[$i]->mergeCells($startColumn . '3:' . $endColumn . '3');
        $sheets[$i]->setCellValue($startColumn . '1',
            'Տնային տնտեսության քանակը ըստ թղթի թափման քանակի');
        $sheets[$i]->setCellValue($startColumn . '3',
            'Number of households per typical amount of paper/cardboard in waste');

        $sheets[$i]->setCellValue($startColumn . '2', 'Շատ');
        $sheets[$i]->setCellValue($startColumn . '4', 'Much');
        $startColumn++;
        $sheets[$i]->setCellValue($startColumn . '2', 'Ոչ շատ');
        $sheets[$i]->setCellValue($startColumn . '4', 'Not much');
        $startColumn++;

        $data = $fractions;
    } elseif ($i == 5) {
        $endColumn = ExcelHelper::moveColumn($startColumn, count($trashRelationArm));
        $sheets[$i]->mergeCells($startColumn . '1:' . $endColumn . '1');
        $sheets[$i]->mergeCells($startColumn . '3:' . $endColumn . '3');
        $sheets[$i]->setCellValue($startColumn . '1', 'Տնային տնտեսության քանակը ըստ վերաբերմունքի');
        $sheets[$i]->setCellValue($startColumn . '3', 'Number of households per attitude pattern');

        foreach ($trashRelationArm as $key => $value) {
            $sheets[$i]->setCellValue($startColumn . '2', $value);
            $sheets[$i]->setCellValue($startColumn . '4', $trashRelationEng[$key]);
            $startColumn++;
        }

        $data = $attitudes;
    } elseif ($i == 6) {
        $endColumn = ExcelHelper::moveColumn($startColumn, count($trashRecycleArm));
        $sheets[$i]->mergeCells($startColumn . '1:' . $endColumn . '1');
        $sheets[$i]->mergeCells($startColumn . '3:' . $endColumn . '3');
        $sheets[$i]->setCellValue($startColumn . '1',
            'Տնային տնտեսության քանակը որոնք պատրաստեն փորձելու հավաքել առանձին հետագա վերամշակման համար ըստ ֆրակցիաներ');
        $sheets[$i]->setCellValue($startColumn . '3',
            'Number of households ready to experiment re separate collection of recyclables per fraction');

        foreach ($trashRecycleArm as $key => $value) {
            $sheets[$i]->setCellValue($startColumn . '2', $value);
            $sheets[$i]->setCellValue($startColumn . '4', $trashRecycleEng[$key]);
            $startColumn++;
        }

        $data = $pilots;
    }

    $sheets[$i] = ExcelHelper::printData($data, $cities, $types, $sheets[$i]);
    for ($columnItem = 'A'; $columnItem <= $endColumn; $columnItem++) {
        $sheets[$i]->getColumnDimension($columnItem)->setWidth(15);
    }
    $sheets[$i]->getStyle('A1:'.$endColumn.'4')->getAlignment()->setWrapText(true);
    $i++;
}

$sheets[$i] = new PHPExcel_Worksheet($objPHPExcel, 'total');
$objPHPExcel->addSheet($sheets[$i]);

$main = new Main();
$searchModel = new MainSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$dataProvider->setPagination(['pageSize'=>$dataProvider->getTotalCount()]);
$dataArray = [
    [
        $main->getAttributeLabel('city'),
        $main->getAttributeLabel('type'),
        $main->getAttributeLabel('resident'),
        $main->getAttributeLabel('children'),
        $main->getAttributeLabel('employee'),
        $main->getAttributeLabel('retiree'),
        $main->getAttributeLabel('dominant'),
        $main->getAttributeLabel('mainTrashPlaces.trash_place_id'),
        $main->getAttributeLabel('mainTrashMen.trash_man_id'),
        $main->getAttributeLabel('filter_trash_out'),
        $main->getAttributeLabel('filter_trash_count'),
        $main->getAttributeLabel('filter_summer_1'),
        $main->getAttributeLabel('filter_summer_2'),
        $main->getAttributeLabel('filter_summer_3'),
        $main->getAttributeLabel('filter_summer_4'),
        $main->getAttributeLabel('filter_winter_1'),
        $main->getAttributeLabel('filter_winter_2'),
        $main->getAttributeLabel('filter_winter_3'),
        $main->getAttributeLabel('filter_winter_4'),
        $main->getAttributeLabel('paper'),
        $main->getAttributeLabel('mainTrashRelations.trash_relation_id'),
        $main->getAttributeLabel('mainTrashRecycles.trash_recycle_id'),
        $main->getAttributeLabel('mainRubberItems.rubber_item_id'),
        $main->getAttributeLabel('answer_count'),
        $main->getAttributeLabel('woman_count'),
        $main->getAttributeLabel('person'),
        $main->getAttributeLabel('date'),
        $main->getAttributeLabel('interrogatory'),
    ],
];
foreach($dataProvider->getModels() as $value){

    $dataArray[] = [
        isset($value->city0)?$value->city0->nameBothShort:'',
        isset($value->type0)?$value->type0->nameBothShort:'',
        $value->resident,
        $value->children,
        $value->employee,
        $value->retiree,
        isset($value->dominant0)?$value->dominant0->nameBothShort:'',
        $value->trashPlaceMulti,
        $value->trashManMulti,
        $value->trash_out,
        $value->trash_count,
        $value->summer_count_1,
        $value->summer_count_2,
        $value->summer_count_3,
        $value->summer_count_4,
        $value->winter_count_1,
        $value->winter_count_2,
        $value->winter_count_3,
        $value->winter_count_4,
        isset($value->paper0)?$value->paper0->nameBothShort:'',
        $value->trashRelationMulti,
        $value->trashRecycleMulti,
        $value->rubberItemsMulti,
        $value->answer_count,
        $value->woman_count,
        isset($value->person0)?$value->person0->nameBothShort:'',
        $value->date,
        $value->interrogatory
    ];
}
$sheets[$i]->fromArray($dataArray, '', 'A1');

header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0
header("Content-Type: application/vnd.ms-excel; name='excel'");
header("Content-disposition: attachment; filename=" . $exportFileName . ".xlsx");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
Yii::$app->end();