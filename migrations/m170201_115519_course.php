<?php

use yii\db\Migration;

class m170201_115519_course extends Migration
{
    public function up()
    {

        $this->createTable(
            'course',
            [
                'id' => 'pk',
                'coursename' => 'string'
                		
            ],
            'ENGINE=InnoDB'
        );

    }

    public function down()
    {
         $this->dropTable('course');
    }
}
