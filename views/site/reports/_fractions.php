<table class="table table-bordered">
    <tr>
        <th rowspan="2">Համայնքի անուն</th>
        <th rowspan="2">Տնային տնտեսությունները ուսումնասիրության ընթացքում</th>
        <th colspan="4">Տնային տնտեսության քանակը ըստ շաբաթում թափված աղբի քանակի (դույլ կամ տոպրակ)</th>
        <th colspan="<?= count($trashCountSummerArm); ?>">Տնային տնտեսության քանակը ըստ շաբաթում գեներացված աղբի
            (Ամռանը)
        </th>
        <th colspan="<?= count($trashCountWinterArm); ?>">Տնային տնտեսության քանակը ըստ շաբաթում գեներացված աղբի
            (Ձմռանը)
        </th>
        <th colspan="2">Տնային տնտեսության քանակը ըստ թղթի թափման քանակի</th>
    </tr>
    <tr>
        <td>1</td>
        <td>2-3 հատ</td>
        <td>4-5 հատ</td>
        <td>6 և ավելի</td>
        <?php foreach ($trashCountSummerArm as $value) { ?>
            <td><?= $value ?></td>
        <?php } ?>
        <?php foreach ($trashCountWinterArm as $value) { ?>
            <td><?= $value ?></td>
        <?php } ?>
        <td>Շատ</td>
        <td>Ոչ շատ</td>
    </tr>
    <tr>
        <td rowspan="2">Community name</td>
        <td rowspan="2">Households covered by the survey</td>
        <th colspan="4">Number of households per number of bags/buckets of household waste disposed of per
            week
        </th>
        <th colspan="<?= count($trashCountSummerEng); ?>">Number of households per number of packaging waste
            items generated per week
            in summer
        </th>
        <th colspan="<?= count($trashCountWinterEng); ?>">Number of households per number of packaging waste
            items generated per week
            in winter
        </th>
        <th colspan="2">Number of households per typical amount of paper/cardboard in waste</th>
    </tr>
    <tr>
        <td>1</td>
        <td>2-3 pcs</td>
        <td>4-5 pcs</td>
        <td>6 or more pcs</td>
        <?php foreach ($trashCountSummerEng as $value) { ?>
            <td><?= $value ?></td>
        <?php } ?>
        <?php foreach ($trashCountWinterEng as $value) { ?>
            <td><?= $value ?></td>
        <?php } ?>
        <td>Much</td>
        <td>Not much</td>
    </tr>
    <?php foreach ($fractions as $city => $value) {
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