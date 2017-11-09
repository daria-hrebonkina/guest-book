<?php

use yii\db\Migration;

/**
 * Handles the creation of table `likes`.
 */
class m171109_220726_create_likes_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute(
            'CREATE TABLE likes (
                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                comment_id INT(11) NOT NULL,
                ip BIGINT NULL DEFAULT NULL
            ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('likes');
    }
}
