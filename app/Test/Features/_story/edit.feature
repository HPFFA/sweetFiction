@story
Feature: Edit an existing story
    In order to manage stories, the user wants to edit his/her stories

    Background:
        Given there is a "User":
            | id | name  | email         | password | confirmation |
            | 1  | Peach | p@example.com | test     | test         |
        And there is a "Story":
            | id | user_id | title            |
            | 1  | 1       | Predefined Story |
        And there is a "StoryChapter":
            | id | user_id | story_id | title              | text |
            | 1  | 1       | 1        | Predefined chapter | ...  |

    Scenario: Access the edit story page
        Given I am logged in as "Peach" with "test"
        And I am on "/stories/view/1"
        And I follow "Edit Story" within ".actions"
        Then I should be on "/stories/edit/1"
        Then I should see an "#story_form" element

    Scenario: Editing the user's story
        Given I am logged in as "Peach" with "test"
        And I am on "/stories/edit/1"
        Then the "Title" field should contain "Predefined Story"
        When I fill in "Title" with "Changed story"
        And I fill in "Prologue" with "Changed prologue"
        And I fill in "Epilogue" with "Changed epilogue"
        And I fill in "Summary" with "Changed summary"
        And I check "Completed"
        And I press "Submit"
        Then I should be on "/stories/view/1"
        And the "#story_title" element should contain "Changed story"
        And the "#story_prologue" element should contain "Changed prologue"
        And the "#story_epilogue" element should contain "Changed epilogue"
        And the "#story_summary" element should contain "Changed summary"
        And the "#story_completed" element should contain "Completed"

    Scenario: Denial of save for invalid edited story
        Given I am logged in as "Peach" with "test"
        And I am on "/stories/edit/1"
        Then the "Title" field should contain "Predefined Story"
        When I fill in "Title" with ""
        And I fill in "Prologue" with "Changed prologue"
        And I press "Submit"
        Then I should be on "/stories/edit/1"
        And I should see "The story could not be saved. Please, try again."
        And the ".error-message" element should contain "The title cannot be empty."
        And the "Prologue" field should contain "Changed prologue"

    Scenario: Denial of editing stories for guests
        When I go to "/stories/edit/1"
        Then I should see "You are not authorized to access that location."
        When I send a POST request to "stories/edit/1" with:
            | some_data  |
            | irrelevant |
        Then I should see "You are not authorized to access that location."

    Scenario: Denial of editing stories of other users
        Given there is a "User":
            | id | name  | email         | password | confirmation |
            | 2  | Luigi | l@example.com | test     | test         |
        And I am logged in as "Luigi" with "test"
        Then I should not be allowed to go to "/users/edit/1"
        When I send a POST request to "stories/edit/1" with:
            | some_data  |
            | irrelevant |
        Then the response status code should be 403