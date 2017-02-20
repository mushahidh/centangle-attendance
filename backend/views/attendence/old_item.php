<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model backend\models\Attendence */

?>
<div class="row">
    <div class="col-md-3">
         <?= Html::a('Current Reoprt', ['/attendence/currentreport'], ['class'=>'btn btn-primary']) ?>
    </div>
    <div class="col-md-3">
        <?= Html::a('Create Attendence', ['/attendence/dailyat'], ['class'=>'btn btn-primary']) ?>
       
    </div>
       <div class="col-md-3">
        <?= Html::a('Monthly Report', ['/attendence/monthlywisereport'], ['class'=>'btn btn-primary']) ?>
       
    </div>
          <div class="col-md-3">
        <?= Html::a('Create Staff', ['/staff/index'], ['class'=>'btn btn-primary']) ?>
       
    </div>
</div>

     <?=  GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           // 'id',
            'daytime',

            [
            'attribute' => 'present_count', 
            'value' => 'present_count',
            ],
            [
            "attribute" => "absent_count",
            'value' => 'absent_count',
            ],
            
             ['class' => 'yii\grid\ActionColumn',
                 'template' => '{delete}{edit}',
    'buttons' => [
        'edit' => function ($url, $model) {
            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                        'title' => Yii::t('app', 'edit'),
                  'data-method' => 'post',
                'data-pjax' => true,
            ]);
        }
    ],
    'urlCreator' => function ($action, $model, $key, $index) {
        if ($action === 'edit') {
             $url = \yii\helpers\Url::toRoute(['attendence/update', 'id_date' => $key]);
            return $url;
        }
          else if ($action === 'delete') {
             $url = \yii\helpers\Url::toRoute(['attendence/delete', 'id_date' => $key]);
            return $url;
        }
       
    }
                 ],
            

    ]
]);
?>

</div>
