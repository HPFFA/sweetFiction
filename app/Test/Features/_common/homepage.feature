@homepage
Feature: Run simply

    Scenario: Visiting the homepage
        Given I am on "/"
        Then I should see "Login"
        And I should see "Register"
