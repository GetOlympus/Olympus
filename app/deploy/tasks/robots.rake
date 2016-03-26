# Robots.txt
namespace :robots do

  desc "Creates robots.txt"
  task :create do
    on roles(:app) do

      if fetch(:stage) == :staging then
        io = StringIO.new('User-agent: *
Disallow: /
')

      elsif fetch(:stage) == :production then
        io = StringIO.new('Sitemap: #{fetch(:localurl)}/sitemap.xml

User-agent: *
Disallow: /*?

User-agent: Googlebot
User-agent: Googlebot-News
User-agent: Googlebot-Image
User-agent: Googlebot-Video
User-agent: Googlebot-Mobile
User-agent: Mediapartners-Google
User-agent: Mediapartners
User-agent: AdsBot-Google
User-agent: Bingbot
User-agent: Twitterbot
Crawl-delay: 5

User-agent: CCBot
Crawl-delay: 10

User-agent: Yandex
Crawl-delay: 10

User-agent: Applebot
Crawl-delay: 10

User-agent: archive.org_bot
Crawl-delay: 10

User-agent: ia_archiver
Crawl-delay: 10
')

      else
        io = StringIO.new('# Nothing to do')
      end

      upload! io, File.join(shared_path, 'robots.txt')
      execute :chmod, '644 #{shared_path}/robots.txt'
      execute :mv, '#{shared_path}/robots.txt', '#{shared_path}/web/robots.txt'

    end
  end

end
