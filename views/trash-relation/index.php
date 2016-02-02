<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TrashRelationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trash Relations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trash-relation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Trash Relation', ['create'], ['class' => 'btn btn-success']) ?>
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
