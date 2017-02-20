<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "working_hours".
 *
 * @property integer $id
 * @property integer $attendence_id
 * @property string $check_in
 * @property string $check_out
 */
class WorkingHours extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'working_hours';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attendence_id', 'check_in', 'check_out'], 'required'],
            [['attendence_id'], 'integer'],
            [['check_in', 'check_out'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attendence_id' => 'Attendence ID',
            'check_in' => 'Check In',
            'check_out' => 'Check Out',
        ];
    }
     public static function insertAttendencehours($attendence_id, $user) {
        $workingHours = new WorkingHours();
        $workingHours->isNewRecord = true;
        $workingHours->id = null;
        //$workingHours->working_date = date("Y-m-d h:i:s");
        $workingHours->attendence_id = $attendence_id;
        $workingHours->check_in = date("Y-m-d h:i:s");
         $workingHours->user_id = $user;
        $workingHours->check_out = null;
        $workingHours->working_date = date("Y-m-d");
        $result = $workingHours->save(false);
        return $result;
    }

    public static function Lastcheckin($user) {
        $lstcheck_in = (new \yii\db\Query())->select('id,check_in')->from('working_hours')->where('user_id=' . $user)->andWhere("check_out is NULL")->one();
        return $lstcheck_in;
    }

    public static function updatechekin_system($lstcheck_in_ID) {

        $updated = Yii::$app->db->createCommand()
                ->update('working_hours', ['check_out' => date("Y-m-d h:i:s"), 'system_checked_out' => 'system date'], 'id =' . $lstcheck_in_ID)
                ->execute();
        return true;
    }

    public static function updatecheckout($user) {
        $update_id = (new \yii\db\Query())->select('id')->from('working_hours')->where('user_id=' . $user)->andWhere("check_out is NULL")->one();
        $update_id = $update_id['id'];
        if($update_id){
                $updated = Yii::$app->db->createCommand()
                ->update('working_hours', ['check_out' => date("Y-m-d h:i:s")], 'id =' . $update_id)
                ->execute();
        return $updated;
        }  else {
           return  $update_id;
        }
    
    }

}
