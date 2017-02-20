<?php

namespace backend\models;

use Yii;
use backend\models\Staff;

/**
 * This is the model class for table "attendence".
 *
 * @property integer $id
 * @property string $status
 * @property string $time_in
 * @property string $time_out
 * @property string $daytime
 * @property integer $staff_id
 *
 * @property Staff $staff
 */
class Attendence extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attendence';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'is_offical','time_in', 'time_out', 'daytime', 'staff_id'], 'required'],
         
            [['staff_id'], 'integer'],
            [['daytime'], 'safe'],
            [['status','is_offical','working_from_home', 'time_in', 'time_out'], 'string', 'max' => 45],
            [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => Staff::className(), 'targetAttribute' => ['staff_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'time_in' => 'Time In',
            'time_out' => 'Time Out',
            'daytime' => 'Daytime',
            'staff_id' => 'Staff ID',
            'is_offical' => 'Is Offical',
            'working_from_home' => 'Working from home'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasOne(Staff::className(), ['id' => 'staff_id']);
    }
    public function getStaffName() {
          return $this->staff->name;
}
 public static function isAttendenceMarked($staff_id) {

        $attendence_id = (new \yii\db\Query())->select('id')->from('attendence')->where('staff_id=' . $staff_id)->andWhere("DATE(daytime) = Date(NOW())")->one();
        $attendence_id = $attendence_id['id'];
        return $attendence_id;
    }
   

    public static function insertAttendence($staff_id) {
        $model = new Attendence();
        $model->isNewRecord = true;
        $model->id = null;
        $model->staff_id = $staff_id;
        $model->status = TRUE;
     
        $model->daytime = date("Y-m-d");
        $result = $model->save(false);
        if ($result == true) {
            return $at_id = $model->id;
        } else {
            return $result;
        }
    }

}
