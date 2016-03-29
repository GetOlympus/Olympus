# Varnish
namespace :varnish do

  desc "Varnish restart"
  task :restart do
    on roles(:app) do
      sudo :service, :varnish, :restart
    end
  end

end
