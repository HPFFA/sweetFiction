Feature: Open the home page
    In order to visit the archiv
    I want to see a homepage containing the most important components

Scenario: Visit the homepage
    Given I am on the home page
    Then I should see "Anmelden"
    And I should see "Navigation"
    And I should see "Willkommen im HPFFA"
    
@javascript
Scenario: Sample javascript test
