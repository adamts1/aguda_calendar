<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;
/**
 * This is the model class for table "center".
 *
 * @property integer $id
 * @property string $name
 *
 * @property CourseCenter[] $courseCenters
 * @property Student[] $students
 * @property Supervising[] $supervisings
 * @property Teacher[] $teachers
 */
class Center extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'center';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseCenters()
    {
        return $this->hasMany(CourseCenter::className(), ['centerid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::className(), ['centerid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupervisings()
    {
        return $this->hasMany(Supervising::className(), ['centerid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachers()
    {
        return $this->hasMany(Teacher::className(), ['centerid' => 'id']);
    }

    public static function getCenter()  // return the name of the course using for dropdown 
	{
		$allCenter = self::find()->all();
		$allCenterArray = ArrayHelper::
					map($allCenter, 'id', 'name');
		return $allCenterArray;						
	}   

     public function getCentername()
    {
        return $this->name;
    }

}
