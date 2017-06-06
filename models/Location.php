<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property int $id
 * @property string $name
 * @property int $centerid
 *
 * @property Event[] $events
 * @property Events[] $events0
 * @property Group[] $groups
 * @property Center $center
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['centerid'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['centerid'], 'exist', 'skipOnError' => true, 'targetClass' => Center::className(), 'targetAttribute' => ['centerid' => 'id']],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'שם',
            'centerid' => 'Centerid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['locationid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents0()
    {
        return $this->hasMany(Events::className(), ['locationid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['locationid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCenter()
    {
        return $this->hasOne(Center::className(), ['id' => 'centerid']);
    }

     public static function getLocation()  // return the name of the location using for dropdown 
	{
		$allLocation = self::find()->all();
		$allLocationArray = ArrayHelper::
					map($allLocation, 'id', 'name');
		return $allLocationArray;						
	}   

     public function getLocationName()
    {
        return $this->name;
    }
}
