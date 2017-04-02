<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supervisor".
 *
 * @property integer $id
 * @property integer $centerId
 *
 * @property Supervising[] $supervisings
 * @property Center $center
 * @property User $id0
 */
class Supervisor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supervisor';
    }

    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['centerId'], 'integer'],
            [['centerId'], 'exist', 'skipOnError' => true, 'targetClass' => Center::className(), 'targetAttribute' => ['centerId' => 'id']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'centerId' => 'מרכז',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupervisings()
    {
        return $this->hasMany(Supervising::className(), ['supervisorid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCenter()
    {
        return $this->hasOne(Center::className(), ['id' => 'centerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }
}
