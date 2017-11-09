<?php

use yii\db\Migration;

/**
 * Class m171109_221306_add_create_time_to_comments_table
 */
class m171109_221306_add_create_time_to_comments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute('ALTER TABLE `comments` 
          ADD COLUMN `create_time` INTEGER(11) NULL DEFAULT NULL,
          ADD COLUMN `update_time` INTEGER(11) NULL DEFAULT NULL;
       ');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->execute('ALTER TABLE `comments` 
          DROP COLUMN `create_time`,
          DROP COLUMN `update_time`;
       ');
    }
}
