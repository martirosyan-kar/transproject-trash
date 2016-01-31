<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TrashCountSummer */

$this->title = 'Create Trash Count Summer';
$this->params['breadcrumbs'][] = ['label' => 'Trash Count Summers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trash-count-summer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
