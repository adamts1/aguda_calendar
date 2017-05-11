<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use miloschuman\highcharts\Highmaps;
use yii\web\JsExpression;



/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-view">

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
            'centerid',
            'name',
            'lastname',
            'grade',
        ],
    ]) ?>

    
<?php $this->registerJsFile('http://code.highcharts.com/mapdata/countries/de/de-all.js', [
    'depends' => 'miloschuman\highcharts\HighchartsAsset'
]);

echo Highmaps::widget([
    'options' => [
        'title' => [
            'text' => 'Highmaps basic demo',
        ],
        'mapNavigation' => [
            'enabled' => true,
            'buttonOptions' => [
                'verticalAlign' => 'bottom',
            ]
        ],
        'colorAxis' => [
            'min' => 0,
        ],
        'series' => [
            [
                'data' => [
                    ['hc-key' => 'de-ni', 'value' => 0],
                    ['hc-key' => 'de-hb', 'value' => 1],
                    ['hc-key' => 'de-sh', 'value' => 2],
                    ['hc-key' => 'de-be', 'value' => 3],
                    ['hc-key' => 'de-mv', 'value' => 4],
                    ['hc-key' => 'de-hh', 'value' => 5],
                    ['hc-key' => 'de-rp', 'value' => 6],
                    ['hc-key' => 'de-sl', 'value' => 7],
                    ['hc-key' => 'de-by', 'value' => 8],
                    ['hc-key' => 'de-th', 'value' => 9],
                    ['hc-key' => 'de-st', 'value' => 10],
                    ['hc-key' => 'de-sn', 'value' => 11],
                    ['hc-key' => 'de-br', 'value' => 12],
                    ['hc-key' => 'de-nw', 'value' => 13],
                    ['hc-key' => 'de-bw', 'value' => 14],
                    ['hc-key' => 'de-he', 'value' => 15],
                ],
                'mapData' => new JsExpression('Highcharts.maps["countries/de/de-all"]'),
                'joinBy' => 'hc-key',
                'name' => 'Random data',
                'states' => [
                    'hover' => [
                        'color' => '#BADA55',
                    ]
                ],
                'dataLabels' => [
                    'enabled' => true,
                    'format' => '{point.name}',
                ]
            ]
        ]
    ]
]);
?>

   

</div>
