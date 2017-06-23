<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'הוספת רכז כללי';
$this->params['breadcrumbs'][] = ['label' => 'רכז כללי', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
       // 'teacher' => $teacher,
    ]) ?>

</div>
