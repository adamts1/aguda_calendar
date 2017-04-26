<?php

use yii\db\Migration;

class m170419_131545_alter_events extends Migration
{
    public function up()
    {

       $this->addColumn('events','centerid','integer', 'NOT  NULL');

       $this->addForeignKey(
            'fk-events-centerid',// This is the fk => the table where i want the fk will be
            'events',// son table
            'centerid', // son pk	
            'center', // father table
            'id', // father pk
            'CASCADE'
        );	

    }

    public function down()
    {

     $this->dropColumn('events', 'centerid');

    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction.
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170419_131545_alter_events cannot be reverted.\n";

        return false;
    }
    */
}
