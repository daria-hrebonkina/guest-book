<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property string $site_url
 * @property string $text
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $likes_counter
 * @property string $status
 * @property string $author
 */
class Comments extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'comments';
    }

    public function rules()
    {
        return [
            [['text', 'status', 'author'], 'string'],
            [['create_time', 'update_time', 'likes_counter'], 'integer'],
            [['site_url'], 'string', 'max' => 255],
            [['site_url'], 'validateUrl'],
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'site_url' => 'Site Url',
            'text' => 'Text',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'status' => 'Status',
            'author' => 'Author',
        ];
    }

    public function getMedia()
    {
        return $this->hasMany(Media::className(), ['comment_id' => 'id']);
    }

    public function validateUrl()
    {
        $this->site_url = !preg_match("~^(?:f|ht)tps?://~i", $this->site_url) ? 'http://' . $this->site_url : $this->site_url;
    }
}
