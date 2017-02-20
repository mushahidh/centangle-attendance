<?php

namespace backend\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property string $logo
 * @property string $address
 * @property string $url
 *
 * @property Staff[] $staff
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'logo', 'address', 'url'], 'required'],
            [['name', 'url'], 'string', 'max' => 45],
            [['logo', 'address'], 'string', 'max' => 75],
            [['file'],'file'],
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
            'file' => 'Logo',
            'address' => 'Address',
            'url' => 'Url',
        ];
    }
    
      public function getImageUrl() {
        return Url::to('@web/' . $this->logo, true);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasMany(Staff::className(), ['company_id' => 'id']);
    }

}
