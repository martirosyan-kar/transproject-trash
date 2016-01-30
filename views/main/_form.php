<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Main */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="main-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'answer_count')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'woman_count')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'interrogatory')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'resident')->textInput() ?>

    <?= $form->field($model, 'children')->textInput() ?>

    <?= $form->field($model, 'employee')->textInput() ?>

    <?= $form->field($model, 'retiree')->textInput() ?>

    <?= $form->field($model, 'dominant')->textInput() ?>

    <?= $form->field($model, 'place')->textInput() ?>

    <?= $form->field($model, 'trash_man')->textInput() ?>

    <?= $form->field($model, 'trash_out')->textInput() ?>

    <?= $form->field($model, 'trash_count')->textInput() ?>

    <?= $form->field($model, 'trash_count_summer')->textInput() ?>

    <?= $form->field($model, 'trash_count_winter')->textInput() ?>

    <?= $form->field($model, 'paper')->textInput() ?>

    <?= $form->field($model, 'trash_relation')->textInput() ?>

    <?= $form->field($model, 'trash_recycle')->textInput() ?>

    <?= $form->field($model, 'summer_count_1')->textInput() ?>

    <?= $form->field($model, 'winter_count_1')->textInput() ?>

    <?= $form->field($model, 'summer_count_2')->textInput() ?>

    <?= $form->field($model, 'summer_count_3')->textInput() ?>

    <?= $form->field($model, 'summer_count_4')->textInput() ?>

    <?= $form->field($model, 'winter_count_2')->textInput() ?>

    <?= $form->field($model, 'winter_count_3')->textInput() ?>

    <?= $form->field($model, 'winter_count_4')->textInput() ?>

    <?= $form->field($model, 'person')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
