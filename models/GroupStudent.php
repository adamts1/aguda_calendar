<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group_student".
 *
 * @property integer $studentid
 * @property integer $groupid
 *
 * @property Group $group
 * @property Student $student
 */
class GroupStudent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group_student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['studentid', 'groupid'], 'integer'],
            [['groupid'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['groupid' => 'id']],
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
            'groupid' => 'Groupid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'groupid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'studentid']);
    }
}
