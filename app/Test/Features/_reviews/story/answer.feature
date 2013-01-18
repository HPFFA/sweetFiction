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
         Given there is a "Review":
            | id | parent_id | reference_id | reference_type | user_id | user_name | text             |
            | 1  | 0         | 1            | story          | 0       | Anonymous | First story 1    |
            | 2  | 1         | 1            | story          | 2       |           | First story 1.1  |
            | 3  | 0         | 1            | story          | 0       | Guest     | First story 2    |
            | 4  | 0         | 2            | story          | 0       | Guest     | Other story      |

    Scenario: Seeing the possible answering forms for guest users
        Given I am on "/stories/view/1"
        Then I should see 4 ".review_form" elements
        And I should see a "#review_0_reply" element
        And I should see a "#review_1_reply" element
        And I should see a "#review_2_reply" element
        And I should see a "#review_3_reply" element

    Scenario: Seeing the possible answering forms as not-author - no possiblity for doppel posts
        Given I am logged in as "Luigi" with "test"
        And I am on "/stories/view/1"
        Then I should see 3 ".review_form" elements
        And I should see a "#review_0_reply" element
        And I should see a "#review_1_reply" element
        But I should not see a "#review_2_reply" element
        And I should see a "#review_3_reply" element

    Scenario: Seeing the possible answering forms as author
        Given I am logged in as "Peach" with "test"
        And I am on "/stories/view/1"
        Then I should see 3 ".review_form" elements
        And I should not see a "#review_0_reply" element
        And I should see a "#review_1_reply" element
        And I should see a "#review_2_reply" element
        And I should see a "#review_3_reply" element