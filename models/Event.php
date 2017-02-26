<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property integer $groupid
 * @property integer $teacherid
 * @property integer $locationid
 * @property string $date
 *
 * @property Group $group
 * @property Location $location
 * @property Teacher $teacher
 * @property Presence[] $presences
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['groupid', 'teacherid', 'locationid'], 'integer'],
            [['date'], 'safe'],
            [['groupid'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['groupid' => 'id']],
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
            'groupid' => 'Groupid',
            'teacherid' => 'Teacherid',
            'locationid' => 'Locationid',
            'date' => 'Date',
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
    public function getPresences()
    {
        return $this->hasMany(Presence::className(), ['eventid' => 'id']);
    }
}
