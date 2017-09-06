# StartupEngine: the CMS for Startups

A beautiful & open-source platform for launching startups.

Powered by [Contentful](https://contentful.com), [Heroku](https://Heroku.com), [Laravel](https://laravel.com), and [Webslides](https://github.com/webslides/webslides/).

<div>
     <img src="https://images.contentful.com/x5o3atz1wqhm/2PWSbcsefYImQyMuqcIuGi/5efaa2c98a4819ef729885a7c3aa381c/App_Icon_2x.png" width="100">    
</div>

**Table of Contents** 

- [Screenshots](#screenshots)
- [Features](#features)
    - [Create pages](#create-pages)
    - [Control access to your content](#control-access-to-your-content)                    
    - [Strategic Benefits](#strategic-benefits)
- [Deploying](#deploying)

# Screenshots
<div>
     <img src="/storage/app/docs/screenshots/Article.png" width="250">
     <img src="/storage/app/docs/screenshots/Articles.png" width="250">
</div>

# Features 
Everything you need to launch & grow your website, app, or business.

##### Create pages
* [x] Landing pages
* [X] Products & Services
* [x] Articles
* [x] Help & Documentation

##### Control access to your content
* [x] Public (viewable by guests)
* [x] Private (unlisted, requires direct link)
* [x] Protected (requires password)
* [x] Premium (requires login)
* [x] Paid (requires paid subscription)

##### Strategic Benefits
* [x] Completely free.
* [x] Completely plug-and-play. No coding required.
* [x] Automatic updates via Github & Heroku.
* [x] Decoupled architecture: if you ever want to move your site to another platform, you can do so without having to migrate your data.

# Deploying

## Requirements
You will need a free [Contentful](https://contentful.com) account to manage your content on StartupEngine.

Simply specify your account credentials (Space ID, API Key, and Management Token) during deployment.

## Deploy to Heroku
Click the button below to deploy a new instance of StartupEngine to Heroku instantly.

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy?template=https://github.com/luckyrabbitllc/StartupEngine)

## Import Default Content
After deploying, you will need to import the default content to your Contentful space. 

Connect to your StartupEngine instance using the [Heroku CLI](https://devcenter.heroku.com/articles/heroku-cli)

```
$ heroku run bash --app $yourHerokuAppName
```

```
$ npm install contentful-import
```

```
$ php artisan command:ImportDefaultSpace
```

Your Contentful space is now populated with content.

Simply edit the existing pages or create new ones to administrate your site.

## Security Vulnerabilities

If you discover a security vulnerability within StartupEngine, please send an e-mail to info@StartupEngine.io. All security vulnerabilities will be promptly addressed.

## License

StartupEngine is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
