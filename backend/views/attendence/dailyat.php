<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Attendence;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AttendenceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Attendences';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="attendence-index">
   <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
       'action' => ['site/index'],
       ]
           
           ); ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
  
        <div class="col-md-3">
           <h3> Date</h3>
        </div>
        <div class="col-md-3">
           <h3> Present</h3>
        </div>
           <div class="col-md-3">
           <h3> Aresent</h3>
        </div>
           <div class="col-md-3">
        </div>
    </div>
     <div class="row">
  
         
         
         
        <?php

    $attendence_present = (new \yii\db\Query())
    ->select(['daytime,count(case when status = 1  then 1 end) as present_count, count(case when status = 0 then 0 end) as absent_count '])
    ->from('attendence')

->groupBy(['daytime'])
    ->limit(10)->all();
var_dump($attendence_present);



        ?>
        <div class="col-md-3">
           <h3> <?= date('Y-m-d'); ?></h3>
        </div>
        <div class="col-md-3">
           <h3> <?php //['presents'] ?></h3>
        </div>
           <div class="col-md-3">
           <h3> <?= $attendence_absent['absents'] ?></h3>
        </div>
           <div class="col-md-3">
         <button class="btn btn-primary">Update</button>
        </div>
    </div>

      <?php ActiveForm::end(); ?>
</div>
