<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\WorkingHoursSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Working Hours';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="working-hours-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Working Hours', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'attendence_id',
            'check_in',
            'check_out',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
