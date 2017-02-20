<?php

namespace backend\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "staff".
 *
 * @property integer $id
 * @property string $name
 * @property string $position
 * @property string $gender
 * @property string $profile_pic
 * @property integer $user_id
 * @property integer $company_id
 * @property integer $salary
 * * @property string $wotking_days 
 *
 * @property Attendence[] $attendences
 * @property Fine[] $fines
 * @property Holidays[] $holidays
 * @property User $user
 * @property Company $company
 * @property Vocation[] $vocations
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
        public $file;
    public static function tableName()
    {
        return 'staff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'position', 'gender', 'profile_pic', 'user_id', 'company_id', 'salary','working_days', 'created_date'], 'required'],
            [['gender','working_days'], 'string'],
             [['file'],'file'],
              [['created_date'], 'safe'], 
            [['user_id', 'company_id', 'salary'], 'integer'],
            [['name', 'position', 'profile_pic'], 'string', 'max' => 45],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'position' => 'Position',
            'gender' => 'Gender',
            'file' => 'Profile Pic',
            'user_id' => 'User ID',
            'company_id' => 'Company ID',
            'salary' => 'Salary',
             'working_days' => 'Working Days', 
             'created_date' => 'Created Date',
        ];
    }
      public function getImageUrl() {
        return Url::to('@web/' . $this->profile_pic, true);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttendences()
    {
        return $this->hasMany(Attendence::className(), ['staff_id' => 'id']);
    }
 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFines()
    {
        return $this->hasMany(Fine::className(), ['staff_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHolidays()
    {
        return $this->hasMany(Holidays::className(), ['staff_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
public function getCompanyName() {
          return $this->company->name;
}
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVocations()
    {
        return $this->hasMany(Vocation::className(), ['staff_id' => 'id']);
    }
     public static function staff_id($user) {

        $staff_id = (new \yii\db\Query())->select('id')->from('staff')->where('user_id=' . $user)->one();
        $staff_id = $staff_id['id'];
        return $staff_id;
    }
}
