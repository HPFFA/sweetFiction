<?php

use Behat\Behat\Context\Step\Then;

$steps->Then('/^show me the page$/', function()
{
    return new Then("show last response");
});

?>