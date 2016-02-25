<?php
/**
 * Created by PhpStorm.
 * User: karen
 * Date: 2/23/16
 * Time: 11:53 PM
 */

$members = [];
$incomes = [];
$disposals = [];
$who = [];
$fractions = [];

foreach ($cities as $cityKey => $city) {


    foreach ($types as $typeKey => $type) {
        //Members
        for ($i = 1; $i <= 5; $i++) {
            $members[$cityKey][$typeKey]['resident_' . $i] = 0;
        }
        $members[$cityKey][$typeKey]['woman'] = 0;
        for ($i = 1; $i <= 5; $i++) {
            $members[$cityKey][$typeKey]['children_' . $i] = 0;
        }

        //incomes
        for ($i = 1; $i <= 3; $i++) {
            $incomes[$cityKey][$typeKey]['employee_' . $i] = 0;
        }
        for ($i = 1; $i <= 3; $i++) {
            $incomes[$cityKey][$typeKey]['retiree_' . $i] = 0;
        }

        //disposals
        foreach ($trashPlaceArm as $key => $value) {
            $disposals[$cityKey][$typeKey][$key] = 0;
        }

        //who
        foreach ($trashManArm as $key => $value) {
            $who[$cityKey][$typeKey][$key] = 0;
        }
        for ($i = 1; $i <= 3; $i++) {
            $who[$cityKey][$typeKey]['out_' . $i] = 0;
        }
    }
    //members total
    for ($i = 1; $i <= 5; $i++) {
        $members[$cityKey]['total']['resident_' . $i] = 0;
    }
    $members[$cityKey]['total']['woman'] = 0;
    for ($i = 1; $i <= 5; $i++) {
        $members[$cityKey]['total']['children_' . $i] = 0;
    }

    //incomes total
    for ($i = 1; $i <= 3; $i++) {
        $incomes[$cityKey]['total']['employee_' . $i] = 0;
    }
    for ($i = 1; $i <= 3; $i++) {
        $incomes[$cityKey]['total']['retiree_' . $i] = 0;
    }

    //disposals total
    foreach ($trashPlaceArm as $key => $value) {
        $disposals[$cityKey]['total'][$key] = 0;
    }

    //who total
    foreach ($trashManArm as $key => $value) {
        $who[$cityKey]['total'][$key] = 0;
    }
    for ($i = 1; $i <= 3; $i++) {
        $who[$cityKey]['total']['out_' . $i] = 0;
    }
}
$types['total'] = 'Ընդամենը<br>Total';
//echo '<pre>'; print_r($disposals);exit();
foreach ($data as $value) {
    //members
    if ($value->resident >= 1) {
        if ($value->resident >= 5) {
            $members[$value->city][$value->type]['resident_5']++;
            $members[$value->city]['total']['resident_5']++;
        } else {
            $members[$value->city][$value->type]['resident_' . $value->resident]++;
            $members[$value->city]['total']['resident_' . $value->resident]++;
        }
    }

    if ($value->children >= 1) {
        if ($value->children >= 5) {
            $members[$value->city][$value->type]['children_5']++;
            $members[$value->city]['total']['children_5']++;
        } else {
            $members[$value->city][$value->type]['children_' . $value->children]++;
            $members[$value->city]['total']['children_' . $value->children]++;
        }
    }

    if ($value->dominant == 1) {
        $members[$value->city][$value->type]['woman']++;
        $members[$value->city]['total']['woman']++;
    }

    //incomes
    if ($value->employee >= 1) {
        if ($value->employee >= 3) {
            $incomes[$value->city][$value->type]['employee_3']++;
            $incomes[$value->city]['total']['employee_3']++;
        } else {
            $incomes[$value->city][$value->type]['employee_' . $value->employee]++;
            $incomes[$value->city]['total']['employee_' . $value->employee]++;
        }
    }
    if ($value->retiree >= 1) {
        if ($value->retiree >= 3) {
            $incomes[$value->city][$value->type]['retiree_3']++;
            $incomes[$value->city]['total']['retiree_3']++;
        } else {
            $incomes[$value->city][$value->type]['retiree_' . $value->retiree]++;
            $incomes[$value->city]['total']['retiree_' . $value->retiree]++;
        }
    }

    //disposals
    $disposalData = $value->mainTrashPlaces;
    if (!empty($disposalData)) {
        foreach ($disposalData as $disposalValue) {
            $disposals[$value->city][$value->type][$disposalValue->trash_place_id]++;
            $disposals[$value->city]['total'][$disposalValue->trash_place_id]++;
        }
    }

    //who
    $trashOutData = $value->mainTrashMen;
    if (!empty($trashOutData)) {
        foreach ($trashOutData as $outValue) {
            $who[$value->city][$value->type][$outValue->trash_man_id]++;
            $who[$value->city]['total'][$outValue->trash_man_id]++;
        }
    }

    if($value->trash_out <= 1) {
        $who[$value->city][$value->type]['out_1']++;
        $who[$value->city]['total']['out_1']++;
    }
    elseif($value->trash_out >=2 && $value->trash_out <= 3) {
        $who[$value->city][$value->type]['out_2']++;
        $who[$value->city]['total']['out_2']++;
    }
    else {
        $who[$value->city][$value->type]['out_3']++;
        $who[$value->city]['total']['out_3']++;
    }
}

//echo "<pre>"; print_r($disposals);exit();
?>

<ul class="nav nav-tabs">
    <li role="presentation" class="active"><a href="#members" role="tab" data-toggle="tab">Members</a></li>
    <li role="presentation"><a href="#income" role="tab" data-toggle="tab">Income</a></li>
    <li role="presentation"><a href="#disposal" role="tab" data-toggle="tab">Disposal</a></li>
    <li role="presentation"><a href="#who" role="tab" data-toggle="tab">Who</a></li>
    <li role="presentation"><a href="#fractions" role="tab" data-toggle="tab">Fractions</a></li>
    <li role="presentation"><a href="#attitude" role="tab" data-toggle="tab">Attitude</a></li>
    <li role="presentation"><a href="#re-pilot" role="tab" data-toggle="tab">Re-pilot</a></li>
</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="members">
        <table class="table table-bordered">
            <tr>
                <th rowspan="2">Համայնքի անուն</th>
                <th rowspan="2">Տնային տնտեսությունները ուսումնասիրության ընթացքում</th>
                <th colspan="5">Տնային տնտեսության քանակը ըստ բնակիչների քանակի</th>
                <th rowspan="2">Կնոջ գլխավորու-թյամբ տնային տնտեսության քանակը</th>
                <th colspan="5">Տնային տնտեսության քանակ ըստ երեխաների քանակի</th>
            </tr>
            <tr>
                <td>1 բնակիչ</td>
                <td>2 բնակիչ</td>
                <td>3 բնակիչ</td>
                <td>5 բնակիչ</td>
                <td>5 և ավելի բնակիչ-ներ</td>
                <td>1 երեխա</td>
                <td>2 երեխա</td>
                <td>3 երեխա</td>
                <td>4 երեխա</td>
                <td>5 և ավելի երեխաներ</td>
            </tr>
            <tr>
                <td rowspan="2">Community name</td>
                <td rowspan="2">Households covered by the survey</td>
                <td colspan="5">Number of households with number of members</td>
                <td rowspan="2">Number of female headed households</td>
                <td colspan="5">Number of households with number of children</td>
            </tr>
            <tr>
                <td>1 member</td>
                <td>2 members</td>
                <td>3 members</td>
                <td>4 members</td>
                <td>Above 5 members</td>
                <td>1 child</td>
                <td>2 child</td>
                <td>3 child</td>
                <td>4 child</td>
                <td>5 and more children</td>
            </tr>
            <?php foreach ($members as $city => $value) {
                echo '<tr><td rowspan="3">' . $cities[$city] . '</td>';
                foreach ($value as $typeKey => $typeValue) {
                    echo ($typeKey != 1) ? '<tr ' . (($typeKey == 'total') ? 'class="active"' : '') . '>' : '';
                    echo '<td>' . $types[$typeKey] . '</td>';
                    foreach ($typeValue as $column) { ?>
                        <td><?= $column; ?></td>
                    <?php }
                    echo '</tr>';

                }
            } ?>
        </table>
    </div>
    <div role="tabpanel" class="tab-pane" id="income">
        <table class="table table-bordered">
            <tr>
                <th rowspan="2">Համայնքի անուն</th>
                <th rowspan="2">Տնային տնտեսությունները ուսումնասիրության ընթացքում</th>
                <th colspan="3">Տնային տնտեսության քանակը ըստ աշխատավարձ ստացողների քանակի</th>
                <th colspan="3">Տնային տնտեսության քանակը ըստ թոշակ/կրթաթոշակ ստացողների քանակի</th>
            </tr>
            <tr>
                <td>1 բնակիչ</td>
                <td>2 բնակիչ</td>
                <td>3 և ավելի բնակիչներ</td>
                <td>1 բնակիչ</td>
                <td>2 բնակիչ</td>
                <td>3 և ավելի բնակիչներ</td>
            </tr>
            <tr>
                <td rowspan="2">Community name</td>
                <td rowspan="2">Households covered by the survey</td>
                <td colspan="3">Number of households with number of persons on salary</td>
                <td colspan="3">Number of households with number of persons getting pension/stipendium only</td>
            </tr>
            <tr>
                <td>1 person</td>
                <td>2 persons</td>
                <td>3 and more persons</td>
                <td>1 person</td>
                <td>2 persons</td>
                <td>3 and more persons</td>
            </tr>
            <?php foreach ($incomes as $city => $value) {
                echo '<tr><td rowspan="3">' . $cities[$city] . '</td>';
                foreach ($value as $typeKey => $typeValue) {
                    echo ($typeKey != 1) ? '<tr ' . (($typeKey == 'total') ? 'class="active"' : '') . '>' : '';
                    echo '<td>' . $types[$typeKey] . '</td>';
                    foreach ($typeValue as $column) { ?>
                        <td><?= $column; ?></td>
                    <?php }
                    echo '</tr>';

                }
            } ?>
        </table>
    </div>
    <div role="tabpanel" class="tab-pane" id="disposal">
        <table class="table table-bordered">
            <tr>
                <th rowspan="2">Համայնքի անուն</th>
                <th rowspan="2">Տնային տնտեսությունները ուսումնասիրության ընթացքում</th>
                <th colspan="<?= count($trashPlaceArm) ?>">Տնային տնտեսության քանակը ըստ աղբի նետման տեսակի</th>
            </tr>
            <tr>
                <?php foreach ($trashPlaceArm as $value) { ?>
                    <td><?= $value ?></td>
                <?php } ?>
            </tr>
            <tr>
                <td rowspan="2">Community name</td>
                <td rowspan="2">Households covered by the survey</td>
                <th colspan="<?= count($trashPlaceEng) ?>">Number of households as per typical waste disposal practice
                </th>
            </tr>
            <tr>
                <?php foreach ($trashPlaceEng as $value) { ?>
                    <td><?= $value ?></td>
                <?php } ?>
            </tr>
            <?php foreach ($disposals as $city => $value) {
                echo '<tr><td rowspan="3">' . $cities[$city] . '</td>';
                foreach ($value as $typeKey => $typeValue) {
                    echo ($typeKey != 1) ? '<tr ' . (($typeKey == 'total') ? 'class="active"' : '') . '>' : '';
                    echo '<td>' . $types[$typeKey] . '</td>';
                    foreach ($typeValue as $column) { ?>
                        <td><?= $column; ?></td>
                    <?php }
                    echo '</tr>';

                }
            } ?>
        </table>
    </div>
    <div role="tabpanel" class="tab-pane" id="who">
        <table class="table table-bordered">
            <tr>
                <th rowspan="2">Համայնքի անուն</th>
                <th rowspan="2">Տնային տնտեսությունները ուսումնասիրության ընթացքում</th>
                <th colspan="<?= count($trashManArm) ?>">Ով է սովորաբար նետում աղբը Ձեր տանը</th>
                <th colspan="<?= 3 ?>">Քանի անգամ է հանվում աղբը</th>
            </tr>
            <tr>
                <?php foreach ($trashManArm as $value) { ?>
                    <td><?= $value ?></td>
                <?php } ?>
                <td>1 կամ 1-ից քիչ</td>
                <td>2-3 անգամ</td>
                <td>ամեն օր</td>
            </tr>
            <tr>
                <td rowspan="2">Community name</td>
                <td rowspan="2">Households covered by the survey</td>
                <th colspan="<?= count($trashManEng) ?>">Who typically takes out waste from your household?</th>
                <th colspan="<?= 3 ?>">Times a week your household takes the waste out</th>
            </tr>
            <tr>
                <?php foreach ($trashManEng as $value) { ?>
                    <td><?= $value ?></td>
                <?php } ?>
                <td>1 or less</td>
                <td>2-3 times</td>
                <td>every day or so</td>
            </tr>
            <?php foreach ($who as $city => $value) {
                echo '<tr><td rowspan="3">' . $cities[$city] . '</td>';
                foreach ($value as $typeKey => $typeValue) {
                    echo ($typeKey != 1) ? '<tr ' . (($typeKey == 'total') ? 'class="active"' : '') . '>' : '';
                    echo '<td>' . $types[$typeKey] . '</td>';
                    foreach ($typeValue as $column) { ?>
                        <td><?= $column; ?></td>
                    <?php }
                    echo '</tr>';

                }
            } ?>
        </table>
    </div>
    <div role="tabpanel" class="tab-pane" id="fractions">...4</div>
    <div role="tabpanel" class="tab-pane" id="attitude">...5</div>
    <div role="tabpanel" class="tab-pane" id="re-pilot">...6</div>
</div>
