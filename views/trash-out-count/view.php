<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TrashOutCount */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Trash Out Counts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trash-out-count-view">

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
            'id',
            'name_short',
            'name_eng',
            'name',
            'name_short_eng',
        ],
    ]) ?>

</div>
