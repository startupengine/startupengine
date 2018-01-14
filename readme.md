# StartupEngine

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
* [x] 1-Click Install
* [x] Completely plug-and-play - coding is optional.
* [x] Completely open-source - you can change and distribute the code.
* [x] Create pages, blog posts, and documentation, or make your own custom content types.
* [x] Display your content anywhere using the API.
* [x] Define who can browse/read/edit/add/delete content with role-based access control.
* [x] Manage users, settings, content, features, & more from the command line. 
* [x] Version-control everything with the optional git-based workflow.
* [x] Use the pre-installed Boostrap 4 + Vue.js theme, or build your own with the tools of your choice.

##### Pre-Installed Pages
* [x] Landing page
* [x] Blog
* [x] Help / FAQ's
* [x] Search

# Deploying

Click the button below to deploy a new instance of StartupEngine to Heroku instantly.

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy?template=https://github.com/luckyrabbitllc/StartupEngine)

First, make sure the `APP_KEY` config variable is set.

Then run the following commands on your instance via the [Heroku CLI](https://devcenter.heroku.com/articles/heroku-cli):

`php artisan migrate:refresh --seed --force`

`php artisan passport:install`

`php artisan command:SyncGit reset`

The default user email is **admin@example.com** and the default password is **password**.

Change these after logging in.

# Support

Questions/comments? Chime in on [the official support chat](https://support.startupengine.io/).

Found a bug? Submit an issue here on Github.

# Security 

If you discover a security vulnerability within StartupEngine, please send an e-mail to startupengine.io@domainsbyproxy.com
 
All security vulnerabilities will be promptly addressed.

# License

StartupEngine is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).