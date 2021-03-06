<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FundingsourceTeacher;

/**
 * FundingsourceTeacherSearch represents the model behind the search form of `app\models\FundingsourceTeacher`.
 */
class FundingsourceTeacherSearch extends FundingsourceTeacher
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sourceid', 'teacherid','numberOfHours'], 'integer'],
            [['sourceid', 'teacherid','numberOfHours'], 'required'],


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
        $query = FundingsourceTeacher::find();

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
            'sourceid' => $this->sourceid,
            'teacherid' => $this->teacherid,
            'numberOfHours'=>$this->numberOfHours,
        ]);

        return $dataProvider;
    }
}
