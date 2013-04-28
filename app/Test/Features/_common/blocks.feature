@blocks
Feature: Users want to see important things

    Background:
        Given there is a "User":
            | id | name  | email         | password | confirmation |
            | 1  | Peach | p@example.com | test     | test         |
            | 1  | Luigi | l@example.com | test     | test         |
        And there is a "Story":
            | id | user_id | title        | completed |
            | 1  | 1       | First Story  | 0         |
            | 2  | 2       | Second Story | 1         |
        And there is a "StoryChapter":
            | id | user_id | story_id | chapter_number | title            | text                     |
            | 1  | 1       | 1        | 1              | First chapter    | Some text for the first  |
            | 2  | 1       | 1        | 2              | Second chapter   | Some text for the second |
            | 3  | 1       | 1        | 3              | Third chapter    | Some text for the third  |
            | 4  | 2       | 2        | 1              | First chapter    | Some text for the third  |

    Scenario: The layout should show recent stories
        Given I am on "/"
        Then I should see "Recent Stories" in the "#recent_stories" element
        Then the "First Story" link within "#recent_stories" should point to "/stories/view/1"
        Then the "Second Story" link within "#recent_stories" should point to "/stories/view/2"
