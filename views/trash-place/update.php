<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TrashPlace */

$this->title = 'Update Trash Place: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Trash Places', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trash-place-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
