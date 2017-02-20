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
    <h1>Monthly Report of <?php echo $monthName;?> &nbsp; <?php echo $year; ?> </h1>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Total Office Days</th>
        <th>Total Present</th>
        <th>Allowed Vacation</th>
           <th>Vacation Used</th>
              <th>Vacation Left</th>
                 <th>Extra Vacation</th>
                    <th>Fine</th>
      </tr>
    </thead>
    <tbody>
             <?php 
          foreach ($monthlyreportlaba as $monthlyreportlabal) { 
        ?>
      <tr>
        <td>   <?php echo $monthlyreportlabal['name']; ?></td>
        <td> <?php echo $monthlyreportlabal['total_office_days']; ?></td>
        <td>   <?php echo $monthlyreportlabal['total_present']; ?></td>
        <td> <?php echo $monthlyreportlabal['allowed_vocation']; ?></td>
         <td>   <?php echo $monthlyreportlabal['vocation_used']; ?></td>
          <td>     <?php echo $monthlyreportlabal['vocation_left']; ?></td>
           <td> <?php echo $monthlyreportlabal['extra_vocation']; ?></td>
            <td>   <?php $a = $monthlyreportlabal['fine']; 
                      $newa = number_format($a, 2); // Round to two places
echo $newa;
                 ?></td>
      </tr>
     <?php } ?>
    </tbody>
    </table>
 
   
          
</div>
