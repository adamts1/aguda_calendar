<?php

use yii\db\Migration;

class m170228_135807_alter_supervisor_add_center extends Migration
{
   public function up()
    {
        
      $this->addColumn('supervisor','centerId','integer'); // We want to add foreign key 'roleId' from table 'teamRole' to table 'team'
      $this->addForeignKey(
            'fk-supervisor-centerId',// This is the fk => the table where i want the fk will be
            'supervisor',// son table
            'centerId', // son pk	
            'center', // father table
            'id', // father pk
            'CASCADE'
        );

    }

    public function down()
    {
        // drops foreign key for table `teacher`
        $this->dropForeignKey(
            'fk-supervisor-centerId',
            'supervisor'
        );
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
