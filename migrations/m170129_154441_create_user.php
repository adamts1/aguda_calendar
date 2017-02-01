<?php

use yii\db\Migration;
use yii\db\Schema;

class m170129_154441_create_user extends Migration
{
    
	       public function up()
    {
	        $this->createTable(
            'user',
            [
                'id' => 'pk',
                'username' => 'string',
                'password' => 'string',
                'auth_key'	=> 'string',	
			    'firstname' => 'string',
                'lastname' => 'string',	
				'email' => 'string',
				'phone' => 'string',	
				'address' => 'string',	
                'notes' => 'text',
				'status' => 'integer',
				'created_at'=>'integer',
				'updated_at'=>'integer',
				'created_by'=>'integer',
				'updated_by'=>'integer'				
            ],
            'ENGINE=InnoDB'
        );
		

    }

    public function down()
    {
         $this->dropTable('user');
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
