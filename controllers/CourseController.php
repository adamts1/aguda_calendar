<?php

namespace app\controllers;

use Yii;
use app\models\Course;
use app\models\Supervisor;
use app\models\User;
use app\models\CourseSearch;
use app\models\CourseCenter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\db\QueryBuilder;  
use \yii\web\HttpException;
use \yii\web\UnauthorizedHttpException;


/**
 * CourseController implements the CRUD actions for Course model.
 */
class CourseController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [

             'access' => [
            'class' => \yii\filters\AccessControl::className(),  //due to aloww crud only if connected
            'only' => ['create', 'update', 'index'],
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
     * Lists all Course models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->identity->userRole == 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה לצפות ברשימת קורסים');}
        else{
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
    }

    /**
     * Displays a single Course model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->identity->userRole == 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה לצפות ברשימת קורסים');}
        else{
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
        }
    }

    /**
     * Creates a new Course model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->identity->userRole == 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה ליצור קורסים חדשים  ');}
        else{
        if (Yii::$app->user->can('createStudent'))
        {
        $model = new Course();
        $supervisor = new Supervisor();
        $user = new User();
        // $user = new User();
  

          if ($model->load(Yii::$app->request->post()) && $model->save()) {
 ///////////////////////////////////////////////////////////////////////////////////////////////////
              
             $coursecenter = new CourseCenter; //instantiate new CourseTeacher model
             $coursecenter->centerid = (new \yii\db\Query()) //insert course according to center
               ->select(['centerId'])
               ->from('supervisor')
               ->where(['id'=> Yii::$app->user->identity->id ])->scalar();
             $coursecenter->courseid = $model->id;
             $coursecenter->save();
/////////////////////////////////////////////////////////////////////////////////////////////////////
            return $this->redirect(['view', 'id' => $model->id]);
           } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        }else{
        throw new NotFoundHttpException('The requested page does not exist.');


    }
    }
    }

    /**
     * Updates an existing Course model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->identity->userRole == 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה לעדכן קורסים  ');}
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
     * Deletes an existing Course model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->identity->userRole == 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה למחוק קורסים  ');}
        else{

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    }

    /**
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Course::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
