<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrderCustomer;

/**
 * OrderCustomerSearch represents the model behind the search form about `app\models\OrderCustomer`.
 */
class OrderCustomerSearch extends OrderCustomer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status', 'update_by', 'type', 'customer_id'], 'integer'],
            [['total_amount'], 'number'],
            [['note', 'created_date', 'update_at'], 'safe'],
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
        $query = OrderCustomer::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],

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
            'user_id' => $this->user_id,
            'total_amount' => $this->total_amount,
            'created_date' => $this->created_date,
            'update_at' => $this->update_at,
            'status' => $this->status,
            'update_by' => $this->update_by,
            'type' => $this->type,
            'customer_id' => $this->customer_id,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
