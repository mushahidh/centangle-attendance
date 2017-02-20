<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\HolidaysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="holidays-index">
    <div class="row">
        <div class="col-md-6"></div>
          <div class="col-md-2"></div>
        <div class="col-md-4 abc">
            <h3>Select the month to show the Report</h3>
  <?php
    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
                'action' => ['attendence/permonthreport'],
                    ]
    );
           echo DatePicker::widget([
                'name' => 'mounth',
                
                'value' => date('Y-m'),
                'options' => ['placeholder' => 'Select issue date ...'],
                'pluginOptions' => [
                  'autoclose' => true,
                        'startView'=>'year',
                        'minViewMode'=>'months',
                        'format' => 'yyyy-mm'
                ]
            ]);
    ?>
             <?php ActiveForm::end(); ?>
        </div>
    </div>
    <?php 
    $dateObj   = DateTime::createFromFormat('!m', $month);
$monthName = $dateObj->format('F');

    ?>
    <h1>No MONTHLY Report for <?php echo $monthName;?> &nbsp; <?php echo $year; ?> </h1>
  
</div>>