<?php

use yii\db\Migration;

class m170616_115711_alter_events_lacationstring extends Migration
{
    public function up()
    {

        $this->addColumn('events','loctionstring','string'); 

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
        echo "m170616_115711_alter_events_lacationstring cannot be reverted.\n";

        return false;
    }
    */
}
