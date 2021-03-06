<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        //Html::img('/images/Logo-80.png')
        'brandLabel' =>'',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if ( !Yii::$app->user->isGuest ):
     if (Yii::$app->user->identity->userRole == 2):
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            /*['label' => 'תלמידים', 'url' => ['/student']],
            ['label' => 'קורסים', 'url' => ['/course']],
            ['label' => 'מורים', 'url' => ['/teacher']],
            ['label' => 'כיתות', 'url' => ['/location']],
            ['label' => 'מרכזים', 'url' => ['/center']],
            ['label' => 'אירועים', 'url' => ['/event']],
            ['label' => 'רכזים', 'url' => ['/supervisor']],
            ['label' => 'מקור מימון', 'url' => ['/funding-source']],*/
            ['label' => 'הפרופיל שלי', 'url' => ['/supervisor/view?id='.Yii::$app->user->identity->id]],
            ['label' => 'שיבוצים', 'url' => ['/event']],
            [
            'label' => 'ניהול משאבים',
                'items' => [
                    ['label' =>  'מקור מימון', 'url' => ['/funding-source']],
                    '<li class="divider"></li>',
                    ['label' => 'כיתות', 'url' => ['/location']],
                    '<li class="divider"></li>',
                    ['label' => 'קורסים', 'url' => ['/course']],
                    '<li class="divider"></li>',
                    ['label' => 'תלמידים', 'url' => ['/student']],
                ],
            ],
            [
            'label' => 'ניהול משתמשים',
                'items' => [
                    ['label' => 'מורים', 'url' => ['/teacher']],
                    '<li class="divider"></li>',
                     ['label' => 'רכזים', 'url' => ['/supervisor']],
                ],
            ],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    ' ( התנתקות )  ' . Yii::$app->user->identity->username ,
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    elseif(Yii::$app->user->identity->userRole == 3):
     echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
             ['label' => 'הפרופיל שלי', 'url' => ['/user/view?id='.Yii::$app->user->identity->id]],
            ['label' => 'שיבוצים', 'url' => ['/event']],
            [
            'label' => 'ניהול משאבים',
                'items' => [
                    ['label' =>  'מקור מימון', 'url' => ['/funding-source']],
                    '<li class="divider"></li>',
                    ['label' => 'כיתות', 'url' => ['/location']],
                    '<li class="divider"></li>',
                    ['label' => 'קורסים', 'url' => ['/course']],
                    '<li class="divider"></li>',
                    ['label' => 'תלמידים', 'url' => ['/student']],
                    '<li class="divider"></li>',
                    ['label' => 'מרכזים', 'url' => ['/center']],
                ],
            ],
            [
            'label' => 'ניהול משתמשים',
                'items' => [
                    ['label' => 'מורים', 'url' => ['/teacher']],
                    '<li class="divider"></li>',
                     ['label' => 'רכזים', 'url' => ['/supervisor']],
                ],
            ],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout )' . Yii::$app->user->identity->username . '    )',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    elseif(Yii::$app->user->identity->userRole == 1):
         echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
             ['label' => 'הפרופיל שלי', 'url' => ['/teacher/view?id='.Yii::$app->user->identity->id]],
             ['label' => 'שיבוצים', 'url' => ['/events']],
               Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout )' . Yii::$app->user->identity->username . '    )',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
                 ],
                 
    ]);
    NavBar::end();
    endif;
    endif;
    ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Adam Tsityat & Laury Aziza <?= date('Y') ?></p>

        <p class="pull-right"><?//= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>