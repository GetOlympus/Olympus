# Varnish
namespace :varnish do

  desc "Varnish restart"
  task :restart do
    on roles(:app) do
      as :root do
        execute :service, :varnish, :restart
      end
    end
  end

end
