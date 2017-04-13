<?php

use yii\db\Migration;

class m170413_190356_alter_course_center extends Migration
{
   public function up()
    {

        $this->createTable(
            'course_center',
            [
                'courseid' => 'integer',
                'centerid' => 'integer',
                'PRIMARY KEY(courseid, centerid)',
             
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


         $this->dropForeignKey(
            'fk-course_center-courseid',
            'course_center');
    

        $this->dropForeignKey(
            'fk-course_center-centerid',
            'course_center');

         $this->dropTable('course_center');



    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction.
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170413_190356_alter_course_center cannot be reverted.\n";

        return false;
    }
    */
}
