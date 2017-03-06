<?php


use yii\db\Migration;

class m170201_110754_student_teacher extends Migration
{
    public function up()
    {

        $this->createTable(
            'student_teacher',
            [
                'teacherid' => 'integer',
                'studentid' => 'integer'
             
            ],
            'ENGINE=InnoDB'
        );

         $this->addForeignKey(
            'fk-student_teacher-teacherid',// This is the fk => the table where i want the fk will be
            'student_teacher',// son table
            'teacherid', // son pk	
            'teacher', // father table
            'id', // father pk
            'CASCADE'
        );	

        $this->addForeignKey(
            'fk-student_teacher-studentid',// This is the fk => the table where i want the fk will be
            'student_teacher',// son table
            'studentid', // son pk	
            'student', // father table
            'id', // father pk
            'CASCADE'
        );	


    }

    public function down()
    {
         $this->dropTable('student_teacher');

         $this->dropForeignKey(
            'fk-student_teacher-studentid',
            'student_teacher');
    

        $this->dropForeignKey(
            'fk-student_teacher-teacherid',
            'student_teacher');
    }

  
}
