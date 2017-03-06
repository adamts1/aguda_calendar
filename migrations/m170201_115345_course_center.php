<?php

use yii\db\Migration;

class m170201_115345_course_center extends Migration
{
    public function up()
    {

        $this->createTable(
            'course_center',
            [
                'courseid' => 'integer',
                'centerid' => 'integer'
             
            ],
            'ENGINE=InnoDB'
        );

        


    }

    public function down()
    {
         $this->dropTable('course_center');

    }
}
