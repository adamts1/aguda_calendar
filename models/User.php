<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\Query;
use yii\widgets\DetailView;
use app\models\Userrole;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $notes
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $userRole
 *
 * @property Userrole $userRole0
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $role; 
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notes'], 'string'],
            [[/*'status',*/ 'created_at', 'updated_at', 'created_by', 'updated_by', 'userRole'], 'integer'], /// status is cancelled
            [['username', 'password', 'auth_key', 'firstname', 'lastname', 'email', 'phone', 'address'], 'string', 'max' => 255],
			['role', 'safe'], //// necessary for authorization!!!!! 
            [['userRole'], 'exist', 'skipOnError' => true, 'targetClass' => Userrole::className(), 'targetAttribute' => ['userRole' => 'roleId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'firstname' => 'First name',
            'lastname' => 'Last name',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'notes' => 'Notes',
            //'status' => 'Status', /// status is cancelled
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'userRole' => 'User role',
			'role'  => 'Permission level',			
        ];
    }
	
		public function getCreatedBy()
    {
		
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }	
	
		public function getUpdateddBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }	
	
	
	public function getFullname()
    {
        return $this->firstname.' '.$this->lastname;
    }
	
		 public function behaviors()
    {
		return 
		[
			[
				'class' => BlameableBehavior::className(),
				'createdByAttribute' => 'created_by',
				'updatedByAttribute' => 'updated_by',
			 ],
				'timestamp' => [
				'class' => 'yii\behaviors\TimestampBehavior',
				'attributes' => [
					ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
					ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
				],
			],
		];
    }
	

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRole0()
    {
       return $this->hasOne(Userrole::className(), ['roleId' => 'userRole']);
    }
	
	
	public static function findIdentity($id)
    {
        return static::findOne($id);
    }
	
	public static function findIdentityByAccessToken($token, $type = null)
    {
		throw new NotSupportedException('You can only login
							by username/password pair for now.');
    }
	
	 public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
         return $this->getAuthKey() === $authKey;
    }	
	
	public function beforeSave($insert)
    {
        $return = parent::beforeSave($insert);

        if ($this->isAttributeChanged('password'))
            $this->password = Yii::$app->security->
					generatePasswordHash($this->password);

        if ($this->isNewRecord)
		    $this->auth_key = Yii::$app->security->generateRandomString(32);

        return $return;
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
	
	public function afterSave($insert,$changedAttributes)
    {
        $return = parent::afterSave($insert, $changedAttributes);

        if (!\Yii::$app->user->can('updateUser')){
			return $return;
		}
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
	
	
	public static function findByUsername($username)
	{
		return static::findOne(['username' => $username]);
	}
	
	
	
	private function isCorrectHash($plaintext, $hash)
	{
		return Yii::$app->security->validatePassword($plaintext, $hash);
	}
	
	
	public function validatePassword($password)
	{
		return $this->isCorrectHash($password, $this->password); 
	}
	
	public static function getTeames1()  
	{
		$allTeames = (new \yii\db\Query())
           ->select(['*'])
           ->from('user')
           ->where(['userRole' => '1'])
           ->limit(10)
           ->all();
		$allTeamesArray = ArrayHelper::
					map($allTeames, 'id', 'username');
		return $allTeamesArray;						
	}
	
	public static function getTeames3()  
	{
		$allTeames = (new \yii\db\Query())
           ->select(['*'])
           ->from('user')
           ->where(['userRole' => '3'])
           ->limit(10)
           ->all();
		$allTeamesArray = ArrayHelper::
					map($allTeames, 'id', 'username');
		return $allTeamesArray;						
	}
	
	public static function getTeames2()  
	{
	$allTeames = (new \yii\db\Query())
          ->select(['*'])
          ->from('user')
          ->where(['userRole' => '2'])
          ->limit(10)
          ->all();
		$allTeamesArray = ArrayHelper::
					map($allTeames, 'id', 'username');
		return $allTeamesArray;						
	}
	
}
