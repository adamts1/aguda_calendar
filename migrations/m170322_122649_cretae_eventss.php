<?php

use yii\db\Migration;

class m170322_122649_cretae_eventss extends Migration
{
    public function up()
    {

        $this->createTable(
            'events',
            [
                'id' => 'pk',
                'location' => 'string',
                'title' => 'string',
                'color' => 'string',
                'start' => 'datetime',
                'end' => 'datetime'
                

               

               			
            ],
            'ENGINE=InnoDB'
        );

    }

    public function down()
    {
           $this->dropTable('events');
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
