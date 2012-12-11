Feature: Run simply

    Scenario: Visiting the homepage
        Given I am on the "homepage"
        Then I should see "Login"
        And I should see "Register"
