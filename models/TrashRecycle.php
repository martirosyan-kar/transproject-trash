<?php

namespace app\models;

use Yii;
use app\components\EnglishBehavior;

/**
 * This is the model class for table "trash_recycle".
 *
 * @property integer $id
 * @property string $name_short
 * @property string $name_eng
 * @property string $name
 * @property string $name_short_eng
 *
 * @property Main[] $mains
 * @property MainTrashRecycle[] $mainTrashRecycles
 */
class TrashRecycle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trash_recycle';
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
        return $this->hasMany(Main::className(), ['trash_recycle' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainTrashRecycles()
    {
        return $this->hasMany(MainTrashRecycle::className(), ['trash_recycle_id' => 'id']);
    }
}
