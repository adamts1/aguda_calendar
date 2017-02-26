<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property integer $id
 * @property integer $centerid
 * @property string $name
 * @property string $lastname
 * @property string $grade
 *
 * @property GroupStudent[] $groupStudents
 * @property Presence[] $presences
 * @property Center $center
 * @property StudentCourse[] $studentCourses
 * @property StudentTeacher[] $studentTeachers
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
            [['name', 'lastname', 'grade'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'lastname' => 'Lastname',
            'grade' => 'Grade',
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
    public function getPresences()
    {
        return $this->hasMany(Presence::className(), ['studentid' => 'id']);
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
    public function getStudentTeachers()
    {
        return $this->hasMany(StudentTeacher::className(), ['studentid' => 'id']);
    }
}
