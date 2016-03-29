# Server Nginx or Apache
namespace :server do

  desc "Server restart"
  task :restart do
    on roles(:app) do
      if test("[ -f /etc/init.d/nginx ]")
        sudo :service, :nginx, :restart
      elsif test("[ -f /etc/init.d/apache2 ]")
        sudo :service, :apache2, :restart
      end
    end
  end

  desc "Server start"
  task :start do
    on roles(:app) do
      if test("[ -f /etc/init.d/nginx ]")
        sudo :service, :nginx, :start
      elsif test("[ -f /etc/init.d/apache2 ]")
        sudo :service, :apache2, :start
      end
    end
  end

  desc "Server stop"
  task :stop do
    on roles(:app) do
      if test("[ -f /etc/init.d/nginx ]")
        sudo :service, :nginx, :stop
      elsif test("[ -f /etc/init.d/apache2 ]")
        sudo :service, :apache2, :stop
      end
    end
  end

end
