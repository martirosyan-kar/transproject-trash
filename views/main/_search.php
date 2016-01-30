<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MainSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="main-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'answer_count') ?>

    <?= $form->field($model, 'woman_count') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'interrogatory') ?>

    <?= $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'resident') ?>

    <?php // echo $form->field($model, 'children') ?>

    <?php // echo $form->field($model, 'employee') ?>

    <?php // echo $form->field($model, 'retiree') ?>

    <?php // echo $form->field($model, 'dominant') ?>

    <?php // echo $form->field($model, 'place') ?>

    <?php // echo $form->field($model, 'trash_man') ?>

    <?php // echo $form->field($model, 'trash_out') ?>

    <?php // echo $form->field($model, 'trash_count') ?>

    <?php // echo $form->field($model, 'trash_count_summer') ?>

    <?php // echo $form->field($model, 'trash_count_winter') ?>

    <?php // echo $form->field($model, 'paper') ?>

    <?php // echo $form->field($model, 'trash_relation') ?>

    <?php // echo $form->field($model, 'trash_recycle') ?>

    <?php // echo $form->field($model, 'summer_count_1') ?>

    <?php // echo $form->field($model, 'winter_count_1') ?>

    <?php // echo $form->field($model, 'summer_count_2') ?>

    <?php // echo $form->field($model, 'summer_count_3') ?>

    <?php // echo $form->field($model, 'summer_count_4') ?>

    <?php // echo $form->field($model, 'winter_count_2') ?>

    <?php // echo $form->field($model, 'winter_count_3') ?>

    <?php // echo $form->field($model, 'winter_count_4') ?>

    <?php // echo $form->field($model, 'person') ?>

    <?php // echo $form->field($model, 'id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
