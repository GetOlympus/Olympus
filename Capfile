# Define capistrano common vars
set :upload_files_path, 'app/deploy/files/'
set :stage_config_path, 'app/deploy/stages/'
set :deploy_config_path, 'app/deploy/config.rb'

# Load DSL and set up stages
require 'capistrano/setup'

# Include default deployment tasks
require 'capistrano/deploy'

# Include wp-cli tool
require 'capistrano/wpcli'

# Load custom tasks if needed
Dir.glob('app/deploy/tasks/*.rake').each { |r| import r }
