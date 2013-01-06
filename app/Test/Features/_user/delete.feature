@user
Feature: Deleting an account

    Background:
        Given there is a "User":
            | id | name  | email         | password | confirmation |
            | 1  | Peach | p@example.com | test     | test         |

    #TODO Reactivate - Currently there are some troubles with the selenium2 driver
    @javascript
    Scenario: Delete of own user account
        When I am logged in as "Peach" with "test"
        And I am on "/users/edit/1"
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
        Then I should not see "User deleted"
        But I should see "Forbidden"
        And there should be a "User":
            | name  | email         |
            | Peach | p@example.com |
