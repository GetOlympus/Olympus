# config valid only for current version of Capistrano
lock '3.4.0'

# ~~~~

# Setup Capistrano
set :log_level, :debug
set :keep_releases, 3

# Setup Project ~ Update these settings
set :application, 'olympus-deploy'
set :localurl, 'http://www.domain.tld'
set :user_name, 'admin'
set :user_password, 'PfdBotadk7TqnrjOSB' # Auto-generated for the example
set :user_email, 'admin@domain.tld'

# Setup Git
set :repo_url, 'git@github.com:crewstyle/Olympus.git'
set :scm, :git
set :git_strategy, SubmoduleStrategy

# Setup SSH
set :use_sudo, false
set :ssh_options, {
  forward_agent: true
}

# ~~~~

# Setup Composer
set :composer_install_flags, '--no-dev --no-interaction --quiet --optimize-autoloader'
set :composer_roles, :all
set :composer_working_dir, -> { fetch(:release_path) }
set :composer_dump_autoload_flags, '--optimize'
set :composer_download_url, 'https://getcomposer.org/installer'

# ~~~~

# Setup Symlinks
set :linked_files, fetch(:linked_files, []).push('.htaccess', 'app/config/#{stage}.php', 'web/robots.txt')
set :linked_dirs, fetch(:linked_dirs, []).push('web/statics/uploads')

# ~~~~

# Deploy
namespace :deploy do

  after :publishing, 'server:stop'
  after :publishing, 'php:restart'
  after :publishing, 'server:start'

  after :publishing, 'redis:flushall'
  after :publishing, 'pagespeed:flushall'
  after :publishing, 'varnish:restart'

end

# ~~~~

# Setup ~ First deploy only
namespace :setup do

  before 'deploy:starting', 'config:create_dirs'
  before 'deploy:starting', 'config:create_files'
  before 'deploy:starting', 'mysql:create_database'
  after 'deploy:updated', 'robots:create'

end
