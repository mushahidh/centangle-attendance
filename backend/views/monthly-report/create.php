<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MonthlyReport */

$this->title = 'Create Monthly Report';
$this->params['breadcrumbs'][] = ['label' => 'Monthly Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monthly-report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
