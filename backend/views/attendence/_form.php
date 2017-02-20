<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use backend\models\Staff;


/* @var $this yii\web\View */
/* @var $model backend\models\Attendence */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attendence-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>
      <?=
        $form->field($model, 'time_in')->widget(TimePicker::classname(), [
            'name' => 'time_in',
            'addonOptions' => [
                'asButton' => true,
                'containerOptions' => ['class' => 'has-warning']
            ],
            'pluginOptions' => [
                'showMeridian' => true,
                'minuteStep' => 5,
            ]
        ]);
        ?>
        <?=
        $form->field($model, 'time_out')->widget(TimePicker::classname(), [
            'name' => 'time_out',
            'addonOptions' => [
                'asButton' => true,
                'buttonOptions' => ['class' => 'btn btn-info'],
            ],
            'pluginOptions' => [
                'showMeridian' => true,
                'minuteStep' =>5,
            ]
        ]);
        ?>
   
       <?=
        $form->field($model, 'daytime')->widget(DatePicker::className(), [
            'name' => 'daydate',
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-m-dd'
            ]
        ]);
        ?>



    <?= $form->field($model, 'staff_id')->dropDownList(ArrayHelper::map(Staff::find()->all(),'id','name'),['prompt' => 'Select Member']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
