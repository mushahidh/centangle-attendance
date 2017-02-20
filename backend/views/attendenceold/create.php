<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Attendence */

$this->title = 'Create Attendence';
$this->params['breadcrumbs'][] = ['label' => 'Attendences', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendence-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
