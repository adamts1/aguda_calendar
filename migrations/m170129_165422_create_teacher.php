<?php

use yii\db\Migration;

class m170129_165422_create_teacher extends Migration
{
          public function up()
    {
	        $this->createTable(
            'teacher',
            [
                'id' => 'pk',
                'subject' => 'string'
               
              		
            ],
            'ENGINE=InnoDB'
        );
		

    }

    public function down()
    {
         $this->dropTable('teacher');
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
