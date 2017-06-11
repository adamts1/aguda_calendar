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

    <?= $form->field($model, 'role')->dropDownList($roles, ['readonly' => true])->label('הרשאות'); ?>		

    <?= $form->field($user, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'notes')->textarea(['rows' => 6]) ?>

    <!--<?= $form->field($user, 'status')->textInput() ?>-->

    <!--<?= $form->field($user, 'created_at')->textInput() ?>-->

    <!--<?= $form->field($user, 'updated_at')->textInput() ?>-->

    <!--<?= $form->field($user, 'created_by')->textInput() ?>-->

    <!--<?= $form->field($user, 'updated_by')->textInput() ?>-->

    

  
    <?php 
    
    $data = Teacher::getCourseByCenter(); 

    $datafunding = Teacher::getFundinSourceTeacher();

    if ($model->isNewRecord) {  ?>
  <?=  $form->field($course, 'id')->widget(Select2::classname(), [
   
    'data' => [$data],
    'language' => 'de',
   'options' => ['multiple' => true],
    'pluginOptions' => [
        'allowClear' => true,
        'tags' => true,
    ],
]);
?>

<?=  $form->field($fundingsource, 'id')->widget(Select2::classname(), [
   
    'data' => [$datafunding],
    'language' => 'de',
   'options' => ['multiple' => true],
    'pluginOptions' => [
        'allowClear' => true,
        'tags' => true,
    ],
]);
?>

  
     

     <?php }else { ?>

    <?php $coursesids = Teacher::getInitCourses($id); ?>
    <?php $sourcesids = Teacher::getInitFunding($id); ?>

    <label class="control-label">מלמד קורסים</label>

     <?= Select2::widget([
         
        'attribute' => 'id',
        'name' => 'CourseTeacher[courseid]',
	     'value' => $coursesids, 
         'data' => [$data],
        'options' => ['placeholder' => 'בחר מקצועות לימוד', 'multiple' => true],
        'pluginOptions' => [
            'tags' => true,
            'maximumInputLength' => 10
        ],
    ]); ?>

     
<label class="control-label">מקור מימון</label>

   <?= Select2::widget([
      
        'name' => 'FundingsourceTeacher[sourceid]',
	     'value' => $sourcesids, 
         'data' => [$datafunding],
        'options' => ['placeholder' => 'הזן מקור מימון', 'multiple' => true],
        'pluginOptions' => [
            'tags' => true,
            'maximumInputLength' => 10
        ],
    ]);
    
     ?>

     <?php } ?>



     <!-- as a teacher-->
  

<div>

</div>

    <div class="form-group">
      
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>