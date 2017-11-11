<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 11.11.2017
 * Time: 23:19
 */

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class ImageUploader extends Model
{
    /**
     * @var UploadedFile[] $photos
     */
    public $photos;
    /**
     * @var Comments $instance Comments model
     */
    public $instance;

    public function rules()
    {
        return [
            [['photos'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 100],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            foreach ($this->photos as $file) {
                $fileName = 'uploads/' . $file->baseName . '.' . $file->extension;
                $mediaItem = new Media();
                $mediaItem->comment_id = $this->instance->id;
                $mediaItem->url = $fileName;
                if($mediaItem->save()) {
                    $file->saveAs($fileName);
                }
            }
            return true;
        } else {
            return false;
        }
    }
}