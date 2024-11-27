<?php

class EntryFormCest
{
    public function _before(FunctionalTester $I)
    {
        // Any necessary preparation (e.g., creating test data)
    }

    // Test for displaying the entry form
    public function testEntryFormWithValidData(FunctionalTester $I)
    {
        $I->amOnPage('/site/entry');  // Ensure you are on the entry form page

        // Check if the page contains the expected text
        $I->see("Entry Form");  // Verify that "Entry Form" is present on the page
    }

    // Test for submitting invalid data in the entry form
    public function testEntryFormWithInvalidData(FunctionalTester $I)
    {
        $I->amOnPage('/site/entry');  // Ensure you are on the entry form page

        // Submit the form with invalid data
        $I->submitForm("#entry-form", [
            'EntryForm[name]' => '',
            'EntryForm[email]' => 'invalid-email',
        ]);

        // Check for validation errors or form submission result
        $I->see('Name cannot be blank');  // Example validation error
        $I->see('Email is not a valid email address');  // Example validation error
    }
}
