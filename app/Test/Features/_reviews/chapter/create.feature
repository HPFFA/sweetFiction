@review @test
Feature: User want to add reviews to stories

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

    Scenario: Add the first review to a story as anonymous user
        Given I am on "/stories/view/1/chapters/view/1"
        When I fill in "User Name" within ".review_form" with "A guest"
        And I fill in "Text" within ".review_form" with "Some text to test"
        And I press "Submit"
        Then I should be on "/stories/view/1/chapters/view/1"
        And the "#flashMessage" element should contain "The review has been saved"
        And the "#review_1 .author" element should contain "A guest"
        And the "#review_1 .text" element should contain "Some text to test"

    Scenario: Add the first review to a story as registered user
        Given I am logged in as "Luigi" with "test"
        And I am on "/stories/view/1/chapters/view/1"
        Then I should not see an "User Name" field
        When I fill in "Text" within ".review_form" with "Some text of a registered user"
        And I press "Submit"
        Then I should be on "/stories/view/1/chapters/view/1"
        And the "#flashMessage" element should contain "The review has been saved"
        And the "#review_1 .author" element should contain "Luigi"
        And the "Luigi" link within "#review_1 .author" should point to "/users/view/2"
        And the "#review_1 .text" element should contain "Some text of a registered user"

    Scenario Outline: Denial of creating a review as unregistered user
        Given I am on "/stories/view/1/chapters/view/1"
        When I fill in "User Name" within ".review_form" with "<user>"
        And I fill in "Text" within ".review_form" with "<text>"
        And I press "Submit"
        Then I should be on "/stories/reviews/1/add/0"
        And the "#flashMessage" element should contain "The review could not be saved. Please, try again."
        And the ".error-message" element should contain "<message>"
        And the "<restored_field>" field should contain "<restored_value>"
        When I fill in "User Name" within ".review_form" with "Valid"
        And I fill in "Text" within ".review_form" with "..."
        And I press "Submit"
        Then I should be on "/stories/view/1/chapters/view/1"
        And there should be a "Review":
            | user_name | text |
            | Valid     | ...  |

        Examples:
            | restored_field | restored_value | user  | text | message                                                 |
            | Text           | ...            |       | ...  | As guest you need to specify a username.                |
            | Text           | ...            | Peach | ...  | The name is already in use and cannot be used as guest. |
            | User Name      | Peach          | Peach | ...  | The name is already in use and cannot be used as guest. |
            | User Name      | You            | You   |      | The text cannot be empty.                               |

    Scenario: Denial of creating a review as registered user
        Given I am logged in as "Luigi" with "test"
        And I am on "/stories/view/1/chapters/view/1"
        And I press "Submit"
        Then I should be on "/stories/reviews/1/add/0"
        And the "#flashMessage" element should contain "The review could not be saved. Please, try again."
        And the ".error-message" element should contain "The text cannot be empty."
        And I fill in "Text" within ".review_form" with "..."
        And I press "Submit"
        Then I should be on "/stories/view/1/chapters/view/1"
        And there should be a "Review":
            | user_id | text |
            | 2       | ...  |

