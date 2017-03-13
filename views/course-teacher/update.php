<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CourseTeacher */

$this->title = 'Update Course Teacher: ' . $model->courseid;
$this->params['breadcrumbs'][] = ['label' => 'Course Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->courseid, 'url' => ['view', 'courseid' => $model->courseid, 'teacherid' => $model->teacherid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="course-teacher-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
