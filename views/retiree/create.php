<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Retiree */

$this->title = 'Create Retiree';
$this->params['breadcrumbs'][] = ['label' => 'Retirees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="retiree-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
