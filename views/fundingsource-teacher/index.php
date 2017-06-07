<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use app\models\FundingSource;
use app\models\FundingsourceTeacher;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FundingsourceTeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fundingsource Teachers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fundingsource-teacher-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Fundingsource Teacher', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<body>

<div class="container">       
  <table class="table table-striped">
    <thead>
      <tr>
        <th>מקור מימון</th>
        <th>מורה</th>
        <th>פירוט שעות לפי מורה</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($fundingSource as $fs): ?>
      <tr>
        <td><?= $fs->sourcename; ?></td>
        <?php $fundingSourceTeachers = FundingSourceTeacher::find()->where(['sourceid'=>$fs->id])->all();?>
        <td>
            <?php foreach ($fundingSourceTeachers as $fundingSourceTeachers): ?>
                <?php $fundingSourceTeachersNames = User::find()->where(['id'=>$fundingSourceTeachers->teacherid])->all();?>
                <?php foreach ($fundingSourceTeachersNames as $fundingSourceTeachersName): ?>
                    <?php  print_r($fundingSourceTeachersName->firstname);?>
                    <?php  print_r($fundingSourceTeachersName->username);?>
                    <?php  print_r('</br>');?>
                <?php endforeach;?>
            <?php endforeach;?>
        </td>
        <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?=$fs->id?>" data-id="<?= $fs->id;?>"><?= $fs->sourcename; ?></button></td>
      </tr>

      <!-- Modal -->
<div class="modal fade" id="myModal<?=$fs->id?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
        
             <?php $fundingSourceTeachers = FundingSourceTeacher::find()->where(['sourceid'=>$fs->id])->all();?>
             
             <div class="modal-title-area">
                 <div class="modal-info-teacher-title">מורים</div>
                 <div class="modal-info-hours-title">שעות ממומנות ע"י מקור מימון זה </div>
             </div>
              <?php foreach ($fundingSourceTeachers as $fundingSourceTeachers): ?>
              <div class="modal-row">
                <?php $fundingSourceTeachersNames = User::find()->where(['id'=>$fundingSourceTeachers->teacherid])->all();?>
                <?php foreach ($fundingSourceTeachersNames as $fundingSourceTeachersName): ?>
                    <div class="modal-info-teacher-name">
                        <?php  print_r($fundingSourceTeachersName->firstname);?>
                        <?php  print_r($fundingSourceTeachersName->username);?>
                        <?php  print_r('</br>');?>
                    </div>
                    <div class="modal-info-teacher-hours">
                        <?php $sitFinal = 0;
                        $numOfHours = FundingsourceTeacher::find()->where(['sourceid'=>$fs->id ,'teacherid'=>$fundingSourceTeachersName->id ])->one();?>
                        <?= $numOfHours->numberOfHours; ?>
                    </div>
                <?php endforeach;?>
            </div>
            <?php endforeach;?>
            <div class="modal-row">
              <div class="modal-info-teacher-name">
                  סה"כ"
              </div>
              <div class="modal-info-teacher-hours">
                <?php $fundingSourceHours = FundingsourceTeacher::find()->where(['sourceid'=>$fs->id])->all(); 
                $totalHours = 0;
                foreach ($fundingSourceHours as $fundingSourceHour):
                  $totalHours = $totalHours + $fundingSourceHour->numberOfHours;
                  
                endforeach;
                print_r($totalHours);
                ?>
              </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

      <?php endforeach;?>
    </tbody>
  </table>
</div>


  
</div>
</body>

</div>
