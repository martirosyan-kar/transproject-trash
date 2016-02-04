<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

use app\models\Region;
use app\models\City;
use app\models\Type;
use app\models\Resident;
use app\models\Children;
use app\models\Employee;
use app\models\Retiree;
use app\models\Dominant;
use app\models\TrashPlace;
use app\models\TrashMan;
use app\models\TrashOutCount;
use app\models\TrashCount;
use app\models\TrashCountSummer;
use app\models\TrashCountWinter;
use app\models\Paper;
use app\models\TrashRelation;
use app\models\TrashRecycle;
use app\models\Person;
use app\components\LanguageHelper;

/* @var $this yii\web\View */

$this->title = 'Trash: Data';
$arrayParams = ['MainSearch' => ['region' => $region]];
$chartLink = LanguageHelper::getLinks('chart', $arrayParams);
$addLink = LanguageHelper::getLinks('add', $arrayParams);
?>
<h3><a class="btn btn-primary" href="<?= $chartLink['url']; ?>"><?= $chartLink['label']; ?></a>&nbsp;<a href="<?= $addLink['url']; ?>" class="btn btn-primary"><?= $addLink['label']; ?></a>&nbsp;</h3>
<div class="site-index" style="width: 2500px;">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'city',
                'value' => 'city0.nameBothShort',
                'filter' => Html::activeDropDownList($searchModel, 'city',
                    ArrayHelper::map(City::find()->all(), 'id', 'nameBothShort'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            [
                'attribute' => 'type',
                'value' => 'type0.nameBothShort',
                'filter' => Html::activeDropDownList($searchModel, 'type',
                    ArrayHelper::map(Type::find()->all(), 'id', 'nameBothShort'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            [
                'attribute' => 'resident',
                'value' => 'resident0.nameBothShort',
                'filter' => Html::activeDropDownList($searchModel, 'resident',
                    ArrayHelper::map(Resident::find()->all(), 'id', 'nameBothShort'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            [
                'attribute' => 'children',
                'value' => 'children0.nameBothShort',
                'filter' => Html::activeDropDownList($searchModel, 'children',
                    ArrayHelper::map(Children::find()->all(), 'id', 'nameBothShort'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            [
                'attribute' => 'employee',
                'value' => 'employee0.nameBothShort',
                'filter' => Html::activeDropDownList($searchModel, 'employee',
                    ArrayHelper::map(Employee::find()->all(), 'id', 'nameBothShort'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            [
                'attribute' => 'retiree',
                'value' => 'retiree0.nameBothShort',
                'filter' => Html::activeDropDownList($searchModel, 'retiree',
                    ArrayHelper::map(Retiree::find()->all(), 'id', 'nameBothShort'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            [
                'attribute' => 'dominant',
                'value' => 'dominant0.nameBothShort',
                'filter' => Html::activeDropDownList($searchModel, 'retiree',
                    ArrayHelper::map(Dominant::find()->all(), 'id', 'nameBothShort'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            [
                'attribute' => 'mainTrashPlaces.trash_place_id',
                'value' => 'trashPlaceMulti',
                'filter' => Html::activeDropDownList($searchModel, 'mainTrashPlaces.trash_place_id',
                    ArrayHelper::map(TrashPlace::find()->all(), 'id', 'nameBothShort'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            [
                'attribute' => 'mainTrashMen.trash_man_id',
                'value' => 'trashManMulti',
                'filter' => Html::activeDropDownList($searchModel, 'mainTrashMen.trash_man_id',
                    ArrayHelper::map(TrashMan::find()->all(), 'id', 'nameBothShort'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            [
                'attribute' => 'filter_trash_out',
                'value' => 'trash_out',
                'filter' => Html::activeDropDownList($searchModel, 'filter_trash_out',
                    array('1' => '1-5', '2' => '6-10', '3' => '11-20', '4' => '20+'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                    //'contentOptions'=>['style'=>'width: 120px;']
            ],
            [
                'attribute' => 'filter_trash_count',
                'value' => 'trash_count',
                'filter' => Html::activeDropDownList($searchModel, 'filter_trash_count',
                    array('1' => '1-5', '2' => '6-10', '3' => '11-20', '4' => '20+'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                    //'contentOptions'=>['style'=>'width: 120px;']
            ],
            [
                'attribute' => 'filter_summer_1',
                'value' => 'summer_count_1',
                'filter' => Html::activeDropDownList($searchModel, 'filter_summer_1',
                    array('1' => '1-5', '2' => '6-10', '3' => '11-20', '4' => '20+'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            [
                'attribute' => 'filter_summer_2',
                'value' => 'summer_count_2',
                'filter' => Html::activeDropDownList($searchModel, 'filter_summer_2',
                    array('1' => '1-5', '2' => '6-10', '3' => '11-20', '4' => '20+'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            [
                'attribute' => 'filter_summer_3',
                'value' => 'summer_count_3',
                'filter' => Html::activeDropDownList($searchModel, 'filter_summer_3',
                    array('1' => '1-5', '2' => '6-10', '3' => '11-20', '4' => '20+'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            [
                'attribute' => 'filter_summer_4',
                'value' => 'summer_count_4',
                'filter' => Html::activeDropDownList($searchModel, 'filter_summer_4',
                    array('1' => '1-5', '2' => '6-10', '3' => '11-20', '4' => '20+'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            [
                'attribute' => 'filter_winter_1',
                'value' => 'winter_count_1',
                'filter' => Html::activeDropDownList($searchModel, 'filter_winter_1',
                    array('1' => '1-5', '2' => '6-10', '3' => '11-20', '4' => '20+'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            [
                'attribute' => 'filter_winter_2',
                'value' => 'winter_count_2',
                'filter' => Html::activeDropDownList($searchModel, 'filter_winter_2',
                    array('1' => '1-5', '2' => '6-10', '3' => '11-20', '4' => '20+'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            [
                'attribute' => 'filter_winter_3',
                'value' => 'winter_count_3',
                'filter' => Html::activeDropDownList($searchModel, 'filter_winter_3',
                    array('1' => '1-5', '2' => '6-10', '3' => '11-20', '4' => '20+'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            [
                'attribute' => 'filter_winter_4',
                'value' => 'winter_count_4',
                'filter' => Html::activeDropDownList($searchModel, 'filter_winter_4',
                    array('1' => '1-5', '2' => '6-10', '3' => '11-20', '4' => '20+'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            [
                'attribute' => 'paper',
                'value' => 'paper0.nameBothShort',
                'filter' => Html::activeDropDownList($searchModel, 'paper',
                    ArrayHelper::map(Paper::find()->all(), 'id', 'nameBothShort'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            [
                'attribute' => 'mainTrashRelations.trash_relation_id',
                'value' => 'trashRelationMulti',
                'filter' => Html::activeDropDownList($searchModel, 'mainTrashRelations.trash_relation_id',
                    ArrayHelper::map(TrashRelation::find()->all(), 'id', 'nameBothShort'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            [
                'attribute' => 'mainTrashRecycles.trash_recycle_id',
                'value' => 'trashRecycleMulti',
                'filter' => Html::activeDropDownList($searchModel, 'mainTrashRecycles.trash_recycle_id',
                    ArrayHelper::map(TrashRecycle::find()->all(), 'id', 'nameBothShort'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            'answer_count',
            'woman_count',
            [
                'attribute' => 'person',
                'value' => 'person0.nameBothShort',
                'filter' => Html::activeDropDownList($searchModel, 'person',
                    ArrayHelper::map(Person::find()->all(), 'id', 'nameBothShort'),
                    ['class' => 'form-control', 'prompt' => 'Select Category']),
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            'date',
            'interrogatory'
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
