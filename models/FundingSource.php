<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use app\models\Teacher;
use app\models\FundingsourceTeacher;
use yii\behaviors\BlameableBehavior;


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
            'id' => 'מספר מזהה',
            'sourcename' => 'שפ המקור',
        ];
    }

    //////////////////////////////////////////// using for show only funding source of conected teacher by many to many realation
    public function getFundingSourceTeacheres()
    {
     return $this->hasMany(FundingsourceTeacher::className(), ['sourceid' => 'id']);
    }

     public function getTeachers()
     {
      return $this->hasMany(Teacher::className(), ['id' => 'teacherid'])
      ->via('fundingSourceTeacheres');
     }
     ///////////////////////////////////////////////////

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFundingsourceTeachers()
    {
        return $this->hasMany(FundingsourceTeacher::className(), ['sourceid' => 'id']);
    }

    

    /*public function getFundingSourceName()
    {
        return $this->sourcename;
    }*/
    public function getFundingSource()
    {
        $allFundingSource = (new \yii\db\Query())
           ->select(['*'])
           ->from('funding_source')
           ->all();
		$allFundingSourceArray = ArrayHelper::
					map($allFundingSource, 'id', 'sourcename');
		return $allFundingSourceArray;	
    }
    public function existFs($Fs){
        $allFundingSources = (new \yii\db\Query())
           ->select(['*'])
           ->from('funding_source')
           ->all();
        foreach ( $allFundingSources as  $allFundingSource){
            if ($Fs == $allFundingSource){
                return true;
            }
        }
        return false;
    }

}
