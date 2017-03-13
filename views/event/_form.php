<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;






/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'groupid')->textInput() ?>

    <?= $form->field($model, 'teacherid')->textInput() ?>

    <?= $form->field($model, 'locationid')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    
 
 
<?= $form->field($model,'created_date')->widget(DatePicker::className(),['language' => 'en','clientOptions' => ['dateFormat' => 'yy-mm-dd']]) ?>
<?= $form->field($model,'endDate')->widget(DatePicker::className(),['language' => 'en','clientOptions' => ['dateFormat' => 'yy-mm-dd']]) ?>



  


  





    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
