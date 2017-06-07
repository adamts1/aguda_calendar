<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Location;
use app\models\Teacher;
use app\models\Course;
use app\models\Events;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;    




/* @var $this yii\web\View */
/* @var $model app\models\Events */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="events-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start')->widget(\yii\jui\DatePicker::classname(), [
    'language' => 'he',
    // 'dateFormat' => 'yyyy-MM-dd',
]) ?>
    <?= $form->field($model, 'end')->widget(\yii\jui\DatePicker::classname(), [
    'language' => 'he',
    // 'dateFormat' => 'yyyy-MM-dd',
]) ?>

    <?= $form->field($model, 'courseid')->dropDownList(course::getCourse()) ?>  

    <?= $form->field($model, 'teacherid')->dropDownList(Teacher::getAllTeachersByCenter()) ?>  


     <?= $form->field($model, 'locationid')->dropDownList(Location::getLocation()) ?>  


   <!--<?= $form->field($model, 'studentstring')->textInput(['maxlength' => true]) ?>-->


<!--///////////////////////////////////-->
<?php

     $datastudents = Events::getStudentByCenter(); 

     $initstudents = Events::getInitStudents($id); ?>

    <label class="control-label">תלמידים בשיבוץ</label>

     <?= Select2::widget([
         
        'attribute' => 'id',
        'name' => 'StudentEvents[studentid]',
	     'value' => $initstudents, 
         'data' => [$datastudents],
        'options' => ['placeholder' => 'ניתן להסיר/להוסיף תלמידים ע"פ מצב נוכחות ', 'multiple' => true],
        'pluginOptions' => [
            'tags' => true,
            'maximumInputLength' => 10
        ],
    ]); ?>

<!--//////////////////////////////////-->
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
