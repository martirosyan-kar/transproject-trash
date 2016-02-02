<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TrashRecycleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trash Recycles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trash-recycle-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Trash Recycle', ['create'], ['class' => 'btn btn-success']) ?>
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
