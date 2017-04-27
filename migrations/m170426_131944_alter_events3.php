<?php

use yii\db\Migration;

class m170426_131944_alter_events3 extends Migration
{
    public function up()
    {

        


      

         $this->addForeignKey(
            'fk-events-locationid',// This is the fk => the table where i want the fk will be
            'events',// son table
            'locationid', // son pk	
            'location', // father table
            'id', // father pk
            'CASCADE'
        );	


         $this->addForeignKey(
            'fk-events-teacherId',// This is the fk => the table where i want the fk will be
            'events',// son table
            'teacherId', // son pk	
            'teacher', // father table
            'id', // father pk
            'CASCADE'
        );	        

    }

    public function down()
    {
       
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction.
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170426_131944_alter_events3 cannot be reverted.\n";

        return false;
    }
    */
}
