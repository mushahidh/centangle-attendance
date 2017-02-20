<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MonthlyReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Monthly Reports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monthly-report-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Monthly Report', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'staff_id',
            'total_office_days',
            'total_present',
            'allowed_vocation',
            // 'vocation_used',
            // 'vocation_left',
            // 'extra_vocation',
            // 'fine',
            // 'date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
