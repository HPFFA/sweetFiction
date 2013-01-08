@homepage
Feature: Run simply

    Scenario: Visiting the homepage
        Given I am on "/"
        Then I should see "Login"
        And I should see "Register"
        And I should see "Users"
        And I should see "Stories"

    Scenario Outline: List all elements of a type
        Given I am on "/"
        And I follow "<link>"
        Then I should be on "<page>"

        Examples:
            | link     | page                     |
            | Users    | /users                   |
            | Stories  | /stories                 |
            | Login    | /authentication/login    |
            | Register | /authentication/register |