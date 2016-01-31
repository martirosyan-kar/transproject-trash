<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TrashRecycle */

$this->title = 'Update Trash Recycle: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Trash Recycles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trash-recycle-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
