<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Region;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\City */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'name_eng')->textInput() ?>

    <?= $form->field($model, 'region')->dropDownList(ArrayHelper::map(Region::find()->all(),'id','nameBoth')); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
