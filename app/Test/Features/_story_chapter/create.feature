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
        And I am on "/stories/edit/1"
        And I follow "Add Chapter"
        Then I should be on "/story_chapters/add/1"
        And I should see an "#story_form" element
        And I should see an "#chapter_form" element

    Scenario: Add a chapter to a story
        Given I am logged in as "Peach" with "test"
        And I am on "/story_chapters/add/1"
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
        And the ".story_title" element should contain "Predefined story"
        And the "#chapter_title" element should contain "The second chapter"
        And the "#chapter_number" element should contain "2"
        #And the "#chapter_author" element should contain "Peach" # hidden because author of chapter are identical with story
        And I should not see a "#chapter_author" element
        And the "#chapter_remarks" element should contain "Newly created"
        And the "#chapter_prologue" element should contain "New prologue"
        And the "#chapter_epilogue" element should contain "New epilogue"
        And the "#chapter_text" element should contain "..."

    Scenario: Denial of creating an incomplete chapter
        Given I am logged in as "Peach" with "test"
        And I am on "/story_chapters/add/1"
        When I check "Completed"
        And I fill in "Remarks" with "..."
        And I press "Submit"
        Then I should be on "/story_chapters/add/1"
        And I should see "The chapter could not be saved. Please, try again."
        And the ".error-message" element should contain "The text cannot be empty."
        And the "Remarks" field within "#chapter_form" should contain "..."
        And there should be no "StoryChapter":
            | remarks |
            | ...     |

    Scenario: Denial of creating chapters for guests
        And I am on "/story_chapters/add/1"
        Then I should see "You are not authorized to access that location."
        When I send a POST request to "/story_chapters/add/1" with:
            | some_data  |
            | irrelevant |
        Then I should see "You are not authorized to access that location."
        And there should be a "Story"
        And there should be a "StoryChapter"

    Scenario: Denial of creating chapters for non-owners
        Given there is a "User":
            | id | name  | email         | password | confirmation |
            | 2  | Luigi | l@example.com | test     | test         |
        And I am logged in as "Luigi" with "test"
        Then I should not be allowed to go to "/story_chapters/add/1"
        When I send a POST request to "/story_chapters/add/1" with:
            | some_data  |
            | irrelevant |
        Then the response status code should be 403
        And there should be a "Story"
        And there should be a "StoryChapter"