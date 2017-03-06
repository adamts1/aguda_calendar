<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Course;
use app\models\Location;
use app\models\User;
use app\models\Student;
//check
/* @var $this yii\web\View */
/* @var $model app\models\Group */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // if(!$model->isNewRecord):?>
    <?php //endif ?>
 

   <?= $form->field($model, 'courseid')->dropDownList(Course::getCourse()) ?>

    <?= $form->field($model, 'teacherid')->dropDownList(User::getTeachers()) ?>

    <?= $form->field($model, 'locationid')->dropDownList(Location::getLocation()) ?>


 <!-- <?= $form->field($model, 'locationid')->dropDownList(Student::getStudentForGroup()) ?> -->
    
    <?= $form->field($model, 'dayintheweek')->textInput(['maxlength' => true]) ?>

   


    <!--  $form->field($model, 'duration')->textInput()  -->


    <div class="form-group ">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
