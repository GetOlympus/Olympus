# Redis
namespace :redis do

  desc "Redis data flush"
  task :flushall do
    on roles(:app) do
      as :root do
        execute 'redis-cli', 'flushall'
      end
    end
  end

  desc "Redis restart"
  task :restart do
    on roles(:app) do
      as :root do
        execute '/etc/init.d/redis-server', 'stop'
        execute '/etc/init.d/redis-server', 'start'
      end
    end
  end

end
