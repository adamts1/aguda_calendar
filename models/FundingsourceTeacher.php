<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fundingsource_teacher".
 *
 * @property int $sourceid
 * @property int $teacherid
 *
 * @property FundingSource $source
 * @property Teacher $teacher
 */
class FundingsourceTeacher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fundingsource_teacher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sourceid', 'teacherid'], 'required'],
            [['sourceid', 'teacherid'], 'integer'],
            [['sourceid'], 'exist', 'skipOnError' => true, 'targetClass' => FundingSource::className(), 'targetAttribute' => ['sourceid' => 'id']],
            [['teacherid'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::className(), 'targetAttribute' => ['teacherid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sourceid' => 'Sourceid',
            'teacherid' => 'Teacherid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource()
    {
        return $this->hasOne(FundingSource::className(), ['id' => 'sourceid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::className(), ['id' => 'teacherid']);
    }
}
