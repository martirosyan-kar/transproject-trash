<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TrashCountSummerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trash Count Summers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trash-count-summer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Trash Count Summer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name_short',
            'name_eng',
            'name',
            'name_short_eng',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
