<?php

use yii\db\Migration;

class m170201_101858_create_supervising extends Migration
{
    public function up()
    {
        $this->createTable(
            'supervising',
            [
                'centerid' => 'integer',
                'supervisorid' => 'integer'
               			
            ],
            'ENGINE=InnoDB'
        );

         $this->addForeignKey(
            'fk-supervising-supervisorid',// This is the fk => the table where i want the fk will be
            'supervising',// son table
            'supervisorid', // son pk	
            'supervisor', // father table
            'id', // father pk
            'CASCADE'
        );	

        $this->addForeignKey(
            'fk-supervising-centerid',// This is the fk => the table where i want the fk will be
            'supervising',// son table
            'centerid', // son pk	
            'center', // father table
            'id', // father pk
            'CASCADE'
        );	

    }

    public function down()
    {
          $this->dropTable('supervising');
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
