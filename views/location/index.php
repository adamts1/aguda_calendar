<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LocationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'מיקום';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-index">
<?php print_r($url);?>

 <div class="right-list col-md-2">
    <div class="button-action-list">
        <?php  if (Yii::$app->user->identity->userRole != 3) :?>
             <?= Html::a('הוספת מיקום ', ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
    </div>
    <div class="btn-group-vertical button-action-list" role="group" aria-label="...">
    <?= Html::a('קורסים', ['/course'], ['class' => 'btn btn-info']) ?>
    <?= Html::a('מורים', ['/teacher'], ['class' => 'btn btn-info']) ?>
    <?= Html::a('מרכזים', ['/center'], ['class' => 'btn btn-info']) ?>
    <?= Html::a('אירועים', ['/event'], ['class' => 'btn btn-info']) ?>
    <?= Html::a('תלמידים', ['/student'], ['class' => 'btn btn-info']) ?>
    <?= Html::a('מקור מימון', ['/funding-source'], ['class' => 'btn btn-info']) ?>
    </div>
</div>
<div class="col-md-10">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            ['class' => 'yii\grid\ActionColumn',
            'template' => Yii::$app->user->identity->userRole != 3 ? '{update} {delete} {view}' :'{delete} {view}',
            ],
        ],
    ]); ?>
</div>
