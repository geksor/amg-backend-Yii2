<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Quiz;

/**
 * QuizSearch represents the model behind the search form of `common\models\Quiz`.
 */
class QuizSearch extends Quiz
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'trueAnswer'], 'integer'],
            [['question', 'answer_1', 'answer_2', 'answer_3', 'answer_4'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Quiz::find();

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
            'trueAnswer' => $this->trueAnswer,
        ]);

        $query->andFilterWhere(['like', 'question', $this->question])
            ->andFilterWhere(['like', 'answer_1', $this->answer_1])
            ->andFilterWhere(['like', 'answer_2', $this->answer_2])
            ->andFilterWhere(['like', 'answer_3', $this->answer_3])
            ->andFilterWhere(['like', 'answer_4', $this->answer_4]);

        return $dataProvider;
    }
}
