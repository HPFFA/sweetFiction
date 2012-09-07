module NavigationHelpers
  # Maps a name to a path. Used by the
  #
  #   When /^I go to (.+)$/ do |page_name|
  #
  # step definition in web_steps.rb
  #
  def path_to(page_name)
    case page_name

    # Add more mappings here.
    # Here is an example that pulls values out of the Regexp:
    #
    #   when /^(.*)'s profile page$/i
    #     user_profile_path(User.find_by_login($1))
    # Add more page name => path mappings here

    when /the home\s?page/
        '/'
    when /index page/
        '/'
     when /the (login|sign in|signup) page/
      new_user_session_path
    when /customer overview/
      '/customers'
    when /create customer/
      '/customers/new'
    when /update customer/
      '/customers/1/edit'
    when /product overview/
      '/products'
    when /create product/
      '/products/new'
    when /update product/
      '/products/1/edit'
    when /update sales order/
      '/salesOrders/1/edit'
    when /create sales order/
      '/salesOrders/new'
    when /sales order overview/
      '/salesOrders'
    when /release sales order/
	  '/salesOrders/releasableOrders'
	when /post goods issue/
	  '/salesOrders/releasedOrders'
	when /post customer invoice/
	  '/salesOrders/deliveredOrders'
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
end
World(NavigationHelpers)