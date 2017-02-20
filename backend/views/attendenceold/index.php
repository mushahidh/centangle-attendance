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
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
                            [
             'attribute'=>'staff_id',
            'value'=>'StaffName',
            
            ],
            'status',
            'time_in',
            'time_out',
            'daytime',
            // 'staff_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
