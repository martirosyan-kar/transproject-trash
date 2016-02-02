<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TrashMan */

$this->title = 'Update Trash Man: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Trash Men', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trash-man-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
