<?php

namespace app\models;

    use Yii;
	use \yii\web\IdentityInterface;
	use yii\db\ActiveRecord;
	use yii\behaviors\BlameableBehavior;
    use yii\helpers\ArrayHelper;
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
 * @property Supervisor $supervisor
 * @property Teacher $teacher
 * @property Userrole $userRole0
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
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
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by', 'userRole'], 'integer'],
            [['username', 'password', 'auth_key', 'firstname', 'lastname', 'email', 'phone', 'address'], 'string', 'max' => 255],
            [['username', 'password', ], 'required'],
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
            'username' => 'שם משתמש',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'firstname' => 'שם',
            'lastname' => 'שם משפחה',
            'email' => 'דואר אלקטרוני',
            'phone' => 'טלפון',
            'address' => 'כתובת',
            'notes' => 'הערות',
            'status' => 'Status',
            'created_at' => 'תאריך כניסה למערכת',
            'updated_at' => 'עדכון אחרון',
            'created_by' => 'נוצר ע"י',
            'updated_by' => 'עודכן ע"י',
            'userRole' => 'תפקיד',
            'createUserName' => Yii::t('app', 'נוצר ע"י'),
            'updateUserName' => Yii::t('app', 'נערך ע"י'),
        ];
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
    public function getSupervisor()
    {
        return $this->hasOne(Supervisor::className(), ['id' => 'id']);
    }

  ////////////// functions for blamable behaviors
    public function getCreateUser()
    {

        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getCreateUserName() 
    {
        return $this->createUser ? $this->createUser->fullname : 'לא קיים'; // The fullName will showen in the "created by" field (view.php)
    }

    public function getUpdateUser()
    {
    return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public function getUpdateUserName() 
    {
      return $this->createUser ? $this->updateUser->fullname : 'לא קיים'; // The fullName will showen in the "update by" field (view.php)
   }
    /////////////





    public function getFullname()
    {
        return $this->firstname.' '.$this->lastname;
    }

     public function getUserName()
    {
        return $this->username;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::className(), ['id' => 'id']);
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

	public static function findByUsername($username)
	{
		return static::findOne(['username' => $username]);
	}

     public static function findIdentityByAccessToken($token, $type = null)
    {
		throw new NotSupportedException('You can only login
							by username/password pair for now.');
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }   

    public function getId()
    {
        return $this->id;
    }

    public function validateAuthKey($authKey)
    {
         return $this->getAuthKey() === $authKey;
    }	

     public function validatePassword($password)
	{
		return $this->isCorrectHash($password, $this->password); 
	}

	private function isCorrectHash($plaintext, $hash)
	{
		return Yii::$app->security->validatePassword($plaintext, $hash);
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

    public static function getTeachers()  
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

    public static function getSupervisors()  
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
