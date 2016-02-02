<?php

namespace app\models;

use Yii;
use app\components\EnglishBehavior;

/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property string $name
 * @property string $name_eng
 * @property integer $region
 *
 * @property Region $region0
 * @property Main[] $mains
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            EnglishBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'name_eng'], 'string'],
            [['region'], 'integer']
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
            'name_eng' => 'Name Eng',
            'region' => 'Region',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion0()
    {
        return $this->hasOne(Region::className(), ['id' => 'region']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMains()
    {
        return $this->hasMany(Main::className(), ['city' => 'id']);
    }
}
