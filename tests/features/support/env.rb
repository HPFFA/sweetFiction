begin require 'rspec/expectations'; rescue LoadError; require 'spec/expectations'; end
require 'capybara' 
require 'capybara/dsl' 
require 'capybara/cucumber'
require 'capybara/mechanize/cucumber'

Capybara.run_server = false

Capybara.default_selector   = :css
#mechanize supports fast non-javascript tests
Capybara.default_driver		= :mechanize
# uses Iceweasel
#Capybara.javascript_driver  = :selenium
# uses Chromium
Capybara.javascript_driver     = :selenium_chrome
Capybara.default_wait_time  = 1

Capybara.register_driver :rack_test do |app|
  Capybara::RackTest::Driver.new(app, :browser => :chrome)
end

Capybara.register_driver :selenium_chrome do |app| 
	Capybara::Selenium::Driver.new(app, :browser => :chrome) 
end 

Capybara.app_host = 'http://localhost/~logge002/HPFFA/archiv' 
World(Capybara) 
