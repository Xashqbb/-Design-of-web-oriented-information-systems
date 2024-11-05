<?php

namespace app\models;

use yii\base\Model;

class EntryForm extends Model
{
    public $name;
    public $email;

    public function rules()
    {
        return [

            [['name', 'email'], 'required'],

            ['email', 'email'],

            ['name', 'string', 'max' => 50],

            ['name', 'match', 'pattern' => '/^[a-zа-яіїєґ\s]+$/iu', 'message' => 'Поле "Ім’я" має містити тільки літери.']
        ];
    }
}
