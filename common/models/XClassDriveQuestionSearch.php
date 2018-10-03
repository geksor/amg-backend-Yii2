<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\XClassDriveQuestion;

/**
 * XClassDriveQuestionSearch represents the model behind the search form of `common\models\XClassDriveQuestion`.
 */
class XClassDriveQuestionSearch extends XClassDriveQuestion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'answer_isImage'], 'integer'],
            [['title', 'question', 'question_image', 'description', 'request', 'answer_var_1', 'answer_var_2', 'answer_var_3', 'answer_var_4'], 'safe'],
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
        $query = XClassDriveQuestion::find();

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
            'answer_isImage' => $this->answer_isImage,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'question', $this->question])
            ->andFilterWhere(['like', 'question_image', $this->question_image])
            ->andFilterWhere(['like', 'description', $this->description])
//            ->andFilterWhere(['like', 'request', $this->request])
            ->andFilterWhere(['like', 'answer_var_1', $this->answer_var_1])
            ->andFilterWhere(['like', 'answer_var_2', $this->answer_var_2])
            ->andFilterWhere(['like', 'answer_var_3', $this->answer_var_3])
            ->andFilterWhere(['like', 'answer_var_4', $this->answer_var_4]);

        return $dataProvider;
    }
}
