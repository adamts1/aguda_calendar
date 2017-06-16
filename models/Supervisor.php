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
          public $role; 

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supervisor';
    }

     public function afterSave($insert,$changedAttributes)
    {
        $return = parent::afterSave($insert, $changedAttributes);

        $auth = Yii::$app->authManager;
		$roleName = $this->role; 
		$role = $auth->getRole($roleName);
		if (\Yii::$app->authManager->getRolesByUser($this->id) == null){
			$auth->assign($role, $this->id);
		} else {
			$db = \Yii::$app->db;
			$db->createCommand()->delete('auth_assignment',
				['user_id' => $this->id])->execute();
			$auth->assign($role, $this->id);
		}

        return $return;
    }

    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['centerId'], 'integer'],
            ['role', 'safe'],
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
            'role'  => 'User role',

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

    public static function getRoles()
	{
		$rolesObjects = Yii::$app->authManager->getRoles();
		$roles = [];
		foreach($rolesObjects as $id =>$rolObj){
			$roles[$id] = $rolObj->name; 
		}
		return $roles; 	
	}
     public static function createRandomCode() { 

    $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
    srand((double)microtime()*1000000); 
    $i = 0; 
    $pass = '' ; 

    while ($i <= 7) { 
        $num = rand() % 33; 
        $tmp = substr($chars, $num, 1); 
        $pass = $pass . $tmp; 
        $i++; 
    } 

    return $pass; 

} 
}
