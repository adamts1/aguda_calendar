<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FundingsourceTeacher */

$this->title = $model->sourceid;
$this->params['breadcrumbs'][] = ['label' => 'Fundingsource Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fundingsource-teacher-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'sourceid' => $model->sourceid, 'teacherid' => $model->teacherid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'sourceid' => $model->sourceid, 'teacherid' => $model->teacherid], [
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
            'sourceid',
            'teacherid',
            'numberOfHours',
        ],
    ]) ?>

</div>
