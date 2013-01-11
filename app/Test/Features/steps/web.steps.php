<?php


use Behat\Behat\Context\Step\Given,
    Behat\Behat\Context\Step\When,
    Behat\Behat\Context\Step\Then;

use Behat\Mink\Element\NodeElement,
    Behat\Mink\Exception\ElementNotFoundException,
    Behat\Mink\Exception\ExpectationException,
    Behat\Mink\Exception\ResponseTextException,
    Behat\Mink\Exception\ElementHtmlException,
    Behat\Mink\Exception\ElementTextException;

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

$steps->Then('/^the "([^"]*)" field within "([^"]*)" should contain "([^"]*)"$/', function($world, $field, $scope, $value) {
    $reducedScope = $world->getReducedScopeOf($scope, true);
    $element = $reducedScope->findField($field);
    $actual  = $element->getValue();
    $regex   = '/'.preg_quote($value, '/').'/ui';

    if (!preg_match($regex, $actual)) {
        $message = sprintf('The text "%s" was not found in the text of the element matching %s "%s" within "%s".', $value, 'css', $field, $scope);
        throw new ElementTextException($message, $world->getSession(), $element);
    }
});

$steps->Then('/^I should see the link "([^"]*)"$/', function($world, $linkName) {
   $link = $world->getSession()->getPage()->findLink($world->fixStepArgument($linkName));
   assertNotEquals($link, null, "Expected to find the link '".$linkName."' but found none");
});

$steps->Then('/^I should not see the link "([^"]*)"$/', function($world, $linkName) {
   $link = $world->getSession()->getPage()->findLink($world->fixStepArgument($linkName));
   assertEquals($link, null, "Unexpected occurrence of link '".$linkName."'");
});

?>