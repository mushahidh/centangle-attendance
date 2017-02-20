<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\HolidaysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="holidays-index">

    <h1>Current Report</h1>
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
        
          foreach ($resultupDataholiday as $resultupDataholidays) { 
            
              $temp_working_days = $total_working_days;
              
              //$alloweid = '';
              //$alloweid = $resultupDataholidays['id'];
                //  $allowed_vocation = (new \yii\db\Query())
                //->select('allowed_holiday')
               // ->from('holidays')
               // ->where("MONTH(starting_date) = Month(NOW()) AND staff_id = $alloweid ")               
               // ->one();
    // if($allowed_vocation){
         
        // $allowed_vocation_int = (int)($allowed_vocation['allowed_holiday']) ;
      
        //  $allowed = 2 + $allowed_vocation_int;
     //}else{
        //  $allowed = 2;
    // }
         $allowed = 2;
                  
         ?>
        <tr>
            <td>  <?php echo $resultupDataholidays['name']; ?></td>
             <td> <?php if ($resultupDataholidays['working_days'] == 24){
                 //code for the employee above date
                            //  $cde = $resultupDataholidays['created_date'];
            //  $d = date_parse_from_format("Y-m-d", $cde);
            //$c = $d["month"];
             // $today = date('Y-m-01');
            //$t = date_parse_from_format("Y-m-d", $today);
           // $e = $t["month"];
           // if($c == $e){
          // $start = new DateTime($cde);
//$end = new DateTime($today);
//$days = $start->diff($end, true)->days;

//$sundays = intval($days / 7) + ($start->format('N') + $days % 7 >= 7);

  //$difff = $start->diff($end)->format("%a");
  //$diff = (int) $difff;

//$notemp = $diff - $sundays;
 //echo  $temp_working_days = $temp_working_days - $notemp;
 
          //  }else{
        
             echo  $temp_working_days;  
            
            
             }
               
            
             else{
        
                echo $temp_working_days - $saturdays_current_are; 
           
             }
             ?>
       </td>
              <td><?php echo $resultupDataholidays['present_count']; ?></td>
               <td>   <?php echo $allowed; ?></td>
                <td><?php 
             //$cde = $resultupDataholidays['present_count'];
             // $d = date_parse_from_format("Y-m-d", $cde);
           // $c = $d["month"];
            //  $today = date('Y-m-d');
           // $t = date_parse_from_format("Y-m-d", $today);
           // $e = $t["month"];
           // if($c == $e){
            //    $total = $resultupDataholidays['present_count']; 
            // $total_at = $total + $allowed; 
             
           // }
             $total = $resultupDataholidays['present_count']; 
             $total_at = $total + $allowed;
               if ($resultupDataholidays['working_days'] == 24){
               $total_working =  $temp_working_days;
             } 
             else{
                $total_working = $temp_working_days - $saturdays_current_are; 
             }
            
             if($total_at > $total_working ){
               $used = $total_at - $total_working;
               if($used == 1){
                    echo 1; 
               }else
              echo 0;        
             }
             else if($total_at == $total_working){
                 echo 2;
             }
                  else if($total_at < $total_working){
                      $extra_at = $total_working - $total_at;
                    echo 2;
             }
             ?></td>
                 <td>  <?php $total = $resultupDataholidays['present_count']; 
             $total_at = $total + $allowed;
                 if ($resultupDataholidays['working_days'] == 24){
               $total_working =  $total_working_days;
             } 
             else{
                $total_working = $total_working_days - $saturdays_current_are; 
             }
             if($total_at < $total_working ){
                  $extra_at = $total_working - $total_at;
                   echo 0;
             }
             else if($total_at == $total_working){
                 echo 0;
             }
                  else if($total_at > $total_working){
                      $extra_at = $total_at - $total_working;
                      if($extra_at == 1){
                 echo 1;
                      }else{
                      echo 2;    
                      }
             }?></td>
                  <td>         <?php $f = $resultupDataholidays['salary']/$resultupDataholidays['working_days'];
              $fine = $f/2;
              $total = $resultupDataholidays['present_count']; 
             $total_at = $total + $allowed;
                 if ($resultupDataholidays['working_days'] == 24){
               $total_working =  $temp_working_days;
             } 
             else{
                $total_working = $temp_working_days - $saturdays_current_are; 
             }
             if($total_at < $total_working){
                 
               echo  $flageya = $total_working - $total_at;
                  
             }else{
                 echo 0;
             }
              ?></td>
                   <td> <?php $f = $resultupDataholidays['salary']/$resultupDataholidays['working_days'];
              $fine = $f/2;
              $total = $resultupDataholidays['present_count']; 
             $total_at = $total + $allowed;
                 if ($resultupDataholidays['working_days'] == 24){
               $total_working =  $temp_working_days;
             } 
             else{
                $total_working = $temp_working_days - $saturdays_current_are; 
             }
             if($total_at < $total_working){
                 
                $flageya = $total_working - $total_at;
                  $total_fine = $flageya *  $fine;
                  $newa = number_format($total_fine, 2); // Round to two places
echo $newa;
                  
             }
             else{
                 echo 0;
             }
              ?></td>
        </tr> 
           <?php 
          
          $temp_working_days = '';
             } ?>
    </tbody>
    </table>

 
</div>
