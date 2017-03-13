<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Course;

/* @var $this yii\web\View */
/* @var $model app\models\CourseTeacher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="course-teacher-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'courseid')->dropDownList(Course::getCourse()) ?>  

    <?= $form->field($model, 'teacherid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
