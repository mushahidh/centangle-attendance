<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MonthlyReport;

/**
 * MonthlyReportSearch represents the model behind the search form about `backend\models\MonthlyReport`.
 */
class MonthlyReportSearch extends MonthlyReport
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'staff_id', 'total_office_days', 'total_present', 'allowed_vocation', 'vocation_used', 'vocation_left', 'extra_vocation', 'fine'], 'integer'],
            [['date'], 'safe'],
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
        $query = MonthlyReport::find();

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
            'staff_id' => $this->staff_id,
            'total_office_days' => $this->total_office_days,
            'total_present' => $this->total_present,
            'allowed_vocation' => $this->allowed_vocation,
            'vocation_used' => $this->vocation_used,
            'vocation_left' => $this->vocation_left,
            'extra_vocation' => $this->extra_vocation,
            'fine' => $this->fine,
            'date' => $this->date,
        ]);

        return $dataProvider;
    }
}
