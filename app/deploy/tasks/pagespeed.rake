# PageSpeed
namespace :pagespeed do

  desc "PageSpeed data flush"
  task :flushall do
    on roles(:app) do
      as :root do
        execute :touch, '/var/cache/mod_pagespeed/cache.flush'
      end
    end
  end

end
