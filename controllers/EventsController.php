<?php

namespace app\controllers;

use Yii;
use app\models\Events;
use app\models\Student;
use app\models\StudentEvents;
use app\models\EventsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use	yii\helpers\ArrayHelper; 
use \yii\web\HttpException;
use \yii\web\UnauthorizedHttpException;


/**
 * EventsController implements the CRUD actions for Events model.
 */
class EventsController extends Controller
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
     * Lists all Events models.
     * @return mixed
     */
    public function actionIndex()
    {
          if (Yii::$app->user->identity->userRole != 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה לצפות בדף זה');}
        else{
        $searchModel = new EventsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }}

    /**
     * Displays a single Events model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
          if (Yii::$app->user->identity->userRole != 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה לצפות בדף זה');}
        else{
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
        }
    }

    /**
     * Creates a new Events model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
          if (Yii::$app->user->identity->userRole != 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה לצפות בדף זה');}
        else{
        $model = new Events();

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        }
    }

    /**
     * Updates an existing Events model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
          if (Yii::$app->user->identity->userRole != 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה לצפות בדף זה');}
        else{
        $model = Events::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException("The events was not found");
        }

         $student = ArrayHelper::map(Student::find()->all(), 'id', 'nickname');
         $studentevents = new StudentEvents();

        if ($model->load(Yii::$app->request->post())) {
            print_r($model);
            $model->save(false);

            StudentEvents::deleteAll(['eventsid' => $id]);
                 $studentevents->load(Yii::$app->request->post());

                 if (!empty($studentevents->studentid)){
                     foreach ($studentevents->studentid as $studentid) {
                        $studentevents = new StudentEvents();
                        $studentevents->setAttributes([
                        'studentid' => $studentid,
                        'eventsid' => $id,
                   ]);
                   $studentevents->save();
                  }
                }


            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'id' => $id,

            ]);
        }
        }
    }

    /**
     * Deletes an existing Events model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
          if (Yii::$app->user->identity->userRole != 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה לצפות בדף זה');}
        else{
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Events model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Events the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Events::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
