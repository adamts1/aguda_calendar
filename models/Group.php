<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property int $id
 * @property int $courseid
 * @property int $teacherid
 * @property int $locationid
 * @property string $day
 * @property string $start
 * @property string $end
 *
 * @property Event[] $events
 * @property Course $course
 * @property Location $location
 * @property Teacher $teacher
 * @property GroupStudent[] $groupStudents
 * @property Student[] $students
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['courseid', 'teacherid', 'locationid'], 'integer'],
            [['start', 'end'], 'safe'],
            [['day'], 'string', 'max' => 255],
            [['courseid'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['courseid' => 'id']],
            [['locationid'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['locationid' => 'id']],
            [['teacherid'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::className(), 'targetAttribute' => ['teacherid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'courseid' => 'מקצוע',
            'teacherid' => 'מורה ',
            'locationid' => 'כיתת לימוד',
            'day' => 'יום',
            'start' => 'שעת התחלה',
            'end' => 'שעת סיום',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['groupid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'courseid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'locationid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::className(), ['id' => 'teacherid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupStudents()
    {
        return $this->hasMany(GroupStudent::className(), ['groupid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::className(), ['id' => 'studentid'])->viaTable('group_student', ['groupid' => 'id']);
    }
     public static function getStudentList() //This function get students and return an array of the existing students list
    {
        $studentList = ArrayHelper::map(Student::find()->all());
        return $studentList;
    }
}
