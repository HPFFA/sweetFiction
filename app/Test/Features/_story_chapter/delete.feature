@chapter
Feature: Deletion of chapters

    Background:
        Given there is a "User":
            | id | name  | email         | password | confirmation |
            | 1  | Peach | p@example.com | test     | test         |
        And there is a "Story":
            | id | user_id | title            |
            | 1  | 1       | Predefined story |
        And there is a "StoryChapter":
            | id | user_id | story_id | title          | text |
            | 1  | 1       | 1        | First chapter  | ...  |
            | 2  | 1       | 1        | Second chapter | ...  |

    @javascript
    Scenario: Delete a chapter as owner
        When I am logged in as "Peach" with "test"
        And I am on "/stories/edit/1"
        And I follow "Delete" within "#story_chapter_2"
        And I confirm my action
        Then the "#flashMessage" element should contain "Chapter deleted"
        And I should be on "/stories/edit/1"
        And there should be a "Story"
        And there should be a "StoryChapter":
            | title         |
            | First chapter |
        And there should be no "StoryChapter":
            | title          |
            | Second chapter |

    @javascript
    Scenario: Delete the chapter as owner will drop the story too
        When I am logged in as "Peach" with "test"
        And I am on "/stories/edit/1"
        And I follow "Delete" within "#story_chapter_1"
        And I confirm my action
        Then the "#flashMessage" element should contain "Chapter deleted"
        And I should be on "/stories/edit/1"
        And I follow "Delete" within "#story_chapter_2"
        And I confirm my action
        Then the "#flashMessage" element should contain "Story with last chapter deleted"
        And I should be on "/stories"
        And there should be no "Story"
        And there should be no "StoryChapter"

    Scenario: Deny deletion of a story for guests
        When I send a POST request to "/stories/edit/1/chapters/delete/1" with:
            | id |
            | 1  |
        Then I should not see "Chapter deleted"
        Then I should see "You are not authorized to access that location."
        And there should be a "Story":
            | title            |
            | Predefined story |
        And there should be a "StoryChapter":
            | title          |
            | First chapter  |
            | Second chapter |

    Scenario: Deny deletion of a story by non-owners
        Given there is a "User":
            | id | name  | email         | password | confirmation |
            | 2  | Luigi | l@example.com | test     | test         |
        When I am logged in as "Luigi" with "test"
        When I send a POST request to "/stories/edit/1/chapters/delete/1" with:
            | id |
            | 1  |
        Then I should not see "Chapter deleted"
        But I should see "Forbidden"
        And there should be a "Story":
            | title            |
            | Predefined story |
        And there should be a "StoryChapter":
            | title          |
            | First chapter  |
            | Second chapter |

