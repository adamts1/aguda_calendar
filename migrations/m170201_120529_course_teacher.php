<?php

use yii\db\Migration;

class m170201_120529_course_teacher extends Migration
{
    public function up()
    {

        $this->createTable(
            'course_teacher',
            [
                'courseid' => 'integer',
                'teacherid' => 'integer'
             
            ],
            'ENGINE=InnoDB'
        );

         $this->addForeignKey(
            'fk-course_teacher-courseid',// This is the fk => the table where i want the fk will be
            'course_teacher',// son table
            'courseid', // son pk	
            'course', // father table
            'id', // father pk
            'CASCADE'
        );	

       $this->addForeignKey(
            'fk-course_teacher-teacherid',// This is the fk => the table where i want the fk will be
            'course_teacher',// son table
            'teacherid', // son pk	
            'teacher', // father table
            'id', // father pk
            'CASCADE'
        );


    }

    public function down()
    {
         $this->dropTable('course_teacher');

        
    }
}
