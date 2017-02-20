<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Attendence */

$this->title = 'Update Attendence: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Attendences', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="attendence-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
