<?php

namespace app\controllers;

use Yii;
use app\models\Center;
use app\models\CenterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\HttpException;
use \yii\web\UnauthorizedHttpException;

/**
 * CenterController implements the CRUD actions for Center model.
 */
class CenterController extends Controller
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
     * Lists all Center models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->identity->userRole == 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה לצפות ברשימת המרכזים');}
        else{

        $searchModel = new CenterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
    }

    /**
     * Displays a single Center model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->identity->userRole == 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה לצפות ברשימת המרכזים');}
        else{

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
        }
    }

    /**
     * Creates a new Center model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->identity->userRole == 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה לצפות ברשימת המרכזים');}
        else{
        $model = new Center();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        }
    }

    /**
     * Updates an existing Center model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->identity->userRole == 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה לצפות ברשימת המרכזים');}
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
     * Deletes an existing Center model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->identity->userRole == 1){ // only teachers and principals can watch users 
			throw new UnauthorizedHttpException ('שלום, אינך מורשה לצפות ברשימת המרכזים');}
        else{
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Center model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Center the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Center::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
