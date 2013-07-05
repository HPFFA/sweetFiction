@editorial
Feature: As editor I want to view unpublished stories

    Background:
        Given there is a "Role":
            | id | name      |
            | 1  | user      |
            | 2  | editorial |
        And there is a "User":
            | name   | email         | password | confirmation |
            | Peach  | p@example.com | test     | test         |
            | E-Gadd | e@example.com | test     | test         |
            | Mario  | m@example.com | test     | test         |

        And there is a "UserRoleAssociation":
            | user_id | role_id |
            | 1       | 1       |
            | 2       | 1       |
            | 2       | 2       |
            | 3       | 1       |
            | 3       | 2       |
        And there is a "Editorial":
            | user_id | story_id | story_chapter_id | completed           | editor_id |
            | 1       | 1        | 1                | 2000-00-00 00:00:00 | 2         |
            | 1       | 1        | 2                |                     | 2         |
            | 1       | 1        | 3                |                     | 2         |
            | 2       | 2        | 4                |                     | 3         |
        And there is a "Story":
            | id | user_id | title                | summary                                                 | completed |
            | 1  | 1       | Peach's first story  |                                                         | 0         |
            | 2  | 2       | E-Gadd's first story | E-Gadd tells us something very important about his life | 1         |
        And there is a "StoryChapter":
            | id | user_id | story_id | chapter_number | title             | text |
            | 1  | 1       | 1        | 1              | First chapter     | ...  |
            | 2  | 1       | 1        | 2              | Second chapter    | ...  |
            | 3  | 1       | 1        | 3              | Third chapter     | ...  |
            | 4  | 2       | 2        | 1              | E-Gadd's one shot | ...  |

    Scenario: View stories in editorial
        Given I am logged in as "E-Gadd" with "test"
        And I am on "/editorials"
        Then I should see "Editorial"
        And the "Peach's first story" link within "#story_1" should point to "/editorials/view/story/1"
        And the "Second chapter" link within "#story_1 .unvalided" should point to "/editorials/view/story_chapter/2"
        And the "E-Gadd" link within "#story_1 .editor" should point to "/users/view/2"
        And the "Third chapter" link within "#story_1 .unvalided" should point to "/editorials/view/story_chapter/3"
        And the "E-Gadd" link within "#story_1 .editor" should point to "/users/view/2"
        And the "E-Gadd's first story" link within "#story_2" should point to "/editorials/view/story/2"
        And the "Mario" link within "#story_2 .editor" should point to "/users/view/3"

    @wip
    Scenario: Inspect story within editorial
        Given I am logged in as "E-Gadd" with "test"
        And I am on "/editorials"
        When I follow "Peach's first story" within "#story_1"
        Then I should be on "/editorials/view/story/1"
        And the "#center_content" element should contain "Peach's first story"
