<?php

use yii\db\Migration;

class m170428_125803_alter_events_foreigen_keys extends Migration
{
    public function up()
    {

         $this->addForeignKey(
            'fk-events-courseid',// This is the fk => the table where i want the fk will be
            'events',// son table
            'courseid', // son pk	
            'course', // father table
            'id', // father pk
            'CASCADE'
        );	


        //  $this->addForeignKey(
        //     'fk-events-teacherid',// This is the fk => the table where i want the fk will be
        //     'events',// son table
        //     'teacherid', // son pk	
        //     'teacher', // father table
        //     'id', // father pk
        //     'CASCADE'
        // );	     


    }

    public function down()
    {
             $this->dropColumn('events', 'teacherid');

    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction.
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170428_125803_alter_events_foreigen_keys cannot be reverted.\n";

        return false;
    }
    */
}
