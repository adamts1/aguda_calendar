<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\GroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'קבוצות לימוד';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="group-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Group', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            //'courseid',
             [
				'attribute' => 'courseid',
				'label' => 'מקצוע לימוד',
				'format' => 'raw',
				'value' => function($model){
					return $model->course->coursename;  //Showing center name instead of center number.
				},
				
			],
            // [
			// 	'attribute' => 'teacherid',
			// 	'label' => 'מורה',
			// 	'format' => 'raw',
			// 	'value' => function($model){
			// 		return $model->teacher->teachername;  //Showing center name instead of center number.
			// 	},

			// ],

            //  [
			//  	'attribute' => 'teacherid',
			//  	'label' => 'מורה',
			//  	'format' => 'raw',
			//  	'value' => function($model){
			// 		return $model->teacher->id0->fullname;  //Showing center name instead of center number.
		 	// },
				
			//  ],

            //'locationid',
            [
            
				'attribute' => 'locationid',
				'label' => 'כיתת לימוד',
				'format' => 'raw',
				'value' => function($model){
					return $model->location->locationname;  //Showing center name instead of center number.
				},
				
			],
            'dayintheweek',
            // 'duration',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>