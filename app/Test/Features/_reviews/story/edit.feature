@review
Feature: Edit exiting reviews of a story

    Background:
        Given there is a "User":
            | id | name  | email         | password | confirmation |
            | 1  | Peach | p@example.com | test     | test         |
        And there is a "Story":
            | id | user_id | title        |
            | 1  | 1       | First Story  |
            | 2  | 1       | Second Story |
        And there is a "StoryChapter":
            | id | user_id | story_id | title         | text |
            | 1  | 1       | 1        | First chapter | ...  |
            | 2  | 1       | 2        | First chapter | ...  |
        And there is a "Review":
            | id | parent_id | reference_id | reference_type | user_id | user_name | text             |
            | 1  | 0         | 1            | story          | 0       | Anonymous | First story 1    |
            | 2  | 1         | 1            | story          | 1       |           | First story 1.1  |
            | 3  | 0         | 1            | story          | 0       | Guest     | First story 2    |
            | 4  | 0         | 2            | story          | 0       | Guest     | Other story      |

    Scenario: Guest should not be able to edit reviews
        When I am on "/stories/view/1"
        And I should not see the link "Edit"

    Scenario: The review author should have the possibility to change his/her review
        And I am logged in as "Peach" with "test"
        When I am on "/stories/view/1"
        Then I should not see the link "Edit" within "#review_1 > .metadata"
        And the "#review_2 .author" element should contain "Peach"
        And the "Edit" link within "#review_2 > .metadata" should point to "/reviews/edit/2"
        And I should not see the link "Edit" within "#review_3 > .metadata"

    @wip
    Scenario: The review author can edit the review text
        And I am logged in as "Peach" with "test"
        When I am on "/stories/view/1"
        Then I should not see the link "Edit" within "#review_1 > .metadata"
        And I follow "Edit" within "#review_2 > .metadata"
        Then I should see the field "Text" within "#review_2"
        When I fill in "Text" with "Changed content"
        And I press "Submit"
        Then I should be on "/stories/view/1"
        And the "#review_2 .text" element should contain "Changed content"


