<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\FundingSource;
use app\models\Userrole;
use app\models\Teacher;

/* @var $this yii\web\View */
/* @var $model app\models\FundingsourceTeacher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fundingsource-teacher-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sourceid')->dropDownList(FundingSource::getFundingSource()) ?>
    <?= $form->field($model, 'teacherid')->dropDownList(Teacher::getTeachers()) ?>

    <?= $form->field($model, 'numberOfHours')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
