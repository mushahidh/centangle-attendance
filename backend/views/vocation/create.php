<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\vocation */

$this->title = 'Create Vocation';
$this->params['breadcrumbs'][] = ['label' => 'Vocations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vocation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
