# Olympus [![Packagist version](https://img.shields.io/packagist/v/crewstyle/olympus.svg?style=flat-square)](https://packagist.org/packages/crewstyle/olympus)  

---

_**Olympus** is a simple, easy to use and powerfull **framework** to deploy and work with **WordPress**. An awesome framework build with ♥ for **WordPress developers**._  

---

[![Total Downloads](https://img.shields.io/packagist/dt/crewstyle/olympus.svg?style=flat-square)](https://packagist.org/packages/crewstyle/olympus) 
[![GitHub version](https://img.shields.io/github/tag/crewstyle/Olympus.svg?style=flat-square)](https://github.com/crewstyle/Olympus) 
![For WordPress](https://img.shields.io/badge/for-WordPress-00aadc.svg?style=flat-square) 
~ ![With Composer](https://img.shields.io/badge/with-Composer-885630.svg?style=flat-square) 
![With Capistrano](https://img.shields.io/badge/with-Capistrano-52c1db.svg?style=flat-square)  

---

To follow more about the project and help if you want:

[Github project repository](https://github.com/crewstyle/Olympus)  
[Salt Bountysource page](https://salt.bountysource.com/teams/olympus)  
[Bountysource page](https://www.bountysource.com/teams/olympus)  
[Documentation](https://olympus.readme.io/)

---

### Requirements

The **Olympus framework** needs [**composer**](https://getcomposer.org/) to be installed.  
Just follow the instructions to install it in your working environments.

---

### What's inside?

[**Capistrano Olympus**](https://github.com/crewstyle/capistrano-olympus)  
Capistrano tasks for deploying WordPress website easily with the Olympus framework.  
[![RubyGem version](https://img.shields.io/gem/v/capistrano-olympus.svg?style=flat-square)](https://rubygems.org/gems/capistrano-olympus)

[**Olympus Zeus**](https://github.com/crewstyle/OlympusZeus)  
A library allows you to easily add professional looking theme options panels to your WordPress website.  
[![Packagist version](https://img.shields.io/packagist/v/crewstyle/olympus-zeus.svg?style=flat-square)](https://packagist.org/packages/crewstyle/olympus-zeus)

[**Olympus Hera**](https://github.com/crewstyle/OlympusHera)  
The framework core system used to make all libraries work efficiently.  
[![Build Status](https://img.shields.io/travis/crewstyle/OlympusHera.svg?style=flat-square)](https://travis-ci.org/crewstyle/OlympusHera)

---

### Installation

You can easily install the **Olympus framework** in 3 steps:

```bash
# Install all framework dependancies
composer install
```

```bash
# Create your own configuration files
cp app/config/env.php.dist app/config/env.php
cp app/config/salt.php.dist app/config/salt.php # Optional
```

```bash
# Create your own deployment files if you intend to use Capistrano
cp app/deploy/config.rb.dist app/deploy/config.rb
cp app/deploy/stages/production.rb.dist app/deploy/stages/production.rb
cp app/deploy/stages/staging.rb.dist app/deploy/stages/staging.rb
```

---

### Customization

Please, edit your own configuration files to make the **Olympus framework** works properly.

+ `app/config/env.php` contains all servers configurable definitions
+ `app/config/salt.php` contains all salt secret keys for WordPress
+ `app/deploy/config.rb` contains all capistrano deploy definitions

That's all to work properly.

---

### Vhost

There are 2 ways to edit your vhost file:

+ if you use **Capistrano Olympus** as process deployment, make the `current/web/` folder as your docroot
+ if you **do not** use **Capistrano Olympus**, make the `web/` folder as your docroot. Do not forget to create your own `.htaccess` and `robots.txt` files in the `web` folder.

The `index.php` file will bootstrap WordPress with all your configuration files.

---

### Deployment process

The **Olympus framework** also works with [**capistrano**](http://capistranorb.com/) if you need it.  
Edit your `app/deploy/stages/:stage.rb` file (`:stage` can be `staging` or `production`), or create your own deployment file, and update settings.  
Please, read the `README.md` file to know more: [**Capistrano Olympus**](https://github.com/crewstyle/capistrano-olympus)

---

### Documentation

[To learn more about the **Olympus WordPress framework**, read the docs](https://olympus.readme.io/).  
The **Olympus WordPress framework** uses [ReadMe.io](https://readme.io) which was built entirely on Open Source projects.

---

### All we need is looooooooooooove :)

[![Salt Bountysource page](https://img.shields.io/badge/Salt%20Bountysource-♥-brightgreen.svg?style=flat-square)](https://salt.bountysource.com/teams/olympus) [![Bountysource page](https://img.shields.io/badge/Bountysource-♥-brightgreen.svg?style=flat-square)](https://www.bountysource.com/teams/olympus)  
Guys, do **not** hesitate to spread your love about the **Olympus WordPress framework** and **all its packages** ;)

---

### Authors and Copyright

**Achraf Chouk**

+ http://fr.linkedin.com/in/achrafchouk/
+ http://twitter.com/crewstyle
+ http://github.com/crewstyle

Please, read [LICENSE](https://github.com/crewstyle/Olympus/blob/master/LICENSE "LICENSE") for more details.  
[![MIT](https://img.shields.io/badge/license-MIT_License-blue.svg?style=flat-square)](http://opensource.org/licenses/MIT "MIT")  

---

**Built with ♥ by [Achraf Chouk](http://github.com/crewstyle "Achraf Chouk") ~ (c) since 2015.**
