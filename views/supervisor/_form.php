<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
use app\models\Userrole;
use app\models\Center;


/* @var $this yii\web\View */
/* @var $model app\models\Supervisor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supervisor-form">

     

    <?php $form = ActiveForm::begin(); ?>

    <!--first create user and then define as a supervisor-->
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

   <?= $form->field($model, 'role')->hiddenInput(['value' => 'pro'])->label(false); ?>			


  



    <!-- as a teacher-->

        <!--<?= $form->field($model, 'id')->textInput() ?>-->

<?php if (Yii::$app->user->identity->userRole == 3):?>
    <?= $form->field($model, 'centerId')->dropDownList(Center::getCenter()) ?>  
    
<?php endif;?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
