@review @test
Feature: View exiting reviews of a story

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

    Scenario: View the review tree of a story
        Given there is a "Review":
            | id | parent_id | reference_id | reference_type | user_id | user_name | text               |
            | 1  | 0         | 1            | story_chapter  | 0       | Anonymous | First chapter 1    |
            | 2  | 1         | 1            | story_chapter  | 1       |           | First chapter 1.1  |
            | 3  | 0         | 1            | story_chapter  | 0       | Guest     | First chapter 2    |
            | 4  | 0         | 2            | story_chapter  | 0       | Guest     | Other chapter      |
        When I am on "/stories/view/1/chapters/view/1"
        Then the "#review_1 .author" element should contain "Anonymous"
        And the "#review_1 .text" element should contain "First story 1"
        And the "#review_2 .author" element should contain "Peach"
        And the "Peach" link within "#review_2 .author" should point to "/users/view/1"
        And the "#review_2 .text" element should contain "First story 1.1"
        And the "#review_3 .author" element should contain "Guest"
        And the "#review_3 .text" element should contain "First story 2"
        And I should not see "Other story"