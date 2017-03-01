<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'תלמידים';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('יצירת תלמיד', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //      'id',
           // 'centerid',

            'name',
            'lastname',
            [
				'attribute' => 'centerid',
				'label' => 'מרכז',
				'format' => 'raw',
				'value' => function($model){
					return $model->center->centername;  //Showing course name instead of course number.
				},
				//'filter'=>Html::dropDownList('CourseClassSearch[teacherId]', $teacher, $teachers, ['class'=>'form-control']),   //////////////// the arguments are from the controller!
			],
           
            'grade',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
