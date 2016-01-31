<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TrashOutCount */

$this->title = 'Create Trash Out Count';
$this->params['breadcrumbs'][] = ['label' => 'Trash Out Counts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trash-out-count-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
