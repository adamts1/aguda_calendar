<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Events';
?>
<style>
	.calendar{
	 	
	margin: 0px 0px 0px 0px;
    padding: 0px 0px 0px 0px;
    width: 250%;
    height: 1500px;
    border: 0px solid black;
     position: fixed;
    right: 50px;
		
	}
</style>         
<div class="events-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
  <!-- display calendar-->
    <iframe class="calendar" src="http://localhost/adam_project/fullcalendar"></iframe>
</div>
</body>

