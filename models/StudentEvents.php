<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_events".
 *
 * @property int $studentid
 * @property int $eventsid
 *
 * @property Events $events
 * @property Student $student
 */
class StudentEvents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['studentid', 'eventsid'], 'required'],
            [['studentid', 'eventsid'], 'integer'],
            [['eventsid'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['eventsid' => 'id']],
            [['studentid'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['studentid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'studentid' => 'Studentid',
            'eventsid' => 'Eventsid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasOne(Events::className(), ['id' => 'eventsid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'studentid']);
    }
}
