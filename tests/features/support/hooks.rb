# hack to include files relative to this one
$LOAD_PATH << File.dirname(__FILE__)

require 'config'

Before do
    visit('/debug/clear');
end
# change the condition to fit your setup
if Capybara.current_driver == :selenium
  require 'headless'

  headless = Headless.new
  headless.start
end
