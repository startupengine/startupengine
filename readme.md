# Startup Engine

A beautiful & open-source platform for launching startups.

<div>
     <img src="https://images.contentful.com/x5o3atz1wqhm/2PWSbcsefYImQyMuqcIuGi/5efaa2c98a4819ef729885a7c3aa381c/App_Icon_2x.png" width="100">    
</div>

**Table of Contents** 

- [Screenshots](#screenshots)
- [Demo](#demo)
- [Features](#features)   
- [Deploying](#deploying)
- [Support](#support)
- [Security](#security)
- [License](#license)

# Screenshots

### Landing Page
<img src="https://s3.us-east-2.amazonaws.com/startupengine/screenshots/home.png" width="400" /><br>

### Blog
<img src="https://s3.us-east-2.amazonaws.com/startupengine/screenshots/blog.png" width="400" /><br>

### Analytics Explorer
<img src="https://s3.us-east-2.amazonaws.com/startupengine/screenshots/analytics.jpg" width="400" /><br>

### Content Editor
<img src="https://s3.us-east-2.amazonaws.com/startupengine/screenshots/editor.png?refresh" width="400" /><br>

### Content Type Editor
<img src="https://s3.us-east-2.amazonaws.com/startupengine/screenshots/content-type.png" width="400" /><br>

### User Management
<img src="https://s3.us-east-2.amazonaws.com/startupengine/screenshots/users.png" width="400" /><br>

### Role Management
<img src="https://s3.us-east-2.amazonaws.com/startupengine/screenshots/roles.png" width="400" /><br>

### Permission Management
<img src="https://s3.us-east-2.amazonaws.com/startupengine/screenshots/permissions.png" width="400" /><br>

### API Management
<img src="https://s3.us-east-2.amazonaws.com/startupengine/screenshots/api-manager.png?refresh" width="400" /><br>

# Demo

See it in action at https://www.startupengine.io

# Features 

* [x] Publish content, sell subscriptions & process payments.
* [x] Completely plug-and-pla. Coding is optional.
* [x] Supports any workflow, architecture, or framework.
* [x] Content API allows you integrate with external sites/apps.
* [x] Landing pages optimization powered by integrated analytics. No setup required.
* [x] Completely open-source.
* [x] 1-Click Install.

# Deploying on Heroku

Click the button below to deploy a new instance of Startup Engine to Heroku instantly.

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy?template=https://github.com/luckyrabbitllc/StartupEngine)

Here's Heroku's [official guide](https://devcenter.heroku.com/articles/getting-started-with-laravel) for getting started with Laravel apps on Heroku.

Once you've installed the [Heroku CLI](https://devcenter.heroku.com/articles/heroku-cli), run the following commands on your instance:

First, generate an `APP_KEY` by running `php artisan key:generate`. 
Then copy the newly generated key and run `heroku config:set APP_KEY=YOURKEYGOESHERE`. 

Followed by...

`php artisan migrate:refresh --seed --force`

`php artisan passport:install`

`php artisan command:SyncGit reset`

You may log in by going to https://www.herokuapp.com/YOURAPPNAME/login

The default user email is **admin@example.com** and the default password is **password**.

Change these after logging in.

# Support

Found a bug? [Submit an issue here on Github.](https://github.com/luckyrabbitllc/startupengine/issues)

# Security 

If you discover a security vulnerability within Startup Engine, please send an e-mail to startupengine.io@domainsbyproxy.com
 
All security vulnerabilities will be promptly addressed.

# License

Startup Engine is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).