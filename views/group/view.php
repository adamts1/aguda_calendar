<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Group */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'courseid',
             [ // the name of supervisor from user
				'label' => $model->attributeLabels()['courseid'],
				'format' => 'html',
				'value' => Html::a($model->course->coursename, 
					['course/view', 'id' => $model->course->id]),
					
			],          
            'teacherid',
            
           // 'locationid',
             [ // the name of supervisor from user
				'label' => $model->attributeLabels()['locationid'],
				'format' => 'html',
				'value' => Html::a($model->location->locationname, 
					['location/view', 'id' => $model->location->id]),
                    	],   
            'dayintheweek',
            'duration',
        ],
    ]) ?>

</div>
