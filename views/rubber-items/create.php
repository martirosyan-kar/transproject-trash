<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RubberItems */

$this->title = 'Create Rubber Items';
$this->params['breadcrumbs'][] = ['label' => 'Rubber Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rubber-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
