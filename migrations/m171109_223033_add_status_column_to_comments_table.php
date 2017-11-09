<?php

use yii\db\Migration;

/**
 * Handles adding status to table `comments`.
 */
class m171109_223033_add_status_column_to_comments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute('ALTER TABLE `comments`
          ADD COLUMN `status` ENUM("draft", "active") NOT NULL DEFAULT "draft";
        ');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->execute('ALTER TABLE `comments`
          DROP COLUMN `status`;
        ');
    }
}
