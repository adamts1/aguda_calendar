<?php

use yii\db\Migration;

class m170201_131140_event extends Migration
{
    public function up()
    {

        $this->createTable(
            'event',
            [
                'id' => 'pk',
                'groupid' => 'integer',
                'teacherid' => 'integer',
                'locationid' => 'integer',
                'date' => 'date'
               
                

               

               			
            ],
            'ENGINE=InnoDB'
        );

         $this->addForeignKey(
            'fk-event-groupid',// This is the fk => the table where i want the fk will be
            'event',// son table
            'groupid', // son pk	
            'group', // father table
            'id', // father pk
            'CASCADE'
        );	

        $this->addForeignKey(
            'fk-event-teacherid',// This is the fk => the table where i want the fk will be
            'event',// son table
            'teacherid', // son pk	
            'teacher', // father table
            'id', // father pk
            'CASCADE'
        );	

         $this->addForeignKey(
            'fk-event-locationid',// This is the fk => the table where i want the fk will be
            'event',// son table
            'locationid', // son pk	
            'location', // father table
            'id', // father pk
            'CASCADE'
        );	


    }

    public function down()
    {
         $this->dropTable('event');

         $this->dropForeignKey(
            'fk-event-groupid',
            'event');

             $this->dropForeignKey(
            'fk-event-teacherid',
            'event');

             $this->dropForeignKey(
            'fk-event-locationid',
            'event');

    }
}
