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
$attitudes = [];
$pilots = [];
$tables = [];

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

        //fractions
        for ($i = 1; $i <= 4; $i++) {
            $fractions[$cityKey][$typeKey]['trash_count_' . $i] = 0;
        }
        foreach ($trashCountSummerArm as $key => $value) {
            $field = 'summer_count_' . $key;
            $fractions[$cityKey][$typeKey][$field] = 0;
        }
        foreach ($trashCountWinterArm as $key => $value) {
            $field = 'winter_count_' . $key;
            $fractions[$cityKey][$typeKey][$field] = 0;
        }
        for ($i = 1; $i <= 2; $i++) {
            $fractions[$cityKey][$typeKey]['paper_' . $i] = 0;
        }

        //attitude
        foreach ($trashRelationArm as $key => $value) {
            $attitudes[$cityKey][$typeKey][$key] = 0;
        }

        //re-pilot
        foreach ($trashRecycleArm as $key => $value) {
            $pilots[$cityKey][$typeKey][$key] = 0;
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

    //fractions
    for ($i = 1; $i <= 4; $i++) {
        $fractions[$cityKey]['total']['trash_count_' . $i] = 0;
    }
    foreach ($trashCountSummerArm as $key => $value) {
        $field = 'summer_count_' . $key;
        $fractions[$cityKey]['total'][$field] = 0;
    }
    foreach ($trashCountWinterArm as $key => $value) {
        $field = 'winter_count_' . $key;
        $fractions[$cityKey]['total'][$field] = 0;
    }
    for ($i = 1; $i <= 2; $i++) {
        $fractions[$cityKey]['total']['paper_' . $i] = 0;
    }

    //attitude total
    foreach ($trashRelationArm as $key => $value) {
        $attitudes[$cityKey]['total'][$key] = 0;
    }

    //re-pilot total
    foreach ($trashRecycleArm as $key => $value) {
        $pilots[$cityKey]['total'][$key] = 0;
    }
}

$types['total'] = 'Ընդամենը<br>Total';
//echo '<pre>'; print_r($fractions);exit();
foreach ($data as $value) {
    //members
    if ($value->resident >= 1) {
        if ($value->resident >= 5) {
            $members[$value->city][$value->type]['resident_5']++;
            $members[$value->city]['total']['resident_5']++;
        } else {
            if(isset($members[$value->city][$value->type]['resident_' . $value->resident])) {
                $members[$value->city][$value->type]['resident_' . $value->resident]++;
                $members[$value->city]['total']['resident_' . $value->resident]++;
            }
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

    if ($value->trash_out <= 1) {
        $who[$value->city][$value->type]['out_1']++;
        $who[$value->city]['total']['out_1']++;
    } elseif ($value->trash_out >= 2 && $value->trash_out <= 3) {
        $who[$value->city][$value->type]['out_2']++;
        $who[$value->city]['total']['out_2']++;
    } else {
        $who[$value->city][$value->type]['out_3']++;
        $who[$value->city]['total']['out_3']++;
    }

    //fractions
    if ($value->trash_count == 1) {
        $fractions[$value->city][$value->type]['trash_count_1']++;
        $fractions[$value->city]['total']['trash_count_1']++;
    } elseif ($value->trash_count >= 2 && $value->trash_count <= 3) {
        $fractions[$value->city][$value->type]['trash_count_2']++;
        $fractions[$value->city]['total']['trash_count_2']++;
    } elseif ($value->trash_count >= 4 && $value->trash_count <= 5) {
        $fractions[$value->city][$value->type]['trash_count_3']++;
        $fractions[$value->city]['total']['trash_count_3']++;
    } elseif ($value->trash_count >= 6) {
        $fractions[$value->city][$value->type]['trash_count_4']++;
        $fractions[$value->city]['total']['trash_count_4']++;
    }
    foreach ($trashCountSummerArm as $countKey => $countValue) {
        $field = 'summer_count_' . $countKey;
        $fractions[$value->city][$typeKey][$field] ++;
        $fractions[$value->city]['total'][$field] ++;
    }
    foreach ($trashCountWinterArm as $countKey => $countValue) {
        $field = 'winter_count_' . $countKey;
        $fractions[$value->city][$typeKey][$field] ++;
        $fractions[$value->city]['total'][$field] ++;
    }
    if ($value->paper == 1) {
        $fractions[$value->city][$value->type]['paper_1']++;
        $fractions[$value->city]['total']['paper_1']++;
    } elseif ($value->paper == 2) {
        $fractions[$value->city][$value->type]['paper_2']++;
        $fractions[$value->city]['total']['paper_2']++;
    }

    //attitude
    $trashRelationData = $value->mainTrashRelations;
    if (!empty($trashRelationData)) {
        foreach ($trashRelationData as $relationValue) {
            $attitudes[$value->city][$value->type][$relationValue->trash_relation_id]++;
            $attitudes[$value->city]['total'][$relationValue->trash_relation_id]++;
        }
    }

    //re-pilot
    $trashRecycleData = $value->mainTrashRecycles;
    if (!empty($trashRecycleData)) {
        foreach ($trashRecycleData as $recycleValue) {
            $pilots[$value->city][$value->type][$recycleValue->trash_recycle_id]++;
            $pilots[$value->city]['total'][$recycleValue->trash_recycle_id]++;
        }
    }
}

//echo "<pre>"; print_r($disposals);exit();


$tabs = [
    [
        'id' => 'members',
        'value' => 'Members',
        'view' => 'members',
        'params' => [
            'members' => $members,
            'cities' => $cities,
            'types' => $types
        ]
    ],
    [
        'id' => 'income',
        'value' => 'Income',
        'view' => 'income',
        'params' => [
            'incomes' => $incomes,
            'cities' => $cities,
            'types' => $types
        ]
    ],
    [
        'id' => 'disposal',
        'value' => 'Disposal',
        'view' => 'disposal',
        'params' => [
            'disposals' => $disposals,
            'cities' => $cities,
            'types' => $types,
            'trashPlaceArm' => $trashPlaceArm,
            'trashPlaceEng' => $trashPlaceEng
        ]
    ],
    [
        'id' => 'who',
        'value' => 'Who',
        'view' => 'who',
        'params' => [
            'who' => $who,
            'cities' => $cities,
            'types' => $types,
            'trashManArm' => $trashManArm,
            'trashManEng' => $trashManEng
        ]
    ],
    [
        'id' => 'fractions',
        'value' => 'Fractions',
        'view' => 'fractions',
        'params' => [
            'fractions' => $fractions,
            'cities' => $cities,
            'types' => $types,
            'trashCountSummerArm' => $trashCountSummerArm,
            'trashCountWinterArm' => $trashCountWinterArm,
            'trashCountSummerEng' => $trashCountSummerEng,
            'trashCountWinterEng' => $trashCountWinterEng
        ]
    ],
    [
        'id' => 'attitude',
        'value' => 'Attitude',
        'view' => 'attitude',
        'params' => [
            'attitudes' => $attitudes,
            'cities' => $cities,
            'types' => $types,
            'trashRelationArm' => $trashRelationArm,
            'trashRelationEng' => $trashRelationEng
        ]
    ],
    [
        'id' => 're-pilot',
        'value' => 'Re-pilot',
        'view' => 're-pilot',
        'params' => [
            'pilots' => $pilots,
            'cities' => $cities,
            'types' => $types,
            'trashRecycleArm' => $trashRecycleArm,
            'trashRecycleEng' => $trashRecycleEng
        ]
    ],
];

foreach ($tabs as $tab) {
    $tables[$tab['view']] = $this->render('reports/_' . $tab['view'], $tab['params']);
}

if ($excel) {
    $this->render('reports/excel', ['tabs' => $tabs, 'tables' => $tables]);
} else {
    echo $this->render('reports/html', ['region' => $region, 'tabs' => $tabs, 'tables' => $tables]);
}
