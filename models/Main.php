<?php

namespace app\models;

use app\components\LanguageHelper;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "main".
 *
 * @property string $answer_count
 * @property string $woman_count
 * @property string $date
 * @property string $interrogatory
 * @property integer $city
 * @property integer $type
 * @property integer $resident
 * @property integer $children
 * @property integer $employee
 * @property integer $retiree
 * @property integer $dominant
 * @property integer $trash_man
 * @property integer $trash_out
 * @property integer $trash_count
 * @property integer $trash_count_summer
 * @property integer $trash_count_winter
 * @property integer $paper
 * @property integer $trash_relation
 * @property integer $trash_recycle
 * @property string $summer_count_1
 * @property string $winter_count_1
 * @property string $summer_count_2
 * @property string $summer_count_3
 * @property string $summer_count_4
 * @property string $winter_count_2
 * @property string $winter_count_3
 * @property string $winter_count_4
 * @property integer $person
 * @property integer $id
 * @property integer $region
 *
 * @property City $city0
 * @property Dominant $dominant0
 * @property Paper $paper0
 * @property Person $person0
 * @property TrashCountSummer $trashCountSummer
 * @property TrashCountWinter $trashCountWinter
 * @property TrashMan $trashMan
 * @property TrashRecycle $trashRecycle
 * @property TrashRelation $trashRelation
 * @property Type $type0
 * @property MainTrashPlace[] $mainTrashPlaces
 * @property MainTrashMan[] $mainTrashMen
 * @property MainTrashRecycle[] $mainTrashRecycles
 * @property MainTrashRelation[] $mainTrashRelations
 *
 * @property trashPlaceMulti
 */
class Main extends \yii\db\ActiveRecord
{
    public $places = [];
    public $men = [];
    public $relations = [];
    public $recycles = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'main';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'city',
                    'type',
                    'resident',
                    'children',
                    'employee',
                    'retiree',
                    'dominant',
                    'trash_man',
                    'trash_out',
                    'trash_count',
                    'trash_count_summer',
                    'trash_count_winter',
                    'paper',
                    'trash_relation',
                    'trash_recycle',
                    'person',
                    'summer_count_1',
                    'winter_count_1',
                    'summer_count_2',
                    'summer_count_3',
                    'summer_count_4',
                    'winter_count_2',
                    'winter_count_3',
                    'winter_count_4',
                    'region',
                    'resident_man',
                    'resident_woman'
                ],
                'integer'
            ],
            [['answer_count', 'woman_count', 'date', 'interrogatory'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'answer_count' => 'Քանի մարդ էր պատասխանում հարցերին',
            'woman_count' => 'Կին մասնակիցների քանակը ',
            'date' => 'Ամսաթիվ',
            'interrogatory' => 'Հարցաթերթիկ',
            'city' => 'Համայնք',
            'type' => 'Տնտեսության տիպը',
            'resident' => 'Բնակիչների քանակ',
            'children' => 'Երեխաների քանակ',
            'employee' => 'Աշխատավարձ ստացողների քանակ',
            'retiree' => 'Թոշակառուներ',
            'dominant' => 'Ընտանիքի գլխավոր',
            'men' => 'Ով է սովորաբար նետում աղբը Ձեր տանը?',
            'trash_out' => 'Քանի անգամ է հանվում աղբը',
            'filter_trash_out' => 'Քանի անգամ է հանվում աղբը',
            'trash_count' => 'Քանի տոպրակ/դույլ',
            'filter_trash_count' => 'Քանի տոպրակ/դույլ',
            'trash_count_summer' => 'Մոտավոր աղբի քանակը ամռանը',
            'trash_count_winter' => 'Մոտավոր աղբի քանակը ձմռանը',
            'paper' => 'Թուղթ',
            'relations' => 'Ինչպես եք վերաբերվում աղբի խնդրին',
            'mainTrashRecycles.trash_recycle_id' => 'Վերամշակման փորձ',
            'mainTrashRelations.trash_relation_id' => 'Ինչպես եք վերաբերվում աղբի խնդրին',
            'mainTrashPlaces.trash_place_id' => 'Սովորաբար որտեղ եք նետում աղբը',
            'mainTrashMen.trash_man_id' => 'Ով է սովորաբար նետում աղբը Ձեր տանը',
            'filter_summer_1' => $this->getLabel('filter_summer_1'),
            'filter_summer_2' => $this->getLabel('filter_summer_2'),
            'filter_summer_3' => $this->getLabel('filter_summer_3'),
            'filter_summer_4' => $this->getLabel('filter_summer_4'),
            'filter_winter_1' => $this->getLabel('filter_winter_1'),
            'filter_winter_2' => $this->getLabel('filter_winter_2'),
            'filter_winter_3' => $this->getLabel('filter_winter_3'),
            'filter_winter_4' => $this->getLabel('filter_winter_4'),
            'person' => 'Հարցումը անցկացրեց',
            'id' => 'ID',
            'region' => 'Տարածք',
            'places' => 'Սովորաբար որտեղ եք նետում աղբը?',
            'recycles' => 'Պատրաստ եք արդյոք մասնակցել այսպիսի փորձին: Առանձին հավաքել հետևյալ աղբը  հնարավոր վերամշակման համակարգի համար?',
            'resident_man' => 'Չափահաս տղամարդ',
            'resident_woman' => 'Չափահաս կին',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity0()
    {
        return $this->hasOne(City::className(), ['id' => 'city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion0()
    {
        return $this->hasOne(Region::className(), ['id' => 'region']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDominant0()
    {
        return $this->hasOne(Dominant::className(), ['id' => 'dominant']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaper0()
    {
        return $this->hasOne(Paper::className(), ['id' => 'paper']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson0()
    {
        return $this->hasOne(Person::className(), ['id' => 'person']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrashCountSummer()
    {
        return $this->hasOne(TrashCountSummer::className(), ['id' => 'trash_count_summer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrashCountWinter()
    {
        return $this->hasOne(TrashCountWinter::className(), ['id' => 'trash_count_winter']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrashMan()
    {
        return $this->hasOne(TrashMan::className(), ['id' => 'trash_man']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrashRecycle()
    {
        return $this->hasOne(TrashRecycle::className(), ['id' => 'trash_recycle']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrashRelation()
    {
        return $this->hasOne(TrashRelation::className(), ['id' => 'trash_relation']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType0()
    {
        return $this->hasOne(Type::className(), ['id' => 'type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainTrashPlaces()
    {
        return $this->hasMany(MainTrashPlace::className(), ['main_id' => 'id']);
    }


    public function getTrashPlaces()
    {
        return $this->hasMany(TrashPlace::className(), ['id' => 'trash_place_id'])
            ->viaTable('main_trash_place', ['main_id' => 'id']);
    }

    public function getTrashPlaceMulti()
    {
        return implode(', ', ArrayHelper::map($this->trashPlaces, 'id', 'nameBothShort'));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainTrashMen()
    {
        return $this->hasMany(MainTrashMan::className(), ['main_id' => 'id']);
    }

    public function getTrashManMulti()
    {
        return implode(', ', ArrayHelper::map($this->trashMen, 'id', 'nameBothShort'));
    }

    public function getTrashMen()
    {
        return $this->hasMany(TrashMan::className(), ['id' => 'trash_man_id'])
            ->viaTable('main_trash_man', ['main_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainTrashRecycles()
    {
        return $this->hasMany(MainTrashRecycle::className(), ['main_id' => 'id']);
    }

    public function getTrashRecycleMulti()
    {
        return implode(', ', ArrayHelper::map($this->trashRecycles, 'id', 'nameBothShort'));
    }

    public function getRecycleIds()
    {
        return ArrayHelper::map($this->trashRecycles, 'id', 'nameBothShort');
    }

    public function getTrashRecycles()
    {
        return $this->hasMany(TrashRecycle::className(), ['id' => 'trash_recycle_id'])
            ->viaTable('main_trash_recycle', ['main_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainTrashRelations()
    {
        return $this->hasMany(MainTrashRelation::className(), ['main_id' => 'id']);
    }

    public function getTrashRelationMulti()
    {
        return implode(', ', ArrayHelper::map($this->trashRelations, 'id', 'nameBothShort'));
    }

    public function getTrashRelations()
    {
        return $this->hasMany(TrashRelation::className(), ['id' => 'trash_relation_id'])
            ->viaTable('main_trash_relation', ['main_id' => 'id']);
    }

    public function getLabel($attribute)
    {
        $matches = array();
        if (preg_match('/^filter_(summer|winter)_(\d+)$/', $attribute, $matches)) {
            $season = $matches[1];
            return LanguageHelper::getSummerWinterNames($matches[2],$season);
        }
        return '';
    }
}
