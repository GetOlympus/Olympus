# Server Nginx or Apache
namespace :server do

  desc "Server restart"
  task :restart do
    as :root do
      if test("[ -f /etc/init.d/nginx ]")
        execute :service, :nginx, :restart
      elsif test("[ -f /etc/init.d/apache2 ]")
        execute :service, :apache2, :restart
      end
    end
  end

  desc "Server start"
  task :start do
    as :root do
      if test("[ -f /etc/init.d/nginx ]")
        execute :service, :nginx, :start
      elsif test("[ -f /etc/init.d/apache2 ]")
        execute :service, :apache2, :start
      end
    end
  end

  desc "Server stop"
  task :stop do
    as :root do
      if test("[ -f /etc/init.d/nginx ]")
        execute :service, :nginx, :stop
      elsif test("[ -f /etc/init.d/apache2 ]")
        execute :service, :apache2, :stop
      end
    end
  end

end
