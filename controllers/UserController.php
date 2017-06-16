<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Teacher;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\HttpException;
use \yii\web\UnauthorizedHttpException;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
          if (Yii::$app->user->identity->userRole == 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה לצפות בדף זה');}
        else{
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
          if (Yii::$app->user->identity->userRole == 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה לצפות בדף זה');}
        else{
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
        }
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
          if (Yii::$app->user->identity->userRole == 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה לצפות בדף זה');}
        else{
        $model = new User();
        
        //$teacher = new Teacher(); //בדיקה

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
           
            Yii::$app->response->format = 'json';
            if ($model->validate()) {
                return ActiveForm::validate($model);
            } else {
                // validation failed: $errors is an array containing error messages
                $errors = $model->errors;
            }
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()  ) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                //'teacher' => $teacher, 
                
            ]);
        }
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
          if (Yii::$app->user->identity->userRole == 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה לצפות בדף זה');}
        else{
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
          if (Yii::$app->user->identity->userRole == 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה לצפות בדף זה');}
        else{
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
        }
    }

   

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
