<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use backend\models\Staff;

/* @var $this yii\web\View */
/* @var $model backend\models\Holidays */
/* @var $form yii\widgets\ActiveForm */
?>
'1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16'
<div class="holidays-form">

    <?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'staff_id')->dropDownList(ArrayHelper::map(Staff::find()->all(),'id','name'),['prompt' => 'Select Member']) ?>
    
  
         <?=
        $form->field($model, 'starting_date')->widget(DatePicker::className(), [
            'name' => 'month_date',
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-m-dd'
            ]
        ]);
        ?>
            <?=
        $form->field($model, 'ending_date')->widget(DatePicker::className(), [
            'name' => 'month_date',
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-m-dd'
            ]
        ]);
        ?>
  <?= $form->field($model, 'allowed_holiday')->dropDownList([ 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10', 11 => '11', 12 => '12', 13 => '13', 14 => '14', 15 => '15', 16 => '16', ], ['prompt' => 'Select Days']) ?>

   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
