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
<script>
        $( ".select2-selection__rendered" ).click(function() {
        console.log('laury');
        if ( $('#course-id').val() > 0 ){
            $('.form-group .btn.btn-success').removeAttr("disabled");
        }
    }
</script>


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

    <?= $form->field($model, 'role')->hiddenInput(['value' => 'admin'])->label(false); ?>		

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
    'options' => ['multiple' => true , 'require' =>true],
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



     <?php } ?>



     <!-- as a teacher-->
  

<div>

</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success'  : 'btn btn-primary' /*, 'disabled' => 'disabled'*/]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>