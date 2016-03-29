# PHP
namespace :php do

  desc "PHP restart"
  task :restart do
    on roles(:app) do
      if test("[ -f /etc/init.d/php7.0-fpm ]")
        sudo :service, 'php7.0-fpm', :restart
      elsif test("[ -f /etc/init.d/php5-fpm ]")
        sudo :service, 'php5-fpm', :restart
      end
    end
  end

  desc "PHP start"
  task :start do
    on roles(:app) do
      if test("[ -f /etc/init.d/php7.0-fpm ]")
        sudo :service, 'php7.0-fpm', :start
      elsif test("[ -f /etc/init.d/php5-fpm ]")
        sudo :service, 'php5-fpm', :start
      end
    end
  end

  desc "PHP stop"
  task :stop do
    on roles(:app) do
      if test("[ -f /etc/init.d/php7.0-fpm ]")
        sudo :service, 'php7.0-fpm', :stop
      elsif test("[ -f /etc/init.d/php5-fpm ]")
        sudo :service, 'php5-fpm', :stop
      end
    end
  end

end
