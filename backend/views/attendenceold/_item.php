<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model backend\models\Attendence */

?>

     <?=  GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'daytime',

            [
            'attribute' => 'present_count', 
            'value' => 'present_count',
            ],
            [
            "attribute" => "absent_count",
            'value' => 'absent_count',
            ],
      
             ['class' => 'yii\grid\ActionColumn'],

    ]
]);
?>

</div>
