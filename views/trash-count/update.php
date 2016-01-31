<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TrashCount */

$this->title = 'Update Trash Count: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Trash Counts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trash-count-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
