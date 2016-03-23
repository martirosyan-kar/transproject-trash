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