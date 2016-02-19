<?php
/**
 * Created by PhpStorm.
 * User: karen
 * Date: 2/18/16
 * Time: 10:40 PM
 */
use app\components\LanguageHelper;

$menus = LanguageHelper::getUserMenus();
?>
<div class="site-main">
    <?php
    foreach ($menus as $menu) {
        echo '<a href=' . $menu['url'] . '>' . $menu['label'] . '</a><br>';
    }
    ?>
</div>

