<?php
namespace app\rbac;

use yii\rbac\Rule;
use Yii; 

class OwnTeacherRule extends Rule
{
	public $name = 'ownTeacherRule';

	public function execute($user, $item, $params)
	{
		if (!Yii::$app->user->isGuest) {
			return isset($params['user']) ? $params['user']->id == $user : false;
		}
		return false;
	}
}
