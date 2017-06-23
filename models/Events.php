<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;    
use app\models\StudentEvents;



/**
 * This is the model class for table "events".
 *
 * @property int $id
 * @property string $title
 * @property string $color
 * @property string $start
 * @property string $end
 * @property int $centerid
 * @property int $groupNumber
 * @property int $courseid
 * @property int $teacherid
 * @property int $locationid
 * @property string $studentstring
 * @property int status
 *
 * @property Center $center
 * @property Course $course
 * @property Location $location
 * @property Teacher $teacher
 * @property StudentEvents[] $studentEvents
 * @property Student[] $students
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start', 'end'], 'safe'],
            [['centerid', 'groupNumber', 'courseid', 'teacherid', 'locationid','status'], 'integer'],
            [['title', 'color', 'studentstring'], 'string', 'max' => 255],
            [['centerid'], 'exist', 'skipOnError' => true, 'targetClass' => Center::className(), 'targetAttribute' => ['centerid' => 'id']],
            [['courseid'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['courseid' => 'id']],
            [['locationid'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['locationid' => 'id']],
            [['teacherid'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::className(), 'targetAttribute' => ['teacherid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'מספר שיבוץ',
            'title' => 'תיאור ',
            'color' => 'Color',
            'start' => 'זמן התחלה',
            'end' => 'זמן סיום',
            'centerid' => 'מרכז',
            'groupNumber' => 'Group Number',
            'courseid' => 'מקצוע לימוד',
            'teacherid' => 'מורה מלמד',
            'locationid' => 'כיתת לימוד',
            'studentstring' => 'שמות התלמידים',
            'status'=>'סטטוס',
            'comments'=>'הערות',
        ];
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
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'courseid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'locationid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::className(), ['id' => 'teacherid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentEvents()
    {
        return $this->hasMany(StudentEvents::className(), ['eventsid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::className(), ['id' => 'studentid'])->viaTable('student_events', ['eventsid' => 'id']);
    }


    /////////////////////////////////
 

    public static function getStudentByCenter()  //provide courses according to center supervisor
	{
		$studentbycenter = (new \yii\db\Query())
           ->select(['S.id','S.nickname'])
           ->from('student S')
           ->join('JOIN','center C','S.centerid=C.id')
           ->join(' JOIN','teacher T','C.id=T.centerId')
           ->where(['T.id' => Yii::$app->user->identity->id])
           ->limit(50)
           ->all();
		$allstudentbycenter = ArrayHelper::
					map($studentbycenter, 'id', 'nickname');
		return $allstudentbycenter;						
	}

        public static function getInitStudents($id) //This function get courseId and return an array of the existing users on this activity
    {
        $studentevents = ArrayHelper::map(StudentEvents::find()
        ->where(['eventsid'=>$id])->all(),'studentid', 'studentid');
        return $studentevents;
    }
    
    public function getStudentArray() //import all the courses of one teacher used in teacher/view
    {
        $studentArray = [];
        foreach($this->studentEvents as $id) {
            $studentArray[] = $id->studentArray->name;
        }
        return implode("\n,", $studentArray);
    }
/////////////////////////////////////////

}
