<?php
/**
 * Created by PhpStorm.
 * User: karen
 * Date: 1/24/16
 * Time: 8:45 PM
 */
$this->title = 'Trash: Charts';
use yii\web\JqueryAsset;
use app\assets\ChartAsset;
use yii\web\View;
use app\components\LanguageHelper;

//ChartAsset::register($this);
$this->registerJsFile('js/charts.js', ['depends' => [JqueryAsset::className(), ChartAsset::className()]]);

$seasons = ['summer' => 'Մոտավոր աղբի քանակը ամռանը', 'winter' => 'Մոտավոր աղբի քանակը ձմռանը'];

$arrayParams = ['MainSearch' => ['region' => $region]];
$indexLink = LanguageHelper::getLinks('index', $arrayParams);
?>
<h3><a href="<?= $indexLink['url']; ?>"><?= $indexLink['label']; ?></a></h3>

<div class="col-sm-12">
    <?php
    foreach ($totals as $season => $seasonValues) { ?>
        <div class="col-sm-6">
            <h2><?= $seasons[$season]; ?></h2>
            <div id="<?= $season . '-main'; ?>" style="width: 500px; height: 500px;"></div>
        </div>
    <?php } ?>
</div>

<div class="col-sm-12">
    <?php
    foreach ($totalsKG as $season => $seasonValues) { ?>
        <div class="col-sm-6">
            <h2><?= $seasons[$season]; ?>(կգ)</h2>
            <div id="<?= $season . '-main-kg'; ?>" style="width: 500px; height: 500px;"></div>
        </div>
    <?php } ?>
</div>

    <?php
    foreach ($data as $season => $seasonValues) { ?>
<div class="col-sm-12">
        <h2><?= $seasons[$season]; ?> ըստ համայքների</h2>
        <?php foreach ($seasonValues as $cityKey => $value) { ?>
            <div class="col-sm-4">
                <h3><?= $cities[$cityKey] ?></h3>
                <div id="<?= $season . '-' . $cityKey; ?>" style="width: 350px; height: 350px;"></div>
            </div>
        <?php } ?>
</div>
    <?php } ?>

<div class="col-sm-12">
    <div class="col-sm-6">
        <h2><?= 'Վերամշակման փորձ'; ?></h2>
        <div id="<?= 'recycle-main'; ?>" style="width: 500px; height: 500px;"></div>
    </div>
</div>

<div class="col-sm-12">
    <h2><?= 'Վերամշակման փորձ'; ?> ըստ համայքների</h2>
    <?php
    foreach ($recycle as $cityKey => $value) { ?>
        <div class="col-sm-4">
            <h3><?= $cities[$cityKey] ?></h3>
            <div id="recycle-main-<?= $cityKey; ?>" style="width: 350px; height: 350px;"></div>
        </div>
    <?php } ?>
</div>

<script>
    var data1 = <?php echo json_encode($data); ?>;
    var totals = <?php echo json_encode($totals); ?>;
    var totalsKG = <?php echo json_encode($totalsKG); ?>;
    var recycleTotal = <?php echo json_encode($recycleTotal); ?>;
    var recycle = <?php echo json_encode($recycle); ?>;
</script>