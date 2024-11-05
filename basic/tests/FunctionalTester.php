<?php

// Here you can define custom actions for FunctionalTester
// to help you with testing your application.

class FunctionalTester extends \Codeception\Actor
{
    use _generated\FunctionalTesterActions;

    /**
     * Define custom actions here
     */
    public function amOnPage($url)
    {
        // Custom implementation
        $this->getModule('Symfony')->amOnPage($url);
    }

    public function fillField($field, $value)
    {
        // Custom implementation
        $this->getModule('WebDriver')->fillField($field, $value);
    }

    // Add more custom methods as needed
}
