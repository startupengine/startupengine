<div align="center" style="width:100%;">
<h1>Startup Engine</h1>
A beautiful & open-source platform for launching startups.<br>
<img src="storage/docs/images/logo.png" width="100">    
</div>

<img src="storage/docs/screenshots/admin.jpg" alt="Startup Engine Admin Panel" style="border:1px solid #eee;border-radius:5px;"><br>

# Key Features

- [x] Publish & sell software/content subscriptions.
- [x] Completely plug-and-play. Coding is optional.
- [x] Supports any workflow, architecture, or framework.
- [x] JSON API allows you integrate with external sites/apps.
- [x] Completely open-source.
- [x] 1-Click Install.

# Documentation
Documentation is available at [https://www.startupengine.io/docs](https://www.startupengine.io/docs).

# Deployment

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

# Support

Found a bug? [Submit an issue.](https://github.com/startupengine/startupengine/issues)

# Security

If you discover a security vulnerability within Startup Engine, please send an e-mail to startupengine.io@domainsbyproxy.com

All security vulnerabilities will be promptly addressed.

# License

Startup Engine is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
