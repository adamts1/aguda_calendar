<?php

use yii\db\Migration;

class m170201_115345_course_center extends Migration
{
    public function up()
    {

        $this->createTable(
            'course_center',
            [
                'courseid' => 'integer',
                'centerid' => 'integer'
             
            ],
            'ENGINE=InnoDB'
        );

         $this->addForeignKey(
            'fk-course_center-courseid',// This is the fk => the table where i want the fk will be
            'course_center',// son table
            'courseid', // son pk	
            'course', // father table
            'id', // father pk
            'CASCADE'
        );	

        $this->addForeignKey(
            'fk-course_center-centerid',// This is the fk => the table where i want the fk will be
            'course_center',// son table
            'centerid', // son pk	
            'center', // father table
            'id', // father pk
            'CASCADE'
        );	


    }

    public function down()
    {
         $this->dropTable('course_center');

         $this->dropForeignKey(
            'fk-course_center-courseid',
            'course_center');
    

        $this->dropForeignKey(
            'fk-course_center-centerid',
            'course_center');
    }
}
