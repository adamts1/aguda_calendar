<?php
 
namespace app\models;
use Yii;
use yii\base\model;
 
class FormResetPass extends model{
 
 public $email;
 public $password;
 public $password_repeat;
 public $verification_code;
 //public $recover;
     
    public function rules()
    {
        return [
            [['email', 'password', 'password_repeat', 'verification_code'/*, 'recover'*/], 'required', 'message' => 'שדה נדרש'],
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'תווים לפחות 5 ומקסימום 80'],
            ['email', 'email', 'message' => 'Formato no válido'],
            ['password', 'match', 'pattern' => "/^.{8,16}$/", 'message' => 'תווים לפחות 6 ומקסימום 16'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'הסיסמאות אינן תואמות'],
        ];
    }
}