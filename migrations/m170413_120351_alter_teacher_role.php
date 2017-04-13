<?php

use yii\db\Migration;

class m170413_120351_alter_teacher_role extends Migration
{
    public function up()
    {

       $this->addColumn('teacher','role','string');

    }

    public function down()
    {

      $this->dropColumn('teacher', 'role');

    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction.
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170413_120351_alter_teacher_role cannot be reverted.\n";

        return false;
    }
    */
}
