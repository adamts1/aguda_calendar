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

   <?=  $form->field($model, 'duration')->dropDownList([
            '1'=>'8:00',
            '2'=>'8:30',
            '3'=>'9:00',
            '4'=>'9:30',
            '5'=>'10:00',
            '6'=>'10:30',
            '7'=>'11:00',
            '8'=>'11:30',
            '9'=>'12:00',
            '10'=>'12:30',
            '11'=>'13:00',
            '12'=>'13:30',
            '13'=>'14:00',
            '14'=>'14:30',
            '15'=>'15:00',
            '16'=>'15:30',
            '17'=>'16:00',
            '18'=>'16:30',
            '19'=>'17:00',
            '20'=>'17:30',
            '21'=>'18:00',

            ]) ?>
    
  

 <!-- <?//= $form->field($model, 'locationid')->dropDownList(Student::getStudentForGroup()) ?> -->


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
