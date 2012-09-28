Feature: View the active user
    In order to manage the archiv
    I want to see the users and their information

Scenario: Visit the users page
    Given I am on the home page
    When I follow "Users"
    Then I should be on the "Users" page
