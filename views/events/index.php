<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Events';
?>

<div class="events-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
  <!-- display calendar-->
    <iframe class="calendar" src="http://localhost/a_p/Fullcalendar"></iframe>
</div>
</body>

