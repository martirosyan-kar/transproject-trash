<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trash_man".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Main[] $mains
 */
class TrashMan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trash_man';
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
        return $this->hasMany(Main::className(), ['trash_man' => 'id']);
    }
}
