<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\LostPasswordForm;
use app\models\ContactForm;
use app\models\User;
use app\models\EmailMessage;

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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $lostPasswordForm = new LostPasswordForm();
        if($lostPasswordForm->load(Yii::$app->request->post()) && $lostPasswordForm->validate())
        {
          $user = User::findOne(['email'=>$lostPasswordForm->email]);

          if ($user){
              
              $message = EmailMessage::findOne(['slug'=>'password_recovery']);
              
            
               $email = Yii::$app->mailer
                ->compose(['body'=>$message])
                ->setFrom('donotereply@mipo.com')
                ->setTo($user->email)
                ->setSubject('Recovery Password');
                
                Yii::$app->mailer->compose()
                    ->setFrom('somebody@domain.com')
                    ->setTo($user->email)
                    ->setSubject('Email sent from Yii2-Swiftmailer')
                    ->send();

                 Yii::$app->mailer->compose()
                    ->setTo('laury.aziza@gmail.com')
                    ->setFrom('donotreply@gmail.com')
                    ->setSubject('Invite')
                    ->setTextBody('Hello!')
                    ->send();

                if ($email->send()){
                    print_r('email send');die();
                }



          }
        }

        return $this->render('login', [
            'model' => $model,
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
