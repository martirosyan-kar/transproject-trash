<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "main_rubber_items".
 *
 * @property integer $id
 * @property integer $main_id
 * @property integer $rubber_item_id
 *
 * @property Main $main
 * @property RubberItems $rubberItem
 */
class MainRubberItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'main_rubber_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['main_id', 'rubber_item_id'], 'integer'],
            [['main_id'], 'exist', 'skipOnError' => true, 'targetClass' => Main::className(), 'targetAttribute' => ['main_id' => 'id']],
            [['rubber_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => RubberItems::className(), 'targetAttribute' => ['rubber_item_id' => 'id']],
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
            'rubber_item_id' => 'Rubber Item ID',
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
    public function getRubberItem()
    {
        return $this->hasOne(RubberItems::className(), ['id' => 'rubber_item_id']);
    }
}
