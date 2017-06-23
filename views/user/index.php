<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ניהול עובדים';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <?php if (Yii::$app->user->identity->userRole == 3):?>
        <?= Html::a('הוספת רכז כללי', ['user/create'], ['class' => 'btn btn-success']) ?>
    
        <?= Html::a('הוספת רכז', ['supervisor/create'], ['class' => 'btn btn-info']) ?>
    <?php endif;?>
    <?php if (Yii::$app->user->identity->userRole != 3):?>
        <?= Html::a('הוספת מורה', ['teacher/create'], ['class' => 'btn btn-warning']) ?>
    <?php endif;?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'username',
           // 'password',
            //'auth_key',
            'firstname',
           'lastname',
            //'email:email',
            // 'phone',
            // 'address',
            // 'notes:ntext',
            // 'status',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            //'userRole',

            // [
			// 	'attribute' => 'userRole',
			// 	'label' => 'תפקיד',
			// 	'format' => 'raw',
			// 	'value' => function($model){
			// 		return $model->userRole0->userRoleName;  //Showing role name instead of role number.
			// 	},
				
			// ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
