<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\SupervisorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'רכזים';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supervisor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Supervisor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // [
			// 	'attribute' => 'id',
			// 	'label' => 'רכז',
			// 	'format' => 'raw',
			// 	'value' => function($model){
			// 		return $model->id0->fullname;  //////////Showing course name instead of course number.
			// 	},
			// 	//'filter'=>Html::dropDownList('CourseClassSearch[teacherId]', $teacher, $teachers, ['class'=>'form-control']),   //////////////// the arguments are from the controller!
			// ],

           
           
            [
				'attribute' => 'centerId',
				'label' => 'מרכז',
				'format' => 'raw',
				'value' => function($model){
					return $model->center->centername;  //Showing course name instead of course number.
				},
				//'filter'=>Html::dropDownList('CourseClassSearch[teacherId]', $teacher, $teachers, ['class'=>'form-control']),   //////////////// the arguments are from the controller!
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
