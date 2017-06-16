<?php

namespace app\controllers;

use Yii;
use app\models\FundingsourceTeacher;
use app\models\FundingSource;
use app\models\Teacher;
use app\models\FundingsourceTeacherSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FundingsourceTeacherController implements the CRUD actions for FundingsourceTeacher model.
 */
class FundingsourceTeacherController extends Controller
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
     * Lists all FundingsourceTeacher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FundingsourceTeacherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $fundingSource = FundingSource::find()->all();
        $teachers = Teacher::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'fundingSource'=>$fundingSource,
            'teachers'=>$teachers,
        ]);
    }

    /**
     * Displays a single FundingsourceTeacher model.
     * @param integer $sourceid
     * @param integer $teacherid
     * @return mixed
     */
    public function actionView($sourceid, $teacherid)
    {
        return $this->render('view', [
            'model' => $this->findModel($sourceid, $teacherid),
        ]);
    }

    /**
     * Creates a new FundingsourceTeacher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FundingsourceTeacher();
        
        /*if (($model->sourceid && $model->teacherid) ){
            echo "<script>
                alert('There are no fields to generate a report');
                window.location.href='admin/ahm/panel';
                </script>";
        }*/
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'sourceid' => $model->sourceid, 'teacherid' => $model->teacherid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FundingsourceTeacher model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $sourceid
     * @param integer $teacherid
     * @return mixed
     */
    public function actionUpdate($sourceid, $teacherid)
    {
        $model = $this->findModel($sourceid, $teacherid);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'sourceid' => $model->sourceid, 'teacherid' => $model->teacherid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FundingsourceTeacher model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $sourceid
     * @param integer $teacherid
     * @return mixed
     */
    public function actionDelete($sourceid, $teacherid)
    {
        $this->findModel($sourceid, $teacherid)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FundingsourceTeacher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $sourceid
     * @param integer $teacherid
     * @return FundingsourceTeacher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($sourceid, $teacherid)
    {
        if (($model = FundingsourceTeacher::findOne(['sourceid' => $sourceid, 'teacherid' => $teacherid])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
