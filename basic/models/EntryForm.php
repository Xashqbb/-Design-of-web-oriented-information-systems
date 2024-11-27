<?php

namespace app\models;

use yii\base\Model;

class EntryForm extends Model
{
    public $username;
    public $password;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],  // Валідація для обох полів
            ['username', 'string', 'max' => 50],
            ['username', 'match', 'pattern' => '/^[a-zа-яіїєґ\s]+$/iu', 'message' => 'Поле "Ім’я" має містити тільки літери.'],
            ['password', 'string', 'min' => 6],  // Валідація для пароля
        ];
    }
}
