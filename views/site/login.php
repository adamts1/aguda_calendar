<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'התחברות';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>נא למלא את השדות הבאים כדי להתחבר :</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>


        <!-----------------------------------------   Show password   --------------------->
		<?= $form->field($model, 'password')->passwordInput() ?> &nbsp;
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  <!------- space ---> 
		<div class="checkbox-1">
            <?= Html::checkbox('reveal-password', false, ['id' => 'reveal-password']) ?> <?= Html::label('ראה סיסמא', 'reveal-password') ?>
            <br>
            <?php 
            $this->registerJs("jQuery('#reveal-password').change(function(){jQuery('#loginform-password').attr('type',this.checked?'text':'password');})");
            ?>
        </div>
		<!--------------------------------------------------------------------------------->		
        <div class="checkbox-1">
            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"\">{input} {label}</div>\n<div class=\"\">{error}</div>",
                'label'=>"<b>זכור אותי</b>",
            ]) ?>
        </div>

        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-9">
                <?= Html::submitButton('התחברות', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    <div class="col-lg-offset-1" style="color:#999;">
        
    </div>
</div>
