<?php
namespace backend\controllers;

use Yii;
use backend\models\Calendar;
use yii\web\Controller;
use backend\models\CalendarSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
class CalendarController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new CalendarSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

// get the posts in the current page

    
        return $this->render('index', [
                'dataProvider' => $dataProvider
            ]);
    }
}