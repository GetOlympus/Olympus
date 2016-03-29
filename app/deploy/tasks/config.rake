# Config
namespace :config do

  desc "Creates directories"
  task :setup do
    on roles(:web) do

      # Check last created file: it means all setup process is done or not!
      if test "[ ! -f \"#{shared_path}/web/robots.txt\" ]"
        puts "Create directories"

        execute :mkdir, '-p', "#{shared_path}/tmp"
        execute :mkdir, '-p', "#{shared_path}/app/config/env"
        execute :mkdir, '-p', "#{shared_path}/web/statics/upgrade"
        execute :mkdir, '-p', "#{shared_path}/web/statics/uploads"

        puts "Create files"
        invoke "files:do_actions"
      end

    end
  end

end
