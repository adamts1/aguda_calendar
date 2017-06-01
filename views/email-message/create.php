<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EmailMessage */

$this->title = Yii::t('app', 'Create Email Message');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Email Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-message-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
