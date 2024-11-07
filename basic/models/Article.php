<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Article extends ActiveRecord
{
    public $image;

    public static function tableName()
    {
        return 'articles';
    }

    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 2], // 2 MB

        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'image' => 'Image',
        ];
    }
}
