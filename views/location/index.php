<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LocationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'כיתות';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-index">

  <div class="right-list col-md-2">
    <div class="button-action-list">
        <?= Html::a('הוספת כיתה', ['create'], ['class' => 'btn btn-success']) ?>
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
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>