<?php

use yii\db\Migration;

class m170530_160850_alter_events_stringstudents extends Migration
{
    public function up()
    {

         $this->addColumn('events','studentstring','string'); 

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
        echo "m170530_160850_alter_events_stringstudents cannot be reverted.\n";

        return false;
    }
    */
}
