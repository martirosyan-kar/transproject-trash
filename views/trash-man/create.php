<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TrashMan */

$this->title = 'Create Trash Man';
$this->params['breadcrumbs'][] = ['label' => 'Trash Men', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trash-man-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
