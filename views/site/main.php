<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\City;
use app\models\Type;
use app\models\Resident;

/* @var $this yii\web\View */
/* @var $model app\models\Main */
/* @var $form ActiveForm */
?>
<div class="site-main">

    <?php $form = ActiveForm::begin(); ?>

    <h3>
    <?= $form->field($model, 'city')->radioList(ArrayHelper::map(City::find()->where(['region' => $region])->all(),
        'id', 'nameBoth'), ['class' => 'radio', 'separator' => '<br>']); ?>
    </h3>

    <h3>
    <?= $form->field($model, 'type')->radioList(ArrayHelper::map(Type::find()->all(),
        'id', 'nameBoth'), ['class' => 'radio', 'separator' => '<br>']); ?>
    </h3>

    <h3>
    <?= $form->field($model, 'resident')->radioList(ArrayHelper::map(Resident::find()->all(),
        'id', 'nameBoth'), ['class' => 'radio', 'separator' => '<br>']); ?>
    </h3>

    <?= $form->field($model, 'children') ?>
    <?= $form->field($model, 'employee') ?>
    <?= $form->field($model, 'retiree') ?>
    <?= $form->field($model, 'dominant') ?>
    <?= $form->field($model, 'trash_man') ?>
    <?= $form->field($model, 'trash_out') ?>
    <?= $form->field($model, 'trash_count') ?>
    <?= $form->field($model, 'trash_count_summer') ?>
    <?= $form->field($model, 'trash_count_winter') ?>
    <?= $form->field($model, 'paper') ?>
    <?= $form->field($model, 'trash_relation') ?>
    <?= $form->field($model, 'trash_recycle') ?>
    <?= $form->field($model, 'person') ?>
    <?= $form->field($model, 'summer_count_1') ?>
    <?= $form->field($model, 'winter_count_1') ?>
    <?= $form->field($model, 'summer_count_2') ?>
    <?= $form->field($model, 'summer_count_3') ?>
    <?= $form->field($model, 'summer_count_4') ?>
    <?= $form->field($model, 'winter_count_2') ?>
    <?= $form->field($model, 'winter_count_3') ?>
    <?= $form->field($model, 'winter_count_4') ?>
    <?= $form->field($model, 'region') ?>
    <?= $form->field($model, 'answer_count') ?>
    <?= $form->field($model, 'woman_count') ?>
    <?= $form->field($model, 'date') ?>
    <?= $form->field($model, 'interrogatory') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-main -->
