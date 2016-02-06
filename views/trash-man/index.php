<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TrashManSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trash Men';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trash-man-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Trash Man', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name_short',
            'name_short_eng',
            'name',
            'name_eng',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
