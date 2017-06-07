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

   <div class="right-list col-md-2">
    <div class="button-action-list">
        <?= Html::a('הוספת רכז', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="btn-group-vertical button-action-list" role="group" aria-label="...">
    <?= Html::a('קבוצות', ['/group'], ['class' => 'btn btn-info']) ?>
    <?= Html::a('קורסים', ['/course'], ['class' => 'btn btn-info']) ?>
    <?= Html::a('מורים', ['/teacher'], ['class' => 'btn btn-info']) ?>
    <?= Html::a('כיתות', ['/location'], ['class' => 'btn btn-info']) ?>
    <?= Html::a('מרכזים', ['/center'], ['class' => 'btn btn-info']) ?>
    <?= Html::a('אירועים', ['/event'], ['class' => 'btn btn-info']) ?>
    <?= Html::a('סטודנטים', ['/student'], ['class' => 'btn btn-info']) ?>
    <?= Html::a('מקור מימון', ['/funding-source'], ['class' => 'btn btn-info']) ?>
    </div>
</div>
<div class="col-md-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        'columns' => [
             [   
                    'attribute'=>'user',
                    'format'=>'raw',
                   	'value' => function($model){
					return  Html::a($model->id0->fullName,['supervisor/view','id'=>$model->id], ['title' => 'View','class'=>'no-pjax']);
                    }
            ],

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

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',],
        ],
    ]); ?>
</div>
</div>