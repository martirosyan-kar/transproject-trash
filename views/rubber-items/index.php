<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RubberItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rubber Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rubber-items-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rubber Items', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'name_eng',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
