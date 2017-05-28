<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Teacher */

$this->title = 'הוספת מורה';
$this->params['breadcrumbs'][] = ['label' => 'מורים', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="main.js"></script>
<script>    
    console.log('laury');
</script>

<div class="teacher-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'user' => $user,
        'course' => $course,
        'fundingsource' => $fundingsource,
        'roles' => $roles,

        
      
    ]) ?>

</div>
