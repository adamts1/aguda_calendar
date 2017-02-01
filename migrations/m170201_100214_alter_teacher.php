<?php

use yii\db\Migration;

class m170201_100214_alter_teacher extends Migration
{
    public function up()
    {	
	$this->addColumn('teacher','centerid','integer'); // We want to add foreign key 'roleId' from table 'teamRole' to table 'team'
	
 // add foreign key for table `user`
        $this->addForeignKey(
            'fk-teacher-centerid',// This is the fk => the table where i want the fk will be
            'teacher',// son table
            'centerid', // son pk	
            'center', // father table
            'id', // father pk
            'CASCADE'
        );	
    }

    public function down()
    {
			
		  // drops foreign key for table `team`
        $this->dropForeignKey(
            'fk-teacher-centerid',
            'teacher'
        );

        $this->dropColumn('teacher', 'centerid');
		
		

        
    }
}
