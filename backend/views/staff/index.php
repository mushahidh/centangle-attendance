<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StaffSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Staff';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Staff', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
      
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'position',
            'gender',
            //'time_in',
             //'time_out',
             //'daydate',
              // 'created_date', 
            'working_days',
               [
                'label' => 'Proile picture',
                'format' => 'raw',
                'value' => function($model) {
                    $url = $model->getImageUrl();
                    //var_dump( $url);
                    return Html::img($url, ['alt' => 'yii', 'width' => '50', 'height' => '50']);
                }
                    ],
            
                             [
             'attribute'=>'Company',
            'value'=>'CompanyName',
            ],
                            
           
            // 'user_id',
            // 'company_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
