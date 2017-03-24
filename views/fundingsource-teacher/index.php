<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FundingsourceTeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fundingsource Teachers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fundingsource-teacher-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Fundingsource Teacher', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sourceid',
            'teacherid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
