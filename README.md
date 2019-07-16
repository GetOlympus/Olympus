<p align="center">
    <img src="https://news.getolympus.me/content/images/2019/07/olympus-large.png" width="381" height="305"><br/>
    <i>This logo is property of <a href="https://anischouk.com/" target="_blank">Anis Chouk</a>.</i>
</p>

# Olympus ![PHP Version][php-image]
> The **Olympus** package is the **easiest and secure** way to install **WordPress** websites with the powerfull **Zeus Core** framework.
> All WordPress optimizations are listed and enabled here. You can use theme easily.

[![Olympus Component][olympus-image]][olympus-url]
[![CodeFactor Grade][codefactor-image]][codefactor-url]
[![Packagist Version][packagist-image]][packagist-url]
[![Travis Status][travis-image]][travis-url]

**Table of Contents**
- [What is Olympus?](#what-is-olympus)
- [Features](#features)
- [Get started](#get-started)
  - [Install Olympus in 2 steps](#install-olympus-in-2-steps)
  - [Update Vhost](#update-vhost)
  - [Build database](#build-database)
- [Get started with Capistrano](#get-started-with-capistrano)
  - [Build scripts](#build-scripts)
  - [Update Vhost with Capistrano](#update-vhost-with-capistrano)
  - [Build database with Capistrano](#build-database-with-capistrano)
- [Advanced details](#advanced-details)
  - [Application Structure](#application-structure)
  - [Configuration files](#configuration-files)
  - [Variables definitions](#variables-definitions)
  - [Log levels](#log-levels)
- [Release History](#release-history)
- [Authors and Copyright](#authors-and-copyright)
- [Contributing](#contributing)

## What is Olympus?

The **Olympus** package is a tool that provides a secure WordPress application structure with better tools to developers. It is aimed to WordPress developers of any levels.

In order to provide those tools, the **Olympus** package dependency manager and remote server automation tool such as **Composer** and **Capistrano**. A bunch of auto-generated files and autoloaded plugins make your WordPress website more secure and faster.

## Features

+ Better and secure folder structure
+ Autoloader for mu-plugins
+ Auto-generated configuration files with `composer install`
+ Dependency management with [**Composer**](https://getcomposer.org)
+ Remote server automation tool with [**Capistrano**](http://capistranorb.com/) and [**Capistrano Olympus**](https://github.com/GetOlympus/capistrano-olympus)

And more:
+ [Monolog](https://github.com/Seldaek/monolog) as an extensible powerful file logger
+ [Whoops](https://github.com/filp/whoops) as the best PHP debugger "for cool kids"
+ [WP Rest API](http://v2.wp-api.org/) as your official JSON Rest API: all your posts with a simple `GET` request: `/wp-json/wp/v2/posts`

![With Composer](https://img.shields.io/badge/with-Composer-885630.svg?style=flat-square)
![With Capistrano](https://img.shields.io/badge/with-Capistrano-52c1db.svg?style=flat-square)

## Get started

### Install Olympus in 2 steps

**1st step**, clone the repository (use SSH key if you want on git@github.com:GetOlympus/Olympus.git):

```bash
# Change "projectname" to your root website folder name
git clone https://github.com/GetOlympus/Olympus.git projectname && cd $_
```

**2nd step**, install package vendors via **Composer** and set your parameters when it's asked:  
_See [this documentation](https://getcomposer.org/doc/00-intro.md) to know how to install Composer_

```bash
composer install
```

### Update Vhost

This is quite simple: make the `web/` folder as your docroot.  
The `web/index.php` file will bootstrap WordPress with all your configuration files.  
Restart your server and That's all folkes.

### Build database

Go to your website homepage URL to launch your WordPress website install.

## Get started with Capistrano

> Capistrano is a remote server automation tool.  
> It supports the scripting and execution of arbitrary tasks, and includes a set of sane-default deployment workflows.

You can find all details on [**Capistrano website**](https://capistranorb.com).

### Build scripts

You'll need to create your deployments scripts for all your environments. These scripts are written in Ruby programming language.  
The **Olympus** package provides you 2 examples you can easily copy/paste in the `app/deploy/stages/` folder:

```bash
# You can find all explanations as comments in the `app/deploy/stages/staging.rb.dist` file.
cp app/deploy/stages/production.rb.dist app/deploy/stages/production.rb
cp app/deploy/stages/staging.rb.dist app/deploy/stages/staging.rb
```

Feel free to read the `README.md` file of the [**Capistrano Olympus**](https://github.com/GetOlympus/capistrano-olympus) repository to know more.

### Update Vhost with Capistrano

As seen on the ["Update Vhost"](#update-vhost) section, you'll need to set the `current/web/` folder as your docroot this time.  
Restart your server and That's all folkes.

### Build database with Capistrano

Go to your website homepage URL to launch your WordPress website install.

## Advanced details

### Application Structure

The **Olympus** package is structured as this:

```bash
+-- app/                        # ~ main application folder
|  +-- cache/                   # stores cache files generated by WordPress plugins and Olympus components
|  +-- components/              # stores custom components used to autoload mu-plugins and error logger
   |  +-- Autoloader
   |  +-- Error
   |  +-- Handler
|  +-- config/                  # stores custom configuration files
   |  +-- env.php.dist
   |  +-- opts.php.dist
   |  +-- own.php.dist
   |  +-- salt.php.dist
|  +-- deploy/                  # stores Capistrano workflows deployments
   |  +-- stages/
      |  +-- production.rb.dist
      |  +-- staging.rb.dist
   |  +-- config.rb.dist
|  +-- environments/            # stores WordPress constants definitions
   |  +-- cache.php
   |  +-- configuration.php
   |  +-- cookies.php
   |  +-- database.php
   |  +-- debug.php
   |  +-- multisite.php
   |  +-- website.php
|  +-- logs/                    # stores log file generated by Monolog package
|  +-- app.php
|  +-- autoload.php
|  +-- environment.php
|  +-- error.php
+-- vendor/                     # ~ vendors downloaded with composer
+-- web/                        # ~ web server doc root
|  +-- cms/                     # stores default WordPress installation
|  +-- resources/               # stores assets files expected by Olympus compoenents
   |  +-- dist/
|  +-- statics/                 # stores default "wp-content" folder contents
   |  +-- languages/
   |  +-- mu-plugins/
   |  +-- plugins/
   |  +-- themes/
   |  +-- uploads/
   |  +-- advanced-cache.php
|  +-- .htaccess.dist
|  +-- constants.php            # defines default Olympus package constants
|  +-- favicon.ico              # custom favicon.ico made by anischouk.com
|  +-- index.php                # ~ main file, bootstraps WordPress
|  +-- robots.txt.dist
|  +-- wp-config.php
|  +-- xmlrpc.php
+-- .gitattributes
+-- .gitignore
+-- .travis.yml
+-- Capfile
+-- CHANGELOG.md
+-- composer.json
+-- Gemfile
+-- LICENCE
+-- phpcs.xml
+-- README.md
+-- wp-cli.yml
```

### Configuration files

Go to your `app/config/` folder and make sure to find:
+ `env.php`, contains WordPress website environment configuration
+ `own.php`, a simple blank PHP file you can fill with your own constants definitions
+ `salt.php`, contains WordPress authentication unique keys and salts

An other file you can create if needed is:
+ `opts.php`, contains WordPress constants overrides. Simply copy the `opts.php.dist` file to `opts.php` and edit it.  
**Be carefull** with this file: you can change your WordPress core functions  
See [Variables definitions](#variables-definitions) to know more about this `opts.php` file contents.

### Variables definitions

**Website section**, sets all statics folder names:

| Variable          | Type    | Default value                                  | Expected value                   |
| ----------------- | ------- | ---------------------------------------------- | -------------------------------- |
| `wp_content_dir`  | String  | `'/path/to/web_docroot/statics/'`              | path to your `statics` folder    |
| `wp_content_url`  | String  | `'https://www.domain.tld/statics/'`            | url to your `statics` folder     |
| `wpmu_plugin_dir` | String  | `'/path/to/web_docroot/statics/mu-plugins/'`   | path to your `mu-plugins` folder |
| `wpmu_plugin_dir` | String  | `'https://www.domain.tld/statics/mu-plugins/'` | url to your `mu-plugins` folder  |
| `wp_plugin_dir`   | String  | `'/path/to/web_docroot/statics/plugins/'`      | path to your `plugins` folder    |
| `wp_plugin_url`   | String  | `'https://www.domain.tld/statics/plugins/'`    | url to your `plugins` folder     |
| `wp_theme_dir`    | String  | `'/path/to/web_docroot/statics/themes/'`       | path to your `themes` folder     |
| `wp_theme_url`    | String  | `'https://www.domain.tld/statics/themes/'`     | url to your `themes` folder      |

**Configuration section**, sets memory limit, some security and features options:

| Variable               | Type    | Default value | Expected value                           |
| ---------------------- | ------- | ------------- | ---------------------------------------- |
| `wp_memory_limit`      | String  | `'128M'`      | frontend PHP `memory_limit`              |
| `wp_max_memory_limit`  | String  | `'256M'`      | backend PHP `memory_limit`               |
| `autosave_interval`    | Integer | `60`          | interval in seconds between 2 autosaves  |
| `wp_cron_lock_timeout` | Integer | `60`          | interval in seconds to unlock cron tasks |
| `media_trash`          | Boolean | `true`        | enable or not trash in media page        |

**Multisite section**, sets default current site definitions in multisite case

| Variable               | Type    | Default value      | Expected value                    |
| ---------------------- | ------- | ------------------ | --------------------------------- |
| `subdomain_install`    | Boolean | `true`             | use or not sub domain display     |
| `domain_current_site`  | String  | `'www.domain.tld'` | url to the current (main) website |
| `path_current_site`    | String  | `'/cms/'`          | path to current (main) website    |
| `site_id_current_site` | Integer | `1`                | site id of the main website       |
| `blog_id_current_site` | Integer | `1`                | blog id of the main website       |

**Cookies section**, sets all cookies names.  
In these examples, you can replace:
- `olympus` by the result of `md5('olympus')`
- `domaintld` by the result of `md5('https://www.domain.tld/cms/')`

| Variable               | Type    | Default value                       | Expected value              |
| ---------------------- | ------- | ----------------------------------- | --------------------------- |
| `cookiehash`           | String  | `'domaintld'`                       | current domain cookie hash  |
| `user_cookie`          | String  | `'olympusu_domaintld'`              | user cookie hash            |
| `pass_cookie`          | String  | `'olympusp_domaintld'`              | password cookie hash        |
| `auth_cookie`          | String  | `'olympusa_domaintld'`              | auth cookie hash            |
| `secure_auth_cookie`   | String  | `'olympuss_domaintld'`              | secure auth cookie hash     |
| `logged_in_cookie`     | String  | `'olympusl_domaintld'`              | logged in cookie hash       |
| `recovery_mode_cookie` | String  | `'olympusr_domaintld'`              | recovery mode cookie hash   |
| `cookiepath`           | String  | `'www.domain.tld'`                  | home cookie hash            |
| `sitecookiepath`       | String  | `'www.domain.tld/cms/'`             | site cookie hash            |
| `admin_cookie_path`    | String  | `'www.domain.tld/cms/wp-admin/'`    | admin panel cookie hash     |
| `plugins_cookie_path`  | String  | `'www.domain.tld/statics/plugins/'` | plugins url cookie hash     |
| `cookie_domain`        | Boolean | `false`                             | enable or not cookie domain |
| `test_cookie`          | String  | `'olympusis_trying'`                | testing cookie hash         |

**Debug section**, sets all debug options:

| Variable              | Type    | Default value | Expected value                             |
| --------------------- | ------- | ------------- | ------------------------------------------ |
| `concatenate_scripts` | Boolean | `false`       | enable or not scripts concatenation        |
| `compress_scripts`    | Boolean | `false`       | enable or not scripts compression          |
| `compress_css`        | Boolean | `false`       | enable or not stylesheets compressions     |
| `error_level`         | Integer | `200`         | error level, see [Log levels](#log-levels) |

### Log levels

* `100` Detailed debug information.
* `200` Interesting events, like User logs in, SQL logs.
* `250` Uncommon events.
* `300` Exceptional occurrences that are not errors, like use of deprecated APIs, poor use of an API, etc.
* `400` Runtime errors.
* `500` Critical conditions.
* `550` Action must be taken immediately.
* `600` Urgent alert.

## Release History

* v0.0.21 (July 16, 2019)
- [x] FIX: Add opts.php file, new PHPCS validation

* v0.0.20 (March 24, 2018)
- [x] FIX: PHPCS validation.

## Authors and Copyright

Achraf Chouk  
[![@crewstyle][twitter-image]][twitter-url]

Please, read [LICENSE][license-blob] for more information.  
[![MIT][license-image]][license-url]

[https://github.com/crewstyle](https://github.com/crewstyle)  
[https://fr.linkedin.com/in/achrafchouk](https://fr.linkedin.com/in/achrafchouk)

## Contributing

1. Fork it (<https://github.com/GetOlympus/Olympus/fork>)
2. Create your feature branch (`git checkout -b feature/fooBar`)
3. Commit your changes (`git commit -am 'Add some fooBar'`)
4. Push to the branch (`git push origin feature/fooBar`)
5. Create a new Pull Request

---

**Built with ♥ by [Achraf Chouk](https://github.com/crewstyle "Achraf Chouk") ~ (c) since a long time.**  
**Logo design made levely by [Anis Chouk](https://anischouk.com/ "Anis Chouk")**

<!-- links & imgs dfn's -->
[olympus-image]: https://img.shields.io/badge/for-Olympus-44cc11.svg?style=flat-square
[olympus-url]: https://github.com/GetOlympus
[codefactor-image]: https://www.codefactor.io/repository/github/getolympus/olympus/badge?style=flat-square
[codefactor-url]: https://www.codefactor.io/repository/github/getolympus/olympus
[license-blob]: https://github.com/GetOlympus/Olympus/blob/master/LICENSE
[license-image]: https://img.shields.io/badge/license-MIT_License-blue.svg?style=flat-square
[license-url]: http://opensource.org/licenses/MIT
[packagist-image]: https://img.shields.io/packagist/v/getolympus/olympus.svg?style=flat-square
[packagist-url]: https://packagist.org/packages/getolympus/olympus
[php-image]: https://img.shields.io/travis/php-v/GetOlympus/Olympus.svg?style=flat-square
[travis-image]: https://img.shields.io/travis/GetOlympus/Olympus/master.svg?style=flat-square
[travis-url]: https://travis-ci.org/GetOlympus/Olympus
[twitter-image]: https://img.shields.io/badge/crewstyle-blue.svg?style=social&logo=twitter
[twitter-url]: http://twitter.com/crewstyle
