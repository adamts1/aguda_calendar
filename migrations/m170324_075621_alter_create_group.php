<?php

use yii\db\Migration;

class m170324_075621_alter_create_group extends Migration
{
    public function up()
    {
        $this->dropColumn('group', 'duration');
    }

    public function down()
    {
        $this->addColumn('group', 'duration', $this->time());

    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction.
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170324_075621_alter_create_group cannot be reverted.\n";

        return false;
    }
    */
}
