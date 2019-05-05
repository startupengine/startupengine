# Installation

Download or clone the Startup Enginie repository from [https://github.com/startupengine/startupengine](https://github.com/startupengine/startupengine), then follow one of the two sets of instructionis below. 

## Standard Installation

If you're unfamiliar with running Laravel apps locally, see Laravel's [official installation guide](https://laravel.com/docs/5.6/installation) to get started.

Once you're familiar with Laravel, set up a [PostgreSQL](https://www.postgresql.org/) database and run:

`composer install`

To view your installation in a browser, run:

`php artisan serve`

Your app will be viewable at [http://127.0.0.1:8000](http://127.0.0.1:8000).

The default user email is **admin@example.com** and the default password is **password**.

## Containerized Installation

Startup Engine ships with a complete Docker-powered development environment. 

To develop via Docker, run the following command inside the `/laradock` directory:

`docker-compose up -d nginx postgres php-worker laravel-horizon redis workspace`

Alternatively, you may use a PHP artisan command from the root directory to achieve the same effect:

`php artisan launch:Container`

The app will be available locally at [http://startupengine.test](http://startupengine.test).

You may need to [edit your hosts file](https://www.imore.com/how-edit-your-macs-hosts-file-and-why-you-would-want) before the url will work.