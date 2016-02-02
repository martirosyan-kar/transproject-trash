<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Main;

/**
 * MainSearch represents the model behind the search form about `app\models\Main`.
 */
class MainSearch extends Main
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'answer_count',
                    'woman_count',
                    'date',
                    'interrogatory',
                    'summer_count_1',
                    'winter_count_1',
                    'summer_count_2',
                    'summer_count_3',
                    'summer_count_4',
                    'winter_count_2',
                    'winter_count_3',
                    'winter_count_4',
                    'mainTrashPlaces.trash_place_id',
                    'mainTrashMen.trash_man_id',
                    'mainTrashRecycles.trash_recycle_id',
                    'mainTrashRelations.trash_relation_id',
                    'filter_summer_1',
                    'filter_summer_2',
                    'filter_summer_3',
                    'filter_summer_4',
                    'filter_winter_1',
                    'filter_winter_2',
                    'filter_winter_3',
                    'filter_winter_4'
                ],
                'safe'
            ],
            [
                [
                    'region',
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
                    'id'
                ],
                'integer'
            ],
        ];
    }

    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), [
            'mainTrashPlaces.trash_place_id',
            'mainTrashMen.trash_man_id',
            'mainTrashRecycles.trash_recycle_id',
            'mainTrashRelations.trash_relation_id',
            'filter_summer_1',
            'filter_summer_2',
            'filter_summer_3',
            'filter_summer_4',
            'filter_winter_1',
            'filter_winter_2',
            'filter_winter_3',
            'filter_winter_4'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        if (empty($this->region)) {
            $this->region = 1;
        }
        $query = Main::find()->joinWith(['mainTrashPlaces', 'mainTrashMen', 'mainTrashRecycles', 'mainTrashRelations']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->select('main.*');
        $query->distinct();

        $query->andFilterWhere([
            'region' => $this->region,
            'city' => $this->city,
            'type' => $this->type,
            'resident' => $this->resident,
            'children' => $this->children,
            'employee' => $this->employee,
            'retiree' => $this->retiree,
            'dominant' => $this->dominant,
            'trash_man' => $this->trash_man,
            'trash_out' => $this->trash_out,
            'trash_count' => $this->trash_count,
            'trash_count_summer' => $this->trash_count_summer,
            'trash_count_winter' => $this->trash_count_winter,
            'paper' => $this->paper,
            'trash_relation' => $this->trash_relation,
            'trash_recycle' => $this->trash_recycle,
            'person' => $this->person,
            'id' => $this->id,
            'main_trash_place.trash_place_id' => $this->getAttribute('mainTrashPlaces.trash_place_id'),
            'main_trash_man.trash_man_id' => $this->getAttribute('mainTrashMen.trash_man_id'),
            'main_trash_recycle.trash_recycle_id' => $this->getAttribute('mainTrashRecycles.trash_recycle_id'),
            'main_trash_relation.trash_relation_id' => $this->getAttribute('mainTrashRelations.trash_relation_id'),
        ]);
        $query = $this->addBetween($query);

        $query->andFilterWhere(['like', 'answer_count', $this->answer_count])
            ->andFilterWhere(['like', 'woman_count', $this->woman_count])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'interrogatory', $this->interrogatory]);


        return $dataProvider;
    }

    public function addBetween($query)
    {
        $seasons = ['summer', 'winter'];
        $ranges = [1 => [1, 5], 2 => [6, 10], 3 => [11, 20], 4 => [21, 10000]];
        foreach ($seasons as $season) {
            for ($i = 1; $i <= 4; $i++) {
                $fieldCompare = $season . '_count_' . $i;
                $fieldFilter = 'filter_' . $season . '_' . $i;
                for ($j = 1; $j <= 4; $j++) {
                    if ($this->$fieldFilter == $j) {
                        $query->andWhere(['between', $fieldCompare, $ranges[$j][0], $ranges[$j][1]]);
                    }
                }
            }
        }

        return $query;
    }
}
