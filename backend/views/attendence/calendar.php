<?php
use kartik\dialog\Dialog;
use backend\models\Attendence;
     $resultData = (new \yii\db\Query())
                ->select(['id,daytime ,count(case when status = 1  then 1 end) as present_count, count(case when status = 0 then 0 end) as absent_count '])
                ->from('attendence')
                ->groupBy(['daytime'])
             ->where("is_offical = 1")
                ->orderBy('daytime DESC')
                ->all();
     $events = array();
        foreach ($resultData as $resultDatar)
        {
          $Event = new \yii2fullcalendar\models\Event();
  $Event->id = $resultDatar['id'];
  $Event->title =  'Present = '.$resultDatar['present_count'] .' Absent ='.$resultDatar['absent_count'];
  
  $Event->start = $resultDatar['daytime'];
  
  $events[] = $Event;    
        }
  //Testing



  ?>

  <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
      'events'=> $events,
     'clientOptions' => [
        'weekends' => true,
        'editable' => true,
   
      ],
  ));
  echo Dialog::widget();
  ?>


<script>
$(function() {
   $(".abc #w1").change(function() {
     $("form").submit();
   });
  
   $("html").delegate(".update", "click", function () {
    var id_date = this.id;
  var url= '<?php echo Yii::$app->urlManager->createUrl(['attendence/update']);?>' + '&id_date='+encodeURI(id_date);
    window.location.href=url;

})
 $( "body" ).delegate(".fc-agendaWeek-view .fc-event","click", function() {
     
        var clicked_td=$(this).parent();
         var clicked_col = clicked_td.parent().children().index(clicked_td);
        
       var selectedDate =  clicked_td.closest("tbody").parent().closest("tbody").siblings().closest("thead").find("thead").children().children().eq(clicked_col).attr('data-date');
         
       // var url="http://localhost/yii-application/backend/web/index.php?r=attendence%2Fupdate&id_date="+ selectedDate;  
       // window.location.href=url;
      // $('#myModal').modal('show');
   
 
$.ajax({
                type: "POST",
                url: "<?php echo Yii::$app->getUrlManager()->createUrl('attendence/ajax')  ; ?>",
                data: {test: selectedDate},
                success: function (test) {
                                       krajeeDialog.dialog(
        test,
        function (result) {}
    );
   

                },
                error: function (exception) {
                    alert(exception);
                }
            });

        });

    $( "body" ).delegate(".fc-month-view .fc-event","click", function() {
        
        var clicked_td=$(this).parent();
         var clicked_col = clicked_td.parent().children().index(clicked_td);
         var selectedDate=clicked_td.parent().parent().siblings().children().children().eq(clicked_col).attr('data-date');
       // var url="http://localhost/yii-application/backend/web/index.php?r=attendence%2Fupdate&id_date="+ selectedDate;  
       // window.location.href=url;
      // $('#myModal').modal('show');
     
 
$.ajax({
                type: "POST",
                url: "<?php echo Yii::$app->getUrlManager()->createUrl('attendence/ajax')  ; ?>",
                data: {test: selectedDate},
                success: function (test) {
                           krajeeDialog.dialog(
        test,
        function (result) {}
    );
            

                },
                error: function (exception) {
                    alert(exception);
                }
            });
      

        });
        
   
    

 });
</script>
