<?php

namespace app\models;

    use Yii;
	use \yii\web\IdentityInterface;
	use yii\db\ActiveRecord;
	use yii\behaviors\BlameableBehavior;

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
 *
 * @property Supervisor $supervisor
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
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            ['email', 'email'],
            [['username', 'password', ], 'required'],
            [['username', 'password', 'auth_key', 'firstname', 'lastname', 'phone', 'address'], 'string', 'max' => 255],
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
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'notes' => 'Notes',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
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


}