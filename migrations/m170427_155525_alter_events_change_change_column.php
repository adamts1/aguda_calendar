<?php

use yii\db\Migration;

class m170427_155525_alter_events_change_change_column extends Migration
{
    public function up()
    {
             $this->dropIndex('events','teacherId');

            



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
        echo "m170427_155525_alter_events_change_change_column cannot be reverted.\n";

        return false;
    }
    */
}
