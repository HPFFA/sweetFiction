Feature: Open the home page
    In order to visit the archiv
    I want to see a homepage containing the most important components

Scenario: Visit the homepage
    Given I am on the home page
    Then I should see "Register"
    And I should see "Menu"
    And I should see "Welcome"
    And I should see "Users"
    
#@javascript
#Scenario: Sample javascript test
