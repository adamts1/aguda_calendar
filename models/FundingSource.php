<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "funding_source".
 *
 * @property integer $id
 * @property string $sourcename
 *
 * @property FundingsourceTeacher[] $fundingsourceTeachers
 */
class FundingSource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'funding_source';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sourcename'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'מקורות מימון',
            'sourcename' => 'sourcename',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFundingsourceTeachers()
    {
        return $this->hasMany(FundingsourceTeacher::className(), ['sourceid' => 'id']);
    }

    

    public function getFundingSourceName()
    {
        return $this->sourcename;
    }
}
