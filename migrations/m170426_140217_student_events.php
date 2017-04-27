<?php

use yii\db\Migration;

class m170426_140217_student_events extends Migration
{
    public function up()
    {

        $this->createTable(
            'student_events',
            [
                'studentid' => 'integer',
                'eventsid' => 'integer',
                'PRIMARY KEY(studentid, eventsid)',
             
            ],
            'ENGINE=InnoDB'
        );

         $this->addForeignKey(
            'fk-student_events-studentid',// This is the fk => the table where i want the fk will be
            'student_events',// son table
            'studentid', // son pk	
            'student', // father table
            'id', // father pk
            'CASCADE'
        );	

       $this->addForeignKey(
            'fk-student_events-eventsid',// This is the fk => the table where i want the fk will be
            'student_events',// son table
            'eventsid', // son pk	
            'events', // father table
            'id', // father pk
            'CASCADE'
        );	


    }

    public function down()
    {
         $this->dropTable('student_events');

        
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction.
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170426_140217_student_events cannot be reverted.\n";

        return false;
    }
    */
}
