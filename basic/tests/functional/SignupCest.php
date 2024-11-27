<?php

class SignupCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/site/signup');
    }

    public function testSignupWithValidData(FunctionalTester $I)
    {
        // Заповнення форми
        $I->submitForm('#signup-form', [
            'SignupForm[username]' => 'testuser',
            'SignupForm[password]' => 'password123',
        ]);

        // Перевірка успішної реєстрації
        $I->see('Thank you for signing up.');
        $I->seeRecord('app\models\User', ['username' => 'testuser']);
    }
}

