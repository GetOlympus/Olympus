# Redis
namespace :redis do

  desc "Redis data flush"
  task :flushall do
    on roles(:app) do
      sudo 'redis-cli', 'flushall'
    end
  end

  desc "Redis restart"
  task :restart do
    on roles(:app) do
      sudo '/etc/init.d/redis-server', 'stop'
      sudo '/etc/init.d/redis-server', 'start'
    end
  end

end
