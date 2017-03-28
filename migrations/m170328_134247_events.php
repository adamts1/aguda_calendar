<?php

use yii\db\Migration;

class m170328_134247_events extends Migration
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

}
