@user
Feature: Viewing the registered users

    Background:
        Given there is a "User":
            | id | name  | email         | password | confirmation |
            | 1  | Peach | p@example.com | test     | test         |

    Scenario: The list of users
        When I am on "/users"
        Then I should see "Peach"
        When I log in as "Peach" with "test"
        And I am on "/users"
        Then I should see "Peach"

    Scenario: Go to the user profile
        When I am on "/users"
        And I follow "Peach" within "#list_user_1"
        Then I should be on "/users/view/1"

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
        When I am on "/users/view/2"
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
        And I am on "/users/view/2"
        Then I should not see "Edit"
        When I am on "/users/view/1"
        Then I should see "Edit"

    Scenario: View an user profile of a user with stories
        Given there is a "Story":
            | id | user_id | title                    | summary                                           | completed |
            | 1  | 1       | Peach's first story |                                                        | 0         |
        And there is a "StoryChapter":
            | id | user_id | story_id | title             | text              | chapter_number |
            | 1  | 1       | 1        | First chapter     | ...               | 1              |
        And I am on "/users/view/1"
        Then I should see an ".stories" element
        And the ".stories" element should contain "Peach's first story"
        When I follow "Peach's first story"
        Then I should be on "/stories/view/1"