<?php

namespace app\controllers;

use Yii;
use app\models\Teacher;
use app\models\User;
use app\models\Course;
use app\models\CourseTeacher;
use app\models\TeacherSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use	yii\helpers\ArrayHelper; 


/**
 * TeacherController implements the CRUD actions for Teacher model.
 */
class TeacherController extends Controller
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
     * Lists all Teacher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeacherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

       

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Teacher model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),

        ]);
    }

    /**
     * Creates a new Teacher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Teacher();
        $user = new User();
        $course = new Course();
        
       

    //    $model->editableUsers = [2,3,4]; //many to many
    //     $model->save();

        if ($model->load(Yii::$app->request->post()) && $user->load(Yii::$app->request->post())  && $model->save()) {
         
            $user->id = $user->id;  //insert id to user table
            $user->save();

            $model->id = $user->id; //insert the same id as user
            $model->save();

          foreach ($_POST['Course']['id'] as $id) {
              $questionCategory = new CourseTeacher; //instantiate new CourseTeacher model
             $questionCategory->teacherid = $model->id;
              $questionCategory->courseid = $id;
              $questionCategory->save();
           } // due to multiple courses for for one teacher

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'user' => $user,
                'course' => $course,
                // 'course' => Course::getCourse1(),
               
            ]);
        }
    }

    /**
     * Updates an existing Teacher model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionUpdate($id)
    // {
    //     $user = $this->findModel($id);
    //         ///  User::find()->where(['id' =>$id])->one(); // trying to update user&techer

    //     $model = $this->findModel($id);
    
    //   if ($model->load(Yii::$app->request->post())  && $user->load(Yii::$app->request->post())  && $model->save()) {
                
          
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     } else {
    //         return $this->render('update', [
               
    //             'user' => $user,   //taking iputs from user to teacher
    //              'model' => $model,
    //         ]); 
    //     }
    // }

    public function actionUpdate($id)  // update teacher & user  together
        {
        $model = Teacher::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException("The teacher was not found.");
        }
        
        $user = User::findOne($model->id); // userNumber is the fk
        if (!$user) {
            throw new NotFoundHttpException("The user has no profile.");
        }

        //  $course = ArrayHelper::map(Course::find()->all(), 'id', 'coursename');
        //  $courseteacher = new CourseTeacher();

    
        //$model->scenario = 'update';
        //$teacher->scenario = 'update';
        
        if ($model->load(Yii::$app->request->post()) && $user->load(Yii::$app->request->post())) {
            //$isValid = $model->validate();
            //$isValid = $teacher->validate() && $isValid;
            //if ($isValid) {
                $model->save(false);
                $user->save(false);
        //         $course->save(false);

        //           CourseTeacher::deleteAll(['teacherid' => $id]);
        //            $courseteacher->load(Yii::$app->request->post());

        //            if (!empty($courseteacher->courseid)){
        //     foreach ($courseteacher->courseid as $courseid) {
        //         $courseteacher = new CourseTeacher();
        //         $courseteacher->setAttributes([
        //             'courseid' => $location_id,
        //             'teacherid' => $model->id,
        //         ]);
        //         $courseteacher->save();
        //     }
        // }

              
               
                return $this->redirect(['teacher/view', 'id' => $id]);
           // }
        }
        
        return $this->render('update', [
            'model' => $model,
            'user' => $user,
       
        ]);
    }




    /**
     * Deletes an existing Teacher model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

         User::find()->where(['id' =>$id])->one()->delete();// delete from user table
        $this->findModel($id)->delete();
       
      
        return $this->redirect(['index']);
    }

    /**
     * Finds the Teacher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Teacher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Teacher::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    
}
