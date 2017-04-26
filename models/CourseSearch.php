<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
// use app\models\Course;

/**
 * CourseSearch represents the model behind the search form about `app\models\Course`.
 */
class CourseSearch extends Course
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['coursename'], 'safe'],
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
        $query = Course::find();

        // add conditions that should always apply here

        // $dataProvider = new ActiveDataProvider([
        //     'query' => $query,
        // ]);
        
        /////////// query that provide only courses of conected teacher 

        if (Yii::$app->user->can('createSchoolDir'))
         {
           $dataProvider = new ActiveDataProvider([
           'query' => $query,

         ]);}
         else{
            $dataProvider = new ActiveDataProvider([
              'query' => Course::find()
           ->join('JOIN','course_center','course_center.courseid=course.id')
           ->join('JOIN','center','course_center.centerid=center.id')
           ->join('JOIN','supervisor','center.id=supervisor.centerId')
           ->where(['supervisor.id' => Yii::$app->user->identity->id])

        ]);
               
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
        ]);

        $query->andFilterWhere(['like', 'coursename', $this->coursename]);

        return $dataProvider;
    }
}
