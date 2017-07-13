<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\LostPasswordForm;
use app\models\ContactForm;
use app\models\User;
use app\models\EmailMessage;
use yii\web\Session;
use app\models\FormRecoverPass;
use app\models\FormResetPass;


class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        
        $url = Yii::$app->getUrlManager()->getBaseUrl();
        //print_r($url);
        if(Yii::$app->user->isGuest)
        { 
            $this->redirect(['/site/login']);
        }
        return $this->render('index',[
            'url'=>$url,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
     public function actionRecoverpass()
 {
  
  $model = new FormRecoverPass;
  
  $msg = null;
  
  if ($model->load(Yii::$app->request->post()))
  {
      
   if ($model->validate())
   {
    
    $users = User::find()->where(['email' => $model->email])->all();
    $url = Yii::$app->getUrlManager()->getBaseUrl();
    foreach ($users as $user):
        $userId = $user->id;
    endforeach;
    
     $subject = "Reset password";
     $body = "<p>Copie this code to reset password ... ";
     $body .= "<strong>".$user->verification_code."</strong></p>";
     $body .= "<p><a href='http://localhost".$url."/site/resetpass'>Reset password</a></p>";

     //Enviamos el correo
     Yii::$app->mailer->compose()
     ->setTo($model->email)
     ->setFrom('donotereply@agudalekidumahinuh.com')
     ->setSubject($subject)
     ->setHtmlBody($body)
     ->send();
     
     $model->email = null;
     $msg = "נשלחה הודעה אל חשבון האימייל שלך, לצורך איפוס סיסמה";
   
   
   }
   else
   {
    $model->getErrors();
   }

  }
  return $this->render("recoverpass", ["model" => $model, "msg" => $msg]);
 }
 
 public function actionResetpass()
 {
  
  $model = new FormResetPass;
  $msg = null;
  
  
  
  
  if ($model->load(Yii::$app->request->post()))
  {
   if ($model->validate())
   {
    
     $newUser = User::findOne(["email" => $model->email, "verification_code" => $model->verification_code]);
     
     //Encriptar el password
     //$user->password = crypt($model->password, Yii::$app->params["salt"]);
     $newUser->password = $model->password;


     //Si la actualización se lleva a cabo correctamente
     if ($newUser->save())
     {
      
      //Vaciar los campos del formulario
      $model->email = null;
      $model->password = null;
      $model->password_repeat = null;
      $model->verification_code = null;
      
      $msg = "איפוס הסיסמה מחדש נעשה בהצלחה כהלכה לעמוד ההתחברות ...";
      $msg .= "<meta http-equiv='refresh' content='5; ".Url::toRoute("site/login")."'>";
     }
     else
     {
        $msg = "טעות";
     }
     
   
   }
  }
  
  return $this->render("resetpass", ["model" => $model, "msg" => $msg]);
  
 }
    public function actionLogin()
    {
        
        $model = new LoginForm();
        $lostPasswordForm = new LostPasswordForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            /* if (Yii::$app->user->identity->userRole == 1){
                 return $this->redirect('http://localhost/a_p/web/events'); 
             }*/
             return $this->goHome();
            //return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
            'lostPasswordForm' => $lostPasswordForm,

        ]);
        
    }
    public function actionForgotPassword()
    {
        $lostPasswordForm = new LostPasswordForm();
        if($lostPasswordForm->load(Yii::$app->request->post()) && $lostPasswordForm->validate())
        {
          $user = User::findOne(['email'=>$lostPasswordForm->email]);
          if ($user){
              $message = EmailMessage::findOne(['slug'=>'password_recovery']);
              //print_r($message->body);die;
               $email = Yii::$app->mailer
                ->compose(['body'=>$message->body])
                ->setTextBody($message->body)
                ->setFrom('donotereply@agudalekidumahinuh.com')
                ->setTo($lostPasswordForm->email)
                ->setSubject('Recovery Password');

                if ($email->send()){
                    //print_r('email send to '.$lostPasswordForm->email);die();
                    Yii::$app->session->setFlash('emailSend');
                    return $this->goHome();
                }
                else{
                     print_r('email not send');die();
                }
                if (!Yii::$app->user->isGuest) {
                    return $this->goHome();
                }
          }
        }

        return $this->render('login', [
            'lostPasswordForm' => $lostPasswordForm,

        ]);
        
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {

        Yii::$app->user->logout();

        return $this->goHome();

    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    //////////////////////////////////////////////////// RBAC  /////////////////////////////////////////
	
    public function actionRole()
	{
		$auth = Yii::$app->authManager;				
		
		$basic = $auth->createRole('basic');
		$auth->add($basic);
		
		$pro = $auth->createRole('pro');
		$auth->add($pro);

		$admin = $auth->createRole('admin');
		$auth->add($admin);
	}

	public function actionTeacherpermissions()
	{
		$auth = Yii::$app->authManager;
		
		$indexOwnStudent = $auth->createPermission('indexOwnStudent');
		$indexOwnStudent->description = 'teacher can see his student';
		$auth->add($indexOwnStudent);
		
		$updateOwnTeacher = $auth->createPermission('updateOwnTeacher'); 
		$updateOwnTeacher->description = 'Teacher can update himself';
		$auth->add($updateOwnTeacher);	

	}

	public function actionSchooldirectorpermissions()
	{
		$auth = Yii::$app->authManager;

		$updateOwnDirector = $auth->createPermission('updateOwnDirector'); 
		$updateOwnDirector->description = 'pro can update users';
		$auth->add($updateOwnDirector);	

		$createStudent = $auth->createPermission('createStudent'); 
		$createStudent->description = 'School director can create student';
		$auth->add($createStudent);	

		$schedule = $auth->createPermission('schedule'); 
		$schedule->description = 'School director can schedule ';
		$auth->add($schedule);

		$updateOwnSchoolDir = $auth->createPermission('updateOwnSchoolDir'); 
		$updateOwnSchoolDir->description = 'School director can update only himself ';
		$auth->add($updateOwnSchoolDir);		
	}
	

	public function actionAdminpermissions()
	{
		$auth = Yii::$app->authManager;
		
		$createSchoolDir = $auth->createPermission('createSchoolDir');  
		$createSchoolDir->description = 'admin can create all School Director';
		$auth->add($createSchoolDir);

	}

	public function actionChilds()
	{
		$auth = Yii::$app->authManager;				
		
		$basic = $auth->getRole('basic'); 

		$indexOwnStudent = $auth->getPermission('indexOwnStudent'); 
		$auth->addChild($basic, $indexOwnStudent);
		
		$updateOwnTeacher = $auth->getPermission('updateOwnTeacher'); 
		$auth->addChild($basic, $indexTeacher);		
		
		
		
		////////////////////////////////////
		
		$pro = $auth->getRole('pro'); 
		$auth->addChild($pro, $basic);
		
		$updateOwnDirector = $auth->getPermission('updateOwnDirector'); 
		$auth->addChild($pro, $updateOwnDirector);

		$createStudent = $auth->getPermission('createStudent'); 
		$auth->addChild($pro, $createStudent);	

		$schedule = $auth->getPermission('schedule'); 
		$auth->addChild($pro, $schedule);	

		$updateOwnSchoolDir = $auth->getPermission('updateOwnSchoolDir'); 
		$auth->addChild($pro, $updateOwnSchoolDir);	

		///////////////////////////////////////
		
		$admin = $auth->getRole('admin'); 
		$auth->addChild($admin, $pro);	
		
		$createSchoolDir = $auth->getPermission('createSchoolDir'); 
		$auth->addChild($admin, $createSchoolDir);
		
	

		

	}
		//////////////////////////////////////////////////
		
	// 	public function actionAddfirstrule()
	// {
	// 	$auth = Yii::$app->authManager;
		
	// 	$updateOwnTeacher = $auth->getPermission('updateOwnTeacher');
	// 	$auth->remove($updateOwnTeacher);
		
	// 	$rule = new \app\rbac\OwnTeacherRule;
	// 	$auth->add($rule);
				
	// 	$updateOwnTeacher->ruleName = $rule->name;		
	// 	$auth->add($updateOwnTeacher);	
	// }	
		////////////////////////////////////////
	// 	public function actionAddsecondrule()
	// {	
	// 	$auth = Yii::$app->authManager;
		
	// 	$indexOwnStudent = $auth->getPermission('indexOwnStudent');
	// 	$auth->remove($indexOwnStudent);
		
	// 	/////////////////////////////////////////////////עצרנו פה כי לא הצלחנו ליישם 2 הרשאות על אותו החוק למרות שבקורס הצלחנו. צריך לוודא שקיים updateOwnPassword
	// 	$rule = new \app\rbac\OwnStudentRule;
	// 	$auth->add($rule);
				
	// 	$indexOwnStudent->ruleName = $rule->name;		
	// 	$auth->add($indexOwnStudent);	
	// }	

	// public function actionAddthirdrule()
	// {	
	// 	$auth = Yii::$app->authManager;
		
	// 	$updateOwnDirector = $auth->getPermission('updateOwnDirector');
	// 	$auth->remove($indexOwnStudent);
		
	// 	/////////////////////////////////////////////////עצרנו פה כי לא הצלחנו ליישם 2 הרשאות על אותו החוק למרות שבקורס הצלחנו. צריך לוודא שקיים updateOwnPassword
	// 	$rule = new \app\rbac\OwnDirrectorRule;
	// 	$auth->add($rule);
				
	// 	$updateOwnDirector->ruleName = $rule->name;		
	// 	$auth->add($indexOwnStudent);	
	// }	

	
}
