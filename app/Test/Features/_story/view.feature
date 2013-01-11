@story
Feature: View stories

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
            | id | user_id | story_id | title             | text |
            | 1  | 1       | 1        | First chapter     | ...  |
            | 2  | 1       | 1        | Second chapter    | ...  |
            | 3  | 2       | 2        | Luigi's one shot  | ...  |

    Scenario: Access a story
        Given I am on "/stories"
        Then I should see "Peach's first story"
        When I follow "Peach's first story" within "#story_1"
        Then I should be on "/stories/view/1"

    Scenario Outline: Sort the entries
        Given I am on "/stories"
        And I follow "<link>" within ".sorting"
        Then I should be on "<url>"

        Examples:
            | link      | url                                         |
            | Title     | /stories/index/sort:title/direction:asc     |
            | User      | /stories/index/sort:user_id/direction:asc   |
            | Updated   | /stories/index/sort:updated/direction:asc   |
            | Completed | /stories/index/sort:completed/direction:asc |
    @wip
    Scenario: View a story as owner
        Given I am on "/stories/view/1"
        Then I should see the link "Edit Story"
        And the "#story_title" element should contain "Peach's first story"
        And the "#story_author" element should contain "Peach"
        And I should see 2 ".story_chapter" elements
