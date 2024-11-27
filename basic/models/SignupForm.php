<?php

class SignupCest
{
    public function _before(FunctionalTester $I)
    {
        // Setup or create any test data here
    }

    // Test for signup with valid data
    public function testSignupWithValidData(FunctionalTester $I)
    {
        $I->amOnPage('/site/signup');  // Ensure you are on the signup page

        // Submit the form with valid data
        $I->submitForm("#signup-form", [
            'SignupForm[username]' => 'testuser',
            'SignupForm[password]' => 'password123',
        ]);

        // Check if the signup was successful by seeing a confirmation or redirection
        $I->see('Welcome, testuser');
    }
}
