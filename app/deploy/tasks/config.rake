# Config
namespace :config do

  desc "Creates directories"
  task :create_dirs do
    on roles(:web) do
      execute :mkdir, '-p', '#{shared_path}/sql'
      execute :mkdir, '-p', '#{shared_path}/app/config/env'
      execute :mkdir, '-p', '#{shared_path}/web/statics/upgrade'
      execute :mkdir, '-p', '#{shared_path}/web/statics/uploads'
    end
  end

  desc "Creates files"
  task :create_files do
    on roles(:web) do
      #upload! StringIO.new(File.read('app/config/env/#{stage}.php')), '#{shared_path}/app/config/env/#{stage}.php'
      upload! StringIO.new(File.read('app/config/common.php')), '#{shared_path}/app/config/common.php'
      upload! StringIO.new(File.read('app/config/env.php')), '#{shared_path}/app/config/env.php'
      upload! StringIO.new(File.read('web/.htaccess')), '#{shared_path}/web/.htaccess'
    end
  end

end
