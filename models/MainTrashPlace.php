<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "main_trash_place".
 *
 * @property integer $id
 * @property integer $main_id
 * @property integer $trash_place_id
 *
 * @property Main $main
 * @property TrashPlace $trashPlace
 */
class MainTrashPlace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'main_trash_place';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['main_id', 'trash_place_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'main_id' => 'Main ID',
            'trash_place_id' => 'Trash Place ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMain()
    {
        return $this->hasOne(Main::className(), ['id' => 'main_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrashPlace()
    {
        return $this->hasOne(TrashPlace::className(), ['id' => 'trash_place_id']);
    }
}
