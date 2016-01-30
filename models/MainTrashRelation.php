<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "main_trash_relation".
 *
 * @property integer $id
 * @property integer $main_id
 * @property integer $trash_relation_id
 *
 * @property Main $main
 * @property TrashRelation $trashRelation
 */
class MainTrashRelation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'main_trash_relation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['main_id', 'trash_relation_id'], 'integer']
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
            'trash_relation_id' => 'Trash Relation ID',
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
    public function getTrashRelation()
    {
        return $this->hasOne(TrashRelation::className(), ['id' => 'trash_relation_id']);
    }
}
