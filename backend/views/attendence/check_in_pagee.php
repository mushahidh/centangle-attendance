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
  <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
       'action' => ['attendence/markindividualattendance'],
       ]
           
           ); ?>
  
 <table class="table table-striped">
    <thead>
      <tr>
        <th>Checkin</th>
        <th>Checkout</th>
       
      </tr>
    </thead>
    <tbody>
        <tr>
        <?php if($check_in_att_id)
            { ?>
            <td></td>
            <?php
            }else{?>
            <td><button name="submit" value="0" class="btn btn-primary">Checkin</button></td>
          <?php  }?>
           
                <td><button name="submit" value="1" class="btn btn-primary">Checkout</button></td>
        </tr>
    </tbody>
    </table>
<?php ActiveForm::end(); ?>