<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\helpers\ArrayHelper;    
use kartik\widgets\Select2;
use app\models\Course;
// use kartik\detail\DetailView; 


/* @var $this yii\web\View */
/* @var $model app\models\Teacher */

$this->title = $model->id0->userName;
$this->params['breadcrumbs'][] = ['label' => 'Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-view">

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
            // 'id',
            // 'courseTeachers.courseid',
             [  // Shows all  the courses
                'attribute' => 'מלמד קורסים',
                'value' => $model->getCoursesOfTeacher(),
              
            ],

            [  // Shows all  the courses
                'attribute' => 'מומן ע"י',
                'value' => $model->getSourceOfTeacher(),
              
            ],

             [  // Shows all  the courses
                'attribute' => 'שם ושם משפחה',
                'value' => $model->id0->fullName,
              
            ],

            
            
        //    'subject',
           // 'centerid',
                [ // the name of supervisor from user
				'label' => $model->attributeLabels()['centerid'],
				'format' => 'html',
				'value' => Html::a($model->center->centername, 
					['center/view', 'id' => $model->center->id]),	
			    ],  

                              

        ],


    ]) ?>

</div>
