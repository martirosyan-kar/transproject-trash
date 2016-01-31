<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TrashCountWinter */

$this->title = 'Create Trash Count Winter';
$this->params['breadcrumbs'][] = ['label' => 'Trash Count Winters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trash-count-winter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
