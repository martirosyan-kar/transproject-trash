<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TrashOutCount */

$this->title = 'Update Trash Out Count: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Trash Out Counts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trash-out-count-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
