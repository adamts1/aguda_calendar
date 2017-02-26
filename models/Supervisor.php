<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supervisor".
 *
 * @property integer $id
 *
 * @property Supervising[] $supervisings
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
    public function getId0()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }
}
