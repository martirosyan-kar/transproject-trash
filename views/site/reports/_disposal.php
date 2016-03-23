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