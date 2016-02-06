<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\City;
use app\models\Type;
use app\models\Dominant;
use app\models\TrashPlace;
use app\models\TrashMan;
use app\models\Paper;
use app\models\TrashRelation;
use app\models\TrashRecycle;
use app\models\Person;
use yii\web\JqueryAsset;

use kartik\date\DatePicker;


use app\components\LanguageHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Main */
/* @var $form ActiveForm */

$this->registerJsFile('js/scripts.js', ['depends' => [JqueryAsset::className()]]);
?>
<style>
    #main-recycles.radio label {
        width:50%;
    }
</style>
<div class="site-main">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'city', ['options' => ['class' => 'form-inline col-sm-10']])->dropDownList(
        ArrayHelper::map(
            City::find()->where([
                'region' => $region
            ])->all(),
            'id', 'nameBoth'),
        [
            'class' => 'col-sm-6 form-control'
        ])->label(null, ['class' => 'col-sm-4']); ?>
    
    <div class="clearfix"></div>
    <hr>
    <?= $form->field($model, 'type',
        ['options' => ['class' => 'form-inline col-sm-10']])
        ->radioList(
            ArrayHelper::map(Type::find()->all(),
                'id', 'nameBoth'),
            ['class' => 'radio col-sm-6', 'separator' => '<span style="padding-left: 30px;"></span>']
        )
        ->label(null, ['class' => 'col-sm-4']); ?>
    <div class="clearfix"></div>
    <hr>
    <?= $form->field($model, 'resident',
        ['options' => ['class' => 'form-inline col-sm-10']])
        ->label(null, ['class' => 'col-sm-4'])->textInput(['readonly'=>'readonly']); ?>
    <div class="clearfix"></div>

    <?= $form->field($model, 'resident_man',
        ['options' => ['class' => 'form-inline col-sm-10']])
        ->label(null, ['class' => 'col-sm-4'])->textInput(['class'=>'quantity form-control']); ?>
    <div class="clearfix"></div>

    <?= $form->field($model, 'resident_woman',
        ['options' => ['class' => 'form-inline col-sm-10']])
        ->label(null, ['class' => 'col-sm-4'])->textInput(['class'=>'quantity form-control']); ?>
    <div class="clearfix"></div>

    <?= $form->field($model, 'children',
        ['options' => ['class' => 'form-inline col-sm-10']])
        ->label(null, ['class' => 'col-sm-4'])->textInput(['class'=>'quantity form-control']); ?>
    <div class="clearfix"></div>

    <?= $form->field($model, 'employee',
        ['options' => ['class' => 'form-inline col-sm-10']])
        ->label(null, ['class' => 'col-sm-4'])->textInput(['class'=>'quantity form-control']); ?>
    <div class="clearfix"></div>

    <?= $form->field($model, 'retiree',
        ['options' => ['class' => 'form-inline col-sm-10']])
        ->label(null, ['class' => 'col-sm-4'])->textInput(['class'=>'quantity form-control']); ?>
    <div class="clearfix"></div>
    <hr>
    <?= $form->field($model, 'dominant',
        ['options' => ['class' => 'form-inline col-sm-10']])
        ->radioList(
            ArrayHelper::map(Dominant::find()->all(),
                'id', 'nameBoth'),
            ['class' => 'radio col-sm-6', 'separator' => '<span style="padding-left: 30px;"></span>']
        )
        ->label(null, ['class' => 'col-sm-4']); ?>
    <hr>
    <div class="clearfix"></div>
    <hr>
    <?= $form->field($model, 'places',
        ['options' => ['class' => 'form-inline col-sm-10']])
        ->checkboxList(
            ArrayHelper::map(TrashPlace::find()->all(),
                'id', 'nameBoth'), ['class' => 'radio col-sm-6', 'separator' => '<br>']
        )
        ->label(null, ['class' => 'col-sm-4']); ?>

    <div class="col-sm-2"></div>
    <div class="clearfix"></div>
    <hr>
    <?= $form->field($model, 'men',
        ['options' => ['class' => 'form-inline col-sm-10']])
        ->checkboxList(
            ArrayHelper::map(TrashMan::find()->all(),
                'id', 'nameBoth'), ['class' => 'radio col-sm-6', 'separator' => '<br>']
        )
        ->label(null, ['class' => 'col-sm-4']); ?>

    <div class="col-sm-2"></div>
    <div class="clearfix"></div>
    <hr>
    <?= $form->field($model, 'trash_out',
        ['options' => ['class' => 'form-inline col-sm-10']])
        ->label(null, ['class' => 'col-sm-4']); ?>
    <div class="clearfix"></div>

    <?= $form->field($model, 'trash_count',
        ['options' => ['class' => 'form-inline col-sm-10']])
        ->label(null, ['class' => 'col-sm-4']); ?>

    <div class="clearfix"></div>
    <hr>
    <div class="col-sm-12">
        <div class="col-sm-7">
            <div class="col-sm-8">Մոտավոր աղբի քանակը շաբաթում</div>
            <div class="col-sm-4">Ամռանը</div>
        </div>
        <div class="col-sm-3">Ձմռանը</div>

        <?= $form->field($model, 'summer_count_1',
            ['options' => ['class' => 'form-inline col-sm-7']])
            ->textInput(['class' => 'col-sm-4 form-control'])
            ->label(LanguageHelper::getSummerWinterNames(1, 'summer'), ['class' => 'col-sm-8']); ?>
        <?= $form->field($model, 'winter_count_1',
            ['options' => ['class' => 'form-inline col-sm-3']])
            ->textInput(['class' => 'form-control'])
            ->label(false); ?>


        <?= $form->field($model, 'summer_count_2',
            ['options' => ['class' => 'form-inline col-sm-7']])
            ->textInput(['class' => 'col-sm-4 form-control'])
            ->label(LanguageHelper::getSummerWinterNames(2, 'summer'), ['class' => 'col-sm-8']); ?>
        <?= $form->field($model, 'winter_count_2',
            ['options' => ['class' => 'form-inline col-sm-3']])
            ->textInput(['class' => 'form-control'])
            ->label(false); ?>

        <?= $form->field($model, 'summer_count_3',
            ['options' => ['class' => 'form-inline col-sm-7']])
            ->textInput(['class' => 'col-sm-4 form-control'])
            ->label(LanguageHelper::getSummerWinterNames(3, 'summer'), ['class' => 'col-sm-8']); ?>
        <?= $form->field($model, 'winter_count_3',
            ['options' => ['class' => 'form-inline col-sm-3']])
            ->textInput(['class' => 'form-control'])
            ->label(false); ?>

        <?= $form->field($model, 'summer_count_4',
            ['options' => ['class' => 'form-inline col-sm-7']])
            ->textInput(['class' => 'col-sm-4 form-control'])
            ->label(LanguageHelper::getSummerWinterNames(4, 'summer'), ['class' => 'col-sm-8']); ?>
        <?= $form->field($model, 'winter_count_4',
            ['options' => ['class' => 'form-inline col-sm-3']])
            ->textInput(['class' => 'form-control'])
            ->label(false); ?>
    </div>

    <?= $form->field($model, 'paper',
        ['options' => ['class' => 'form-inline col-sm-10']])
        ->radioList(
            ArrayHelper::map(Paper::find()->all(),
                'id', 'nameBoth'),
            ['class' => 'radio col-sm-6', 'separator' => '<span style="padding-left: 30px;"></span>']
        )
        ->label(null, ['class' => 'col-sm-4']); ?>

    <div class="clearfix"></div>
    <hr>
    <?= $form->field($model, 'relations',
        ['options' => ['class' => 'form-inline col-sm-12']])
        ->checkboxList(
            ArrayHelper::map(TrashRelation::find()->all(),
                'id', 'nameBoth'), ['class' => 'radio col-sm-8', 'separator' => '<br>']
        )
        ->label(null, ['class' => 'col-sm-4']); ?>

    <div class="clearfix"></div>
    <hr>
    <?= $form->field($model, 'recycles',
        ['options' => ['class' => 'form-inline col-sm-12']])
        ->checkboxList(
            ArrayHelper::map(TrashRecycle::find()->all(),
                'id', 'nameBoth'), [
                'class' => 'radio col-sm-12',
                'separator' => '',
            ]
        )
        ->label(null, ['class' => 'col-sm-12']); ?>

    <div class="clearfix"></div>
    <hr>

    <?= $form->field($model, 'answer_count',
        ['options' => ['class' => 'form-inline col-sm-6']])
        ->textInput(['class' => 'col-sm-6 form-control'])
        ->label(null, ['class' => 'col-sm-6']); ?>

    <?= $form->field($model, 'woman_count',
        ['options' => ['class' => 'form-inline col-sm-6']])
        ->textInput(['class' => 'col-sm-6 form-control'])
        ->label(null, ['class' => 'col-sm-6']); ?>
    <div class="clearfix"></div>

    <?= $form->field($model, 'person', ['options' => ['class' => 'form-inline col-sm-4']])->dropDownList(
        ArrayHelper::map(
            Person::find()->all(),
            'id', 'nameBoth'),
        [
            'class' => 'form-control'
        ])->label(null, ['class' => 'col-sm-4']); ?>

    <?= $form->field($model, 'date',
        ['options' => ['class' => 'form-inline col-sm-4']])
        ->textInput(['class' => 'form-control'])
        ->label(null, ['class' => 'col-sm-4'])
        ->widget(DatePicker::className(),['pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]])
    ; ?>

    <?= $form->field($model, 'interrogatory',
        ['options' => ['class' => 'form-inline col-sm-4']])
        ->textInput(['class' => 'form-control'])
        ->label(null, ['class' => 'col-sm-4']); ?>

    <div class="clearfix"></div>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-main -->
