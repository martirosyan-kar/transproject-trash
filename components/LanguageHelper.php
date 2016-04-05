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
            $params = array_merge(["site/index"], $arrayParams);
            $url = Yii::$app->urlManager->createUrl($params);
            $items[] = ['label' => $value, 'url' => $url];
        }
        $arrayParams = ['MainSearch' => ['region' => -1]];
        $params = array_merge(["site/index"], $arrayParams);
        $url = Yii::$app->urlManager->createUrl($params);
        $items[] = ['label' => 'Պատ. (Random)', 'url' => $url];
        if(\Yii::$app->user->can('site.list')) {
            $items[] = ['label' => 'Գր. (Library)', 'url' => '/site/list'];
        }
        if(\Yii::$app->user->can('site.users')) {
            $items[] = ['label' => 'Օգտ. (Users)', 'url' => '/site/users'];
        }
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
            'Dominant' => [
                'Ընտանիքի գլխավոր',
                'Household head'
            ],
            'Paper' => [
                'Արդյոք թափում եք աղբի հետ միասին նաև մեծ քանակությամբ թուղթ կամ ստվարաթուղթ',
                'Is there rather much of paper/cardboard in waste from your household'
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
            'TrashPlace' => [
                'Սովորաբար որտեղ եք նետում աղբը',
                'Where do you typically take waste from your household?'
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
            'Person' => [
                'Հարցումը անցկացրեց',
                'The interviewer name'
            ],
            'RubberItems' => [
                'Ռետինե իրեր',
                'Rubber items'
            ],
        ];
    }

    public static function getLinks($key, $params)
    {
        $controller = Yii::$app->controller;
        $array = [
            'chart' => [
                'label' => 'Գրաֆիկներ (Charts)',
                'url' => '/site/chart'
            ],
            'table' => [
                'label' => 'Հաշվետվություններ (Reports)',
                'url' => '/site/tables'
            ],
            'index' => [
                'label' => 'Վերադառնալ (Back)',
                'url' => '/site/index'
            ],
            'add' => [
                'label' => 'Ավելացնել (Add)',
                'url' => '/site/main'
            ],
            'excel' => [
                'label' => 'Արտահանել/Export Excel',
                'url' => '/site/tables'
            ],
        ];

        $return = $array[$key];

        $params = array_merge([$return['url']], $params);
        $return['url'] = Yii::$app->urlManager->createUrl($params);

        return $return;
    }

    /**
     * Get the full name of the Trash Count item
     * @param $i
     * @return string
     */
    public static function getSummerWinterNames($i, $type)
    {
        $className = 'app\models\TrashCount' . ucfirst($type);
        $array = ArrayHelper::map($className::find()->all(), 'id', 'nameBoth');
        $array[5] = 'Թուղթ';
        if (empty($array[$i])) {
            return '';
        }
        return $array[$i];
    }

    public static function getRanges()
    {
        return [
            1 => [1, 5],
            2 => [6, 10],
            3 => [11, 20],
            4 => [21, 10000]
        ];
    }

    public static function getUserMenus(){
        return [
            'users' => [
                'label' => 'Օգտագործողներ (Users)',
                'url' => Yii::$app->urlManager->createUrl(['/user/manager'])
            ],
            'rbac-rule' => [
                'label' => 'Իրավասություններ (rule)',
                'url' => Yii::$app->urlManager->createUrl(['/rbac/rule'])
            ],
            'rbac-permission' => [
                'label' => 'Իրավասություններ (permissions)',
                'url' => Yii::$app->urlManager->createUrl(['/rbac/permission'])
            ],
            'rbac-role' => [
                'label' => 'Իրավասություններ (role)',
                'url' => Yii::$app->urlManager->createUrl(['/rbac/role'])
            ],
            'rbac-assignment' => [
                'label' => 'Իրավասություններ (assignment)',
                'url' => Yii::$app->urlManager->createUrl(['/rbac/assignment'])
            ]
        ];
    }
}