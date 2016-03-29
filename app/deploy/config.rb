# config valid only for current version of Capistrano
lock '3.4.0'

# ~~~~

# Setup Capistrano
set :log_level, :debug
set :keep_releases, 3

# Setup Project ~ Update these settings
set :application, 'olympus-test'
set :localurl, 'http://www.domain.tld'

# Setup Git
set :repo_url, 'git@github.com:crewstyle/Olympus.git'
set :scm, :git
set :git_enable_submodules, true

# Setup SSH
set :copy_exclude, ['.git', '.DS_Store', '.gitignore', '.gitmodules']
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
set :linked_files, fetch(:linked_files, []).push("app/config/env.php", "web/.htaccess", "web/robots.txt")
set :linked_dirs, fetch(:linked_dirs, []).push("web/statics/uploads")

# ~~~~

# Deploy
namespace :deploy do

  # Create files and dirs when its needed
  before 'deploy:starting', 'config:setup'

  # Restart all
  after :publishing, 'server:stop'
  after :publishing, 'php:restart'
  after :publishing, 'server:start'

  # Flush cache
  after :publishing, 'redis:flushall'
  after :publishing, 'pagespeed:flushall'
  after :publishing, 'varnish:restart'

end
