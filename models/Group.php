<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property integer $id
 * @property integer $courseid
 * @property integer $teacherid
 * @property integer $locationid
 * @property string $dayintheweek
 * @property string $duration
 *
 * @property Event[] $events
 * @property Course $course
 * @property Location $location
 * @property Teacher $teacher
 * @property GroupStudent[] $groupStudents
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
            [['duration'], 'safe'],
           // [['student'], 'integer'],  //check
            [['dayintheweek'], 'string', 'max' => 255],
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
            'courseid' => 'Courseid',
            'teacherid' => 'Teacherid',
            'locationid' => 'Locationid',
            'dayintheweek' => 'Dayintheweek',
            'duration' => 'Duration',
            //'student' => 'student',//check
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

    
}
