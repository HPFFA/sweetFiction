@story
Feature: Management of stories

    Background:
        Given there is a "User":
            | id | name  | email         | password | confirmation |
            | 1  | Peach | p@example.com | test     | test         |

    Scenario: Access the create story page
        Given I am logged in as "Peach" with "test"
        And I am on "/users/view/1"
        And I follow "New Story" within ".actions"
        Then I should be on "/stories/add"
        Then I should see an "#story_form" element
        And I should see an "#chapter_form" element

    @wip
    Scenario: Creating a story as user
        Given I am logged in as "Peach" with "test"
        And I am on "/stories/add"
        When I fill in "Title" within "#story_form" with "The first story"
        And I fill in "Summary" within "#story_form" with "A short summary ..."
        And I fill in "Prologue" within "#story_form" with "Something to say before the story starts ..."
        And I fill in "Epilogue" within "#story_form" with "Something to say after the story ends ..."
        And I fill in "Title" within "#chapter_form" with "The first chapter"
        And I fill in "Remarks" within "#chapter_form" with "Some great remarks ..."
        And I fill in "Prologue" within "#chapter_form" with "Something to say before the chapter starts ..."
        And I fill in "Epilogue" within "#chapter_form" with "Something to say after the chapter ends ..."
        And I fill in "Text" within "#chapter_form" with "Some very short chapter text ..."
        And I press "Submit"
        Then show me the page
        When I am on "/stories"
        Then I should see "The first story"
        When I follow "The first story"
        Then I should be on "/stories/view/1"
        And the "#story_title" element should contain "The first story"
        And the "#story_author" element should contain "Peach"
        And the "#story_summary" element should contain "A short summary"
        And the "#story_prologue" element should contain "Something to say before the story starts ..."
        And the "#story_epilogue" element should contain "Something to say after the story ends ..."
        When I follow "The first chapter" within "#story_chapter_1"
        Then I should be on "/story_chapters/view/1"
        And the "#story_title" element should contain "The first story"
        And the "#chapter_title" element should contain "The first chapter"
        And the "#chapter_number" element should contain "1"
        And the "#chapter_author" element should contain "Peach"
        And the "#chapter_remarks" element should contain "Some great remarks ..."
        And the "#chapter_prologue" element should contain "Something to say before the chapter starts ..."
        And the "#chapter_epilogue" element should contain "Something to say after the chapter ends ..."
        And the "#chapter_text" element should contain "Some very short chapter text ..."

    Scenario: Denial of creating an incomplete story
        When I am logged in as "Peach" with "test"
        And I am on "/stories/add"
        And I fill in "Summary" within "#story_form" with "..."
        And I press "Submit"
        And there should be no "Story"
        And there should be no "StoryChapter"
        Then I should be on "/stories/add"
        And I should see "The story could not be saved. Please, try again."
        And the ".error-message" element should contain "The title cannot be empty."
        And the "Summary" field within "#story_form" should contain "..."

    Scenario: Denial of creating an story without a chapter
        When I am logged in as "Peach" with "test"
        And I am on "/stories/add"
        And I fill in "Title" within "#story_form" with "Valid, but should not be created"
        And I fill in "Title" within "#chapter_form" with "Invalid, should prevent creation"
        And I fill in "Prologue" within "#chapter_form" with "..."
        And I press "Submit"
        And there should be no "Story"
        And there should be no "StoryChapter"
        Then I should be on "/stories/add"
        And I should see "The story could not be saved. Please, try again."
        And the ".error-message" element should contain "The text cannot be empty."
        And the "Title" field within "#story_form" should contain "Valid, but should not be created"
        And the "Title" field within "#chapter_form" should contain "Invalid, should prevent creation"
        And the "Prologue" field within "#chapter_form" should contain "..."

    Scenario: Denial of creating stories for guests
        When I go to "/stories/add"
        Then I should see "You are not authorized to access that location."
        When I send a POST request to "stories/add" with:
            | some_data  |
            | irrelevant |
        Then I should see "You are not authorized to access that location."
        And there should be no "Story"
        And there should be no "StoryChapter"
