<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GroupSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'courseid') ?>

    <?= $form->field($model, 'teacherid') ?>

    <?= $form->field($model, 'locationid') ?>

    <?= $form->field($model, 'day') ?>

    <?php // echo $form->field($model, 'start') ?>

    <?php // echo $form->field($model, 'end') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
