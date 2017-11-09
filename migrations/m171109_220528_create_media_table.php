<?php

use yii\db\Migration;

/**
 * Handles the creation of table `media`.
 */
class m171109_220528_create_media_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute(
            'CREATE TABLE media (
                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                comment_id INT(11) NOT NULL,
                url VARCHAR(255) NOT NULL
            ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('media');
    }
}
