<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paper".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Main[] $mains
 */
class Paper extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'paper';
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
        return $this->hasMany(Main::className(), ['paper' => 'id']);
    }
}
