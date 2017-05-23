<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Location;

/**
 * LocationSearch represents the model behind the search form of `app\models\Location`.
 */
class LocationSearch extends Location
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'centerid'], 'integer'],
            [['name'], 'safe'],
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
        $query = Location::find();

   /////////// query that provide only location of conected user
           $dataProvider = new ActiveDataProvider([
              'query' => Location::find()
           ->join('JOIN','center','location.centerid=center.id')
           ->join('JOIN','supervisor','center.id=supervisor.centerId')
           ->where(['supervisor.id' => Yii::$app->user->identity->id])

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
            'centerid' => $this->centerid,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
