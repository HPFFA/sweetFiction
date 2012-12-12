@authentication
Feature: Authentication of users
    
    Background:
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
            | name  | email         | 
            | Luigi | l@example.com | 
        And I should be on the "homepage"

    Scenario Outline: Denial of registering an user with wrong credentials
        Given I am on the "registration page"
        When I fill in "Name" with "<name>"
        And I fill in "Email" with "<email>"
        And I fill in "Password" with "<password>"
        And I fill in "Confirmation" with "<confirmation>"
        And I press "Submit"
        Then the "#authMessage" element should contain "The author could not be registered. Please, try again."
        And I should see "<message>"
        And I should be on the "registration page"
        And the "Name" field should contain "<name>"
        And the "Email" field should contain "<email>"
        And the "Password" field should contain ""
        And the "Confirmation" field should contain ""

        Examples:
            | name  | email         | password | confirmation | message                                                |
            |       |               |          |              | The author could not be registered. Please, try again. |
            | Guest | g@example.com | wrong    | gnorw        | The password and confirmation does not match.          |
            | Peach | w@example.com | test     | test         | The name is already in use.                            |
            | Guest | p@example.com | test     | test         | The email is already in use.                           |
            | Guest | invali        | test     | test         | The provided email seems not to be valid, try another. |
            |       | e@example.com | test     | test         | The name cannot be empty.                              |
            | Guest |               | test     | test         | The email cannot be empty.                             |
            | Guest | e@example.com |          |              | The password cannot be empty.                          |
            | Guest | e@example.com | 123      | 123          | The password should be at least four characters long.  |
            | T_    | t@example.com | test     | test         | Your name must start and end with a number or letter and must have a length of three. |

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