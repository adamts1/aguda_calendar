<?php

use yii\db\Migration;

class m170129_164414_alter_supervisor extends Migration
{
    public function up()
    {
      $this->addForeignKey(
            'fk-supervisor-id',// This is the fk => the table where i want the fk will be
            'supervisor',// son table
            'id', // son pk	
            'user', // father table
            'id', // father pk
            'CASCADE'
        );

    }

    public function down()
    {
        // drops foreign key for table `teacher`
        $this->dropForeignKey(
            'fk-supervisor-id',
            'supervisor'
        );
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
