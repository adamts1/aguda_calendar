<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Student;
use app\models\Center;
use yii\db\ActiveRecord;


/**
 * StudentSearch represents the model behind the search form of `app\models\Student`.
 */
class StudentSearch extends Student
{
    /**
     * @inheritdoc
     */
    public $center;

    public function rules()
    {
        return [
            [['id', 'centerid'], 'integer'],
            [['name', 'lastname','center', 'grade', 'phone', 'notes', 'nickname'], 'safe'],
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

        // add conditions that should always apply here
     if (Yii::$app->user->identity->userRole == 3){
          // if eden
           $query = Student::find();

         }

          if (Yii::$app->user->identity->userRole == 2 ){  

            $query = Student::find()
           ->join('JOIN','center as c','student.centerid=c.id')
           ->join('JOIN','supervisor as s','c.id=s.centerId')
           ->where(['s.id' => Yii::$app->user->identity->id]);

         }

          if (Yii::$app->user->identity->userRole == 1 ){  
               $query = Student::find()
              ->join('JOIN','center','student.centerid=center.id')
              ->join('JOIN','supervisor','center.id=supervisor.centerId')
              ->where(['supervisor.id' => Yii::$app->user->identity->id]);

         }
                    $query->joinWith(['center']);


          if (!Yii::$app->user->isGuest){
      

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

          }

               $dataProvider->sort->attributes['center'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['center.name' => SORT_ASC],
        'desc' => ['center.name' => SORT_DESC],
    ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'centerid' => $this->centerid,
        // ]);

        // $query->andFilterWhere(['like', 'name1', $this->name])
            $query->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'grade', $this->grade])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'center.name', $this->center])
            ->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'nickname', $this->nickname]);

            

        return $dataProvider;
    }
}
