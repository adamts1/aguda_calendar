<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Supervisor;
use app\models\center;
use app\models\user;

/**
 * SupervisorSearch represents the model behind the search form about `app\models\Supervisor`.
 */
class SupervisorSearch extends Supervisor
{

      public $user;
      public $center;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'centerId'], 'integer'],
            [['user','center'], 'safe'],
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

            $query->joinWith(['id0','center']);
          



        // add conditions that should always apply here
        if (Yii::$app->user->identity->userRole == 3){  

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        }
        else{
            $dataProvider = new ActiveDataProvider([
             'query' => Supervisor::find()
           ->join('JOIN','center','supervisor.centerid=center.id')
           ->join('JOIN','user','supervisor.id=user.id')
           ->where(['supervisor.id' => Yii::$app->user->identity->id])

             ]);// provide for supervisor
        }


        $dataProvider->sort->attributes['user'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['user.firstname' => SORT_ASC],
        'desc' => ['user.firstname' => SORT_DESC],
    ];

     $dataProvider->sort->attributes['center'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['center.name' => SORT_ASC],
        'desc' => ['center.name' => SORT_DESC],
    ];

    // $dataProvider->sort->attributes['center'] = [
    //     // The tables are the ones our relation are configured to
    //     // in my case they are prefixed with "tbl_"
    //     'asc' => ['center.name' => SORT_ASC],
    //     'desc' => ['center.name' => SORT_DESC],
    // ];



        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        // $query->andFilterWhere([
        //     // 'id' => $this->id,
        //     'center' => $this->centerId,
        // ]);

    //    $query->andFilterWhere(['like', 'user.firstname' ,  $this->user]);
        $query->andFilterWhere(['like', 'user.firstname' ,  $this->user]);
        $query->andFilterWhere(['like', 'center.name' ,  $this->center]);



        

        return $dataProvider;
    }
}
