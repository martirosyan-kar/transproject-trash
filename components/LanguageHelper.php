<?php
/**
 * Created by PhpStorm.
 * User: karen
 * Date: 1/31/16
 * Time: 12:07 PM
 */

namespace app\components;

use Yii;
use app\models\Region;
use yii\helpers\ArrayHelper;

class LanguageHelper
{
    public static function getMenuItems()
    {
        $items = [];
        $regions = ArrayHelper::map(Region::find()->all(), 'id', 'nameBoth');

        $controller = Yii::$app->controller;

        foreach ($regions as $key => $value) {
            $arrayParams = ['MainSearch' => ['region' => $key]];
            $params = array_merge(["{$controller->id}/index"], $arrayParams);
            $url = Yii::$app->urlManager->createUrl($params);
            $items[] = ['label' => $value, 'url' => $url];
        }
        $items[] = ['label' => 'Գրադարան (Library)', 'url' => '/site/list'];
        return $items;
    }

    public static function getModels()
    {
        return [
            'Region' => [
                'Տարածք',
                'Region'
            ],
            'City' => [
                'Համայնք',
                'Community'
            ],
            'Children' => [
                'Երեխաներ',
                'Children'
            ],
            'Dominant' => [
                'Ընտանիքի գլխավոր',
                'Household head'
            ],
            'Employee' => [
                'Աշխատավարձ ստացողների քանակ',
                'Employed (on paid job)'
            ],
            'Paper' => [
                'Արդյոք թափում եք աղբի հետ միասին նաև մեծ քանակությամբ թուղթ կամ ստվարաթուղթ',
                'Is there rather much of paper/cardboard in waste from your household'
            ],
            'Resident' => [
                'Փաստացի բնակիչների քանակը',
                'Actual number of persons in the household'
            ],
            'Retiree' => [
                'Թոշակառուներ',
                'Receiving only pension'
            ],
            'TrashCount' => [
                'Մոտ քանի տոպրակ/դույլ աղբ է կուտակվում մեկ շաբաթում',
                'TrashCount'
            ],
            'TrashCountSummer' => [
                'Մոտավոր աղբի քանակը շաբաթում Ամռանը',
                'Approximate amount of waste per week in Summer'
            ],
            'TrashCountWinter' => [
                'Մոտավոր աղբի քանակը շաբաթում Ձմռանը',
                'Approximate amount of waste per week in Winter'
            ],
            'TrashMan' => [
                'Ով է սովորաբար նետում աղբը Ձեր տանը',
                'Who typically takes out the waste generated in your household'
            ],
            'TrashOutCount' => [
                'Քանի անգամ է Ձեր տանից  շաբաթվա ընթացքում հանվում աղբը?',
                'How many times a week take your household the waste out?'
            ],
            'TrashPlace' => [
                'Սովորաբար որտեղ եք նետում աղբըՍովորաբար որտեղ եք նետում աղբը',
                'Approximately how many bags/buckets of waste are taken out per week'
            ],
            'TrashRecycle' => [
                'Պատրաստ եք արդյոք մասնակցել այսպիսի փորձին: Առանձին հավաքել հետևյալ աղբը  հնարավոր վերամշակման համակարգի համար',
                'Are you ready to participated in experiment on separate collection for a possible recycling of the following waste fractions'
            ],
            'TrashRelation' => [
                'Ինչպես եք վերաբերվում աղբի խնդրին',
                'Your general attitude to waste issues'
            ],
            'Type' => [
                'Տնտեսության տիպը',
                'Household type'
            ],
        ];
    }

    public static function getLinks($key,$params)
    {
        $controller = Yii::$app->controller;


        $array = [
            'chart' => [
                'label' => 'Գրաֆիկներ (Charts)',
                'url' => '/site/chart'
            ],
            'index' => [
                'label' => 'Վերադառնալ (Back)',
                'url' => '/site/index'
            ],
        ];

        $return = $array[$key];

        $params = array_merge([$return['url']], $params);
        $return['url'] = Yii::$app->urlManager->createUrl($params);

        return $return;
    }
}