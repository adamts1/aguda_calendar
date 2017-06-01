<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\User;

/**
* LoginForm is the model behind the login form.
*/
class LostPasswordForm extends Model
{
   public $email;

   /**
    * @return array the validation rules.
    */
   public function rules()
   {
       return [
           [['email'], 'required'],
           [['email'], 'email'],
       ];
   }

public function attributeLabels()
{
    return [
        'email' => 'Enter your Email'
         ];
    }
}