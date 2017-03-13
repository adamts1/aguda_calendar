<?php

use yii\db\Migration;

class m170201_122002_student_course extends Migration
{
    public function up()
    {

        $this->createTable(
            'student_course',
            [
                'courseid' => 'integer',
                'studentid' => 'integer',
                'PRIMARY KEY(courseid, studentid)',
             
            ],
            'ENGINE=InnoDB'
        );

         $this->addForeignKey(
            'fk-student_course-courseid',// This is the fk => the table where i want the fk will be
            'student_course',// son table
            'courseid', // son pk	
            'course', // father table
            'id', // father pk
            'CASCADE'
        );	

       $this->addForeignKey(
            'fk-student_course-studentid',// This is the fk => the table where i want the fk will be
            'student_course',// son table
            'studentid', // son pk	
            'student', // father table
            'id', // father pk
            'CASCADE'
        );	


    }

    public function down()
    {
         $this->dropTable('student_course');

        
    }
}
