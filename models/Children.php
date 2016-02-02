<?php

namespace app\models;

use Yii;
use app\components\EnglishBehavior;

/**
 * This is the model class for table "children".
 *
 * @property integer $id
 * @property string $name_short
 * @property string $name_eng
 * @property string $name
 * @property string $name_short_eng
 *
 * @property Main[] $mains
 */
class Children extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'children';
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
            [['name_short', 'name_eng', 'name', 'name_short_eng'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_short' => 'Name Short',
            'name_eng' => 'Name Eng',
            'name' => 'Name',
            'name_short_eng' => 'Name Short Eng',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMains()
    {
        return $this->hasMany(Main::className(), ['children' => 'id']);
    }
}
