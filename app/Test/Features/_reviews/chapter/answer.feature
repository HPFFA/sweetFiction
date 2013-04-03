@review
Feature: Answering existing reviews

    Background:
        Given there is a "User":
            | id | name  | email         | password | confirmation |
            | 1  | Peach | p@example.com | test     | test         |
            | 2  | Luigi | l@example.com | test     | test         |
        And there is a "Story":
            | id | user_id | title            |
            | 1  | 1       | Predefined Story |
        And there is a "StoryChapter":
            | id | user_id | story_id | title              | text |
            | 1  | 1       | 1        | Predefined chapter | ...  |
            | 2  | 1       | 1        | Othe chapter       | ...  |
         Given there is a "Review":
            | id | parent_id | reference_id | reference_type | user_id | user_name | text               |
            | 1  | 0         | 1            | story_chapter  | 0       | Anonymous | First chapter 1    |
            | 2  | 1         | 1            | story_chapter  | 2       |           | First chapter 1.1  |
            | 3  | 0         | 1            | story_chapter  | 0       | Guest     | First chapter 2    |
            | 4  | 0         | 2            | story_chapter  | 0       | Guest     | Other chapter      |

    Scenario: Seeing the possible answering forms for guest users
        Given I am on "/story_chapters/view/1/1"
        Then I should see 4 ".review_form" elements
        And I should see a "#review_0_reply" element
        And I should see a "#review_1_reply" element
        And I should see a "#review_2_reply" element
        And I should see a "#review_3_reply" element

    Scenario: Answering to a given review as guest
        Given I am on "/story_chapters/view/1/1"
        When I fill in "User Name" within "#review_1_reply" with "Responder"
        And I fill in "Text" within "#review_1_reply" with "The newly added review"
        And I press "Submit" within "#review_1_reply"
        Then I should be on "/story_chapters/view/1/1"
        Then I should see a "#review_5" element
        And the "#review_5 .author" element should contain "Responder"
        And the "#review_5 .text" element should contain "The newly added review"

    Scenario: Seeing the possible answering forms as not-author - no possiblity for doppel posts
        Given I am logged in as "Luigi" with "test"
        And I am on "/story_chapters/view/1/1"
        Then I should see 3 ".review_form" elements
        And I should see a "#review_0_reply" element
        And I should see a "#review_1_reply" element
        But I should not see a "#review_2_reply" element
        And I should see a "#review_3_reply" element

    Scenario Outline: Answering to a given review as user
        Given I am logged in as "<user>" with "test"
        Given I am on "/story_chapters/view/1/1"
        And I fill in "Text" within "#review_<parent_id>_reply" with "The newly added review"
        And I press "Submit" within "#review_<parent_id>_reply"
        Then I should be on "/story_chapters/view/1/1"
        And there should be a "Review":
            | user_id   | reference_type | reference_id | parent_id   | text                   |
            | <user_id> | story_chapter  | 1            | <parent_id> | The newly added review |
        Then I should see a "#review_5" element
        And the "#review_<parent_id> #review_5 .author" element should contain "<user>"
        And the "#review_<parent_id> #review_5 .text" element should contain "The newly added review"

        Examples:
            | user  | user_id | parent_id |
            | Peach | 1       | 2         |
            | Luigi | 2       | 3         |

    Scenario: Seeing the possible answering forms as author
        Given I am logged in as "Peach" with "test"
        And I am on "/story_chapters/view/1/1"
        Then I should see 3 ".review_form" elements
        And I should not see a "#review_0_reply" element
        And I should see a "#review_1_reply" element
        And I should see a "#review_2_reply" element
        And I should see a "#review_3_reply" element

