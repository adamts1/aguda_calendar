<?php

use yii\db\Migration;

class m170227_115812_alter_user_add_role extends Migration
{
    public function up()
    {
        
      $this->addColumn('user','userRole','integer'); // We want to add foreign key 'roleId' from table 'teamRole' to table 'team'
      $this->addForeignKey(
            'fk-user-userRole',// This is the fk => the table where i want the fk will be
            'user',// son table
            'userRole', // son pk	
            'userrole', // father table
            'roleId', // father pk
            'CASCADE'
        );

    }

    public function down()
    {
        // drops foreign key for table `teacher`
        $this->dropForeignKey(
            'fk-user-userRole',
            'user'
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
