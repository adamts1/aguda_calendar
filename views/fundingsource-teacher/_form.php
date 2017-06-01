<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FundingsourceTeacher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fundingsource-teacher-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sourceid')->textInput() ?>

    <?= $form->field($model, 'teacherid')->textInput() ?>

    <?= $form->field($model, 'numberOfHours')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
