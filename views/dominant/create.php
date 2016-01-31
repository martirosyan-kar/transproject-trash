<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Dominant */

$this->title = 'Create Dominant';
$this->params['breadcrumbs'][] = ['label' => 'Dominants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dominant-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
