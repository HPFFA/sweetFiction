require 'capybara' 


module NavigationHelpers

	def application_paths(page_name)
		case page_name
		when /home page/
        '/'
    when /users/
        '/users'
    else
      begin
        page_name =~ /the (.*) page/
        path_components = $1.split(/\s+/)
        self.send(path_components.push('path').join('_').to_sym)
      rescue Object => e
        raise "Can't find mapping from \"#{page_name}\" to a path.\n" +
          "Now, go and add a mapping in #{__FILE__}"
      end
    end
	end
  # Maps a name to a path. Used by the
  #
  #   When /^I go to (.+)$/ do |page_name|
  #
  # step definition in web_steps.rb
  #
  def path_to(page_name)
		return Capybara.app_host + application_paths(page_name)
	end
end
World(NavigationHelpers)
