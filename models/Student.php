<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property int $centerid
 * @property string $name
 * @property string $lastname
 * @property string $grade
 * @property string $phone
 * @property string $notes
 *
 * @property GroupStudent[] $groupStudents
 * @property Group[] $groups
 * @property Presence[] $presences
 * @property Event[] $events
 * @property Center $center
 * @property StudentCourse[] $studentCourses
 * @property Course[] $courses
 * @property StudentEvents[] $studentEvents
 * @property Events[] $events0
 * @property StudentTeacher[] $studentTeachers
 * @property Teacher[] $teachers
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['centerid'], 'integer'],
            [['name', 'lastname', 'grade', 'phone', 'notes'], 'string', 'max' => 255],
            [['centerid'], 'exist', 'skipOnError' => true, 'targetClass' => Center::className(), 'targetAttribute' => ['centerid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'centerid' => 'Centerid',
            'name' => 'שם',
            'lastname' => 'שם משפחה',
            'grade' => 'כיתה',
            'phone' => 'טלפון ליצירת קשר',
            'notes' => 'הערות',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupStudents()
    {
        return $this->hasMany(GroupStudent::className(), ['studentid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['id' => 'groupid'])->viaTable('group_student', ['studentid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresences()
    {
        return $this->hasMany(Presence::className(), ['studentid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['id' => 'eventid'])->viaTable('presence', ['studentid' => 'id']);
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
    public function getStudentCourses()
    {
        return $this->hasMany(StudentCourse::className(), ['studentid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Course::className(), ['id' => 'courseid'])->viaTable('student_course', ['studentid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentEvents()
    {
        return $this->hasMany(StudentEvents::className(), ['studentid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents0()
    {
        return $this->hasMany(Events::className(), ['id' => 'eventsid'])->viaTable('student_events', ['studentid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentTeachers()
    {
        return $this->hasMany(StudentTeacher::className(), ['studentid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachers()
    {
        return $this->hasMany(Teacher::className(), ['id' => 'teacherid'])->viaTable('student_teacher', ['studentid' => 'id']);
    }

      public static function getStudentForGroup()  // return the name of the course using for dropdown 
	{
		$allStudentForGroup = self::find()->all();
		$allStudentForGroupArray = ArrayHelper::
					map($allStudentForGroup, 'id', 'name');
		return $allStudentForGroupArray;						
	} 

    public function getStudentName()
    {
        return $this->name.' '.$this->lastname;
    }
}
