<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property int $id
 * @property string $title
 * @property string $color
 * @property string $start
 * @property string $end
 * @property int $centerid
 * @property int $groupNumber
 * @property int $courseid
 * @property int $teacherid
 * @property int $locationid
 *
 * @property Center $center
 * @property Course $course
 * @property Location $location
 * @property Teacher $teacher
 * @property StudentEvents[] $studentEvents
 * @property Student[] $students
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start', 'end'], 'safe'],
            [['centerid', 'groupNumber', 'courseid', 'teacherid', 'locationid'], 'integer'],
            [['title', 'color'], 'string', 'max' => 255],
            [['centerid'], 'exist', 'skipOnError' => true, 'targetClass' => Center::className(), 'targetAttribute' => ['centerid' => 'id']],
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
            'title' => 'Title',
            'color' => 'Color',
            'start' => 'Start',
            'end' => 'End',
            'centerid' => 'Centerid',
            'groupNumber' => 'Group Number',
            'courseid' => 'Courseid',
            'teacherid' => 'Teacherid',
            'locationid' => 'Locationid',
        ];
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
    public function getStudentEvents()
    {
        return $this->hasMany(StudentEvents::className(), ['eventsid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::className(), ['id' => 'studentid'])->viaTable('student_events', ['eventsid' => 'id']);
    }
}
