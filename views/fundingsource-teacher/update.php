<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FundingsourceTeacher */

$this->title = 'Update Fundingsource Teacher: ' . $model->sourceid;
$this->params['breadcrumbs'][] = ['label' => 'Fundingsource Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sourceid, 'url' => ['view', 'sourceid' => $model->sourceid, 'teacherid' => $model->teacherid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fundingsource-teacher-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
