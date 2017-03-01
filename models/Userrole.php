<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "userrole".
 *
 * @property integer $roleId
 * @property string $roleName
 *
 * @property User[] $users
 */
class Userrole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userrole';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['roleName'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'roleId' => 'Role ID',
            'roleName' => 'Role Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['userRole' => 'roleId']);
    }

    public static function getUserrole()  // return the name of the course using for dropdown 
	{
		$allUserrole = self::find()->all();
		$allUserroleArray = ArrayHelper::
					map($allUserrole, 'roleId', 'roleName');
		return $allUserroleArray;						
	}   

     public function getUserRoleName()
    {
        return $this->roleName;

    }

    

}
