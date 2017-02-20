<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "holidays".
 *
 * @property integer $id
 * @property string $allowed_holiday
 * @property integer $staff_id
 * @property string $month
 *
 * @property Staff $staff
 */
class Holidays extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'holidays';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['allowed_holiday', 'staff_id', 'starting_date', 'ending_date',], 'required'],
      
            [['staff_id','allowed_holiday'], 'integer'],
            [['starting_date', 'ending_date'], 'safe'],
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
            'allowed_holiday' => 'Allowed Holiday',
            'staff_id' => 'Staff Nmae',
            'starting_date' => 'Starting Date',
            'ending_date' => 'Ending Date',
        ];
    }
   public function getStaffName() {
          return $this->staff->name;
}
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasOne(Staff::className(), ['id' => 'staff_id']);
    }
}
