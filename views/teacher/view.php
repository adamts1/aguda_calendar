<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;    
use kartik\widgets\Select2;
use app\models\Course;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */

$this->title = $model->id0->userName;
$this->params['breadcrumbs'][] = ['label' => 'Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-view">

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

<!--////////teacher-chart/////////-->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'courseTeachers.courseid',
             [  // Shows all  the courses
                'attribute' => 'מלמד קורסים',
                'value' => $model->getCoursesOfTeacher(),
              
            ],

            [  // Shows all  the courses
                'attribute' => 'מומן ע"י',
                'value' => $model->getSourceOfTeacher(),
              
            ],

             [  // Shows all  the courses
                'attribute' => 'שם ושם משפחה',
                'value' => $model->id0->fullName,
              
            ],

            
            
        //    'subject',
           // 'centerid',
                [ // the name of supervisor from user
				'label' => $model->attributeLabels()['centerid'],
				'format' => 'html',
				'value' => Html::a($model->center->centername, 
					['center/view', 'id' => $model->center->id]),	
			    ],  

                              

        ],


    ]) ?>

</div>
<div style="display: none">
	<?php
		echo Highcharts::widget([
		'scripts' => [
			'highcharts-more',
			//'themes/grid',
			'highcharts-3d',
			'modules/drilldown'
		]
			
	]);
	?>	
</div>


<div id="chart"></div>


<?php


$sql = "SELECT DATE_FORMAT(start, '%M') as start, SUM(TIMESTAMPDIFF(MINUTE , start ,end)/60) as hours, teacherid   FROM events
 JOIN teacher ON events.teacherid =teacher.id
 JOIN user ON teacher.id = user.id
 WHERE start LIKE '2017-%' 
 AND teacherid = '$model->id'
 GROUP BY DATE_FORMAT(start, '%m')";
$rawData = yii::$app->db->createCommand($sql)->queryAll();
$main_data =[];
foreach ($rawData as $data){
	$main_data[] =[
	'name'=>$data['start'],
	'y' => $data['hours'] *1,
	'drilldown' => $data ['hours']
	];	
}


$main = json_encode($main_data);

    $sql = "select month(g.start) as ghh 
    ,SUM(TIMESTAMPDIFF(MINUTE , g.start ,g.end)/60) as total

    ,SUM(TIMESTAMPDIFF(MINUTE , g1.start ,g1.end)/60) as first
    ,SUM(TIMESTAMPDIFF(MINUTE , g2.start ,g2.end)/60)  as sec
    ,SUM(TIMESTAMPDIFF(MINUTE , g3.start ,g3.end)/60)  as third
    ,SUM(TIMESTAMPDIFF(MINUTE , g4.start ,g4.end)/60)  as four
    ,SUM(TIMESTAMPDIFF(MINUTE , g5.start ,g5.end)/60)  as five

    from events g
    left join events g1 on g.start = g1.start and FLOOR((DayOfMonth(g.start)-1)/7)+1 = 1
    left join events g2 on g.start = g2.start and FLOOR((DayOfMonth(g.start)-1)/7)+1 = 2
    left join events g3 on g.start = g3.start and  FLOOR((DayOfMonth(g.start)-1)/7)+1 = 3
    left join events g4 on g.start = g4.start and  FLOOR((DayOfMonth(g.start)-1)/7)+1 = 4
    left join events g5 on g.start = g5.start and  FLOOR((DayOfMonth(g.start)-1)/7)+1 = 5
    

  

    group by month(g.start)";


$rawData = yii::$app->db->createCommand($sql)->queryAll();
$sub_data =[];
foreach ($rawData as $data){
	$sub_data[] =[
	'id' => $data['total'],
	'name' => $data['ghh'] *1,
	'data' => [['שבוע ראשון',$data['first']*1],['שבוע שני',$data['sec']*1],['שבוע שלישי',$data['third']*1],['שבוע רביעי',$data['four']*1],['שבוע חמישי',$data['five']*1]
	]];	
}


$sub = json_encode($sub_data);










?>




<?php	
	
	 $this->registerJs("$(function () {
    // Create the chart
    $('#chart').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'דוח שעות'
        },
      
        xAxis: {
            type: 'category',
			        useHTML: Highcharts.hasBidiBug,
					useHTML:true

			
        },
        yAxis: {
            title: {
                text: ' כמות שעות',
				  useHTML: Highcharts.hasBidiBug,
				  useHTML:true
				  },
				  


        },
		labels: {
				useHTML: Highcharts.hasBidiBug,
				useHTML:true
				},
        legend: {
            enabled: true,
			useHTML:true
        },
		tooltip: {
        useHTML: true
    },
        plotOptions: {
            series: {
				
                borderWidth: 0,
				useHTML:true,

			
				
                dataLabels: {
                    enabled: true,
					useHTML: Highcharts.hasBidiBug,
					            useHTML:true,

                    format: '{point.y}'
                }
            }
			
        },

       

        series: [{
            name: 'חודשים',
            colorByPoint: true,
		 useHTML: Highcharts.hasBidiBug,
		 
		
				
            data: $main,
			useHTML:true

        		
        }],

          drilldown: {
            series: $sub,
			useHTML:true,
        
		}
    });
});");



	?>
