<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TrashRecycle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trash-recycle-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_short')->textInput() ?>

    <?= $form->field($model, 'name_short_eng')->textInput() ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'name_eng')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
