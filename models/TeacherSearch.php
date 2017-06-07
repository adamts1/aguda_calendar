<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Teacher;
use app\models\User;

/**
 * TeacherSearch represents the model behind the search form about `app\models\Teacher`.
 */
class TeacherSearch extends Teacher
{

        public $user;
        public $center;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'centerid'], 'integer'],
            [['subject', 'user', 'center'], 'safe'],
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
        $query = Teacher::find();

        $query->joinWith(['id0']);
        $query->joinWith(['center']);


        // add conditions that should always apply here
        if (\Yii::$app->user->can('createSchoolDir')){
        $dataProvider = new ActiveDataProvider([
             'query' => $query,                             // provide for admin
            // 'query' => Teacher::find()->where(['id'=> Yii::$app->user->identity->id]),
            // 'query' => Supevisor::find()->where(['id'=> Yii::$app->user->identity->id]),
        ]);
        }else{
            $dataProvider = new ActiveDataProvider([
             'query' => Teacher::find()
           ->join('JOIN','center','teacher.centerid=center.id')
           ->join('JOIN','supervisor','center.id=supervisor.centerId')
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

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        // $query->andFilterWhere(['id' => $this->id,'centerid' => $this->centerid]);
        $query->andFilterWhere(['like', 'subject', $this->subject]);
        $query->andFilterWhere(['like', 'user.firstname' ,  $this->user]);
        $query->andFilterWhere(['like', 'center.name' ,  $this->center]);
        // $query->andFilterWhere(['like', 'user.lastname ', $this->user]);

        return $dataProvider;
    }
}
