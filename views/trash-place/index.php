<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TrashPlaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trash Places';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trash-place-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Trash Place', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'name_eng',
            'name_short',
            'name_short_eng',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
