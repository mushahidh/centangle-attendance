<?php
use yii\helpers\Html;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
use scotthuangzl\googlechart\GoogleChart;
?>
<?php if($lastcheck_in == True ){ ?>
<?= Html::a('Check in', ['checkin'], ['class' => 'btn btn-success']) ?>
<?php    
}else{ ?>
<?= Html::a('Check out', ['checkout'], ['class' => 'btn btn-success']) ?>

 <?php    
}


 echo GoogleChart::widget(array('visualization' => 'PieChart',
                'data' => array(
                    array('Task', 'Hours per Day'),
                    array('Work', 11),
                    array('Eat', 2),
                    array('Commute', 2),
                    array('Watch TV', 2),
                    array('Sleep', 7)
                ),
                'options' => array('title' => 'My Weekly Hours')));
 
  echo GoogleChart::widget(array('visualization' => 'PieChart',
                'data' => array(
                    array('Task', 'Hours per Day'),
                    array('Work', 11),
                    array('Eat', 2),
                    array('Commute', 2),
                    array('Watch TV', 2),
                    array('Sleep', 7)
                ),
                'options' => array('title' => 'My Monthly Hours')));
?>

