Given /^I am on the "([^"]*)" page$/ do |page_name|
  visit path_to(page_name)
end

Then /^I should be on the "([^"]*)" page$/ do |page_name|
  #current_path = URI.parse(current_url).path
  current_path = current_url #we take the whole path since 
  if current_path.respond_to? :should
    current_path.should == path_to(page_name)
  else
    assert_equal path_to(page_name), current_path
  end
end

Then /^let me see the page$/ do
	ask('does that look right?')
end 

Then /^show me the page$/ do
  save_and_open_page
end
