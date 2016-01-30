<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trash_count_winter".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Main[] $mains
 */
class TrashCountWinter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trash_count_winter';
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
        return $this->hasMany(Main::className(), ['trash_count_winter' => 'id']);
    }
}
