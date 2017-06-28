<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'מורים';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="right-list col-md-2">
 <?php if (Yii::$app->user->identity->userRole == 2):?>
    <div class="button-action-list">
        <?= Html::a('הוספת מורה', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('הוספת מקור מימון למורה', ['fundingsource-teacher/create'], ['class' => 'btn btn-warning addFST']) ?>
    </div>
<?php endif;?>
    <div class="btn-group-vertical button-action-list" role="group" aria-label="...">
    <?= Html::a('קורסים', ['/course'], ['class' => 'btn btn-info']) ?>
    <?= Html::a('כיתות', ['/location'], ['class' => 'btn btn-info']) ?>
    <?= Html::a('מרכזים', ['/center'], ['class' => 'btn btn-info']) ?>
    <?= Html::a('אירועים', ['/event'], ['class' => 'btn btn-info']) ?>
    <?= Html::a('תלמידים', ['/student'], ['class' => 'btn btn-info']) ?>
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
					return  Html::a($model->id0->fullName,['teacher/view','id'=>$model->id], ['title' => 'View','class'=>'no-pjax']);
                    }
            ],
            [
              'attribute' => 'user',
               	'value' => function($model){
					return $model->id0->fullName;},
            ],
            [
              'attribute' => 'center',
               	'value' => function($model){
					return $model->center->centername;},
            ],
            //'id',
            /* [
				'attribute' => 'id',
				'label' => 'שם מלא',
				'format' => 'raw',
				'value' => function($model){
					return $model->id0->fullname;  //Showing teacher name instead of teacher number.
				},
				
			],*/
            
            //  [
			// 	'attribute' => 'centerid',
			// 	'label' => 'מרכז',
			// 	'format' => 'raw',
			// 	'value' => function($model){
			// 		return $model->center->centername;  //Showing center name instead of center number.
			// 	},
				
			// ],
            
            ['class' => 'yii\grid\ActionColumn',
            'template' => Yii::$app->user->identity->userRole != 3 ? '{update} {delete}' :'{delete}' ,],
        ],
    ]);


     ?>
</div>
</div>