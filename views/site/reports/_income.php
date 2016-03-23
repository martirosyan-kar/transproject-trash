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