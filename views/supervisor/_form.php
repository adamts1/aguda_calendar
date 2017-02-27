<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Supervisor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supervisor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->dropDownList(User::getSupervisors()) ?>  


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
