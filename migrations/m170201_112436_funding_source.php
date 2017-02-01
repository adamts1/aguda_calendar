<?php

use yii\db\Migration;

class m170201_112436_funding_source extends Migration
{
    public function up()
    {
         $this->createTable(
            'funding_source',
            [
                'id' => 'pk',
                'sourcename' => 'string'

               			
            ],
            'ENGINE=InnoDB'
        );

    }

    public function down()
    {
         $this->dropTable('funding_source');
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
