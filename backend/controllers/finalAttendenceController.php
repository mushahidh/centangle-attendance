<?php

namespace backend\controllers;

use Yii;
use backend\models\Attendence;
use backend\models\MonthlyReport;
use backend\models\AttendenceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Staff;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;

/**
 * AttendenceController implements the CRUD actions for Attendence model.
 */
class AttendenceController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Attendence models.
     * @return mixed
     */
    public function actionIndex() {
        $resultData = (new \yii\db\Query())
                ->select(['id,daytime ,count(case when status = 1  then 1 end) as present_count, count(case when status = 0 then 0 end) as absent_count '])
                ->from('attendence')
                ->groupBy(['daytime'])
                ->orderBy('daytime DESC')
                ->all();

        $dataProvider = new ArrayDataProvider([
            'key' => 'daytime',
            'allModels' => $resultData,
            'pagination' => [
                'pageSize' => 31,
            ],
            'sort' => [
                'attributes' => ['daytime', 'present_count', 'absent_count'],
            ],
        ]);
        return $this->render('_item', [
                    //'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCurrentreport() {
        $resultsaturdays = (new \yii\db\Query())
                ->select('DAYOFWEEK(daytime) as saturday')
                ->from('attendence')
                ->where("MONTH(daytime) = Month(NOW())")
                ->groupBy(['daytime'])
                ->all();
        $i = 0;
        foreach ($resultsaturdays as $resultsaturday) {


            if ($resultsaturday['saturday'] == 7) {
                $i = $i + 1;
            }
        }
        $saturdays_current_are = $i;

        $resultupcurrentdays = (new \yii\db\Query())
                ->select('daytime as current_month_days')
                ->from('attendence')
                ->where("MONTH(daytime) = Month(NOW())")
                ->groupBy(['daytime'])
                ->all();
        $total_working_days = count($resultupcurrentdays);

        $resultupDataholiday = (new \yii\db\Query())
                ->select('count(attendence.status) as present_count,staff.name,staff.working_days,staff.salary,staff.created_date')
                ->from('attendence')
                ->innerJoin('staff', 'attendence.staff_id = staff.id')
                ->where("attendence.status = 1 AND attendence.daytime >= '" . date('Y-m-01') . "'  AND attendence.daytime <= '" . date('Y-m-31') . "' ")
                ->groupBy(['staff.name'])
                ->all();

        return $this->render('currentreports', ['resultupDataholiday' => $resultupDataholiday, 'total_working_days' => $total_working_days, 'saturdays_current_are' => $saturdays_current_are]);
    }

    public function actionDatewise_attendence() {
        $searchModel = new AttendenceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('datewise_attendence', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDailyat() {
        return $this->render('index');
    }

    public function actionMarkupdate() {

        $this->render('/site/index');
    }

    /**
     * Displays a single Attendence model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Attendence model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Attendence();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function actionPermonthreport() {
        $m = $_POST['mounth'];
        $dd = date_parse_from_format("Y-m", $m);
        $month = $dd["month"];
        $year = $dd["year"];




        $monthlyreportlaba = (new \yii\db\Query())
                ->select('monthly_report.total_office_days,monthly_report.total_present,monthly_report.allowed_vocation,monthly_report.vocation_used,monthly_report.vocation_left,monthly_report.extra_vocation,monthly_report.fine,monthly_report.date,staff.name')
                ->from('monthly_report')
                ->innerJoin('staff', 'monthly_report.staff_id = staff.id')
                ->where("MONTH(date) =  $month AND YEAR(date) = $year ")
                ->groupBy(['staff.name'])
                ->all();

        if (empty($monthlyreportlaba)) {
            return $this->render('nomonthwisereport', ['year' => $year, 'month' => $month]);
        } else {
            return $this->render('monthwisereport', ['monthlyreportlaba' => $monthlyreportlaba, 'year' => $year, 'month' => $month]);
        }
    }

    public function actionMonthlywisereport() {
        $pmonth = date('Y-m-d', strtotime('first day of last month'));

        $last = date_parse_from_format("Y-m-d", $pmonth);

        $last_month = $last["month"];
        $monthlyreportlaball = (new \yii\db\Query())
                ->select('monthly_report.total_office_days,monthly_report.total_present,monthly_report.allowed_vocation,monthly_report.vocation_used,monthly_report.vocation_left,monthly_report.extra_vocation,monthly_report.fine,monthly_report.date,staff.name')
                ->from('monthly_report')
                ->innerJoin('staff', 'monthly_report.staff_id = staff.id')
                ->where("MONTH(date) = $last_month")
                ->groupBy(['staff.name'])
                ->all();


        return $this->render('monthlyreport', ['monthlyreportlaball' => $monthlyreportlaball]);
    }

    public function actionMark() {
        $attendence_date = $_POST['daytime'];
        $attend_dat_format = date_parse_from_format("Y-m-d", $attendence_date);
        $attend_dat_month = $attend_dat_format["month"];
        $today_dat = date('Y-m-d');

        $today_dat_format = date_parse_from_format("Y-m-d", $today_dat);
        $today_dat_month = $today_dat_format["month"];
        if ($attend_dat_month == $today_dat_month) {
            $model = new Attendence();
            $monthly_report = new MonthlyReport();

            if (Yii::$app->request->post()) {
                \Yii::$app
                        ->db
                        ->createCommand()
                        ->delete('attendence', ['daytime' => $_POST['daytime']])
                        ->execute();
                $staf = Staff::find()
                        ->all();
                //var_dump($_POST);

                $yesteday = date('Y-m-d', strtotime('yesterday'));
                $d = date_parse_from_format("Y-m-d", $yesteday);
                $c = $d["month"];
                // $c = 6;
                $today = date('Y-m-d');
                $t = date_parse_from_format("Y-m-d", $today);
                $e = $t["month"];
                //$e = 10;
                if ($c == $e) {
                    $command = Yii::$app->db->createCommand()
                            ->delete('monthly_report', 'MONTH(date) = MONTH(NOW())')
                            ->execute();
                }

                foreach ($staf as $staff) {
                    $model->isNewRecord = true;
                    $model->id = null;
                    $model->staff_id = $staff->id;
                    if (isset($_POST['E'][$staff->id]['status'])) {
                        $model->status = TRUE;
                    } else
                        $model->status = FALSE;
                    $model->time_in = $_POST['E'][$staff->id]['time_in'];
                    $model->time_out = $_POST['E'][$staff->id]['time_out'];

                    $model->daytime = $_POST['daytime'];

                    if ($model->save(false)) {

                        $resultupDataholida = (new \yii\db\Query())
                                ->select('count(attendence.status) as present_count,staff.name,staff.working_days,staff.salary,staff.created_date')
                                ->from('attendence')
                                ->innerJoin('staff', 'attendence.staff_id = staff.id')
                                ->where("attendence.status = 1 AND attendence.daytime >= '" . date('Y-m-01') . "'  AND attendence.daytime <= '" . date('Y-m-31') . "' AND staff.id = $staff->id")
                                ->groupBy(['staff.name'])
                                ->one();

                        $resultupcurrentday = (new \yii\db\Query())
                                ->select('daytime as current_month_days')
                                ->from('attendence')
                                ->where("MONTH(daytime) = Month(NOW()) AND attendence.staff_id = $staff->id")
                                ->groupBy(['daytime'])
                                ->all();
                        $total_working_day = count($resultupcurrentday);
                        $resultsaturdays = (new \yii\db\Query())
                                ->select('DAYOFWEEK(daytime) as saturday')
                                ->from('attendence')
                                ->where("MONTH(daytime) = Month(NOW())  AND attendence.staff_id = $staff->id")
                                ->groupBy(['daytime'])
                                ->all();
                        $s = 0;
                        foreach ($resultsaturdays as $resultsaturday) {


                            if ($resultsaturday['saturday'] == 7) {
                                $s = $s + 1;
                            }
                        }
                        $saturdays_current_ar = $s;



                        //calculate staff monthly report
                        //Total Office Days of this staff $total_days
                        //Total Present of this staff $presents
                        // $e = 10;
                        if ($c == $e) {
                            $pmonth = date('Y-m-d', strtotime('first day of last month'));

                            $last = date_parse_from_format("Y-m-d", $pmonth);

                            $last_month = $last["month"];

                            $vocation_left_inprevious = (new \yii\db\Query())
                                    ->select('vocation_left')
                                    ->from('monthly_report')
                                    ->where("MONTH(date) = $last_month  AND monthly_report.staff_id = $staff->id")
                                    ->one();

                            if ($vocation_left_inprevious === false) {
                                $vocation_left = 0;
                            } else {
                                $vocation_left = $vocation_left_inprevious['vocation_left'];
                            }
                        } else {
                            $pmonth = date('Y-m-d', strtotime('first day of last month'));

                            $last = date_parse_from_format("Y-m-d", $pmonth);

                            $last_month = $last["month"];

                            $vocation_left_inprevious = (new \yii\db\Query())
                                    ->select('vocation_left')
                                    ->from('monthly_report')
                                    ->where("MONTH(date) = MONTH($pmonth)  AND monthly_report.staff_id = $staff->id")
                                    ->one();
                            if ($vocation_left_inprevious === false) {
                                $vocation_left = 0;
                            } else {
                                $vocation_left = $vocation_left_inprevious['vocation_left'];
                            }
                        }
                        $allowed = 2 + $vocation_left;

                        $monthly_report->isNewRecord = true;
                        $monthly_report->id = NULL;
                        $monthly_report->staff_id = $staff->id;
                        $total = $resultupDataholida['present_count'];
                        // $total_at = $total + $allowed;
                        $total_at = $total;
                        $f = $resultupDataholida['salary'] / $resultupDataholida['working_days'];
                        $fine = $f / 2;
                        if ($resultupDataholida['working_days'] == 24) {
                            $staff_created_date = $resultupDataholida['created_date'];
                            $format_staff_created_date = date_parse_from_format("Y-m-d", $staff_created_date);
                            $month_staff_created_date = $format_staff_created_date["month"];
                            $current_month_first_date = date('Y-m-01');
                            $current_month_first_date_format = date_parse_from_format("Y-m-d", $current_month_first_date);
                            $current_monthu = $t["month"];
                            if ($month_staff_created_date == $current_monthu) {

                                $start = new \DateTime($staff_created_date);
                                $end = new \DateTime($current_month_first_date);
                                $days = $start->diff($end, true)->days;

                                $sundays = intval($days / 7) + ($start->format('N') + $days % 7 >= 7);
                                $difff = $start->diff($end)->format("%a");
                                $diff = (int) $difff;

                                $notemp = $diff - $sundays;

                                if ($total_working_day > $notemp) {
                                    $temp_working_days = $total_working_day - $notemp;
                                    $monthly_report->total_office_days = $temp_working_days;
                                    $total_working = $temp_working_days;
                                } else {
                                    $temp_working_days = $notemp - $total_working_day;
                                    $monthly_report->total_office_days = $temp_working_days;
                                    $total_working = $temp_working_days;
                                }
                            } else {
                                $monthly_report->total_office_days = $total_working_day;
                                $total_working = $total_working_day;
                            }
                        } else {
                            $nobod = $total_working_day - $saturdays_current_ar;
                            $monthly_report->total_office_days = $nobod;
                            $total_working = $total_working_day - $saturdays_current_ar;
                        }
                        if ($total_at > $total_working) {
                            $used = $total_at - $total_working;


                            $monthly_report->vocation_used = 0;
                            $monthly_report->vocation_left = $allowed + $used;
                            $monthly_report->extra_vocation = 0;
                            $monthly_report->fine = 0;
                        } elseif ($total_at == $total_working) {
                            $monthly_report->vocation_used = 0;
                            $monthly_report->vocation_left = $allowed;
                            $monthly_report->extra_vocation = 0;
                            $monthly_report->fine = 0;
                        } elseif ($total_at < $total_working) {

                            $extra_at = $total_working - $total_at;
                            if ($allowed > $extra_at) {
                                $vocation_is_used = $allowed - $extra_at;
                                $monthly_report->vocation_used = $extra_at;
                                $monthly_report->vocation_left = $vocation_is_used;
                                $monthly_report->extra_vocation = 0;
                                $monthly_report->fine = 0;
                            } elseif ($allowed == $extra_at) {

                                $monthly_report->vocation_used = $allowed;
                                $monthly_report->vocation_left = 0;
                                $monthly_report->extra_vocation = 0;
                                $monthly_report->fine = 0;
                            } elseif ($allowed < $extra_at) {
                                $extrap = $extra_at - $allowed;
                                $monthly_report->vocation_used = $allowed;
                                $monthly_report->vocation_left = 0;
                                $monthly_report->extra_vocation = $extrap;
                                $monthly_report->fine = $extrap * $fine;
                            }
                        }
                        $monthly_report->total_present = $resultupDataholida['present_count'];
                        $monthly_report->allowed_vocation = $allowed;
                        $monthly_report->date = $_POST['daytime'];


                        $monthly_report->save();
                    }
                }


// build a DB query to get all articles with status = 1
                $resultData = (new \yii\db\Query())
                        ->select(['id,daytime,count(case when status = 1  then 1 end) as present_count, count(case when status = 0 then 0 end) as absent_count '])
                        ->from('attendence')
                        ->groupBy(['daytime'])
                        ->all();

                $dataProvider = new ArrayDataProvider([
                    'key' => 'daytime',
                    'allModels' => $resultData,
                    'pagination' => [
                        'pageSize' => 31,
                    ],
                    'sort' => [
                        'attributes' => ['daytime', 'present_count', 'absent_count'],
                    ],
                ]);
                return $this->render('_item', [
                            //'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
            }
        } else {
            return $this->render('not_insert');
        }
    }

    public function actionMarkupdates() {
        $model = new Attendence();
        $monthly_report = new MonthlyReport();

        if (Yii::$app->request->post()) {
            \Yii::$app
                    ->db
                    ->createCommand()
                    ->delete('attendence', ['daytime' => $_POST['daytime']])
                    ->execute();
            $staf = Staff::find()
                    ->all();
            //var_dump($_POST);

            $yesteday = date('Y-m-d', strtotime('yesterday'));
            $d = date_parse_from_format("Y-m-d", $yesteday);
            $c = $d["month"];
            // $c = 6;
            $today = date('Y-m-d');
            $t = date_parse_from_format("Y-m-d", $today);
            $e = $t["month"];
            //$e = 10;
            if ($c == $e) {
                $command = Yii::$app->db->createCommand()
                        ->delete('monthly_report', 'MONTH(date) = MONTH(NOW())')
                        ->execute();
            }

            foreach ($staf as $staff) {
                $model->isNewRecord = true;
                $model->id = null;
                $model->staff_id = $staff->id;
                if (isset($_POST['E'][$resultup['id']]['status'])) {
                    $model->status = TRUE;
                } else
                    $model->status = FALSE;
                $model->time_in = $_POST['E'][$resultup['id']]['time_in'];
                $model->time_out = $_POST['E'][$resultup['id']]['time_out'];


                $model->daytime = $_POST['daytime'];

                if ($model->save(false)) {

                    $resultupDataholida = (new \yii\db\Query())
                            ->select('count(attendence.status) as present_count,staff.name,staff.working_days,staff.salary,')
                            ->from('attendence')
                            ->innerJoin('staff', 'attendence.staff_id = staff.id')
                            ->where("attendence.status = 1 AND attendence.daytime >= '" . date('Y-m-01') . "'  AND attendence.daytime <= '" . date('Y-m-31') . "' AND staff.id = $staff->id")
                            ->groupBy(['staff.name'])
                            ->one();
                    $resultupcurrentday = (new \yii\db\Query())
                            ->select('daytime as current_month_days')
                            ->from('attendence')
                            ->where("MONTH(daytime) = Month(NOW()) AND attendence.staff_id = $staff->id")
                            ->groupBy(['daytime'])
                            ->all();
                    $total_working_day = count($resultupcurrentday);
                    $resultsaturdays = (new \yii\db\Query())
                            ->select('DAYOFWEEK(daytime) as saturday')
                            ->from('attendence')
                            ->where("MONTH(daytime) = Month(NOW())  AND attendence.staff_id = $staff->id")
                            ->groupBy(['daytime'])
                            ->all();
                    $s = 0;
                    foreach ($resultsaturdays as $resultsaturday) {


                        if ($resultsaturday['saturday'] == 7) {
                            $s = $s + 1;
                        }
                    }
                    $saturdays_current_ar = $s;



                    //calculate staff monthly report
                    //Total Office Days of this staff $total_days
                    //Total Present of this staff $presents
                    // $e = 10;
                    if ($c == $e) {
                        $pmonth = date('Y-m-d', strtotime('first day of last month'));

                        $last = date_parse_from_format("Y-m-d", $pmonth);

                        $last_month = $last["month"];

                        $vocation_left_inprevious = (new \yii\db\Query())
                                ->select('vocation_left')
                                ->from('monthly_report')
                                ->where("MONTH(date) = $last_month  AND monthly_report.staff_id = $staff->id")
                                ->one();

                        if ($vocation_left_inprevious === false) {
                            $vocation_left = 0;
                        } else {
                            $vocation_left = $vocation_left_inprevious['vocation_left'];
                        }
                    } else {
                        $pmonth = date('Y-m-d', strtotime('first day of last month'));

                        $last = date_parse_from_format("Y-m-d", $pmonth);

                        $last_month = $last["month"];

                        $vocation_left_inprevious = (new \yii\db\Query())
                                ->select('vocation_left')
                                ->from('monthly_report')
                                ->where("MONTH(date) = MONTH($pmonth)  AND monthly_report.staff_id = $staff->id")
                                ->one();
                        if ($vocation_left_inprevious === false) {
                            $vocation_left = 0;
                        } else {
                            $vocation_left = $vocation_left_inprevious['vocation_left'];
                        }
                    }
                    $allowed = 2 + $vocation_left;

                    $monthly_report->isNewRecord = true;
                    $monthly_report->id = NULL;
                    $monthly_report->staff_id = $staff->id;
                    $total = $resultupDataholida['present_count'];

                    // $total_at = $total + $allowed;
                    $total_at = $total;
                    $f = $resultupDataholida['salary'] / $resultupDataholida['working_days'];
                    $fine = $f / 2;
                    if ($resultupDataholida['working_days'] == 24) {
                        $monthly_report->total_office_days = $total_working_day;
                        $total_working = $total_working_day;
                    } else {
                        $nobod = $total_working_day - $saturdays_current_ar;
                        $monthly_report->total_office_days = $nobod;
                        $total_working = $total_working_day - $saturdays_current_ar;
                    }
                    if ($total_at > $total_working) {
                        $used = $total_at - $total_working;


                        $monthly_report->vocation_used = 0;
                        $monthly_report->vocation_left = $allowed + $used;
                        $monthly_report->extra_vocation = 0;
                        $monthly_report->fine = 0;
                    } elseif ($total_at == $total_working) {
                        $monthly_report->vocation_used = 0;
                        $monthly_report->vocation_left = $allowed;
                        $monthly_report->extra_vocation = 0;
                        $monthly_report->fine = 0;
                    } elseif ($total_at < $total_working) {

                        $extra_at = $total_working - $total_at;
                        if ($allowed > $extra_at) {
                            $vocation_is_used = $allowed - $extra_at;
                            $monthly_report->vocation_used = $extra_at;
                            $monthly_report->vocation_left = $vocation_is_used;
                            $monthly_report->extra_vocation = 0;
                            $monthly_report->fine = 0;
                        } elseif ($allowed == $extra_at) {

                            $monthly_report->vocation_used = $allowed;
                            $monthly_report->vocation_left = 0;
                            $monthly_report->extra_vocation = 0;
                            $monthly_report->fine = 0;
                        } elseif ($allowed < $extra_at) {
                            $extrap = $extra_at - $allowed;
                            $monthly_report->vocation_used = $allowed;
                            $monthly_report->vocation_left = 0;
                            $monthly_report->extra_vocation = $extrap;
                            $monthly_report->fine = $extrap * $fine;
                        }
                    }
                    $monthly_report->total_present = $resultupDataholida['present_count'];
                    $monthly_report->allowed_vocation = $allowed;
                    $monthly_report->date = $_POST['daytime'];


                    $monthly_report->save();
                }
            }

// build a DB query to get all articles with status = 1
            $resultData = (new \yii\db\Query())
                    ->select(['id,daytime,count(case when status = 1  then 1 end) as present_count, count(case when status = 0 then 0 end) as absent_count '])
                    ->from('attendence')
                    ->groupBy(['daytime'])
                    ->all();

            $dataProvider = new ArrayDataProvider([
                'key' => 'daytime',
                'allModels' => $resultData,
                'pagination' => [
                    'pageSize' => 31,
                ],
                'sort' => [
                    'attributes' => ['daytime', 'present_count', 'absent_count'],
                ],
            ]);
            return $this->render('_item', [
                        //'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Updates an existing Attendence model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id_date) {
        // echo $id_date;
        $day_time = $id_date;
        $resultupData = (new \yii\db\Query())
                ->select('attendence.daytime as daytime,attendence.time_in as timein,attendence.time_out as time_out,staff.name as name,staff.id,attendence.status')
                ->from('attendence')
                ->innerJoin('staff', 'attendence.staff_id = staff.id')
                ->where(['attendence.daytime' => $day_time,])
                ->all();

        return $this->render('update_attendence', ['resultupData' => $resultupData, 'day_time' => $day_time]);
    }

    /**
     * Deletes an existing Attendence model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id_date) {
        \Yii::$app
                ->db
                ->createCommand()
                ->delete('attendence', ['daytime' => $id_date])
                ->execute();
        $resultData = (new \yii\db\Query())
                ->select(['id,daytime,count(case when status = 1  then 1 end) as present_count, count(case when status = 0 then 0 end) as absent_count '])
                ->from('attendence')
                ->groupBy(['daytime'])
                ->all();

        $dataProvider = new ArrayDataProvider([
            'key' => 'daytime',
            'allModels' => $resultData,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['daytime', 'present_count', 'absent_count'],
            ],
        ]);
        return $this->render('_item', [
                    //'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Attendence model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Attendence the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Attendence::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
