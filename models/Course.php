<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;
use app\models\Teacher;
use app\models\CourseTeacher;
// use arogachev\ManyToMany\behaviors\ManyToManyBehavior;

/**
 * This is the model class for table "course".
 *
 * @property integer $id
 * @property string $coursename
 *
 * @property CourseCenter[] $courseCenters
 * @property CourseTeacher[] $courseTeachers
 * @property Group[] $groups
 * @property StudentCourse[] $studentCourses
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['coursename'], 'string', 'max' => 255],
        ];
    }

    //////////////////////////////////////////// using for show only courses of conected teacher by many to many realation
    public function getCoursesTeachers()
    {
      return $this->hasMany(CourseTeacher::className(), ['courseid' => 'id']);
    }

    public function getTeachers()
    {
    return $this->hasMany(Teacher::className(), ['id' => 'teacherid'])
    ->via('coursesTeachers');
    }
    //////////////////////////////////////////////////

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'קורסים',
            'coursename' => 'מקצוע לימוד',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseCenters()
    {
        return $this->hasMany(CourseCenter::className(), ['courseid' => 'id']);
    }

    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseTeachers()
    {
        return $this->hasMany(CourseTeacher::className(), ['courseid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['courseid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentCourses()
    {
        return $this->hasMany(StudentCourse::className(), ['courseid' => 'id']);
    }

    public static function getCourse()  // return the name of the course using for dropdown 
	{
		$allCourses =  (new \yii\db\Query())
           ->select(['C.id','C.coursename'])
           ->from('course C')
           ->join('JOIN','course_center CC','C.id=CC.courseid')
           ->join('JOIN','center C1','CC.centerid=C1.id')
           ->join('JOIN','teacher T','C1.id=T.centerid')
           ->where(['T.id' => Yii::$app->user->identity->id])
           ->limit(50)
           ->all();
		$allCoursesArray = ArrayHelper::
					map($allCourses, 'id', 'coursename');
		return $allCoursesArray;						
	}   

    

    public function getCourseName()
    {
        return $this->coursename;
    }

    public static function getCourse1()
    {
    return Course::find()->select(['id', 'coursename'])->all();
    }


}
