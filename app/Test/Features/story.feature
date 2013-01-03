@story
Feature: Management of stories

 Background:
        Given there is a "User":
            | id | name  | email         | password | confirmation |
            | 1  | Peach | p@example.com | test     | test         |

  Scenario: Access the create story page
    Given I am logged in as "Peach" with "test"
    And I follow "Create Story" within ".actions"
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
    When I am on the "story list" page
    Then I should see "The first story"
    When I follow "The first story"
    Then I should be on the "story detail 1" page
    And the "#story_title" element should contain "The first story"
    And the "#story_author" element should contain "Peach"
    And the "#story_summary" element should contain "A short summary"
    And the "#story_prologue" element should contain "Something to say before the story starts ..."
    And the "#story_epilogue" element should contain "Something to say after the story ends ..."
    When I follow "The first chapter" within "#story_chapter_1"
    Then I should be on the "chapter detail 1" page
    And the "#story_title" element should contain "The first story"
    And the "#chapter_title" element should contain "The first chapter"
    And the "#chapter_number" element should contain "1"
    And the "#chapter_author" element should contain "Peach"
    And the "#chapter_remarks" element should contain "Some great remarks ..."
    And the "#chapter_prologue" element should contain "Something to say before the chapter starts ..."
    And the "#chapter_epilogue" element should contain "Something to say after the chapter ends ..."
    And the "#chapter_text" element should contain "Some very short chapter text ..."
