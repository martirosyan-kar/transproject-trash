<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Main */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'answer_count',
            'woman_count',
            'date',
            'interrogatory',
            'city',
            'type',
            'resident',
            'children',
            'employee',
            'retiree',
            'dominant',
            'place',
            'trash_man',
            'trash_out',
            'trash_count',
            'trash_count_summer',
            'trash_count_winter',
            'paper',
            'trash_relation',
            'trash_recycle',
            'summer_count_1',
            'winter_count_1',
            'summer_count_2',
            'summer_count_3',
            'summer_count_4',
            'winter_count_2',
            'winter_count_3',
            'winter_count_4',
            'person',
            'id',
        ],
    ]) ?>

</div>
