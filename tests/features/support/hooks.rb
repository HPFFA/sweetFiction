Before do
    #visit('/_reset')
end
# change the condition to fit your setup
if Capybara.current_driver == :selenium
  require 'headless'

  headless = Headless.new
  headless.start
end
