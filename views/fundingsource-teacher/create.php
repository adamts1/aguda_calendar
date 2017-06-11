<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FundingsourceTeacher */

$this->title = ' יצירת מקורות מימון לפי מורה ';
$this->params['breadcrumbs'][] = ['label' => 'מקורות מימון לפי מורה', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fundingsource-teacher-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
