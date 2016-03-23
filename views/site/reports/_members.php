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