@story
Feature: Deletion of stories

    Background:
        Given there is a "User":
            | id | name  | email         | password | confirmation |
            | 1  | Peach | p@example.com | test     | test         |
        And there is a "Story":
            | id | user_id | title            |
            | 1  | 1       | Predefined story |
        And there is a "StoryChapter":
            | id | user_id | story_id | title              | text |
            | 1  | 1       | 1        | Predefined chapter | ...  |

    @javascript
    Scenario: Delete a story as owner
        When I am logged in as "Peach" with "test"
        And I am on "/stories/edit/1"
        And I follow "Delete"
        And I confirm my action
        Then the "#flashMessage" element should contain "Story deleted"
        And I should be on "/stories"
        And there should be no "Story":
            | title            |
            | Predefined story |
        And there should be no "StoryChapter":
            | title              |
            | Predefined chapter |

    Scenario: Deny deletion of other story
        Given there is a "User":
            | id | name  | email         | password | confirmation |
            | 2  | Luigi | l@example.com | test     | test         |
        When I am logged in as "Luigi" with "test"
        When I send a POST request to "/stories/delete/1" with:
            | id |
            | 1  |
        Then I should not see "Story deleted"
        But I should see "Forbidden"
        And there should be a "Story":
            | title            |
            | Predefined story |
        And there should be a "StoryChapter":
            | title              |
            | Predefined chapter |

