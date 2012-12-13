<?php


$steps->Given('/^I follow "([^"]*)" within "([^"]*)"$/', function($world, $link, $selector) {
    $world->clickLinkInScope($link, $selector);
});


?>