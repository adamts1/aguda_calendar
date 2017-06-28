<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;    
use kartik\widgets\Select2;
use app\models\Course;
use yii\widgets\ListView;
use yii\grid\GridView;
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
        <?php if (Yii::$app->user->identity->userRole == 2):?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif;?>

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

           /* [  // Shows all  the courses
                'attribute' => 'מומן ע"י',
                'value' => $model->getSourceOfTeacher(),
              
            ],*/

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
<?php
/////////variable of year////////
 $submittedValue = "2017";
        $value0 = "2017";
        $value1 = "2018";
        $value2 = "2019";
        $value3 = "2020";
        if (isset($_POST["FruitList"])) {
            $submittedValue = $_POST["FruitList"];
        }else{


                        $submittedValue = '2017';

        }

        ?>
        <!--/////////dropdownlist of year////////-->
   <form action="" name="fruits" method="post"> 
   <h3> שעות מורה לפי שנה</h3> 
         <select project="FruitList" id="FruitList" name="FruitList" class="btn btn-primary" value='$_POST["FruitList"]'>
         <option value = "<?php echo $value0; ?>"<?php echo ($value0 == $submittedValue)?" SELECTED":""?>><?php echo $value0; ?></option>
         <option value = "<?php echo $value1; ?>"<?php echo ($value1 == $submittedValue)?" SELECTED":""?>><?php echo $value1; ?></option>
         <option value = "<?php echo $value2; ?>"<?php echo ($value2 == $submittedValue)?" SELECTED":""?>><?php echo $value2; ?></option>
         <option value = "<?php echo $value3; ?>"<?php echo ($value3 == $submittedValue)?" SELECTED":""?>><?php echo $value3; ?></option>
         
        </select>
        <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" value=' $submittedValue' />
        <!--//////necessary for yii//////////-->
        <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary" />
        <!--////////////////-->
        </form>

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

/////////add conition for filtring by year $submittedValue-%///

$sql = " SELECT DATE_FORMAT(start, '%Y-%M' )  as start , SUM(TIMESTAMPDIFF(MINUTE , start ,end)/60) as hours, teacherid   FROM events
 JOIN teacher ON events.teacherid =teacher.id
 JOIN user ON teacher.id = user.id
 WHERE start LIKE '$submittedValue-%' 
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

/////////add conition for filtring by year $submittedValue-% in drill down//

$main = json_encode($main_data);

    $sql = "select month(e.start) as monthdrill 
    ,SUM(TIMESTAMPDIFF(MINUTE , e.start ,e.end)/60) as total

    ,SUM(TIMESTAMPDIFF(MINUTE , e1.start ,e1.end)/60) as first
    ,SUM(TIMESTAMPDIFF(MINUTE , e2.start ,e2.end)/60)  as sec
    ,SUM(TIMESTAMPDIFF(MINUTE , e3.start ,e3.end)/60)  as third
    ,SUM(TIMESTAMPDIFF(MINUTE , e4.start ,e4.end)/60)  as four
    ,SUM(TIMESTAMPDIFF(MINUTE , e5.start ,e5.end)/60)  as five

    from events e
    left join events e1 on e.start = e1.start and FLOOR((DayOfMonth(e.start)-1)/7)+1 = 1
    left join events e2 on e.start = e2.start and FLOOR((DayOfMonth(e.start)-1)/7)+1 = 2
    left join events e3 on e.start = e3.start and  FLOOR((DayOfMonth(e.start)-1)/7)+1 = 3
    left join events e4 on e.start = e4.start and  FLOOR((DayOfMonth(e.start)-1)/7)+1 = 4
    left join events e5 on e.start = e5.start and  FLOOR((DayOfMonth(e.start)-1)/7)+1 = 5
           WHERE e.teacherid = '$model->id' 

    AND e.start LIKE '$submittedValue-%' 


  

    group by month(e.start)";


$rawData = yii::$app->db->createCommand($sql)->queryAll();
$sub_data =[];
foreach ($rawData as $data){
	$sub_data[] =[
	'id' => $data['total'],
	'name' => $data['monthdrill'] *1,
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
        credits: false,
      
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



	
