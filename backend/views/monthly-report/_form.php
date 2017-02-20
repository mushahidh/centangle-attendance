<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MonthlyReport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="monthly-report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'staff_id')->textInput() ?>

    <?= $form->field($model, 'total_office_days')->textInput() ?>

    <?= $form->field($model, 'total_present')->textInput() ?>

    <?= $form->field($model, 'allowed_vocation')->textInput() ?>

    <?= $form->field($model, 'vocation_used')->textInput() ?>

    <?= $form->field($model, 'vocation_left')->textInput() ?>

    <?= $form->field($model, 'extra_vocation')->textInput() ?>

    <?= $form->field($model, 'fine')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
