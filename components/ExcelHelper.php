<?php
/**
 * Created by PhpStorm.
 * User: karen
 * Date: 3/30/16
 * Time: 8:45 PM
 */

namespace app\components;


class ExcelHelper
{
    public static function printData($data, $cities, $types, $sheet)
    {
        $row = 5;
        foreach ($data as $city => $value) {
            $sheet->mergeCells('A' . $row . ':' . 'A' . ($row + 2));
            $sheet->setCellValue('A' . $row, $cities[$city]);
            foreach ($value as $typeKey => $typeValue) {
                $col = 'B';
                $sheet->setCellValue($col . $row, str_replace('<br>',"\n",$types[$typeKey]));
                $col++;
                foreach ($typeValue as $column) {
                    $sheet->setCellValue($col . $row, str_replace('<br>',"\n",$column));
                    $col++;
                }
                $row++;
            }
        }

        return $sheet;
    }

    public static function moveColumn($start, $step)
    {
        return chr(ord($start) + $step - 1);
    }

    public static function setBothLanguages($startColumn, $sheet, $merge, $textArm, $textEng)
    {
        if($merge) {
            $rowArm = 1;
            $rowEng = 3;
        }
        else {
            $rowArm = 2;
            $rowEng = 4;
        }

        $sheet->setCellValue($startColumn.$rowArm, $textArm);
        $sheet->setCellValue($startColumn.$rowEng, $textEng);

        return $sheet;
    }

    public static function mergeBothLanguages($startColumn, $endColumn, $sheet)
    {
        $sheet->mergeCells($startColumn.'1:'.$endColumn.'1');
        $sheet->mergeCells($startColumn.'3:'.$endColumn.'3');
        return $sheet;
    }
}