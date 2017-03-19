<?php

namespace app\models;

use Yii;
use arogachev\ManyToMany\behaviors\ManyToManyBehavior;
use arogachev\ManyToMany\validators\ManyToManyValidator;
use app\models\Course;
use yii\helpers\ArrayHelper;  
/**
 * This is the model class for table "teacher".
 *
 * @property integer $id
 * @property string $subject
 * @property integer $centerid
 *
 * @property CourseTeacher[] $courseTeachers
 * @property Event[] $events
 * @property FundingsourceTeacher[] $fundingsourceTeachers
 * @property Group[] $groups
 * @property StudentTeacher[] $studentTeachers
 * @property Center $center
 * @property User $id0
 */
class Teacher extends \yii\db\ActiveRecord
{
      public $editableUsers = [];  // many to many

    public static function tableName()
    {
        return 'teacher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['centerid'], 'integer'],
            [['subject'], 'string', 'max' => 255],
            [['centerid'], 'exist', 'skipOnError' => true, 'targetClass' => Center::className(), 'targetAttribute' => ['centerid' => 'id']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    public function behaviors()
{
    return [
        [
            'class' => ManyToManyBehavior::className(),
            'relations' => [
                [
                    'editableAttribute' => 'editableUsers', // Editable attribute name
                    'table' => 'course_teacher', // Name of the junction table
                    'ownAttribute' => 'teacherid', // Name of the column in junction table that represents current model
                    'relatedModel' => Course::className(), // Related model class
                    'relatedAttribute' => 'courseid', // Name of the column in junction table that represents related model
                ],
            ],
        ],
    ];
}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject' => 'מקצוע',
            'centerid' => 'מרכז',
        ];
    }

  

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseTeachers()
    {
        return $this->hasMany(CourseTeacher::className(), ['teacherid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getCoursesViaTable()
    {
        return $this->hasMany(Course::className(), ['id' => 'courseid'])
            ->viaTable('course_teacher', ['teacherid' => 'id']);
    }
     
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoursesViaRelation()
    {
        return $this->hasMany(Courses::className(), ['id' => 'courseid'])
            ->via('CourseTeacher');
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['teacherid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFundingsourceTeachers()
    {
        return $this->hasMany(FundingsourceTeacher::className(), ['teacherid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['teacherid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentTeachers()
    {
        return $this->hasMany(StudentTeacher::className(), ['teacherid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCenter()
    {
        return $this->hasOne(Center::className(), ['id' => 'centerid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }

    public static function getCoursesTeacher()
    {
         $courses =  ArrayHelper::map(Course::find()->all(),'id','coursename');
        return $courses;                       
    }

    public static function getInitCourses($id) //This function get activityId and return an array of the existing users on this activity
    {
        $coursesteacher = ArrayHelper::map(CourseTeacher::find()
        ->where(['teacherid'=>$id])->all(),'courseid', 'courseid');
        return $coursesteacher;
    }

   

    
}
