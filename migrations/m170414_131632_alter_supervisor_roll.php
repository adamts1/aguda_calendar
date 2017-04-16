<?php

use yii\db\Migration;

class m170414_131632_alter_supervisor_roll extends Migration
{
    public function up()
    {

       $this->addColumn('supervisor','role','string');

    }

    public function down()
    {

      $this->dropColumn('supervisor', 'role');

    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction.
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170414_131632_alter_supervisor_roll cannot be reverted.\n";

        return false;
    }
    */
}
