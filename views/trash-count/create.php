<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TrashCount */

$this->title = 'Create Trash Count';
$this->params['breadcrumbs'][] = ['label' => 'Trash Counts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trash-count-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
