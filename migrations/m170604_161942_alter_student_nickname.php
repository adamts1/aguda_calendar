<?php

use yii\db\Migration;

class m170604_161942_alter_student_nickname extends Migration
{
    public function up()
    {

                 $this->addColumn('student','nickname','string'); 


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
        echo "m170604_161942_alter_student_nickname cannot be reverted.\n";

        return false;
    }
    */
}
