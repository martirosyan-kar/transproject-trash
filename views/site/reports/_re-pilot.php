<table class="table table-bordered">
    <tr>
        <th rowspan="2">Համայնքի անուն</th>
        <th rowspan="2">Տնային տնտեսությունները ուսումնասիրության ընթացքում</th>
        <th colspan="<?= count($trashRecycleArm) ?>">Տնային տնտեսության քանակը որոնք պատրաստեն փորձելու հավաքել
            առանձին հետագա վերամշակման համար ըստ ֆրակցիաներ
        </th>
    </tr>
    <tr>
        <?php foreach ($trashRecycleArm as $value) { ?>
            <td><?= $value ?></td>
        <?php } ?>
    </tr>
    <tr>
        <td rowspan="2">Community name</td>
        <td rowspan="2">Households covered by the survey</td>
        <th colspan="<?= count($trashRecycleEng) ?>">Number of households ready to experiment re separate
            collection of recyclables per fraction
        </th>
    </tr>
    <tr>
        <?php foreach ($trashRecycleEng as $value) { ?>
            <td><?= $value ?></td>
        <?php } ?>
    </tr>
    <?php foreach ($pilots as $city => $value) {
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