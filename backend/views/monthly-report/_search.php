<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MonthlyReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="monthly-report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'staff_id') ?>

    <?= $form->field($model, 'total_office_days') ?>

    <?= $form->field($model, 'total_present') ?>

    <?= $form->field($model, 'allowed_vocation') ?>

    <?php // echo $form->field($model, 'vocation_used') ?>

    <?php // echo $form->field($model, 'vocation_left') ?>

    <?php // echo $form->field($model, 'extra_vocation') ?>

    <?php // echo $form->field($model, 'fine') ?>

    <?php // echo $form->field($model, 'date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
