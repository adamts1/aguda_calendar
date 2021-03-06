<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Events;

/**
 * EventsSearch represents the model behind the search form of `app\models\Events`.
 */
class EventsSearch extends Events
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'centerid', 'groupNumber', 'courseid', 'teacherid', 'locationid'], 'integer'],
            [['title', 'color', 'start', 'end', 'studentstring'], 'safe'],
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
        $query = Events::find();
        // add conditions that should always apply here

       $dataProvider = new ActiveDataProvider([
           'pagination' => false,

       
             'query' => Events::find()
            ->join('JOIN','teacher','events.teacherid=teacher.id')
            ->where(['teacher.id' => Yii::$app->user->identity->id])
            ->andWhere(['<=','start',date("Y-m-d")])
            ->orderBy(['start' => SORT_DESC])
            ->limit(10)
            








             ]);// provide for supervisor

        $this->load($params);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'start' => $this->start,
            'end' => $this->end,
            'centerid' => $this->centerid,
            'groupNumber' => $this->groupNumber,
            'courseid' => $this->courseid,
            'teacherid' => $this->teacherid,
            'locationid' => $this->locationid,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'studentstring', $this->studentstring]);

        return $dataProvider;
    }
}
