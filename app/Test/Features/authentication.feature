@authentication
Feature: Authentication of users
    
    Background
    Scenario: Login in an existing user
        Given there is a "User":
            | name  | email         | password | confirmation |
            | Peach | p@example.com | test     | test         |

    Scenario: Go to register page
        Given I am on the "homeage"
        And I follow "Register"
        Then I should be on the "registration page"

    Scenario: Register a "User"
        Given I am on the "registration page"
        When I fill in "Name" with "Luigi" 
        And I fill in "Email" with "l@example.com"
        And I fill in "Password" with "test"
        And I fill in "Confirmation" with "test"
        And I press "Submit"
        Then the "#authMessage" element should contain "The author has been registered"
        And there should be a "User":
            | name  | email         | password |
            | Luigi | l@example.com | test     |
        And I should be on the "homepage"

    Scenario: Go to login page
        When I am on the "homepage"
        And I follow "Login"
        Then I should be on the "login page"

    Scenario: Login in an existing user
        When I am on the "login page"
        When I fill in "Name" with "Peach"
        And I fill in "Password" with "test"
        And I press "Login"
        Then the "#authMessage" element should contain "Welcome Peach"
        Then show me the page

    Scenario Outline: Denial of login with wrong creditials
        When I am on the "login page"
        When I fill in "Name" with "<name>"
        And I fill in "Password" with "<password>"
        And I press "Login"
        Then the "#authMessage" element should contain "<message>"
        And I should be on the "login page"
        And the "Name" field should contain "<name>"
        And the "Password" field should contain ""

        Examples:
            | name      | password   | message                      |
            |           | test       | Invalid username or password |
            | Guest     | test       | Invalid username or password |
            | Peach     | wrong      | Invalid username or password |
            | Peach     |            | Invalid username or password |