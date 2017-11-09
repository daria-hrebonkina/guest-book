<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comments`.
 */
class m171109_215546_create_comments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute(
            'CREATE TABLE comments (
                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                site_url VARCHAR(255) NULL DEFAULT NULL,
                text TEXT(1000) NULL DEFAULT NULL
            ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('comments');
    }
}