<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Supervisor */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'רכזים', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supervisor-view">

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
            //       [ // the name of supervisor from user
			// 	'label' => $model->attributeLabels()['id'],
			// 	'format' => 'html',
			// 	'value' => Html::a($model->id0->fullname, 
			// 		['user/view', 'id' => $model->id0->id]),
					
			// ],            
            'centerId',
                       [ // the name of supervisor from user
				'label' => $model->attributeLabels()['centerId'],
				'format' => 'html',
				'value' => Html::a($model->center->centername, 
					['center/view', 'id' => $model->center->id]),
					
			],          
        ],
    ]) ?>
       

</div>
