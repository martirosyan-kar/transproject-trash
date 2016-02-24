<?php
/**
 * Created by PhpStorm.
 * User: karen
 * Date: 2/23/16
 * Time: 11:53 PM
 */

$table1 = [];
foreach ($cities as $cityKey => $city) {
    foreach ($types as $typeKey => $type) {
        for ($i = 1; $i <= 5; $i++) {
            $table1[$cityKey][$typeKey]['resident_' . $i] = 0;
        }
        $table1[$cityKey][$typeKey]['woman'] = 0;
        for ($i = 1; $i <= 5; $i++) {
            $table1[$cityKey][$typeKey]['children_' . $i] = 0;
        }
    }
    for ($i = 1; $i <= 5; $i++) {
        $table1[$cityKey]['total']['resident_' . $i] = 0;
    }
    $table1[$cityKey]['total']['woman'] = 0;
    for ($i = 1; $i <= 5; $i++) {
        $table1[$cityKey]['total']['children_' . $i] = 0;
    }
}
$types['total'] = 'Ընդամենը<br>Total';

foreach ($data as $value) {
    if ($value->resident >= 1) {
        if ($value->resident >= 5) {
            $table1[$value->city][$value->type]['resident_5']++;
            $table1[$value->city]['total']['resident_5']++;
        } else {
            $table1[$value->city][$value->type]['resident_' . $value->resident]++;
            $table1[$value->city]['total']['resident_' . $value->resident]++;
        }
    }

    if ($value->children >= 1) {
        if ($value->children >= 5) {
            $table1[$value->city][$value->type]['children_5']++;
            $table1[$value->city]['total']['children_5']++;
        } else {
            $table1[$value->city][$value->type]['children_' . $value->children]++;
            $table1[$value->city]['total']['children_' . $value->children]++;
        }
    }

    if ($value->dominant == 1) {
        $table1[$value->city][$value->type]['woman']++;
        $table1[$value->city]['total']['woman']++;
    }
}

//echo "<pre>"; print_r($table1);exit();
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
                <td colspan="5"></td>
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
            <?php foreach ($table1 as $city => $value) {
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
    <div role="tabpanel" class="tab-pane" id="income">...1</div>
    <div role="tabpanel" class="tab-pane" id="disposal">...2</div>
    <div role="tabpanel" class="tab-pane" id="who">...3</div>
    <div role="tabpanel" class="tab-pane" id="fractions">...4</div>
    <div role="tabpanel" class="tab-pane" id="attitude">...5</div>
    <div role="tabpanel" class="tab-pane" id="re-pilot">...6</div>
</div>
