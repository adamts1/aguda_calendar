<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
 <div class="alert alert-success alert-dismissable">
 <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
 <h4><i class="icon fa fa-check"></i>Saved!</h4>
 <?= Yii::$app->session->getFlash('success') ?>
 </div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('error')): ?>
 <div class="alert alert-error alert-dismissable">
 <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
 <h4><i class="icon fa fa-check"></i>Not Saved!</h4>
 <?= Yii::$app->session->getFlash('error') ?>
 </div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('emailSend')): ?>
 <div class="alert alert-success alert-dismissable">
 <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
 <h4><i class="icon fa fa-check"></i>! Email Send</h4>
 </div>
<?php endif; ?>
<div class="site-index">
    <?php if (!empty(Yii::$app->user->identity->id)):
     //print_r(Yii::$app->user->identity->id);
     endif;?>
    <div class="site-index-header"><h1>אגודה לקידום החינוך</h1></div>
    <div class="header-img">
        <div class="header-button-index">
            <a href="/a_p/web/teacher">
                <button type="button" class="btn" >מנהל</button>     
            </a>
            <a href="/a_p/web/supervisor">            
                <button type="button" class="btn">רכז</button>
            </a>
            <a href="/a_p/web/teacher">
                <button type="button" class="btn">מורה</button>
            </a>
        </div>
    </div>


    <!--<div class="jumbotron centered">
        <p class="lead"></p>
    </div>-->

    <div class="body-content">
      <!--  <img src="http://www.kidum-edu.org.il/wp-content/uploads/2016/08/lr-5243.jpg" class="img-site-homepage img-responsive"></img>-->


    </div>
</div>
