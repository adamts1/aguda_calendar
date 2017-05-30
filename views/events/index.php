<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Events';
?>

<style>
                     /* Iframe calendar style */
	.calendar{	
	/*float: center;*/
    /*margin: 0px 0px 0px 0x;*/
    padding: 0px 0px 0px 0px;
    width: 100%;
    height: 1100px;
    border: 0px solid black;
     	
	}
</style>     

<div class="events-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
  <!-- display calendar-->
    <iframe class="calendar" src="http://localhost/a_p/Fullcalendar"></iframe>
</div>
</body>

