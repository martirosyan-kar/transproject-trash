<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TrashOutCountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trash Out Counts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trash-out-count-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Trash Out Count', ['create'], ['class' => 'btn btn-success']) ?>
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
