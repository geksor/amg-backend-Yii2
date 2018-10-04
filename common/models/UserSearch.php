<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form of `common\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'role', 'created_at', 'updated_at', 'group', 'training_id', 'dealer_center_id', 'amgStatic', 'mixStatic', 'mbux', 'xClassDrive', 'amgDrive', 'intelligent', 'mixDrive', 'xClassLine', 'quiz', 'moderatorPoints', 'totalPoint', 'command_id'], 'integer'],
            [['username', 'surname', 'first_name', 'last_name', 'auth_key', 'password_hash', 'password_reset_token', 'email'], 'safe'],
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
        $query = User::find();

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
            'status' => $this->status,
            'role' => [3,4],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'group' => $this->group,
            'training_id' => $this->training_id,
            'dealer_center_id' => $this->dealer_center_id,
            'amgStatic' => $this->amgStatic,
            'mixStatic' => $this->mixStatic,
            'mbux' => $this->mbux,
            'xClassDrive' => $this->xClassDrive,
            'amgDrive' => $this->amgDrive,
            'intelligent' => $this->intelligent,
            'mixDrive' => $this->mixDrive,
            'xClassLine' => $this->xClassLine,
            'quiz' => $this->quiz,
            'moderatorPoints' => $this->moderatorPoints,
            'totalPoint' => $this->totalPoint,
            'command_id' => $this->command_id,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
