# Htaccess
namespace :htaccess do

  desc "Creates files"
  task :do_actions do
    on roles(:web) do

      if File.exists?("#{release_path}/web/.htaccess")
        puts "Copy .htaccess file"
        upload! StringIO.new(File.read("#{release_path}/web/.htaccess")), "#{shared_path}/web/.htaccess"
      else
        puts "Create .htaccess file"
        io = StringIO.new("
# BEGIN WordPress

<IfModule mod_rewrite.c>
  RewriteEngine On
  RewriteBase /
  RewriteRule ^index\.php$ - [L]
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteRule . /index.php [L]
</IfModule>

# END WordPress
")
        upload! io, File.join(shared_path, ".htaccess")
        execute :chmod, "644 #{shared_path}/.htaccess"
        execute :mv, "#{shared_path}/.htaccess", "#{shared_path}/web/"
      end

    end
  end

end
