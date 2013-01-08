@chapter
Feature: Add chapter to existing story

    Background:
        Given there is a "User":
            | id | name  | email         | password | confirmation |
            | 1  | Peach | p@example.com | test     | test         |
        And there is a "Story":
            | id | user_id | title            |
            | 1  | 1       | Predefined Story |
        And there is a "StoryChapter":
            | id | user_id | story_id | chapter_number | title              | text |
            | 1  | 1       | 1        | 1              | Predefined chapter | ...  |

    Scenario: Access the create chapter page
        Given I am logged in as "Peach" with "test"
        And I am on "/stories/view/1"
        And I follow "Add Chapter" within ".actions"
        Then I should be on "/stories/edit/1/chapters/add"
        And I should see an "#story_form" element
        And I should see an "#chapter_form" element

    Scenario: Add a chapter to a story
        Given I am logged in as "Peach" with "test"
        And I am on "/stories/edit/1/chapters/add"
        When I check "Completed"
        And I fill in "Title" with "The second chapter"
        And I fill in "Remarks" with "Newly created"
        And I fill in "Prologue" with "New prologue"
        And I fill in "Epilogue" with "New epilogue"
        And I fill in "Text" with "..."
        And I press "Submit"
        Then I should be on "/stories/view/1"
        And the "#story_completed" element should contain "Completed"
        When I follow "The second chapter" within "#story_chapter_2"
        And the "#story_title" element should contain "Predefined story"
        And the "#chapter_title" element should contain "The second chapter"
        And the "#chapter_number" element should contain "2"
        And the "#chapter_author" element should contain "Peach"
        And the "#chapter_remarks" element should contain "Newly created"
        And the "#chapter_prologue" element should contain "New prologue"
        And the "#chapter_epilogue" element should contain "New epilogue"
        And the "#chapter_text" element should contain "..."
