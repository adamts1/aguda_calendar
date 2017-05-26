<?php

use yii\db\Migration;

class m170525_122305_alter_student extends Migration
{
    public function up()
    {
         $this->addColumn('student','phone','string'); 
         $this->addColumn('student','notes','string'); 

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
        echo "m170525_122305_alter_student cannot be reverted.\n";

        return false;
    }
    */
}
