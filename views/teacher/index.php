<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Teachers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Teacher', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

 


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
              'attribute' => 'user',
               	'value' => function($model){
					return $model->id0->fullName;
                    }, ],
            
            

            //'id',
            /* [
				'attribute' => 'id',
				'label' => 'שם מלא',
				'format' => 'raw',
				'value' => function($model){
					return $model->id0->fullname;  //Showing teacher name instead of teacher number.
				},
				
			],*/
            
             [
				'attribute' => 'centerid',
				'label' => 'מרכז',
				'format' => 'raw',
				'value' => function($model){
					return $model->center->centername;  //Showing center name instead of center number.
				},
				
			],

                
             



            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
