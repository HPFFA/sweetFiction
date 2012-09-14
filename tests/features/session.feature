Feature: Session management

Scenario: Login
    Given I am on the "Home" page
    And I follow "Register"
    Then I should be on the "Register" page
    When I fill in the following:
            | Name          | Princess Peach              |
            | Email         | princess_peach@example.com  |
            | Password      | TopSecretPrincess           |
    Then show me the page
    And I press "Submit"
    Then show me the page
    When I am on the "Users" page
    Then I should see "Princess Peach"
    And I should see "princess_peach@example.com"
