<?php

namespace app\models;

use Yii;
use arogachev\ManyToMany\behaviors\ManyToManyBehavior;
use arogachev\ManyToMany\validators\ManyToManyValidator;
use app\models\Course;
use app\models\FundingSource;
use yii\helpers\ArrayHelper;  
/**
 * This is the model class for table "teacher".
 *
 * @property integer $id
 * @property string $subject
 * @property integer $centerid
 *
 * @property CourseTeacher[] $courseTeachers
 * @property Event[] $events
 * @property FundingsourceTeacher[] $fundingsourceTeachers
 * @property Group[] $groups
 * @property StudentTeacher[] $studentTeachers
 * @property Center $center
 * @property User $id0
 */
class Teacher extends \yii\db\ActiveRecord
{
      public $editableUsers = [];  // many to many
      public $role; 
    
    public static function tableName()
    {
        return 'teacher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['centerid'], 'integer'],
            [['subject'], 'string', 'max' => 255],
            ['role', 'safe'],
            [['centerid'], 'exist', 'skipOnError' => true, 'targetClass' => Center::className(), 'targetAttribute' => ['centerid' => 'id']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

//     public function behaviors()
// {
//     return [
//         [
//             'class' => ManyToManyBehavior::className(),

            
//             'relations' => [
//                 [
//                     'editableAttribute' => 'editableUsers', // Editable attribute name
//                     'table' => 'course_teacher', // Name of the junction table
//                     'ownAttribute' => 'teacherid', // Name of the column in junction table that represents current model
//                     'relatedModel' => Course::className(), // Related model class
//                     'relatedAttribute' => 'courseid', // Name of the column in junction table that represents related model
//                 ],
//             ],
//         ],
//     ];
// }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject' => 'מקצוע',
            'centerid' => 'מרכז',
            'user' => 'שם ושם משפחה',
            'role'  => 'User role',
        ];
    }

    

  

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseTeachers()
    {
        return $this->hasMany(CourseTeacher::className(), ['teacherid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    // public function getCoursesViaTable()
    // {
    //     return $this->hasMany(Course::className(), ['id' => 'courseid'])
    //         ->viaTable('course_teacher', ['teacherid' => 'id']);
    // }

   
     
     /**
     * @return \yii\db\ActiveQuery
     */
    // public function getCoursesViaRelation()
    // {
    //     return $this->hasMany(Courses::className(), ['id' => 'courseid'])
    //         ->via('CourseTeacher');
    // }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['teacherid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFundingsourceTeachers()
    {
        return $this->hasMany(FundingsourceTeacher::className(), ['teacherid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['teacherid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentTeachers()
    {
        return $this->hasMany(StudentTeacher::className(), ['teacherid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCenter()
    {
        return $this->hasOne(Center::className(), ['id' => 'centerid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }

    public static function getCoursesTeacher0() //bring all the courses in all organization
    {
         $courses =  ArrayHelper::map(Course::find()->all(),'id','coursename');
        return $courses;                       
    }

     public static function getCourseByCenter()  //provide courses according to center supervisor
	{
		$coursebycenter = (new \yii\db\Query())
           ->select(['course.id','course.coursename'])
           ->from('course')
           ->join(' JOIN','course_center','course_center.courseid=course.id')
           ->join('JOIN','center','course_center.centerid=center.id')
           ->join(' JOIN','supervisor','center.id=supervisor.centerId')
           ->where(['supervisor.id' => Yii::$app->user->identity->id])
           ->limit(50)
           ->all();
		$allcoursebycenter = ArrayHelper::
					map($coursebycenter, 'id', 'coursename');
		return $allcoursebycenter;						
	}

     public static function getCoursesCenterTeacher()  //provide courses according to teacher
	{
		$coursebyTeacher = (new \yii\db\Query())
           ->select(['course.id','course.coursename'])
           ->from('course')
           ->join(' JOIN','course_center','course_center.courseid=course.id')
           ->join('JOIN','center','course_center.centerid=center.id')
           ->join(' JOIN','teacher','center.id=teacher.centerId')
           ->where(['teacher.id' => Yii::$app->user->identity->id])
           ->limit(50)
           ->all();
		$allcoursebyTeacher = ArrayHelper::
					map($coursebyTeacher, 'id', 'coursename');
		return $allcoursebyTeacher;						
	}

    public static function getFundinSourceTeacher()
   {
         $fundingsource =  ArrayHelper::map(FundingSource::find()->all(),'id', 'sourcename');
         return $fundingsource;                       
     }

     public function afterSave($insert,$changedAttributes)
    {
        $return = parent::afterSave($insert, $changedAttributes);

        $auth = Yii::$app->authManager;
		$roleName = $this->role; 
		$role = $auth->getRole($roleName);
		if (\Yii::$app->authManager->getRolesByUser($this->id) == null){
			$auth->assign($role, $this->id);
		} else {
			$db = \Yii::$app->db;
			$db->createCommand()->delete('auth_assignment',
				['user_id' => $this->id])->execute();
			$auth->assign($role, $this->id);
		}

        return $return;
    }

    public static function getInitCourses($id) //This function get courseId and return an array of the existing users on this activity
    {
        $coursesteacher = ArrayHelper::map(CourseTeacher::find()
        ->where(['teacherid'=>$id])->all(),'courseid', 'courseid');
        return $coursesteacher;
    }

   


    public static function getInitFunding($id) //This function get fundingId and return an array of the existing users on this activity
    {
        $fundingsourceteacher = ArrayHelper::map(FundingsourceTeacher::find()
        ->where(['teacherid'=>$id])->all(),'sourceid', 'sourceid');
        return $fundingsourceteacher;
    }

    public function getCoursesOfTeacher() //import all the courses of one teacher used in teacher/view
    {
    $course = [];
    foreach($this->courseTeachers as $id) {
        $course[] = $id->course->courseName;
    }
    return implode("\n,", $course);
    }

    public function getSourceOfTeacher() //import all the source of one teacher used in teacher/view
    {
    $source = [];
    foreach($this->fundingsourceTeachers as $id) {
        $source[] = $id->source->fundingSourceName;
    }
    return implode("\n,", $source);
    }

    public function getUserole()
    {
		$roleArray = Yii::$app->authManager->
					getRolesByUser($this->id);
		$role = array_keys($roleArray)[0];				
		return	$role;
    }

    public static function getRoles()
	{
		$rolesObjects = Yii::$app->authManager->getRoles();
		$roles = [];
		foreach($rolesObjects as $id =>$rolObj){
			$roles[$id] = $rolObj->name; 
		}
		return $roles; 	
	}
    public static function getAllTeachers()
    {
        $allTeachers = (new \yii\db\Query())
           ->select(['*'])
           ->from('teacher')
           ->all();
		return $allTeachers;	
    }

    public static function getAllTeachersByCenter()
    {

        $centerQuery = (new \yii\db\Query())
        ->select('C2.id')
        ->from('center C2')
        ->join('JOIN','teacher T','C2.id=T.centerid')
        ->where(['T.id' => Yii::$app->user->identity->id]);

        $allTeachersByCenter = (new \yii\db\Query())
           ->select(['U.id','U.username'])
           ->from('user U')
           ->join('JOIN','teacher T','U.id=T.id')
           ->join('JOIN','center C','T.centerid=C.id')
           ->where(['C.id' => $centerQuery])
           ->limit(50)
           ->all();

		$allTeachersByCenterArray = ArrayHelper::
					map($allTeachersByCenter, 'id', 'username');
		return $allTeachersByCenterArray;	
    }

    //   public static function getStudentByTeacher()  //provide courses according to center supervisor
	// {
	// 	$studentByTeacher = (new \yii\db\Query())
    //        ->select(['course.id','course.coursename'])
    //        ->from('course')
    //        ->join(' JOIN','course_center','course_center.courseid=course.id')
    //        ->join('JOIN','center','course_center.centerid=center.id')
    //        ->join(' JOIN','supervisor','center.id=supervisor.centerId')
    //        ->where(['supervisor.id' => Yii::$app->user->identity->id])
    //        ->limit(50)
    //        ->all();
	// 	$allstudentByTeacher = ArrayHelper::
	// 				map($studentByTeacher, 'id', 'coursename');
	// 	return $allcoursebycenter;						
	// }

   

    
}
