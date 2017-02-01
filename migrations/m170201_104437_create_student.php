<?php

use yii\db\Migration;

class m170201_104437_create_student extends Migration
{
    public function up()
    {

        $this->createTable(
            'student',
            [
                'id' => 'pk',
                'centerid' => 'integer',
                'name' => 'string',
                'lastname' => 'string',
                'grade' => 'string'

               			
            ],
            'ENGINE=InnoDB'
        );

         $this->addForeignKey(
            'fk-student-centerid',// This is the fk => the table where i want the fk will be
            'student',// son table
            'centerid', // son pk	
            'center', // father table
            'id', // father pk
            'CASCADE'
        );	


    }

    public function down()
    {
         $this->dropTable('user');

         $this->dropForeignKey(
            'fk-student-centerid',
            'studen');

 
    }

}

