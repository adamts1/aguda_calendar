<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CenterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'מרכזים';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="center-index">
    
    <div class="right-list col-md-2">
        <div class="button-action-list">
            <?= Html::a('הוספת מרכז', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="btn-group-vertical button-action-list" role="group" aria-label="...">
        <?= Html::a('קורסים', ['/course'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('מורים', ['/teacher'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('כיתות', ['/location'], ['class' => 'btn btn-info']) ?>
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

            //   'id',
                'name',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
