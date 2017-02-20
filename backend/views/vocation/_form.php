<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\vocation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vocation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'leave_start')->textInput() ?>

    <?= $form->field($model, 'leave_end')->textInput() ?>

    <?= $form->field($model, 'vocation_days')->textInput() ?>

    <?= $form->field($model, 'staff_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
