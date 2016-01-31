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
            [['name', 'name_eng'], 'string']
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
