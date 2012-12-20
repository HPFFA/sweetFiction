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
        And the following elements should contain given values:
            | #user_homepage    | localhost                     |
            | #user_email       | l@localhost.com               |
            | #user_icq         | 2324                          |
            | #user_yahoo       | 377                           |
            | #user_msn         | check@example.com             |   
            | #user_skype       | lusky                         |
            | #user_aol         | 24                            |
            | #user_real_name   | Luigi C.                      |
            | #user_birthday    | 1987-07-02                    |
            | #user_biography   | Nothing to say here ...       |
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
        
        When I fill in the following:
            | Email         | l@example.com                 |
            | Name          | Luigi                         |
            | Password      | changed                       |
            | Confirmation  | changed                       |
            | Real Name     | Luigi C.                      |
            | Biography     | Nothing special about me ...  |
            | Homepage      | localhost/~check              |
            | Public Email  | l@localhost.com               |
            | Icq           | 2324                          |
            | Yahoo         | 377                           |
            | Msn           | check@example.com             |
            | Skype         | lusky                         |
            | Aol           | 24                            |
        And I select "July" from "UserProfileBirthdayMonth"
        And I select "02" from "UserProfileBirthdayDay"
        And I select "1987" from "UserProfileBirthdayYear"
        And I press "Submit"
        Then the "#flashMessage" element should contain "The user has been updated"
        And I am on the "user profile 1"
        And the following elements should contain given values:
            | #user_homepage    | localhost                     |
            | #user_email       | l@localhost.com               |
            | #user_icq         | 2324                          |
            | #user_yahoo       | 377                           |
            | #user_msn         | check@example.com             |   
            | #user_skype       | lusky                         |
            | #user_aol         | 24                            |
            | #user_real_name   | Luigi C.                      |
            | #user_birthday    | 1987-07-02                    |
            | #user_biography   | Nothing special about me ...  |

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
        And the "Password" field should contain ""
        And the "Confirmation" field should contain ""
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
        And the "Password" field should contain ""
        And the "Confirmation" field should contain ""

        Examples:
            | field | value         | message                                                                               |
            | Name  |               | The name cannot be empty.                                                             |
            | Name  | Peach         | The name is already in use.                                                           |
            | Name  | oO            | Your name must start and end with a number or letter and must have a length of three. |
            | Email | p@example.com | The email is already in use.                                                          |
            | Email | invalid       | The provided email seems not to be valid, try another.                                |
            | Email |               | The email cannot be empty.                                                            |

    Scenario: Deny edit of other user's profiles
        Given there is a "User":
            | id | name  | email         | password | confirmation | 
            | 2  | Luigi | l@example.com | test     | test         |
        When I am logged in as "Luigi" with "test"
        Then I should not be allowed to go to "user profile 1 edit page"
        But I should be allowed to go to "user profile 2 edit page"

    @javascript
    Scenario: Delete of own user account
        When I am logged in as "Peach" with "test"
        And I am on the "user profile 1 edit page"
        And I follow "Delete"
        And I confirm my action
        Then the "#flashMessage" element should contain "User deleted"
        Then  I should not be logged in
        And there should be no "User":
            | name  | email         | 
            | Peach | p@example.com | 

    Scenario: Deny deletion of other user's account
        Given there is a "User":
            | id | name  | email         | password | confirmation | 
            | 2  | Luigi | l@example.com | test     | test         |
        When I am logged in as "Luigi" with "test"
        When I send a POST request to "/users/delete/1" with: 
            | id |
            | 1  |
        Then show me the page
        Then I should not see "User deleted"
        But I should see "Forbidden"
        And there should be a "User":
            | name  | email         | 
            | Peach | p@example.com | 
