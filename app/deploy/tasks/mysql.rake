# MySQL
namespace :mysql do
  set :database_host, 'localhost'
  set :database_name, fetch(:application)
  set :database_user, 'mysql_user'
  set :database_pass, 'password'

  desc "Create database"
  task :create_database do
    on roles(:app) do
      within '#{shared_path}' do
        # Ask for configuration
        set :database_host, ask('Enter the database hostname:', fetch(:database_host))
        set :database_name, ask('Enter the database name:', fetch(:database_name))
        set :database_user, ask('Enter the database user:', fetch(:database_user))
        set :database_pass, ask('Enter the database password:', fetch(:database_pass), echo: false)

        # Create DB file
        io = StringIO.new('CREATE DATABASE #{fetch(:database_name)}')
        upload! io, File.join(shared_path, 'createdb.sql')

        # Execute SQL request and remove temporary file
        execute :mysql, '-u #{database_user} -p#{database_pass} -h #{database_host} < createdb.sql'
        execute :rm, 'createdb.sql'

        # Use WP Cli for next
        execute :rake, 'mysql:wpcli_install'
        execute :rake, 'mysql:wpcli_createdb'
        execute :rake, 'mysql:env_createfile'
      end
    end
  end

  desc "WP Cli install"
  task :wpcli_install do
    on roles(:app) do
      as :root do
        execute :curl, '-O', 'https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar'
        execute :php, 'wp-cli.phar', '--info'
        execute :chmod, '+x', 'wp-cli.phar'
        execute :sudo, :mv 'wp-cli.phar', '/usr/local/bin/wp'
      end
    end
  end

  desc "WP Cli install database"
  task :wpcli_createdb do
    on roles(:app) do
      as :root do
        within '#{shared_path}' do
          execute :mkdir, 'tmp'
          execute :cd, 'tmp'

          # Do the magic ~ @see main config.rb for variables
          execute 'wp core config', '--dbname=#{database_name} --dbuser=#{database_user} --dbpass=#{database_pass}'
          execute 'wp core install', '--url=#{localurl} --title=#{application} --admin_user=#{user_name} --admin_password=#{user_password} --admin_email=#{user_email}'

          execute :cd, '..'
          execute :rm, '-rf', 'tmp'
        end
      end
    end
  end

  desc "Create environment file"
  task :env_createfile do
    on roles(:app) do
      as :root do
        within '#{shared_path}' do
          io = StringIO.new('<?php

/**
 *
 * @package Olympus
 * @author Achraf Chouk <achrafchouk@gmail.com>
 * @since 0.0.1
 *
 */

/**
 * Production environment configuration.
 */
return [
    //Database
    "database" => [
        "host" => "#{database_host}",
        "name" => "#{database_name}",
        "user" => "#{database_user}",
        "pass" => "#{database_pass}",
    ],

    //WordPress URLs
    "wordpress" => [
        "home" => "#{localurl}",
        "siteurl" => "#{localurl}/cms",
    ],

    //Secure?
    "https" => false,

    //Debug
    "debug" => false,
];

')

          upload! io, File.join(shared_path, '#{fetch(:stage)}.php')
          execute :chmod, '644 #{fetch(:stage)}.php'
          execute :cd, '#{fetch(:stage)}.php', 'app/config/env/'
        end
      end
    end
  end

end
