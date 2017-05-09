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
                'value' => date('Y-m-d'),
                'options' => ['placeholder' => 'Select issue date ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
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
             <input type="checkbox" id="checkAll"/></th>
        <th>Working From Home</th>
        <th> Time In</th>
        <th>Time Out</th>        
      </tr>
    </thead>
    <tbody>
        
    <?php
    $staf = Staff::find()
            ->all();

    foreach ($staf as $staff) {
        ?>
         <tr>
        <td>  <input type="hidden"  name="E[<?php echo $staff->id; ?>][id]"  name="<?php echo $staff->name; ?>" value="<?php echo $staff->id; ?>" /><?php echo $staff->name; ?></td>
        <td> <input type="checkbox" class="status" id="check<?php echo $staff->id; ?>" name="E[<?php echo $staff->id; ?>][status]" />
</td>
 <td> <input type="checkbox"  id="check<?php echo $staff->id; ?>" name="E[<?php echo $staff->id; ?>][working_home]" />
</td>
        <td>         <?=
                TimePicker::widget([
                    'name' => 'E[' . $staff->id . '][time_in]',
                    'value' => '9:00 AM',
                    'options' => ['class' => 'recent_time'],
                    'pluginOptions' => [
                        'showSeconds' => true
                    ]
                ]);
                ?></td>
        <td>        <?=
                TimePicker::widget([
                    'name' => 'E[' . $staff->id . '][time_out]',
                    'value' => '5:00 AM',

                    'pluginOptions' => [
                        'showSeconds' => true
                    ]
                ]);
                ?></td>
       
      </tr>
         <?php } ?>
    </tbody>
    </table>

   
    <button class="btn btn-primary">Save</button>
      <script>
    $("#checkAll").change(function () {
    $(".status").prop('checked', $(this).prop("checked"));
});




    </script>

    <?php ActiveForm::end(); ?>

</div>

<script>
    
    
  $('.status').click(function(){
     
 
         var currentdate = new Date(); 
           var datetime =currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds();
                if(currentdate.getHours() < 12)
                {
                    datetime + 'AM';
                }
                else
                {
                    datetime + 'PM';
                }
                //alert($(this).text());
          $(this).parent().parent().children().find('.recent_time').val(datetime);
                 
    
});

</script>