<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fine".
 *
 * @property integer $id
 * @property integer $fine
 * @property integer $staff_id
 *
 * @property Staff $staff
 */
class Fine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fine';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fine', 'staff_id'], 'required'],
            [['fine', 'staff_id'], 'integer'],
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
            'fine' => 'Fine',
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
