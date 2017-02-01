<?php

use yii\db\Migration;

class m170201_114351_cource extends Migration
{
    public function up()
    {

        $this->createTable(
            'cource',
            [
                'id' => 'pk',
                'courcename' => 'string'
                		
            ],
            'ENGINE=InnoDB'
        );

    }

    public function down()
    {
         $this->dropTable('cource');
    }

    
}
