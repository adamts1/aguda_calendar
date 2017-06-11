<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Center */

$this->title = 'יצירת מרכז ';
$this->params['breadcrumbs'][] = ['label' => 'מרכזים', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="center-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
