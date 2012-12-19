<?php


use Behat\Behat\Context\Step\Given,
    Behat\Behat\Context\Step\When,
    Behat\Behat\Context\Step\Then;

$steps->Given('/^I follow "([^"]*)" within "([^"]*)"$/', function($world, $link, $selector) {
    $world->clickLinkInScope($link, $selector);
});

$steps->Given('/^I confirm my action$/', function($world) {
    $world->getSession()->getDriver()->getWebDriverSession()->accept_alert();
});

$steps->Given('/^the following elements should contain given values:$/', function($world, $table) {
    $validation = array();
    foreach ($table->getRowsHash() as $field => $value) {
        $validation[] = new Then('the "'.$field.'" element should contain "'.$value.'"');
    }
    return $validation;
});

?>