<?php

use backend\models\Staff;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\time\TimePicker;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?php
    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
                'action' => ['attendence/mark'],
                    ]
    );
    ?>
    <div class="row">

        <div class="col-md-4 col-md-offset-2"> <?php
            echo DatePicker::widget([
                'name' => 'daytime',
                'value' => $day_time,
                'options' => ['placeholder' => 'Select issue date ...'],
                'pluginOptions' => [
                    'format' => 'dd-M-yyyy',
                    'todayHighlight' => true,
                    'autoclose' => true,
                ]
            ]);
            ?></div>
                <div class="col-md-4"> 
                <div class="col-md-6">
                Official Day
                </div>
                 <div class="col-md-6">
                <input name='is_offical' type="checkbox" checked>
                </div>
          </div>
    </div>
        <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>  Status
             <input type="checkbox" id="checkAll"/ /></th>
        <th> Time In</th>
        <th>Time Out</th>        
      </tr>
    </thead>
    <tbody>
           <?php
    $resultu = $resultupData;

    foreach ($resultu as $resultup) {
        ?> 
        
             <tr>
        <td> <input type="hidden"  name="E[<?php echo $resultup['id']; ?>][id]"   value="<?php echo $resultup['name'] ?>" /><?php echo $resultup['name']; ?>
            </td>    
             <td> <input type="checkbox" <?php if($resultup['status'] == 1){echo 'checked="checked"';} ?> name="E[<?php echo $resultup['id']; ?>][status]" />
 </td>   
                  <td>         <?=
                TimePicker::widget([
                    'name' => 'E[' . $resultup['id'] . '][time_in]',
                    'value' => $resultup['timein'],
                    'pluginOptions' => [
                        'showSeconds' => true
                    ]
                ]);
                ?> </td>   
                       <td>         <?=
                TimePicker::widget([
                    'name' => 'E[' . $resultup['id'] . '][time_out]',
                    'value' => $resultup['time_out'],
                    'pluginOptions' => [
                        'showSeconds' => true
                    ]
                ]);
                ?> </td>   
       </tr>
           <?php } ?>
    </tbody>
        </table>
   
    <script>
    $("#checkAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});

    </script>
    <button class="btn btn-primary">Update</button>
<?php ActiveForm::end(); ?>

</div>
