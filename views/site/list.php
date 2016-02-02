<?php
/**
 * Created by PhpStorm.
 * User: karen
 * Date: 1/31/16
 * Time: 12:31 PM
 */
use yii\helpers\BaseInflector;

foreach ($lists as $key => $value) {
    ?>
    <h4><a href="/<?= BaseInflector::camel2id($key) ?>/index"><?= implode('<br>',$value); ?></a></h4>
<?php } ?>
