<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AttendenceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Attendences';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendence-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Attendence', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'daytime',
            [
    'attribute' => 'Present',
    'format' => 'raw',
    'value' => function ($model) {
         $attendence_present = (new \yii\db\Query())
    ->select(['count(*) as presents'])
    ->from('attendence')
    ->limit(10)->one();

        return $attendence_present['presents'];
    },
],
           

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
