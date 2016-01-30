<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "main_trash_recycle".
 *
 * @property integer $id
 * @property integer $main_id
 * @property integer $trash_recycle_id
 *
 * @property Main $main
 * @property TrashRecycle $trashRecycle
 */
class MainTrashRecycle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'main_trash_recycle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['main_id', 'trash_recycle_id'], 'integer']
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
            'trash_recycle_id' => 'Trash Recycle ID',
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
    public function getTrashRecycle()
    {
        return $this->hasOne(TrashRecycle::className(), ['id' => 'trash_recycle_id']);
    }
}
