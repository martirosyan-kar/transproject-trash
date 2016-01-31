<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TrashCountSummer */

$this->title = 'Update Trash Count Summer: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Trash Count Summers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trash-count-summer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
