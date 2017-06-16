<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'הוספת רכז';
$this->params['breadcrumbs'][] = ['label' => 'עובדים', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
       // 'teacher' => $teacher,
    ]) ?>

</div>
