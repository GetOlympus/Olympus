# Database
namespace :database do

  desc "Creates files"
  task :do_actions do
    on roles(:web) do

      # Ask configs
      set :database_host, ask('Enter the database hostname:', 'localhost')
      set :database_name, ask('Enter the database name:', 'database_name_here')
      set :database_user, ask('Enter the database user:', 'username_here')
      set :database_pass, ask('Enter the database password:', 'username_here', echo: false)

      set :wordpress_name, ask('Enter the admin username:', 'admin')
      set :wordpress_mail, ask('Enter the admin email address:', 'admin@domain.tld')
      set :wordpress_pass, ask('Enter the admin password:', 'password', echo: false)


      if File.exists?("#{release_path}/tmp/database.sql")
        puts "Copy database.sql file"
        upload! StringIO.new(File.read("#{release_path}/tmp/database.sql")), "#{shared_path}/tmp/database.sql"
      else
        puts "Create database.sql file"
        io = StringIO.new("CREATE DATABASE IF NOT EXISTS `#{fetch(:database_name)}`")
        upload! io, File.join(shared_path, "database.sql")
        execute :chmod, "644 #{shared_path}/database.sql"

        # Execute SQL request and remove temporary file
        execute :mysql, "-u #{fetch(:database_user)} -p#{fetch(:database_pass)} -h #{fetch(:database_host)} < #{shared_path}/database.sql"
        execute :rm, "#{shared_path}/database.sql"
      end


      if File.exists?("#{release_path}/app/config/env.php")
        puts "Copy env.php file"
        upload! StringIO.new(File.read("#{release_path}/app/config/env.php")), "#{shared_path}/app/config/env.php"
      else
        puts "Create env.php file"

        if fetch(:stage) == :production then
          debug = StringIO.new("  'debug' => false,")
        else
          debug = StringIO.new("  'debug' => [
    'savequeries' => true,
    'script_debug' => true,
    'wp_debug_display' => true,
    'wp_debug' => true,
  ],")
        end

        io = StringIO.new("<?php

/**
 * File auto-generated while first deploy.
 */
return [
  //Database
  'database' => [
    'host' => '#{fetch(:database_host)}',
    'name' => '#{fetch(:database_name)}',
    'user' => '#{fetch(:database_user)}',
    'pass' => '#{fetch(:database_pass)}',
  ],

  //WordPress URLs
  'wordpress' => [
    'home' => '#{fetch(:localurl)}',
    'siteurl' => '#{fetch(:localurl)}/cms',
  ],

  //Secure?
  'https' => false,

  //Debug
#{fetch(:debug)}
];

")
        upload! io, File.join(shared_path, "env.php")
        execute :chmod, "644 #{shared_path}/env.php"
        execute :mv, "#{shared_path}/env.php", "#{shared_path}/app/config/"
      end


      puts "Execute wp-cli commands to create database"
      execute :mkdir, '-p', "#{shared_path}/tmp/wpcli"
      execute "wp core download --path=#{shared_path}/tmp/wpcli --force"

      unless File.exists?("#{shared_path}/tmp/wpcli/wp-config.php")
        execute "wp core config --path=#{shared_path}/tmp/wpcli --dbname=#{fetch(:database_name)} --dbuser=#{fetch(:database_user)} --dbpass=#{fetch(:database_pass)}"
      end

      execute "wp core install --path=#{shared_path}/tmp/wpcli --url=#{fetch(:localurl)} --title=#{fetch(:application)} --admin_user=#{fetch(:wordpress_name)} --admin_password=#{fetch(:wordpress_pass)} --admin_email=#{fetch(:wordpress_mail)}"

      execute :rm, '-rf', "#{shared_path}/tmp"

    end
  end

end
