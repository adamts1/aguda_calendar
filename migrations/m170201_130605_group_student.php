<?php

use yii\db\Migration;

class m170201_130605_group_student extends Migration
{
    public function up()
    {

        $this->createTable(
            'group_student',
            [
                'studentid' => 'integer',
                'groupid' => 'integer',
                'PRIMARY KEY(studentid, groupid)',
             
            ],
            'ENGINE=InnoDB'
        );

         $this->addForeignKey(
            'fk-group_student-studentid',// This is the fk => the table where i want the fk will be
            'group_student',// son table
            'studentid', // son pk	
            'student', // father table
            'id', // father pk
            'CASCADE'
        );	

       $this->addForeignKey(
            'fk-group_student-groupid',// This is the fk => the table where i want the fk will be
            'group_student',// son table
            'groupid', // son pk	
            'group', // father table
            'id', // father pk
            'CASCADE'
        );	


    }

    public function down()
    {
         $this->dropTable('group_student');

        
    }
}
