<?php

namespace app\models;

use Yii;
use app\components\EnglishBehavior;

/**
 * This is the model class for table "trash_place".
 *
 * @property integer $id
 * @property string $name
 * @property string $name_eng
 * @property string $name_short
 * @property string $name_short_eng
 *
 * @property MainTrashPlace[] $mainTrashPlaces
 */
class TrashPlace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trash_place';
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
            [['name', 'name_eng', 'name_short', 'name_short_eng'], 'string']
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
            'name_short' => 'Name Short',
            'name_short_eng' => 'Name Short Eng',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainTrashPlaces()
    {
        return $this->hasMany(MainTrashPlace::className(), ['trash_place_id' => 'id']);
    }
}
