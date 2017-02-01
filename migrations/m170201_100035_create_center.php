<?php

use yii\db\Migration;

class m170201_100035_create_center extends Migration
{
             public function up()
    {
	        $this->createTable(
            'center',
            [
                'id' => 'pk',
              

                'name' => 'string'
               
              		
            ],
            'ENGINE=InnoDB'
        );
		

    }

    public function down()
    {
         $this->dropTable('center');
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
