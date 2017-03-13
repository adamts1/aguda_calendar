<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;

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

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coursename' => 'מצוע לימוד',
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
		$allCourses = self::find()->all();
		$allCoursesArray = ArrayHelper::
					map($allCourses, 'id', 'coursename');
		return $allCoursesArray;						
	}   

    public function getCourseName()
    {
        return $this->coursename;
    }


}
