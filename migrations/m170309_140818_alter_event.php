<?php

use yii\db\Migration;

class m170309_140818_alter_event extends Migration
{
    public function up()
    {
        $this->addColumn('event','title','string');
        $this->addColumn('event','description','string');
        $this->addColumn('event','created_date','date');
   

    }

    public function down()
    {
          $this->dropColumn('event', 'title');
          $this->dropColumn('event', 'description');
          $this->dropColumn('event', 'created_date');
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
