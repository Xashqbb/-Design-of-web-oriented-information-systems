<?php

namespace functional;

use tests\FunctionalTester;

class SignupCest
{
    public function _before(FunctionalTester $I)
    {
        // Setup before tests
    }

    public function tryToSignup(FunctionalTester $I)
    {
        $I->amOnPage('/site/signup');
        $I->see('Signup', 'h1');
        $I->fillField('Username', 'newuser');
        $I->fillField('Email', 'newuser@example.com');
        $I->fillField('Password', 'password123');
        $I->click('Зареєструватися');
        $I->see('Thank you for registration. You may login now.');
        $I->seeInDatabase('user', [
            'username' => 'newuser',
            'email' => 'newuser@example.com',
        ]);
    }
}
