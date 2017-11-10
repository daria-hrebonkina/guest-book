<?php

use yii\db\Migration;

/**
 * Handles adding author to table `comments`.
 */
class m171109_232709_add_author_column_to_comments_table extends Migration
{
    public function up()
    {
        $this->execute('ALTER TABLE `comments` 
          ADD COLUMN `author` VARCHAR(255) NULL DEFAULT NULL;
       ');
    }

    public function down()
    {
        $this->execute('ALTER TABLE `comments` 
          DROP COLUMN `author`;
       ');
    }
}
