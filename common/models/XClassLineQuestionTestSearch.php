<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\XClassLineQuestion;

/**
 * XClassLineQuestionTestSearch represents the model behind the search form of `common\models\XClassLineQuestion`.
 */
class XClassLineQuestionTestSearch extends XClassLineQuestion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'answerCount', 'xClass_line_test_id'], 'integer'],
            [['title', 'leftColumn', 'rightColumn'], 'safe'],
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
        $query = XClassLineQuestion::find();

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
            'xClass_line_test_id' => $this->xClass_line_test_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'leftColumn', $this->leftColumn])
            ->andFilterWhere(['like', 'rightColumn', $this->rightColumn]);

        return $dataProvider;
    }
}
