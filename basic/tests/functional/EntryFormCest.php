<?php

namespace tests\functional;

use FunctionalTester;

class EntryFormCest
{
    public function _before(FunctionalTester $I)
    {
        // Перед тестом можна налаштувати стартові параметри або перейти на сторінку форми
        $I->amOnPage(['site/entry']);
    }

    public function testEntryFormWithValidData(FunctionalTester $I)
    {
        // Перевіряємо, чи відображається сторінка форми
        $I->see('Entry Form');

        // Заповнюємо поля валідними даними
        $I->fillField('EntryForm[name]', 'Тестове Ім’я');
        $I->fillField('EntryForm[email]', 'test@example.com');

        // Відправляємо форму
        $I->click('Submit');

        // Перевіряємо, чи форма успішно відправилася та з'явилася сторінка підтвердження
        $I->see('Thank you for submitting the form');
    }

    public function testEntryFormWithInvalidData(FunctionalTester $I)
    {
        // Відправляємо форму без заповнення обов’язкових полів
        $I->click('Submit');

        // Перевіряємо, чи відображаються повідомлення про помилки
        $I->see('Name cannot be blank.');
        $I->see('Email cannot be blank.');

        // Заповнюємо неправильний email
        $I->fillField('EntryForm[name]', 'Тестове Ім’я');
        $I->fillField('EntryForm[email]', 'invalid-email');
        $I->click('Submit');

        // Перевіряємо, чи відображається повідомлення про помилку у полі email
        $I->see('Email is not a valid email address.');
    }
}
