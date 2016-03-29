# Files
namespace :files do

  desc "Creates files"
  task :do_actions do
    on roles(:web) do

      if File.exists?("#{release_path}/app/config/common.php")
        puts "Copy common.php file"
        upload! StringIO.new(File.read("#{release_path}/app/config/common.php")), "#{shared_path}/app/config/common.php"
      end

      # Create DB files, and install data
      invoke "database:do_actions"

      # Create .htaccess
      invoke "htaccess:do_actions"

      # Create robots.txt
      invoke "robots:do_actions"

    end
  end

end
