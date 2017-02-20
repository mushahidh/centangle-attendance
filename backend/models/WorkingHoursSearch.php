<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\WorkingHours;

/**
 * WorkingHoursSearch represents the model behind the search form about `backend\models\WorkingHours`.
 */
class WorkingHoursSearch extends WorkingHours
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'attendence_id'], 'integer'],
            [['check_in', 'check_out'], 'safe'],
        ];
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
        $query = WorkingHours::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'attendence_id' => $this->attendence_id,
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,
        ]);

        return $dataProvider;
    }
}
