# PageSpeed
namespace :pagespeed do

  desc "PageSpeed data flush"
  task :flushall do
    on roles(:app) do
      sudo :touch, '/var/cache/mod_pagespeed/cache.flush'
    end
  end

end
