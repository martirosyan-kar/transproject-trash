<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trash_place".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Main[] $mains
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
    public function rules()
    {
        return [
            [['name'], 'string']
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMains()
    {
        return $this->hasMany(Main::className(), ['place' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainTrashPlaces()
    {
        return $this->hasMany(MainTrashPlace::className(), ['trash_place_id' => 'id']);
    }
}
