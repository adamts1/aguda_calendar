<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supervising".
 *
 * @property integer $centerid
 * @property integer $supervisorid
 *
 * @property Center $center
 * @property Supervisor $supervisor
 */
class Supervising extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supervising';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['centerid', 'supervisorid'], 'integer'],
            [['centerid'], 'exist', 'skipOnError' => true, 'targetClass' => Center::className(), 'targetAttribute' => ['centerid' => 'id']],
            [['supervisorid'], 'exist', 'skipOnError' => true, 'targetClass' => Supervisor::className(), 'targetAttribute' => ['supervisorid' => 'id']],
        ];
    }

   

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'centerid' => 'Centerid',
            'supervisorid' => 'Supervisorid',
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
    public function getSupervisor()
    {
        return $this->hasOne(Supervisor::className(), ['id' => 'supervisorid']);
    }
}
