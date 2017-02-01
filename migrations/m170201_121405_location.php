<?php

use yii\db\Migration;

class m170201_121405_location extends Migration
{
    public function up()
    {

        $this->createTable(
            'location',
            [
                'id' => 'pk',
                'name' => 'string'
           
             
            ],
            'ENGINE=InnoDB'
        );
    }

    public function down()
    
    {
       $this->dropTable('course_teacher');
    }

 
}
