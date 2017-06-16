<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Supervisor;

/**
 * SupervisorSearch represents the model behind the search form about `app\models\Supervisor`.
 */
class SupervisorSearch extends Supervisor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'centerId'], 'integer'],
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
        $query = Supervisor::find();

        // add conditions that should always apply here
        if (\Yii::$app->user->can('createSchoolDir')){

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        }else{
            $dataProvider = new ActiveDataProvider([
             'query' => Supervisor::find()
           ->join('JOIN','center','supervisor.centerid=center.id')
           ->where(['supervisor.id' => Yii::$app->user->identity->id])

             ]);// provide for supervisor
        }

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'centerId' => $this->centerId,
        ]);

        return $dataProvider;
    }
}
