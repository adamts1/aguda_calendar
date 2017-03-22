<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Course;
use app\models\Group;
use app\models\Location;
use app\models\User;
use app\models\Student;
use yii\jui\DatePicker;
use \kartik\time\TimePicker;
use kartik\select2\Select2;




/* @var $this yii\web\View */
/* @var $model app\models\Group */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'courseid')->dropDownList(Course::getCourse()) ?>

    <?= $form->field($model, 'teacherid')->dropDownList(User::getTeachers()) ?>

    <?= $form->field($model, 'locationid')->dropDownList(Location::getLocation()) ?>

   <?= $form->field($model, 'day')->dropDownList(['א' => 'א', 'ב' => 'ב', 'ג' => 'ג', 'ד' => 'ד', 'ה' => 'ה', 'ו' => 'ו', 'ש' => 'ש']); ?>


   <?=  $form->field($model, 'start')->widget(TimePicker::classname(), [
    'pluginOptions' => [
        'showSeconds' => false,
        'showMeridian' => false,
        'minuteStep' => 60,
        'secondStep' => 5,
    ]
    ]); 
    ?>

   <?=  $form->field($model, 'end')->widget(TimePicker::classname(), [
    'pluginOptions' => [
        'showSeconds' => false,
        'showMeridian' => false,
        'minuteStep' => 60,
        'secondStep' => 5,
    ]
    ]); 
    ?> 





   

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
