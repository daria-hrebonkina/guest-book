<?php

use yii\db\Migration;

/**
 * Class m171112_013534_add_counter_to_comments_table
 */
class m171112_013534_add_counter_to_comments_table extends Migration
{

    public function up()
    {
        $this->execute('ALTER TABLE `comments` 
          ADD COLUMN `likes_counter` INT(11) NULL DEFAULT 0;
       ');
    }

    public function down()
    {
        $this->execute('ALTER TABLE `comments` 
          DROP COLUMN `likes_counter`;
       ');
    }
}
