<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'משוב על שיעורים';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="events-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--<p>
        <?= Html::a('Create Events', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=>function($model){
            if ($model->status == 1)
            {
                return ['class' => 'success'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
                 [ 'attribute' => 'title', // New attribute for filter instead of fk userNumber. the functions are at TeacherSearch!
           	 'label' => 'תיאור השיבוץ',
             'format'=>'raw',
                    'value' => function($data){
					 return
                        Html::a($data->title, ['events/view','id'=>$data->id], ['title' => 'View','class'=>'no-pjax']);
                    }
            ],
            
            

            // 'id',
            // 'title',
            // 'color',
            'start',
            'end',

            

         // 'groupNumber',

            [
              'attribute' => 'courseid',
               	'value' => function($model){
					return $model->course->courseName;},
            ],

            [
              'attribute' => 'locationid',
               	'value' => function($model){
					return $model->location->locationName;},
            ],
            // 'teacherid',
            'studentstring',

            ['class' => 'yii\grid\ActionColumn',
             'template' => '{update} {delete} {view}',],
        ],
    ]); ?>

</div>
