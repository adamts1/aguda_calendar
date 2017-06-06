<?php

namespace app\controllers;

use Yii;
use app\models\Supervisor;
use app\models\User;
use app\models\SupervisorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\HttpException;
use \yii\web\UnauthorizedHttpException;
/**
 * SupervisorController implements the CRUD actions for Supervisor model.
 */
class SupervisorController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors() //due to aloww crud only if connected
    {
        return [

            
             'access' => [
            'class' => \yii\filters\AccessControl::className(),
            'only' => [ 'update' ],
            'rules' => [
                // deny all POST requests
                [
                    'allow' => true,
                    'verbs' => ['POST']
                ],
                // allow authenticated users
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
                // everything else is denied
            ],
        ],




            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Supervisor models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        if (Yii::$app->user->identity->userRole == 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה לצפות ברשימת הרכזים');}
        else{
        $searchModel = new SupervisorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    }

    /**
     * Displays a single Supervisor model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->identity->userRole == 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה לצפות ברשימת הרכזים');}
        else{
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
        }
    }

    /**
     * Creates a new Supervisor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //
        if (Yii::$app->user->identity->userRole == 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה ליצור רכז  ');}
        else{
        $model = new Supervisor();
         $user = new User();

        if ($model->load(Yii::$app->request->post()) && $user->load(Yii::$app->request->post())  && $model->save()) {
             $user->id = $user->id;  //insert id to user table
             $user->userRole = '2'; //insert id to user table

             $user->save();

             $model->id = $user->id; //insert the same id as user
             $model->save();

            return $this->redirect(['view', 'id' => $model->id]);

             
        } else {

             $roles = Supervisor::getRoles(); 
            return $this->render('create', [
                'model' => $model,
                'user' => $user, //taking iputs from user to supervisor
                'roles' => $roles,

            ]);
        }
    }
    }
    /**
     * Updates an existing Supervisor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     } else {
    //         return $this->render('update', [
    //             'model' => $model,
                
    //         ]);
    //     }
    // }

    public function actionUpdate($id)  // update teacher & user  together
        {
        if (Yii::$app->user->identity->userRole == 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה לעדכן רכזים ');}
        else{
            $model = Supervisor::findOne($id);
            if (!$model) {
                throw new NotFoundHttpException("The supervisor was not found.");
            }
            
            $user = User::findOne($model->id); // userNumber is the fk
            if (!$user) {
                throw new NotFoundHttpException("The user has no profile.");
            }
            
            //$model->scenario = 'update';
            //$teacher->scenario = 'update';
            
            if ($model->load(Yii::$app->request->post()) && $user->load(Yii::$app->request->post())) {
                //$isValid = $model->validate();
                //$isValid = $teacher->validate() && $isValid;
                //if ($isValid) {
                    $model->save(false);
                    $user->save(false);
                    return $this->redirect(['supervisor/view', 'id' => $id]);
            // }
            }
            $roles = Supervisor::getRoles(); 
            return $this->render('update', [
                'model' => $model,
                'user' => $user,
                'roles' => $roles,

            ]);
        }
    }

    /**
     * Deletes an existing Supervisor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->identity->userRole == 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה למחוק רכזים');}
        else{
            User::find()->where(['id' =>$id])->one()->delete();
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Supervisor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Supervisor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Supervisor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
