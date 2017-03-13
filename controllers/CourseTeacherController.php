<?php

namespace app\controllers;

use Yii;
use app\models\CourseTeacher;
use app\models\CourseTeacherSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CourseTeacherController implements the CRUD actions for CourseTeacher model.
 */
class CourseTeacherController extends Controller
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
     * Lists all CourseTeacher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CourseTeacherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CourseTeacher model.
     * @param integer $courseid
     * @param integer $teacherid
     * @return mixed
     */
    public function actionView($courseid, $teacherid)
    {
        return $this->render('view', [
            'model' => $this->findModel($courseid, $teacherid),
        ]);
    }

    /**
     * Creates a new CourseTeacher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CourseTeacher();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'courseid' => $model->courseid, 'teacherid' => $model->teacherid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CourseTeacher model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $courseid
     * @param integer $teacherid
     * @return mixed
     */
    public function actionUpdate($courseid, $teacherid)
    {
        $model = $this->findModel($courseid, $teacherid);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'courseid' => $model->courseid, 'teacherid' => $model->teacherid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CourseTeacher model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $courseid
     * @param integer $teacherid
     * @return mixed
     */
    public function actionDelete($courseid, $teacherid)
    {
        $this->findModel($courseid, $teacherid)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CourseTeacher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $courseid
     * @param integer $teacherid
     * @return CourseTeacher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($courseid, $teacherid)
    {
        if (($model = CourseTeacher::findOne(['courseid' => $courseid, 'teacherid' => $teacherid])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
