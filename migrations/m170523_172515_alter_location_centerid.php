<?php

use yii\db\Migration;

class m170523_172515_alter_location_centerid extends Migration
{
    public function up()
    {
         $this->addColumn('location','cennterid','integer'); // We want to add foreign key 'roleId' from table 'teamRole' to table 'team'
         $this->addForeignKey(
            'fk-location-cennterid',// This is the fk => the table where i want the fk will be
            'location',// son table
            'cennterid', // son pk	
            'center', // father table
            'id', // father pk
            'CASCADE'
        );

    }

    public function down()
    {
        
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction.
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170523_172515_alter_location_centerid cannot be reverted.\n";

        return false;
    }
    */
}
