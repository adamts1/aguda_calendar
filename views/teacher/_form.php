<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
use app\models\Center;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teacher-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput()->dropDownList(User::getTeachers()) ?>  

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'centerid')->dropDownList(Center::getCenter()) ?>  
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
