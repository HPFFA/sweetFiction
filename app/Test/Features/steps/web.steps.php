<?php


use Behat\Behat\Context\Step\Given,
    Behat\Behat\Context\Step\When,
    Behat\Behat\Context\Step\Then;

$steps->Given('/^I follow "([^"]*)" within "([^"]*)"$/', function($world, $link, $scope) {
    $world->getReducedScopeOf($scope)->clickLink($world->fixStepArgument($link));
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

$steps->When('/^I send a (POST|PUT|DELETE) request to "([^"]*)" with:$/', function($world, $method, $page, $table) {
    $world->getSession()->getDriver()->getClient()->request($method, $world->locatePath($page), current($table->getHash()));
});

$steps->When('/^I fill in "([^"]*)" within "([^"]*)" with "([^"]*)"$/', function($world, $field, $scope, $value) {
    $world->getReducedScopeOf($scope)->fillField($world->fixStepArgument($field), $world->fixStepArgument($value));
});

?>