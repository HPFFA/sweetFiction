@chapter
Feature: Edit a chapter of a story

    Background:
        Given there is a "User":
            | id | name  | email         | password | confirmation |
            | 1  | Peach | p@example.com | test     | test         |
        And there is a "Story":
            | id | user_id | title            | completed |
            | 1  | 1       | Predefined Story | 0         |
        And there is a "StoryChapter":
            | id | user_id | story_id | chapter_number | title            | text                     |
            | 1  | 1       | 1        | 1              | First chapter    | Some text for the first  |
            | 2  | 1       | 1        | 2              | Second chapter   | Some text for the second |
            | 3  | 1       | 1        | 3              | Third chapter    | Some text for the third  |

    Scenario: Access the edit page of a chapter
        Given I am logged in as "Peach" with "test"
        And I am on "/stories/edit/1"
        And I follow "Edit" within "#story_chapter_2"
        Then I should be on "/stories/edit/1/chapters/edit/2"
        And I should see an "#story_form" element
        And I should see an "#chapter_form" element

    Scenario: Edit a chapter
        Given I am logged in as "Peach" with "test"
        And I am on "/stories/edit/1/chapters/edit/2"
        When I check "Completed"
        And I fill in "Title" with "Changed chapter"
        And I fill in "Remarks" with "Remarks changed"
        And I fill in "Prologue" with "Prologue changed"
        And I fill in "Epilogue" with "Epilogue changed"
        And I fill in "Text" with "..."
        And I press "Submit"
        Then I should be on "/stories/view/1"
        And the "#story_completed" element should contain "Completed"
        When I follow "Changed chapter" within "#story_chapter_2"
        And the "#story_title" element should contain "Predefined story"
        And the "#chapter_title" element should contain "Changed chapter"
        And the "#chapter_number" element should contain "2"
        And the "#chapter_author" element should contain "Peach"
        And the "#chapter_remarks" element should contain "Remarks changed"
        And the "#chapter_prologue" element should contain "Prologue changed"
        And the "#chapter_epilogue" element should contain "Epilogue changed"
        And the "#chapter_text" element should contain "..."
        And there should be 3 "StoryChapter":
            | story_id |
            | 1        |
        And there should be a "Story":
            | id |
            | 1  |

    Scenario: Try to acess an invalid story - chapter via url
        Given there is a "Story":
            | id | user_id | title            | completed |
            | 2  | 1       | Another Story    | 1         |
        And there is a "StoryChapter":
            | id | user_id | story_id | chapter_number | title            | text                     |
            | 4  | 1       | 2        | 1              | Another chapter  | Some text for the first  |
        Given I am logged in as "Peach" with "test"
        And I am on "/stories/edit/2/chapters/edit/1"
        Then I should see "Invalid chapter"

    Scenario: Edit a chapter of a completed story
        Given there is a "Story":
            | id | user_id | title            | completed |
            | 2  | 1       | Another Story    | 1         |
        And there is a "StoryChapter":
            | id | user_id | story_id | chapter_number | title            | text                     |
            | 4  | 1       | 2        | 1              | Another chapter  | Some text for the first  |
        Given I am logged in as "Peach" with "test"
        And I am on "/stories/edit/2/chapters/edit/4"
        Then the "Completed" checkbox should be checked
        When I uncheck "Completed"
        And I fill in "Title" with "Changed chapter"
        And I fill in "Text" with "..."
        And I press "Submit"
        Then I should be on "/stories/view/2"
        And I should not see a "#story_completed" element
        When I follow "Changed chapter" within "#story_chapter_4"
        And the "#story_title" element should contain "Another story"
        And the "#chapter_title" element should contain "Changed chapter"
        And the "#chapter_number" element should contain "1"
        And the "#chapter_author" element should contain "Peach"
        And the "#chapter_text" element should contain "..."
        And there should be 1 "StoryChapter":
            | story_id |
            | 2        |
        And there should be a "Story":
            | id |
            | 2  |

    Scenario: Denial of editing to an incomplete chapter
        Given I am logged in as "Peach" with "test"
        And I am on "/stories/edit/1/chapters/add"
        When I check "Completed"
        And I fill in "Text" with ""
        And I fill in "Remarks" with "..."
        And I press "Submit"
        Then I should be on "/stories/edit/1/chapters/add"
        And I should see "The chapter could not be saved. Please, try again."
        And the ".error-message" element should contain "The text cannot be empty."
        And the "Remarks" field within "#chapter_form" should contain "..."
        And there should be no "StoryChapter":
            | text |
            |      |

    Scenario: Denial of editing chapters for guests
        And I am on "/stories/edit/1/chapters/edit/1"
        Then I should see "You are not authorized to access that location."
        When I send a POST request to "/stories/edit/1/chapters/edit/1" with:
            | some_data  |
            | irrelevant |
        Then I should see "You are not authorized to access that location."
        And there should be a "Story"
        And there should be 3 "StoryChapter"

    Scenario: Denial of editing chapters for non-owners
        Given there is a "User":
            | id | name  | email         | password | confirmation |
            | 2  | Luigi | l@example.com | test     | test         |
        And I am logged in as "Luigi" with "test"
        Then I should not be allowed to go to "/stories/edit/1/chapters/edit/1"
        When I send a POST request to "/stories/edit/1/chapters/edit/1" with:
            | some_data  |
            | irrelevant |
        Then the response status code should be 403
        And there should be a "Story"
        And there should be 3 "StoryChapter"
