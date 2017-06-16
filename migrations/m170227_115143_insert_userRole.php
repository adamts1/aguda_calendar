<?php

use yii\db\Migration;

class m170227_115143_insert_userRole extends Migration
{
    public function up()
    {
        $this->insert('userRole', [
            'roleName' => 'teacher',
            'roleId' => '1',
        ]);
        $this->insert('userRole', [
            'roleName' => 'supervisor',
            'roleId' => '2',
        ]);	
        $this->insert('userRole', [
            'roleName' => 'administrator',
             'roleId' => '3',
        ]);		
    }

    public function down()
    {
       $this->delete('userRole', ['roleName' => 'teacher']);
		$this->delete('userRole', ['roleName' => 'supervisor']);
		$this->delete('userRole', ['roleName' => 'administrator']);
    }	

   
}
