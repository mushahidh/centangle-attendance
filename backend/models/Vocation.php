<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "vocation".
 *
 * @property integer $id
 * @property string $leave_start
 * @property string $leave_end
 * @property integer $vocation-days
 * @property integer $staff_id
 *
 * @property Staff $staff
 */
class Vocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vocation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['leave_start', 'leave_end', 'vocation-days', 'staff_id'], 'required'],
            [['leave_start', 'leave_end'], 'safe'],
            [['vocation_days', 'staff_id'], 'integer'],
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
            'leave_start' => 'Leave Start',
            'leave_end' => 'Leave End',
            'vocation_days' => 'Vocation Days',
            'staff_id' => 'Staff ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasOne(Staff::className(), ['id' => 'staff_id']);
    }
}
