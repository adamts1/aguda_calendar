<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'עובדים', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
           // 'password',
           // 'auth_key',
            'firstname',
            'lastname',
            'email:email',
            'phone',
            'address',
            //'notes:ntext',
            //'status',
            'created_at:datetime',//shows date time instead integer
            'updated_at:datetime',//shows date time instead integer
            'created_by',

            // [  // Shows all  the courses
            //     'attribute' => 'created_by',
            //     'value' => $model->fullName,
              
            // ],

            'updated_by',
            'userRole',
        ],
    ]) ?>

</div>
