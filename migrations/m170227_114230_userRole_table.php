<?php

use yii\db\Migration;

class m170227_114230_userRole_table extends Migration
{
    public function up()
    {
		
	  $this->createTable( // table roles of user member
      'userRole',
            [
                'roleId' => 'pk', 
                'roleName' => 'string'			
            ],
            'ENGINE=InnoDB'
        ); 

    }

    public function down()
    {
        $this->dropTable('userRole');
    }
    
}
