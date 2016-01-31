<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TrashRelation */

$this->title = 'Create Trash Relation';
$this->params['breadcrumbs'][] = ['label' => 'Trash Relations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trash-relation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
