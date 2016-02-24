<?php

namespace app\controllers;

use app\models\City;
use app\models\Main;
use app\models\MainSearch;
use app\models\MainTrashMan;
use app\models\MainTrashPlace;
use app\models\MainTrashRecycle;
use app\models\MainTrashRelation;
use app\models\Region;
use app\models\TrashRecycle;
use app\models\Type;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use app\models\LoginForm;
use app\components\LanguageHelper;

class SiteController extends Controller
{
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
        $params = Yii::$app->request->queryParams;
        $region = 1;
        if (!empty($params['MainSearch']['region'])) {
            $region = $params['MainSearch']['region'];
        }

        $searchModel = new MainSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'region' => $region
        ]);
    }

    /**
     * Chart Page
     * @return string
     */
    public function actionChart()
    {
        $params = Yii::$app->request->queryParams;
        $region = 1;
        if (!empty($params['MainSearch']['region'])) {
            $region = $params['MainSearch']['region'];
        }
        $mains = Main::find()->where(array('region' => $region))->all();
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
                            'label' => LanguageHelper::getSummerWinterNames($i, $season)
                        ];

                        $totalsKG[$season][$season . '_' . $i] = [
                            'value' => 0,
                            'label' => LanguageHelper::getSummerWinterNames($i, $season)
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
                            'label' => LanguageHelper::getSummerWinterNames($i, $season)
                        ];

                        $dataKG[$season][$cityKey][$season . '_' . $i] = [
                            'value' => 0,
                            'label' => LanguageHelper::getSummerWinterNames($i, $season)
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
            'region' => $region
        ]);
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

    public function actionList()
    {
        $lists = LanguageHelper::getModels();

        return $this->render('list', ['lists' => $lists]);
    }

    public function actionMain()
    {
        $params = Yii::$app->request->queryParams;
        $region = 1;
        if (!empty($params['MainSearch']['region'])) {
            $region = $params['MainSearch']['region'];
        }
        if (!empty($params['id'])) {
            $model = Main::find()->where(['id' => $params['id']])->one();
            $arrayParams = ['MainSearch' => ['region' => $model->region]];
        } else {
            $model = new Main;
            $model->region = $region;
            $arrayParams = ['MainSearch' => ['region' => $region]];
        }


        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if (!$model->isNewRecord) {
                    MainTrashPlace::deleteAll(['main_id' => $model->id]);
                    MainTrashMan::deleteAll(['main_id' => $model->id]);
                    MainTrashRelation::deleteAll(['main_id' => $model->id]);
                    MainTrashRecycle::deleteAll(['main_id' => $model->id]);
                }
                $model->save();
                $main = Yii::$app->request->post()['Main'];
                if (!empty($main['places'])) {
                    foreach ($main['places'] as $value) {
                        $relationModel = new MainTrashPlace();
                        $relationModel->main_id = $model->id;
                        $relationModel->trash_place_id = $value;
                        $relationModel->save();
                    }
                }
                if (!empty($main['men'])) {
                    foreach ($main['men'] as $value) {
                        $relationModel = new MainTrashMan();
                        $relationModel->main_id = $model->id;
                        $relationModel->trash_man_id = $value;
                        $relationModel->save();
                    }
                }
                if (!empty($main['relations'])) {
                    foreach ($main['relations'] as $value) {
                        $relationModel = new MainTrashRelation();
                        $relationModel->main_id = $model->id;
                        $relationModel->trash_relation_id = $value;
                        $relationModel->save();
                    }
                }
                if (!empty($main['recycles'])) {
                    foreach ($main['recycles'] as $value) {
                        $relationModel = new MainTrashRecycle();
                        $relationModel->main_id = $model->id;
                        $relationModel->trash_recycle_id = $value;
                        $relationModel->save();
                    }
                }
                $arrayParams['id'] = $model->id;
                $params = array_merge(["site/index"], $arrayParams);
                $url = Yii::$app->urlManager->createUrl($params);
                return $this->redirect($url);
            }
        }

        $model->places = ArrayHelper::getColumn($model->mainTrashPlaces, 'trash_place_id');
        $model->men = ArrayHelper::getColumn($model->mainTrashMen, 'trash_man_id');
        $model->relations = ArrayHelper::getColumn($model->mainTrashRelations, 'trash_relation_id');
        $model->recycles = ArrayHelper::getColumn($model->mainTrashRecycles, 'trash_recycle_id');

        return $this->render('main', [
            'model' => $model,
            'region' => $region
        ]);
    }

    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('site.users')) {
            $params = Yii::$app->request->queryParams;
            if (empty($params['MainSearch']['region'])) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }

            $this->findModel($id)->delete();
            $params = array_merge(["site/index"], $params);
            $url = Yii::$app->urlManager->createUrl($params);
            return $this->redirect($url);
        } else {
            throw new ForbiddenHttpException('You are not authorized to perform this action.');
        }
    }

    protected function findModel($id)
    {
        if (($model = Main::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUsers()
    {
        return $this->render('users');
    }

    public function actionTables()
    {
        $params = Yii::$app->request->queryParams;
        $region = 1;
        if (!empty($params['MainSearch']['region'])) {
            $region = $params['MainSearch']['region'];
        }

        $data = Main::find()->where(['region' => $region])->all();
        $cities = ArrayHelper::map(City::find()->where(['region' => $region])->orderBy('id')->all(), 'id', 'nameBoth');
        $types = ArrayHelper::map(Type::find()->orderBy('id')->all(), 'id', 'nameBoth');

        return $this->render('tables', ['data' => $data, 'cities' => $cities, 'types' => $types]);
    }
}
