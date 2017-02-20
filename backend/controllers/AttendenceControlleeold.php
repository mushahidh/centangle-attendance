<?php

namespace backend\controllers;

use backend\models\Attendence;
use backend\models\AttendenceSearch;
use backend\models\MonthlyReport;
use backend\models\Staff;
use backend\models\WorkingHours;
use Yii;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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

        $resultData = (new Query())
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
        if (Yii::$app->user->isGuest) {

            return $this->render('_item', [
//'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {

            $roles = \Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());

            if (array_key_exists('mark-attendence', $roles)) {
                return $this->render('_item', [
//'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
            }
        $user = Yii::$app->user->ID;

        $checkin_mark = \backend\models\User::isInOffice($user);
        if ($checkin_mark == true) {
            $lastcheck_in = \backend\models\WorkingHours::Lastcheckin($user);
            $lstcheck_in_ID = $lastcheck_in['id'];
            $lstcheck_in_datetime = $lastcheck_in['check_in'];

            $today = date("Y-m-d H:i:s");
            $hours = round((strtotime($today) - strtotime($lstcheck_in_datetime)) / (60 * 60));
            if ($hours > 10) {
                $lastcheck_in = \common\models\WorkingHours::updatechekin_system($lstcheck_in_ID);
                //return $this->render('check_in_page');
                    return $this->render('check_in_page', ['lastcheck_in' => $lastcheck_in]);
            } else {
                //return $this->render('check_out');
                $lastcheck_in = False;
                 return $this->render('check_in_page', ['lastcheck_in' => $lastcheck_in]);
            }
        } else {
             $lastcheck_in = TRUE;
             return $this->render('check_in_page', ['lastcheck_in' => $lastcheck_in]);
           // return $this->render('check_in_page');
        }

            //return $this->render('check_in_page');
        }
    }
        public function actionCheckin() {
        $user = Yii::$app->user->ID;
          $staff_id = \backend\models\Staff::staff_id($user);
        $attendence_id = \backend\models\Attendence::isAttendenceMarked($staff_id);

        if ($attendence_id) {
            $saved = \backend\models\WorkingHours::insertAttendencehours($attendence_id,$user);
            if ($saved) {
               // return $this->render('check_out');
                  $lastcheck_in = False;
                 return $this->render('check_in_page', ['lastcheck_in' => $lastcheck_in]);
            } else {
                //return $this->render('check_in_page');
                    $lastcheck_in = TRUE;
             return $this->render('check_in_page', ['lastcheck_in' => $lastcheck_in]);
            }
        } else {
            $saved_attendance = \backend\models\Attendence::insertAttendence($staff_id);
            if ($saved_attendance) {
                $attendence_id = $saved_attendance;
                $saved = \backend\models\WorkingHours::insertAttendencehours($attendence_id,$user);
                if ($saved){
                    //return $this->render('check_out');
                       $lastcheck_in = False;
                 return $this->render('check_in_page', ['lastcheck_in' => $lastcheck_in]);
                } else {
                    //return $this->render('check_in_page');
                        $lastcheck_in = TRUE;
             return $this->render('check_in_page', ['lastcheck_in' => $lastcheck_in]);
                }
            }
        }
    }

    public function actionCheckout() {
        $user = Yii::$app->user->ID;
        $checkout = \backend\models\WorkingHours::updatecheckout($user);
       
        if ($checkout) {

            //return $this->render('check_in_page');
               $lastcheck_in = TRUE;
                 return $this->render('check_in_page', ['lastcheck_in' => $lastcheck_in]);
        } else {
               $lastcheck_in = false;
                 return $this->render('check_in_page', ['lastcheck_in' => $lastcheck_in]);
            //return $this->render('check_out');
        }
    }
    public function actionIndexx() {

        $resultData = (new Query())
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
        if (Yii::$app->user->isGuest) {

            return $this->render('_item', [
//'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {

            $roles = \Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());

            if (array_key_exists('mark-attendence', $roles)) {
                return $this->render('_item', [
//'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
            }

            $userid = Yii::$app->user->getId();
            $check_in_staff_id = (new Query())
                    ->select('id')
                    ->from('staff')
                    ->where("user_id = $userid")
                    ->one();
            $check_in_staff_idd = $check_in_staff_id['id'];
            $check_in_att_idd = (new Query())
                    ->select('id')
                    ->from('attendence')
                    ->where("staff_id = $check_in_staff_idd AND daytime = Date(NOW()) ")
                    ->orderBy(['id' => SORT_DESC])
                    ->one();
            $check_in_att_id = $check_in_att_idd['id'];
            
            return $this->render('check_in_page', ['check_in_att_id' => $check_in_att_id]);

            //return $this->render('check_in_page');
        }
    }

    public function actionCurrentreport() {
        $resultsaturdays = (new Query())
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

        $resultupcurrentdays = (new Query())
                ->select('daytime as current_month_days')
                ->from('attendence')
                ->where("MONTH(daytime) = Month(NOW()) AND is_offical = 1")
                ->groupBy(['daytime'])
                ->all();
        $total_working_days = count($resultupcurrentdays);

        $resultupDataholiday = (new Query())
                ->select('count(case when attendence.status = 1  then 1 end) as present_count,staff.name,staff.working_days,staff.salary,staff.created_date,staff.id')
                ->from('attendence')
                ->innerJoin('staff', 'attendence.staff_id = staff.id')
                ->where("attendence.daytime >= '" . date('Y-m-01') . "'  AND attendence.daytime <= '" . date('Y-m-31') . "' ")
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

    public function actionCalendar() {
        return $this->render('calendar');
    }

    public function actionAjax() {
        $dataa = Yii::$app->request->post('test');
        $data = (new Query())
                ->select('count(case when attendence.status = 1  then 1 end) as present_count,count(case when attendence.status = 0  then 0 end) as absent_count,staff.name as name')
                ->from('attendence')
                ->innerJoin('staff', 'attendence.staff_id = staff.id')
                ->where("attendence.daytime = '" . $dataa . "'")
                ->groupBy(['staff.name'])
                ->all();
        $popupdata = '';
        $popupdata = '<div class=header><h2>Detail for &nbsp' . $dataa . '</h2></div>';
        $popupdata.= '<div class=col-md-12>';
        $popupdata.= '<div class=col-pop><h4>present</h4>';
        foreach ($data as $pop) {
            if ($pop['present_count'] == 1) {

                $popupdata.= '<p>' . $pop['name'] . '</p>';
            }
        }
        $popupdata.= '</div>';
        $popupdata.= '<div class=col-pop><h4>Absent</h4>';
        foreach ($data as $pop) {
            if ($pop['present_count'] == 0) {

                $popupdata.= '<p>' . $pop['name'] . '</p>';
            }
        }
        $popupdata.= '</div>';
        $popupdata.= '</div>';
        $popupdata.= '<div class=foter><button class=update id=' . $dataa . '>Update</button></div>';


        return Json::encode($popupdata);
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




        $monthlyreportlaba = (new Query())
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
        $monthlyreportlaball = (new Query())
                ->select('monthly_report.total_office_days,monthly_report.total_present,monthly_report.allowed_vocation,monthly_report.vocation_used,monthly_report.vocation_left,monthly_report.extra_vocation,monthly_report.fine,monthly_report.date,staff.name')
                ->from('monthly_report')
                ->innerJoin('staff', 'monthly_report.staff_id = staff.id')
                ->where("MONTH(date) = $last_month")
                ->groupBy(['staff.name'])
                ->all();


        return $this->render('monthlyreport', ['monthlyreportlaball' => $monthlyreportlaball]);
    }

    public function actionSavemark($date) {

        $monthly_report = new MonthlyReport();
        $yesteday = date('Y-m-d', strtotime('yesterday'));
        $d = date_parse_from_format("Y-m-d", $yesteday);
        $c = $d["month"];
// $c = 6;
        $today = date('Y-m-d');
        $t = date_parse_from_format("Y-m-d", $today);
        $e = $t["month"];
        $command = Yii::$app->db->createCommand()
                ->delete('monthly_report', 'MONTH(date) = MONTH(NOW())')
                ->execute();
//if ($c == $e) {
// $command = Yii::$app->db->createCommand()
// ->delete('monthly_report', 'MONTH(date) = MONTH(NOW())')
//  ->execute();
// }
        $staf = Staff::find()
                ->all();

        foreach ($staf as $staff) {
            $resultupDataholida = (new Query())
                    ->select('count(attendence.status) as present_count,staff.name,staff.working_days,staff.salary,staff.created_date')
                    ->from('attendence')
                    ->innerJoin('staff', 'attendence.staff_id = staff.id')
                    ->where("attendence.status = 1 AND attendence.daytime >= '" . date('Y-m-01') . "'  AND attendence.daytime <= '" . date('Y-m-31') . "' AND staff.id = $staff->id")
                    ->groupBy(['staff.name'])
                    ->one();

            $resultupcurrentday = (new Query())
                    ->select('daytime as current_month_days')
                    ->from('attendence')
                    ->where("MONTH(daytime) = Month(NOW()) AND attendence.staff_id = $staff->id AND is_offical = 1")
                    ->groupBy(['daytime'])
                    ->all();
            $total_working_day = count($resultupcurrentday);
            $bonus = (new Query())
                    ->select('allowed_holiday')
                    ->from('holidays')
                    ->where("MONTH(starting_date) = Month(NOW()) AND staff_id = $staff->id")
                    ->one();
            $resultsaturdays = (new Query())
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

                $vocation_left_inprevious = (new Query())
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

                $vocation_left_inprevious = (new Query())
                        ->select('vocation_left')
                        ->from('monthly_report')
                        ->where("MONTH(date) = $last_month  AND monthly_report.staff_id = $staff->id")
                        ->one();

                if ($vocation_left_inprevious === false) {
                    $vocation_left = 0;
                } else {
                    $vocation_left = $vocation_left_inprevious['vocation_left'];
                }
            }
            $allowed = 2 + $vocation_left;
            if ($bonus) {
                $bonus_add = (int) ($bonus['allowed_holiday']);
                $allowed = $allowed + $bonus_add;
            }

            $monthly_report->isNewRecord = true;
            $monthly_report->id = NULL;
            $monthly_report->staff_id = $staff->id;
            if ($resultupDataholida['present_count'] > 0) {
                $total = $resultupDataholida['present_count'];
                $total_at = $total;
            } else {
                $total = 0;
// $total_at = $total + $allowed;
                $total_at = $total;
            }

            if ($resultupDataholida['working_days'] > 0) {
                $f = $resultupDataholida['salary'] / $resultupDataholida['working_days'];

                $fine = $f / 2;
            } else {
                $resultupDataholida['working_days'] = 0;
                $fine = 0;
            }


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
            $monthly_report->total_present = $total;

            $monthly_report->allowed_vocation = $allowed;


            $monthly_report->date = $date;


            $monthly_report->save(false);
        }







// build a DB query to get all articles with status = 1
        $resultData = (new Query())
                ->select(['id,daytime,count(case when status = 1  then 1 end) as present_count, count(case when status = 0 then 0 end) as absent_count '])
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

    public function actionMark() {
        if (!Yii::$app->user->isGuest && Yii::$app->User->can('mark-attendence')) {
            $attendence_date = $_POST['daytime'];
            $attend_dat_format = date_parse_from_format("Y-m-d", $attendence_date);
            $attend_dat_month = $attend_dat_format["month"];
            $today_dat = date('Y-m-d');

            $today_dat_format = date_parse_from_format("Y-m-d", $today_dat);
            $today_dat_month = $today_dat_format["month"];
            if ($attend_dat_month == $today_dat_month) {
                $model = new Attendence();
                $workingHours = new WorkingHours();
                if (Yii::$app->request->post()) {
                    \Yii::$app
                            ->db
                            ->createCommand()
                            ->delete('attendence', ['daytime' => $_POST['daytime']])
                            ->execute();
                    $staf = Staff::find()
                            ->all();
                    \Yii::$app
                            ->db
                            ->createCommand()
                            ->delete('working_hours', ['working_date' => $_POST['daytime']])
                            ->execute();
                    $staf = Staff::find()
                            ->all();
//var_dump($_POST);


                    foreach ($staf as $staff) {
                        $model->isNewRecord = true;
                        $model->id = null;
                        $model->staff_id = $staff->id;
                        try {
                               if (isset($_POST['E'][$staff->id]['working_home'])) {
                                $model->working_from_home	 = TRUE;
                            }else{
                                   $model->working_from_home	 = FALSE; 
                            }
                            if (isset($_POST['E'][$staff->id]['status'])) {
                                $model->status = TRUE;
                            } else
                                $model->status = FALSE;
                            $model->time_in = $_POST['E'][$staff->id]['time_in'];
                            $model->time_out = $_POST['E'][$staff->id]['time_out'];

                            $model->daytime = $_POST['daytime'];
                            if (isset($_POST['is_offical'])) {
                                $model->is_offical = TRUE;
                            } else {
                                $model->is_offical = FALSE;
                            }
                            $result = $model->save(false);
                            if ($result) {
                                $time_out = $_POST['E'][$staff->id]['time_out'];
                                $time_in = $_POST['E'][$staff->id]['time_in'];
                                $workingHours->isNewRecord = true;
                                $workingHours->id = null;
                                $workingHours->user_id = $staff->user_id;
                                $workingHours->working_date = $_POST['daytime'];
                                $workingHours->attendence_id = $model->id;
                                $workingHours->check_in = date("Y-m-d h:i:s", mktime(explode(':', $time_in)[0], explode(':', $time_in)[1], 0, $attend_dat_format["month"], $attend_dat_format["day"], $attend_dat_format["year"]));
                                $workingHours->check_out = date("Y-m-d h:i:s", mktime(explode(':', $time_out)[0], explode(':', $time_out)[1], 0, $attend_dat_format["month"], $attend_dat_format["day"], $attend_dat_format["year"]));
                                $workingHours->save(false);
                            }
                        } catch (Exception $e) {
                            
                        }
                    }
                    $date = $_POST['daytime'];
                    $this->redirect(array('savemark', 'date' => $date));
                }
            } else {
                return $this->render('not_insert');
            }
        } else {
            return $this->render('not_insert_except_admin');
        }
    }

    public function actionMarkindividualattendance() {
        $result = false;
        $attendance_Id = -1;
        $today_dat = date('Y-m-d');
        $today_dat_format = date_parse_from_format("Y-m-d", $today_dat);
        $today_dat_month = $today_dat_format["month"];


        $userid = Yii::$app->user->getId();
        $check_in_staff_id = (new Query())
                ->select('id')
                ->from('staff')
                ->where("user_id = $userid")
                ->one();
        $check_in_staff_idd = $check_in_staff_id['id'];
        $check_in_att_idd = (new Query())
                ->select('id')
                ->from('attendence')
                ->where("staff_id = $check_in_staff_idd AND daytime = Date(NOW()) ")
                ->orderBy(['id' => SORT_DESC])
                ->one();
        $check_in_att_id = $check_in_att_idd['id'];
        // Get attendance id of today if exist otherwise set it to -1
        if ($check_in_att_id) {
            $attendance_Id = $check_in_att_id;
        }
        try {
            if ($attendance_Id = -1) {
                $model = new Attendence();
                $model->isNewRecord = true;
                $model->id = null;
                $model->staff_id = $check_in_staff_idd;
                $model->status = TRUE;
                $model->daytime = date('Y-m-d');
                $result = $model->save(false);
                if ($result) {
                    $attendance_Id = $model->id;
                }
            } else {
                $result = true;
            }

            if ($result) {
                if (Yii::$app->request->post('submit') == 0) {
                    $workingHours = new WorkingHours();
                    $workingHours->isNewRecord = true;
                    $workingHours->id = null;
                    $workingHours->working_date = date("Y-m-d h:i:s");
                    $workingHours->attendence_id = $attendance_Id;
                    $workingHours->check_in = date("Y-m-d h:i:s");
                    $workingHours->check_out = null;
                    $workingHours->save(false);
                    
                } else {
                    $working_hours = (new Query())
                            ->select('id')
                            ->from('working_hours')
                            ->where("check_out is NULL")
                            ->one();
                    $working_hours=$working_hours["id"];
                    Yii::$app->db->createCommand()
                            ->update('working_hours', ['check_out' => date("Y-m-d h:i:s")], 'id ='. $working_hours)
                            ->execute();
                }
            }
        } catch (Exception $e) {
            
        }
        $check_in_staff_id = (new Query())
                ->select('id')
                ->from('staff')
                ->where("user_id = $userid")
                ->one();
        $check_in_staff_idd = $check_in_staff_id['id'];
        $check_in_att_idd = (new Query())
                ->select('id')
                ->from('attendence')
                ->where("staff_id = $check_in_staff_idd AND daytime = Date(NOW()) ")
                ->orderBy(['id' => SORT_DESC])
                ->one();
        $check_in_att_id = $check_in_att_idd['id'];
        return $this->render('check_in_page', ['check_in_att_id' => $check_in_att_id]);
    }

    public function actionUpdate($id_date) {
        if (!Yii::$app->user->isGuest && Yii::$app->User->can('mark-attendence')) {
// echo $id_date;
            $day_time = $id_date;
            $resultupData = (new Query())
                    ->select('attendence.daytime as daytime,attendence.time_in as timein,attendence.time_out as time_out,staff.name as name,staff.id,attendence.status')
                    ->from('attendence')
                    ->innerJoin('staff', 'attendence.staff_id = staff.id')
                    ->where(['attendence.daytime' => $day_time,])
                    ->all();

            return $this->render('update_attendence', ['resultupData' => $resultupData, 'day_time' => $day_time]);
        } else {
            return $this->render('not_insert_except_admin');
        }
    }

    /**
     * Deletes an existing Attendence model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id_date) {
        if (!Yii::$app->user->isGuest && Yii::$app->User->can('mark-attendence')) {
            \Yii::$app
                    ->db
                    ->createCommand()
                    ->delete('attendence', ['daytime' => $id_date])
                    ->execute();
            $resultData = (new Query())
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
        } else {
            return $this->render('not_insert_except_admin');
        }
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
