<?php


$steps->Given('/^I follow "([^"]*)" within "([^"]*)"$/', function($world, $link, $selector) {
    $world->clickLinkInScope($link, $selector);
});

$steps->Given('/^I confirm my action$/', function($world) {
    $world->getSession()->getDriver()->getWebDriverSession()->accept_alert();
});
?>