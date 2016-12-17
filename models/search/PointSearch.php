<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Point;

/**
 * PointSearch represents the model behind the search form about `app\models\Point`.
 */
class PointSearch extends Point
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'point_begin', 'point_end'], 'integer'],
            [['prize', 'created_date'], 'safe'],
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
        $query = Point::find();

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
            'point_begin' => $this->point_begin,
            'point_end' => $this->point_end,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'prize', $this->prize]);

        return $dataProvider;
    }
}
