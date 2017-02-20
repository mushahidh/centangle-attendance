<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use backend\models\Company;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\Staff */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-form">
 <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="col-md-6">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female', ], ['prompt' => '']) ?>

        

  
   <?= $form->field($model, 'salary')->textInput() ?>

     <?= $form->field($model, 'file')->fileInput() ?>
    </div>
    <div class="col-md-6">
      <?= $form->field($model, 'working_days')->dropDownList([ 24 => '24', 20 => '20', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->all(),'id','username'),['prompt' => 'Select Company']) ?>

 <?= $form->field($model, 'company_id')->dropDownList(ArrayHelper::map(Company::find()->all(),'id','name'),['prompt' => 'Select Company']) ?>
   
           <?=
        $form->field($model, 'created_date')->widget(DatePicker::className(), [
            'name' => 'created_date',
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-m-dd'
            ]
        ]);
        ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
