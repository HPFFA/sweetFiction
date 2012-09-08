require 'uri'
require 'cgi'

Given /^I am on the home page$/ do
  visit('/')
end

Given /^I have entered "([^"]*)" into the "([^"]*)" field$/ do |text, field|
  fill_in field, :with => text
  trigger_change(field)
end

When /^I click the "([^"]*)" button$/ do |button_text|
  click_button button_text
end

Then /^I should see "([^"]*)"$/ do |text|
  page.should have_content(text)
end

Then /^I should not see "([^"]*)"$/ do |text|
  page.should have_no_content(text)
end

When /^(?:|I )trigger "([^"]*)"$/ do |link|
  click_link(link)
end

When /^(?:|I )press "([^"]*)"$/ do |button|
  click_button(button)
end

When /^(?:|I )follow "([^"]*)"$/ do |link|
  click_link(link)
end

def trigger_change(field)
	page.execute_script('$("'+field+'").focusout()');
end


def trigger_check(field)
	page.execute_script('$("'+field+'").checked()');
end


def fill_in_fixture(hsh)
  hsh.each do |k,v|
    if ["Payment Terms", "Priority"].include?(k)
      step %{I select "#{v[0]}" from "#{k}"}
    else
      step %{I fill in "#{k}" with "#{v[0]}"}
    end
  end
end
