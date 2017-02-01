<?php

use yii\db\Migration;

class m170129_161738_create_supervisor extends Migration
{
     public function up()
    {
	        $this->createTable(
            'supervisor',
            [
                'id' => 'pk',
                

                			
            ],
            'ENGINE=InnoDB'
        );
		

    }

    public function down()
    {
         $this->dropTable('supervisor');
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
