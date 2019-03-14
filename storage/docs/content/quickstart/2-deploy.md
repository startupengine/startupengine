# Deploying

Click the button below to deploy a new instance of Startup Engine to Heroku instantly.

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy?template=https://github.com/luckyrabbitllc/StartupEngine)

Please reference Heroku's [official guide](https://devcenter.heroku.com/articles/getting-started-with-laravel) for getting started with Laravel apps on Heroku.

Once you've installed the [Heroku CLI](https://devcenter.heroku.com/articles/heroku-cli), run the following commands on your instance:

First, generate an `APP_KEY` by locally running:

`php artisan key:generate`.

Then copy the newly generated key and run:

`heroku config:set APP_KEY=APPKEYGOESHERE`

The default user email is `admin@example.com` and the default password is `password`.

Change these after logging in.
