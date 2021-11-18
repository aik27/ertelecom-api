<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\WifiSpot;
use yii\db\Query;

class WifiSpotSearch extends WifiSpot
{
    public function rules()
    {
        return [
            [['id', 'city_id', 'language_id'], 'integer'],
            [['key'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params, int $perPage = 20) : ActiveDataProvider
    {
        $query = WifiSpot::find();
        $query->with('city');
        $query->with('language');

        $sort = [
            'defaultOrder' => [
                'id' => SORT_DESC
            ],
        ];

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => $sort,
            'pagination' => [
                'pageSize' => $perPage,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere($this->getGridConditions($params));

        return $dataProvider;
    }

    public function getGridConditions($params): array
    {
        $this->load($params);
        $conditions = [];

        if (!empty($this->id)) {
            $conditions['id'] = $this->id;
        }
        if (!empty($this->key)) {
            $conditions['key'] = $this->key;
        }
        if (!empty($this->city_id)) {
            $conditions['city_id'] = $this->city_id;
        }
        if (!empty($this->language_id)) {
            $conditions['language_id'] = $this->language_id;
        }

        return $conditions;
    }
}
