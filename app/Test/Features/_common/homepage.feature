@homepage
Feature: Run simply

    Scenario: Visiting the homepage
        Given I am on "/"
        Then the "Login" link within "#user_menu" should point to "/authentication/login"
        Then the "Register" link within "#user_menu" should point to "/authentication/register"
        Then the "Home" link within "#navigation" should point to "/pages/home"
        Then the "Users" link within "#navigation" should point to "/users"
        Then the "Stories" link within "#navigation" should point to "/stories"
