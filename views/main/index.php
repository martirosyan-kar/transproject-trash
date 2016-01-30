<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mains';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Main', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'answer_count',
            'woman_count',
            'date',
            'interrogatory',
            'city',
            // 'type',
            // 'resident',
            // 'children',
            // 'employee',
            // 'retiree',
            // 'dominant',
            // 'place',
            // 'trash_man',
            // 'trash_out',
            // 'trash_count',
            // 'trash_count_summer',
            // 'trash_count_winter',
            // 'paper',
            // 'trash_relation',
            // 'trash_recycle',
            // 'summer_count_1',
            // 'winter_count_1',
            // 'summer_count_2',
            // 'summer_count_3',
            // 'summer_count_4',
            // 'winter_count_2',
            // 'winter_count_3',
            // 'winter_count_4',
            // 'person',
            // 'id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
