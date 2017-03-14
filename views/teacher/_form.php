<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
use app\models\Teacher;
use app\models\Userrole;
use app\models\Center;
use app\models\Course;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;    
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teacher-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--first create user and then define as a teacher-->
     <?= $form->field($user, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'password')->passwordInput(['maxlength' => true]) ?>

    <!--<?= $form->field($user, 'auth_key')->textInput(['maxlength' => true]) ?>-->

    <?= $form->field($user, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'notes')->textarea(['rows' => 6]) ?>

    <!--<?= $form->field($user, 'status')->textInput() ?>-->

    <!--<?= $form->field($user, 'created_at')->textInput() ?>-->

    <!--<?= $form->field($user, 'updated_at')->textInput() ?>-->

    <!--<?= $form->field($user, 'created_by')->textInput() ?>-->

    <!--<?= $form->field($user, 'updated_by')->textInput() ?>-->

        <?= $form->field($user, 'userRole')->dropDownList(Userrole::getTeachersUserRole()) ?>  

    <!-- as a teacher-->
    <?php $data = Teacher::getCoursesTeacher(); ?>

   <?php
echo Alert::widget([
    'options' => [
        'class' => 'alert-info',
    ],
    'body' => 'please add  all the pupils that were on this activity',
]);
?>

  <?=  $form->field($model, 'subject')->widget(Select2::classname(), [
   
    'data' => [$data],
    'language' => 'de',
   'options' => ['multiple' => true],
    'pluginOptions' => [
        'allowClear' => true,
        'tags' => true,
    ],
]);
?>

    

   
 

    <!--<?= $form->field($model, 'subject')->dropDownList(Course::getCourse()) ?>  -->

    <?= $form->field($model, 'centerid')->dropDownList(Center::getCenter()) ?>  


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
