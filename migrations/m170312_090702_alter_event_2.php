<?php

use yii\db\Migration;

class m170312_090702_alter_event_2 extends Migration
{
   public function up()
    {
        $this->addColumn('event','endDate','date');
      
   

    }

    public function down()
    {
          $this->dropColumn('event', 'endDate');
         
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
