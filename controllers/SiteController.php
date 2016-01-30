<?php

namespace app\controllers;

use app\models\City;
use app\models\Main;
use app\models\MainSearch;
use app\models\TrashRecycle;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new MainSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionChart()
    {
        $mains = Main::find()->all();
        $cities = ArrayHelper::map(City::find()->all(), 'id', 'name');
        $recycles = ArrayHelper::map(TrashRecycle::find()->all(), 'id', 'name');
        $cityKeys = array_keys($cities);
        //echo "<pre>";print_r($cities);exit();
        $seasons = ['summer', 'winter'];
        $data = [];
        $totals = [];
        $recycleTotal = [];
        $recycle = [];
        $dataKG = [];
        $totalsKG = [];
        foreach ($mains as $main) {
            foreach ($seasons as $season) {
                if (!isset($data[$season])) {
                    $data[$season] = [];
                    $totals[$season] = [];

                    $dataKG[$season] = [];
                    $totalsKG[$season] = [];
                }
                // totals for summer/winter
                for ($i = 1; $i <= 5; $i++) {
                    if (empty($totals[$season][$season . '_' . $i])) {
                        if ($i == 5) {
                            $filterField = 'paper';
                        } else {
                            $filterField = 'filter_' . $season . '_' . $i;
                        }

                        $totals[$season][$season . '_' . $i] = [
                            'value' => 0,
                            'label' => $this->getSummerWinterNames($i)
                        ];

                        $totalsKG[$season][$season . '_' . $i] = [
                            'value' => 0,
                            'label' => $this->getSummerWinterNames($i)
                        ];

                    }
                    $sum = 0;
                    if ($i == 5) {
                        $field = 'paper';
                        if ($main->$field == 1) {
                            $sum = 5;
                        }
                    } else {
                        $field = $season . '_count_' . $i;
                        $sum = $main->$field;
                    }
                    $totals[$season][$season . '_' . $i]['value'] += $sum;

                    $totalsKG[$season][$season . '_' . $i]['value'] += ($sum * $this->getWeights($i));
                }
                // summer/winter based on cities
                $cityKey = $main->city;
                if (!isset($data[$season][$cityKey])) {
                    $data[$season][$cityKey] = [];
                }
                for ($i = 1; $i <= 5; $i++) {
                    if (empty($data[$season][$cityKey][$season . '_' . $i])) {
                        if ($i == 5) {
                            $filterField = 'paper';
                        } else {
                            $filterField = 'filter_' . $season . '_' . $i;
                        }
                        $color = $this->getRandomColor($i);
                        $data[$season][$cityKey][$season . '_' . $i] = [
                            'value' => 0,
                            'color' => $color['color'],
                            'highlight' => $color['highlight'],
                            'label' => $this->getSummerWinterNames($i)
                        ];

                        $dataKG[$season][$cityKey][$season . '_' . $i] = [
                            'value' => 0,
                            'color' => $color['color'],
                            'highlight' => $color['highlight'],
                            'label' => $this->getSummerWinterNames($i)
                        ];
                    }
                    $sum = 0;
                    if ($i == 5) {
                        $field = 'paper';
                        if ($main->$field == 1) {
                            $sum = 5;
                        }
                    } else {
                        $field = $season . '_count_' . $i;
                        $sum = $main->$field;
                    }
                    $data[$season][$cityKey][$season . '_' . $i]['value'] += $sum;

                    $dataKG[$season][$cityKey][$season . '_' . $i]['value'] += ($sum * $this->getWeights($i));
                }
            }

            $cityKeyRecycle = $main->city;

            $trashRecycles = array_keys($main->getRecycleIds());
            if (!isset($recycle[$cityKeyRecycle])) {
                $recycle[$cityKeyRecycle] = [];
            }
            foreach ($trashRecycles as $trashRecycle) {
                if ($trashRecycle === 0) {
                    continue;
                }
                if (!isset($recycle[$cityKeyRecycle][$trashRecycle])) {
                    $recycle[$cityKeyRecycle][$trashRecycle] = [
                        'value' => 0,
                        'label' => $this->getRecycleNames($trashRecycle)
                    ];
                }
                if (!isset($recycleTotal[$trashRecycle])) {
                    $recycleTotal[$trashRecycle] = [
                        'value' => 0,
                        'label' => $this->getRecycleNames($trashRecycle)
                    ];
                }
                $recycle[$cityKeyRecycle][$trashRecycle]['value'] += 1;
                $recycleTotal[$trashRecycle]['value'] += 1;
            }

        }
        return $this->render('chart', [
            'data' => $data,
            'totals' => $totals,
            'cities' => $cities,
            'recycle' => $recycle,
            'recycleTotal' => $recycleTotal,
            'recycles' => $recycles,
            'totalsKG' => $totalsKG,
        ]);
    }

    public function getRandomColor($i)
    {
        $array = [
            1 => ['color' => "#F7464A", 'highlight' => "#FF5A5E"],
            2 => ['color' => "#46BFBD", 'highlight' => "#5AD3D1"],
            3 => ['color' => "#FDB45C", 'highlight' => "#FFC870"],
            4 => ['color' => "#FFC870", 'highlight' => "#A8B3C5"],
            5 => ['color' => "#A8B3C5", 'highlight' => "#616774"],
        ];
        return $array[$i];
        //return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    public function getSummerWinterNames($i)
    {
        $array = [
            1 => 'Պլաստմասսայից շշեր 0.5-1 լ',
            2 => 'Պլաստմասսայից շշեր 1.5-2 լ',
            3 => 'Պոլիէթիլենային տոպրակներ',
            4 => 'Ապակե տարրաներ / շշեր',
            5 => 'Թուղթ'
        ];
        return $array[$i];
    }

    public function getRecycleNames($i)
    {
        $array = [
            1 => 'Պլաստմասսայից շշեր',
            2 => 'Պոլիէթիլենային տոպրակներ',
            3 => 'Ապակետարաներ / շշեր',
            4 => 'Թուղթ / ստվարաթուղթ',
            5 => 'Էլեկտրոտեխնիկական սարքավորումներ',
            6 => 'Էլեկտրական մարտկոցներ',
            7 => 'Գոմաղբ',
            8 => 'Օրգանական աղբ / սննդաղբ',
            9 => 'Կահույք',
            10 => 'Տեքստիլ / Հագուստ',
            11 => 'Մետաղական իրեր',
            12 => 'Ռետինե իրեր',
        ];
        return $array[$i];
    }

    public function getWeights($i) {
        $array = [
            1 => 0.035,
            2 => 0.042,
            3 => 0.025,
            4 => 0.425,
            5 => 0.01
        ];
        return $array[$i];
    }

}
