<?php

use yii\db\Migration;

class m170201_113110_fundingsource_teacher extends Migration
{
     public function up()
    {

        $this->createTable(
            'fundingsource_teacher',
            [
                'sourceid' => 'integer',
                'teacherid' => 'integer',
                'PRIMARY KEY(sourceid, teacherid)',
             
            ],
            'ENGINE=InnoDB'
        );

         $this->addForeignKey(
            'fk-fundingsource_teacher-sourceid',// This is the fk => the table where i want the fk will be
            'fundingsource_teacher',// son table
            'sourceid', // son pk	
            'funding_source', // father table
            'id', // father pk
            'CASCADE'
        );	

         $this->addForeignKey(
            'fk-fundingsource_teacher-teacherid',// This is the fk => the table where i want the fk will be
            'fundingsource_teacher',// son table
            'teacherid', // son pk	
            'teacher', // father table
            'id', // father pk
            'CASCADE'
        );	


    }

    public function down()
    {
         $this->dropTable('fundingsource_teacher');

         $this->dropForeignKey(
            'fk-fundingsource_teacher-teacherid',
            'fundingsource_teacher');
    

        $this->dropForeignKey(
            'fk-fundingsource_teacher-sourceid',
            'fundingsource_teacher');
    }
}
