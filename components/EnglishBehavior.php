<?php
namespace app\components;

use yii\db\ActiveRecord;
use yii\base\Behavior;
/**
 * Created by PhpStorm.
 * User: karen
 * Date: 1/31/16
 * Time: 12:15 AM
 */
class EnglishBehavior extends Behavior
{
    public $nameBoth;
    public $nameBothShort;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'afterFind',
        ];
    }

    public function afterFind($event)
    {
        $this->nameBoth = $this->owner->name . (($this ->owner->name_eng) ? ' ('.$this ->owner->name_eng.')':'');
        if(in_array('name_short',array_keys($this->owner->attributes))) {
            $this->nameBothShort = $this->owner->name_short . (($this->owner->name_short_eng) ? ' (' . $this->owner->name_short_eng . ')' : '');
        }
        else {
            $this->nameBothShort = $this->nameBoth;
        }
    }
}