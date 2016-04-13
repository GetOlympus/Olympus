# Olympus [![Build Status](https://travis-ci.org/crewstyle/Olympus.svg?branch=master)](https://travis-ci.org/crewstyle/Olympus)  

_**Olympus** is a simple, easy to use and powerfull **framework** to deploy and work with **WordPress**.  
An awesome framework build with ♥ for **WordPress developers**._  
[![Packagist version](https://img.shields.io/packagist/v/crewstyle/olympus.svg?style=flat-square)](https://packagist.org/packages/crewstyle/olympus)  

---

## Features

+ Better and secure folder structure
+ Autoloader for mu-plugins
+ Auto-generated configuration files with `composer install`
+ Dependency management with [**Composer**](https://getcomposer.org)
+ Remote server automation tool with [**Capistrano**](http://capistranorb.com/)

And more:
+ [WP Rest API](http://v2.wp-api.org/) as your official JSON Rest API: all your posts with a simple `GET` request: `/wp-json/wp/v2/posts`

![With Composer](https://img.shields.io/badge/with-Composer-885630.svg?style=flat-square) 
![With Capistrano](https://img.shields.io/badge/with-Capistrano-52c1db.svg?style=flat-square)

---

## Requirements

+ PHP >= 5.4
+ [**Composer**](https://getcomposer.org/)
+ [**Capistrano**](http://capistranorb.com/)

---

## Installation

You can easily install the **Olympus framework** in 2 steps (and a 3rd optional one):

```bash
# Clone the repository (use SSH key if you want: git@github.com:crewstyle/Olympus.git)
git clone https://github.com/crewstyle/Olympus.git projectname && cd $_
```

```bash
# Install framework dependancies via Composer and set your parameters when it's asked
composer install
```

```bash
# [optional] Create your own deployment files if you intend to use Capistrano
cp app/deploy/stages/production.rb.dist app/deploy/stages/production.rb
cp app/deploy/stages/staging.rb.dist app/deploy/stages/staging.rb
```

---

## Vhost

There are 2 ways to edit your vhost file:

+ in your remote(s) server(s):
  + if you use **Capistrano** as process deployment, make the `current/web/` folder as your docroot
  + if you **do not** use **Capistrano**, make the `web/` folder as your docroot and create your own `web/robots.txt` file
+ in your local environment:
  + make the `web/` folder as your docroot

The `web/index.php` file will bootstrap WordPress with all your configuration files.

---

## Deployment process

The **Olympus framework** also works with [**Capistrano**](http://capistranorb.com/) if you need it.  
Please, read the `README.md` file of the [**Capistrano Olympus**](https://github.com/crewstyle/capistrano-olympus) to know more.  
Here are the file to edit:
+ `app/deploy/config.rb`
+ `app/deploy/stages/:stage.rb` (`:stage` can be `staging` or `production`) - _you can also create your own deployment file_ -

---

## In this package ![For WordPress](https://img.shields.io/badge/for-WordPress-00aadc.svg?style=flat-square)

+ [**Capistrano Olympus**](https://github.com/crewstyle/capistrano-olympus): _Capistrano tasks for deploying WordPress website easily with the Olympus framework_
+ [**Olympus Hera**](https://github.com/crewstyle/OlympusHera): _the framework core system used to make all libraries work efficiently **(in beta now)**_
+ [**Olympus Zeus**](https://github.com/crewstyle/OlympusZeus): _a library allows you to easily add professional looking theme options panels to your WordPress website_

---

## Documentation

[To learn more about the **Olympus WordPress framework**, read the docs](https://olympus.readme.io/).  
The **Olympus WordPress framework** uses [ReadMe.io](https://readme.io) which was built entirely on Open Source projects.

---

## All we need is looooooooooooove :)

[![Salt Bountysource page](https://img.shields.io/badge/Salt%20Bountysource-♥-brightgreen.svg?style=flat-square)](https://salt.bountysource.com/teams/olympus) [![Bountysource page](https://img.shields.io/badge/Bountysource-♥-brightgreen.svg?style=flat-square)](https://www.bountysource.com/teams/olympus)  
Guys, do **not** hesitate to spread your love about the **Olympus WordPress framework** and **all its packages** ;)

---

## Authors and Copyright

**Achraf Chouk**

+ http://fr.linkedin.com/in/achrafchouk/
+ http://twitter.com/crewstyle
+ http://github.com/crewstyle

Please, read [LICENSE](https://github.com/crewstyle/Olympus/blob/master/LICENSE "LICENSE") for more details.  
[![MIT](https://img.shields.io/badge/license-MIT_License-blue.svg?style=flat-square)](http://opensource.org/licenses/MIT "MIT")  

---

**Built with ♥ by [Achraf Chouk](http://github.com/crewstyle "Achraf Chouk") ~ (c) since 2015.**
