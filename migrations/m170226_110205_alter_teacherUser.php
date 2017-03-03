<?php

use yii\db\Migration;

class m170226_110205_alter_teacherUser extends Migration
{
    public function up()
    {
      $this->addForeignKey(
            'fk-teacher-id',// This is the fk => the table where i want the fk will be
            'teacher',// son table
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
            'fk-teacher-id',
            'teacher'
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
