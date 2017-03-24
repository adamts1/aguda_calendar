<?php

use yii\db\Migration;

class m170322_211300_create_group extends Migration
{
   public function up()
    {
        // $this->addColumn('group', 'day', $this->string());
        // $this->addColumn('group', 'start', $this->time());
        // $this->addColumn('group', 'end', $this->time());

        //  $this->dropColumn('group', 'dayintheweek');
    }

    public function down()
    {
        // $this->dropColumn('group', 'day');
        // $this->dropColumn('group', 'start');
        // $this->dropColumn('group', 'end');

        // $this->addColumn('group', 'dayintheweek', $this->string());
    }

}
