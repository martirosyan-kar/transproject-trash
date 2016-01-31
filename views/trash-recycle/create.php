<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TrashRecycle */

$this->title = 'Create Trash Recycle';
$this->params['breadcrumbs'][] = ['label' => 'Trash Recycles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trash-recycle-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
