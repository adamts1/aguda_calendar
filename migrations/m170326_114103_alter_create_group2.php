<?php

use yii\db\Migration;

class m170326_114103_alter_create_group2 extends Migration
{
     public function up()
    {
         $this->addColumn('group', 'student_list', $this->tinytext());
    }

    public function down()
    {
        $this->dropColumn('group', 'student_list');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction.
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170326_114103_alter_create_group2 cannot be reverted.\n";

        return false;
    }
    */
}
