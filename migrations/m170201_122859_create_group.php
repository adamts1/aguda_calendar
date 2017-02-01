<?php

use yii\db\Migration;

class m170201_122859_create_group extends Migration
{
   public function up()
    {

        $this->createTable(
            'group',
            [
                'id' => 'pk',
                'courseid' => 'integer',
                'teacherid' => 'integer',
                'locationid' => 'integer',
                'dayintheweek' => 'string',
                'duration' => 'time'
                

               

               			
            ],
            'ENGINE=InnoDB'
        );

         $this->addForeignKey(
            'fk-group-courseid',// This is the fk => the table where i want the fk will be
            'group',// son table
            'courseid', // son pk	
            'course', // father table
            'id', // father pk
            'CASCADE'
        );	

        $this->addForeignKey(
            'fk-group-teacherid',// This is the fk => the table where i want the fk will be
            'group',// son table
            'teacherid', // son pk	
            'teacher', // father table
            'id', // father pk
            'CASCADE'
        );	

         $this->addForeignKey(
            'fk-group-locationid',// This is the fk => the table where i want the fk will be
            'group',// son table
            'locationid', // son pk	
            'location', // father table
            'id', // father pk
            'CASCADE'
        );	


    }

    public function down()
    {
         $this->dropTable('group');

         $this->dropForeignKey(
            'fk-group-courseid',
            'group');

             $this->dropForeignKey(
            'fk-group-teacherid',
            'group');

             $this->dropForeignKey(
            'fk-group-locationid',
            'group');

    }

}
