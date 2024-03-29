<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AmgStaticQuestion;

/**
 * AmgStaticQuestionSearch represents the model behind the search form of `common\models\AmgStaticQuestion`.
 */
class AmgStaticQuestionSearch extends AmgStaticQuestion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'answerCount'], 'integer'],
            [['title', 'image_1', 'image_2', 'image_3', 'amgStatic_test_id'], 'safe'],
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
        $query = AmgStaticQuestion::find();

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
            'answerCount' => $this->answerCount,
            'amgStatic_test_id' => $this->amgStatic_test_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'image_1', $this->image_1])
            ->andFilterWhere(['like', 'image_2', $this->image_2])
            ->andFilterWhere(['like', 'image_3', $this->image_3]);

        return $dataProvider;
    }
}
