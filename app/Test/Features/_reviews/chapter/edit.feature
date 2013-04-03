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
            | 2  | 1       | 2        | Other chapter | ...  |
        And there is a "Review":
            | id | parent_id | reference_id | reference_type | user_id | user_name | text               |
            | 1  | 0         | 1            | story_chapter  | 0       | Anonymous | First chapter 1    |
            | 2  | 1         | 1            | story_chapter  | 1       |           | First chapter 1.1  |
            | 3  | 0         | 1            | story_chapter  | 0       | Guest     | First chapter 2    |
            | 4  | 0         | 2            | story_chapter  | 0       | Guest     | Other chapter      |

    Scenario: Guest should not be able to edit reviews
        When I am on "/story_chapters/view/1/1"
        And I should not see the link "Edit"

    Scenario: The review author should have the possibility to change his/her review
        And I am logged in as "Peach" with "test"
        When I am on "/story_chapters/view/1/1"
        Then I should not see the link "Edit" within "#review_1 > .metadata"
        And the "#review_2 .author" element should contain "Peach"
        And I should see the link "Edit" within "#review_2 > .metadata"
        And I should not see the link "Edit" within "#review_3 > .metadata"

    Scenario: The review author can edit the review text
        And I am logged in as "Peach" with "test"
        When I am on "/story_chapters/view/1/1"
        Then I should not see the link "Edit" within "#review_1 > .metadata"
        And I follow "Edit" within "#review_2 > .metadata"
        Then I should see the field "Text" within "#review_2"
        When I fill in "Text" within "#review_2_edit_form" with "Changed content"
        And I press "Submit" within "#review_2_edit_form"
        Then I should be on "/story_chapters/view/1/1"
        And the "#review_2 .text" element should contain "Changed content"

    Scenario: No guest can edit a review
        When I send a POST request to "story_chapters/reviews/1/edit/1" with:
            | data[Review][user_name] | data[Review][text] |
            | irrelevant              | ...                |
        Then I should see "You are not authorized to access that location."

    Scenario: No user can edit a review of another user
        Given there is a "User":
            | id | name  | email         | password | confirmation |
            | 2  | Luigi | l@example.com | test     | test         |
        And I am logged in as "Luigi" with "test"
        When I send a POST request to "story_chapters/reviews/1/edit/1" with:
            | data[Review][user_name] | data[Review][text] |
            | irrelevant              | ...                |
        Then the response status code should be 403
