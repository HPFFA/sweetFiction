<?php

use Behat\Behat\Context\Step\Given,
    Behat\Behat\Context\Step\When,
    Behat\Behat\Context\Step\Then;

$steps->When('/^I log in as "([^"]*)" with "([^"]*)"$/', function($world, $name, $password) {
    $url = $world->getSession()->getCurrentUrl();
    return array(
        new When('I am logged in as "'.$name.'" with "'.$password.'"'),
        new When('I am on "'.$url.'"')
    );
});

$steps->When('/^I am logged in as "([^"]*)" with "([^"]*)"$/', function($world, $name, $password) {
    return array(
        new When('I am on the "login page"'),
        new When('I fill in "Name" with "'.$name.'"'),
        new When('I fill in "Password" with "'.$password.'"'),
        new When('I press "Login"'));
});

$steps->When('/^I log out$/', function($world) {
    return new When('I follow "Logout"');
});

$steps->When('/^I am logged out$/', function($world) {
    try 
    {
        $world->getSession()->getPage()->clickLink("Logout");
    } catch (Exception $e)
    {
        // we just make sure, that the user is not logged in - therefore it can fail when no one was logged in
    }
    return null;
});

$steps->Then('/^I should be able to log in as "([^"]*)" with "([^"]*)"$/', function($world, $name, $password) {
    $url = $world->getSession()->getCurrentUrl();
    return array(
        new When('I am logged out'),
        new When('I am logged in as "'.$name.'" with "'.$password.'"'),
        new Then('the "#authMessage" element should contain "Welcome '.$name.'"'),
        new When('I am logged out'),
        new Given('I am on "'.$url.'"')
    );
});

$steps->Then('/^I should not be able to log in as "([^"]*)" with "([^"]*)"$/', function($world, $name, $password) {
    $url = $world->getSession()->getCurrentUrl();
    return array(
        new When('I am logged out'),
        new When('I am logged in as "'.$name.'" with "'.$password.'"'),
        new Then('the "#authMessage" element should contain "Invalid username or password"'),
        new When('I am logged out'),
        new Given('I am on "'.$url.'"')
    );
});


?>