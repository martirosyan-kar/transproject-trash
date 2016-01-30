<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "main_trash_man".
 *
 * @property integer $id
 * @property integer $main_id
 * @property integer $trash_man_id
 *
 * @property Main $main
 * @property TrashMan $trashMan
 */
class MainTrashMan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'main_trash_man';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['main_id', 'trash_man_id'], 'integer']
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
            'trash_man_id' => 'Trash Man ID',
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
    public function getTrashMan()
    {
        return $this->hasOne(TrashMan::className(), ['id' => 'trash_man_id']);
    }
}
