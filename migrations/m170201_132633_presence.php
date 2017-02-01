<?php

use yii\db\Migration;

class m170201_132633_presence extends Migration
{
    

    public function up()
    {

        $this->createTable(
            'presence',
            [
                'studentid' => 'integer',
                'eventid' => 'integer',
                'date' => 'date',
                'presence' => 'boolean',
             
            ],
            'ENGINE=InnoDB'
        );

         $this->addForeignKey(
            'fk-presence-studentid',// This is the fk => the table where i want the fk will be
            'presence',// son table
            'studentid', // son pk	
            'student', // father table
            'id', // father pk
            'CASCADE'
        );	

       $this->addForeignKey(
            'fk-presence-eventid',// This is the fk => the table where i want the fk will be
            'presence',// son table
            'eventid', // son pk	
            'event', // father table
            'id', // father pk
            'CASCADE'
        );	

    }

    public function down()
    {
         $this->dropTable('presence');

        
    }
}
