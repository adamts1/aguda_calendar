<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CourseTeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Course Teachers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-teacher-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Course Teacher', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'courseid',
            'teacherid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
