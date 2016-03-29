# Robots
namespace :robots do

  desc "Creates files"
  task :do_actions do
    on roles(:web) do

      if File.exists?("#{release_path}/web/robots.txt")
        puts "Copy robots.txt file"
        upload! StringIO.new(File.read("#{release_path}/web/robots.txt")), "#{shared_path}/web/robots.txt"
      else
        puts "Create robots.txt file"
        if fetch(:stage) == :production then
          io = StringIO.new("Sitemap: #{fetch(:localurl)}/sitemap.xml

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
")
        else
          io = StringIO.new("User-agent: *
Disallow: /
")
        end

        upload! io, File.join(shared_path, "robots.txt")
        execute :chmod, "644 #{shared_path}/robots.txt"
        execute :mv, "#{shared_path}/robots.txt", "#{shared_path}/web/robots.txt"
      end

    end
  end

end
