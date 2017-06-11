<?php
 
namespace app\models;
use Yii;
use yii\base\model;
 
class FormRecoverPass extends model{
 
    public $email;
     
    public function rules()
    {
        return [
            ['email', 'required', 'message' => 'שדה נדרש'],
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'תווים לפחות 5 ומקסימום 80'],
            ['email', 'email', 'message' => 'פורמט לא חוקי'],
        ];
    }
}