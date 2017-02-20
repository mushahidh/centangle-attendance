<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Attendence;

/**
 * AttendenceSearch represents the model behind the search form about `backend\models\Attendence`.
 */
class AttendenceSearch extends Attendence
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['status', 'time_in','staff_id', 'time_out', 'daytime'], 'safe'],
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
        $query = Attendence::find();

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
 $query->joinWith('staff');
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'daytime' => $this->daytime,
      
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'time_in', $this->time_in])
            ->andFilterWhere(['like', 'time_out', $this->time_out])
       ->andFilterWhere(['like', 'staff.name', $this->staff_id]);

        return $dataProvider;
    }
}
