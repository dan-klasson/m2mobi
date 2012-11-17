# Assignment CMS developer

This form assignment was written with Symfony2.1. It is safe from Sql-injection and Cross-site request forgery attacks. It also stores the password hashed and salted.

## To Install

* Run `git clone https://github.com/dan-klasson/m2mobi.git`
* Go to project folder `cd m2mobi/`
* Edit database credentials in `app/config/parameters.yml`
* Install vendors `php composer.phar install`
* Create database `php app/console doctrine:database:create`
* Create the schema `php app/console doctrine:schema:update --force`  
* Setting up permissions. On Ubuntu this is:


```
sudo setfacl -R -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs
sudo setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs
```

* Edit your web server config file so that point to `/path/to/project-foder/web` (on Apache it's `DocumentRoot`).
* Open up `http://localhost/app_dev.php/` in your browder.

[Symfony2 Install manual](http://symfony.com/doc/current/book/installation.html)

## The files that are of interest are:
* `src/M2mobi/UserBundle/Controller/DefaultController.php`
* `src/M2mobi/UserBundle/Entity/User.php`
