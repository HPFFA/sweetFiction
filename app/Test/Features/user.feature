@user
Feature: The management of user

     Background:
        Given there is a "User":
            | id | name  | email         | password | confirmation |
            | 1  | Peach | p@example.com | test     | test         |
    
    Scenario: The list of users 
        When I am on the "user list page"
        Then I should see "Peach"
        When I log in as "Peach" with "test"
        And I am on the "user list page"
        Then I should see "Peach"

    Scenario: Go to the user profile
        When I am on the "user list page"
        And I follow "Peach" within "#list_user_1"
        Then I should be on "user profile 1"

    Scenario: View a profile as guest
        Given there is a "User":
            | id | name  | email         | password | confirmation |
            | 2  | Luigi | l@example.com | test     | test         |
        Given there is a "UserContact":
            | user_id | homepage  | public_email    | icq  | yahoo | msn               | skype | aol |
            | 2       | localhost | l@localhost.com | 2324 | 377   | check@example.com | lusky | 24  |
        And there is a "UserProfile":
            | user_id | real_name | birthday   | biography               |
            | 2       | Luigi C.  | 1987-07-02 | Nothing to say here ... |
        When I am on the "user profile 2"
        Then the "#user_homepage" element should contain "localhost"
        And the "#user_email" element should contain "l@localhost.com"
        And the "#user_icq" element should contain "2324"
        And the "#user_yahoo" element should contain "377"
        And the "#user_msn" element should contain "check@example.com"
        And the "#user_skype" element should contain "lusky"
        And the "#user_aol" element should contain "24"
        And the "#user_real_name" element should contain "Luigi C."
        And the "#user_birthday" element should contain "1987-07-02"
        And the "#user_biography" element should contain "Nothing to say here ..."
        And I should not see "Edit"
        Given I am logged in as "Peach" with "test"
        And I am on the "user profile 2"
        Then I should not see "Edit"
        When I am on the "user profile 1"
        Then I should see "Edit"
    
    Scenario: Access the user's own profile edit page
        When I am logged in as "Peach" with "test"
        And  I am on the "user profile 1"
        And I follow "Edit"
        Then I should be on the "user profile 1 edit page"
    
    Scenario: Edit the user's own profile
        When I am logged in as "Peach" with "test"
        And I am on the "user profile 1 edit page"
        When I fill in "Name" with "Luigi"
        And I fill in "Email" with "l@example.com"
        And I fill in "Password" with "changed"
        And I fill in "Confirmation" with "changed"
        And I fill in "Real Name" with "Luigi C."
        And I select "July" from "UserProfileBirthdayMonth"
        And I select "02" from "UserProfileBirthdayDay"
        And I select "1987" from "UserProfileBirthdayYear"
        And I fill in "Biography" with "Nothing special about me ..."
        And I fill in "Homepage" with "localhost/~check"
        And I fill in "Public Email" with "l@localhost.com"
        And I fill in "Icq" with "2324"
        And I fill in "Yahoo" with "377"
        And I fill in "Msn" with "check@example.com"
        And I fill in "Skype" with "lusky"
        And I fill in "Aol" with "24"
        And I press "Submit"
        Then the "#flashMessage" element should contain "The user has been updated"
        And I am on the "user profile 1"
        And the "#user_homepage" element should contain "localhost"
        And the "#user_email" element should contain "l@localhost.com"
        And the "#user_icq" element should contain "2324"
        And the "#user_yahoo" element should contain "377"
        And the "#user_msn" element should contain "check@example.com"
        And the "#user_skype" element should contain "lusky"
        And the "#user_aol" element should contain "24"
        And the "#user_real_name" element should contain "Luigi C."
        And the "#user_birthday" element should contain "1987-07-02"
        And the "#user_biography" element should contain "Nothing special about me ..."

    Scenario: Check login credentials after password and username change
        When I am logged in as "Peach" with "test"
        And I am on the "user profile 1 edit page"
        When I fill in "Name" with "Luigi"
        And I fill in "Email" with "l@example.com"
        And I fill in "Password" with "changed"
        And I fill in "Confirmation" with "changed"
        And I press "Submit"
        Then the "#flashMessage" element should contain "The user has been updated"
        And I should be able to log in as "Luigi" with "changed"
        And I should not be able to log in as "Peach" with "test"
    
    @fail
    Scenario: Edit the user's own profile without changing the password or user's name
        When I am logged in as "Peach" with "test"
        And I am on the "user profile 1 edit page"
        And I fill in "Real Name" with "Luigi C."
        And I select "July" from "UserProfileBirthdayMonth"
        And I select "02" from "UserProfileBirthdayDay"
        And I select "1987" from "UserProfileBirthdayYear"
        And I fill in "Biography" with "Nothing special about me ..."
        And I press "Submit"
        Then the "#flashMessage" element should contain "The user has been updated"
        And I should be able to log in as "Peach" with "test"

    Scenario: Edit the user's own profile with unmatching information
        When I am logged in as "Peach" with "test"
        And I am on the "user profile 1 edit page"
        And I fill in "Password" with "not"
        And I fill in "Confirmation" with "matching"
        And I press "Submit"
        Then the "#flashMessage" element should contain "The user could not be updated. Please try again."
        And I should be on the "user profile 1 edit page"
        And the ".error-message" element should contain "The password and confirmation does not match."
        And I should be able to log in as "Peach" with "test"

    Scenario Outline: Edit the user's credentials to invalid ones
        Given there is a "User":
            | id | name  | email         | password | confirmation | 
            | 2  | Luigi | l@example.com | test     | test         |
        When I am logged in as "Luigi" with "test"
        And I am on the "user profile 2 edit page"
        And I fill in "<field>" with "<value>"
        And I press "Submit"
        Then I should see "The user could not be updated. Please try again."
        And the ".error-message" element should contain "<message>"

        Examples:
            | field | value         | message                                                                               |
            | Name  |               | The name cannot be empty.                                                             |
            | Name  | Peach         | The name is already in use.                                                           |
            | Name  | oO            | Your name must start and end with a number or letter and must have a length of three. |
            | Email | p@example.com | The email is already in use.                                                          |
            | Email | invalid       | The provided email seems not to be valid, try another.                                |
            | Email |               | The email cannot be empty.                                                            |

