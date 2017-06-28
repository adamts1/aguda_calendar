<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'קורסים';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

   
    <div class="right-list col-md-2">
        <div class="button-action-list">
        <?php  if (Yii::$app->user->identity->userRole != 3) :?>
            <?= Html::a('הוספת קורס', ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
        </div>
        <div class="btn-group-vertical button-action-list" role="group" aria-label="...">
        <?= Html::a('מורים', ['/teacher'], ['class' => 'btn btn-info']) ?>
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
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'coursename',

            ['class' => 'yii\grid\ActionColumn',
            'template' => Yii::$app->user->identity->userRole != 3 ? '{update} {delete} {view}' :'{delete} {view}',
            ],
        ],
    ]); ?>
</div>
</div>