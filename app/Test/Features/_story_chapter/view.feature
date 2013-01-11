@chapter
Feature: View chapters

    Background:
        Given there is a "User":
            | id | name  | email         | password | confirmation |
            | 1  | Peach | p@example.com | test     | test         |
            | 2  | Luigi | l@example.com | test     | test         |
        And there is a "Story":
            | id | user_id | title                    | summary                                           | completed |
            | 1  | 1       | Peach's first story |                                                        | 0         |
            | 2  | 2       | Luigi's first story | Luigi tells us something very important about his life | 1         |
        And there is a "StoryChapter":
            | id | user_id | story_id | title             | text              | chapter_number |
            | 1  | 1       | 1        | First chapter     | ...               | 1              |
            | 2  | 1       | 1        | Second chapter    | Some text to show | 2              |
            | 3  | 1       | 1        | Third chapter     | ...               | 3              |
            | 4  | 1       | 1        | Forth chapter     | ...               | 4              |
            | 5  | 2       | 2        | Luigi's one shot  | ...               | 1              |

    Scenario: Access a chapter
        Given I am on "/stories/view/1"
        When I follow "Second chapter" within "#story_chapter_2"
        Then I should be on "/stories/view/1/chapters/view/2"
        And the ".story_title" element should contain "Peach's first story"
        And the "#chapter_title" element should contain "Second chapter"
        And the "#chapter_text" element should contain "Some text to show"
        And I should see the link "1. First chapter"
        And I should see the link "3. Third chapter"

    Scenario: Navigate through chapters of a story
        When I am on "/stories/view/1/chapters/view/2"
        When I follow "1. First chapter"
        Then I should be on "/stories/view/1/chapters/view/1"
        When I follow "2. Second chapter"
        Then I should be on "/stories/view/1/chapters/view/2"
        When I am on "/stories/view/1/chapters/view/4"
        Then I should see the link "3. Third chapter"
