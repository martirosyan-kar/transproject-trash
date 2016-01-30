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

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','index','chart'],
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

    /**
     * Table Page
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MainSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Chart Page
     * @return string
     */
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

                    $totalsKG[$season][$season . '_' . $i]['value'] += ($sum * $this->getWeightByType($i));
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
                        $data[$season][$cityKey][$season . '_' . $i] = [
                            'value' => 0,
                            'label' => $this->getSummerWinterNames($i)
                        ];

                        $dataKG[$season][$cityKey][$season . '_' . $i] = [
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
                    $data[$season][$cityKey][$season . '_' . $i]['value'] += $sum;

                    $dataKG[$season][$cityKey][$season . '_' . $i]['value'] += ($sum * $this->getWeightByType($i));
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

    /**
     * Get the full name of the Trash Count item
     * @param $i
     * @return string
     */
    public function getSummerWinterNames($i)
    {
        $array = [
            1 => 'Պլաստմասսայից շշեր 0.5-1 լ',
            2 => 'Պլաստմասսայից շշեր 1.5-2 լ',
            3 => 'Պոլիէթիլենային տոպրակներ',
            4 => 'Ապակե տարրաներ / շշեր',
            5 => 'Թուղթ'
        ];
        if (empty($array[$i])) {
            return '';
        }
        return $array[$i];
    }

    /**
     * Get the full name of recycling item
     * @param $i
     * @return string
     */
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
        if (empty($array[$i])) {
           return '';
        }
        return $array[$i];
    }

    /**
     * Get the weight of unit for each type of Trash Count Type + Paper
     * @param $i
     * @return int
     */
    public function getWeightByType($i)
    {
        $array = [
            1 => 0.035,
            2 => 0.042,
            3 => 0.025,
            4 => 0.425,
            5 => 0.01
        ];

        if (empty($array[$i])) {
            return 0;
        }
        return $array[$i];
    }
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
