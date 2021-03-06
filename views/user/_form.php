<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Userrole;
use app\models\User;



/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        //'enableAjaxValidation'=>true,
    ]); ?>

    
    <?= $form->field($model, 'username')->textInput(['maxlength' => true ]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <!--<?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>-->

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <!--<?= $form->field($model, 'status')->textInput() ?>-->

    <!--<?= $form->field($model, 'created_at')->textInput() ?>-->

    <!--<?= $form->field($model, 'updated_at')->textInput() ?>-->

    <!--<?= $form->field($model, 'created_by')->textInput() ?>-->

    <!--<?= $form->field($model, 'updated_by')->textInput() ?>-->

   
    <?= $form->field($model, 'userRole')->dropDownList(Userrole::getAdminstratorUserRole()) ?>

   
  

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'צור חדש' : 'עדכן', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
