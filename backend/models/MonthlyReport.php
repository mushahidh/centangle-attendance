<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "monthly_report".
 *
 * @property integer $id
 * @property integer $staff_id
 * @property integer $total_office_days
 * @property integer $total_present
 * @property integer $allowed_vocation
 * @property integer $vocation_used
 * @property integer $vocation_left
 * @property integer $extra_vocation
 * @property integer $fine
 * @property string $date
 *
 * @property Staff $staff
 */
class MonthlyReport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'monthly_report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['staff_id', 'total_office_days', 'total_present'], 'required'],
            [['staff_id', 'total_office_days', 'total_present', 'allowed_vocation', 'vocation_used', 'vocation_left', 'extra_vocation', 'fine'], 'integer'],
            [['date'], 'safe'],
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
            'staff_id' => 'Staff ID',
            'total_office_days' => 'Total Office Days',
            'total_present' => 'Total Present',
            'allowed_vocation' => 'Allowed Vocation',
            'vocation_used' => 'Vocation Used',
            'vocation_left' => 'Vocation Left',
            'extra_vocation' => 'Extra Vocation',
            'fine' => 'Fine',
            'date' => 'Date',
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
