<div><img src="https://images.contentful.com/x5o3atz1wqhm/2PWSbcsefYImQyMuqcIuGi/5efaa2c98a4819ef729885a7c3aa381c/App_Icon_2x.png" width="100">
<img src="http://www.luckyrabbit.info/images/lr-logo.png" width="100">
</div>

# About SitePress
SitePress is a beautiful &amp; open-source content platform. Powered by [Webslides](https://github.com/webslides/webslides/), [Laravel](https://laravel.com), and [Contentful](https://contentful.com).

# Demo
A demo instance is online at https://sitepress.herokuapp.com/

# Requirements
You will need a [Contentful](https://contentful.com) account to use SitePress. Before deployment you must specify your account credentials (Space ID, API Key, and Management Token).

# Deploying
You can deploy a new instance of SitePress to Heroku instantly by clicking the button below.

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy?template=https://github.com/luckyrabbitllc/SitePress)

# Import Default Content
After deploying, you will need to import the default content to your Contentful space. 

Connect to your SitePress instance using the [Heroku CLI](https://devcenter.heroku.com/articles/heroku-cli)

```
$ heroku run bash --app $yourHerokuAppName
```

```
$ npm install contentful-import
```

```
$ php artisan command:ImportDefaultSpace
```

Your Contentful space is now populated with content. Simply edit the existing pages or create new ones to administrate your site.

# Roadmap
## End-user Features
* [Done] Landing pages
* [Done] Galleries
* [Done] Articles

## 3rd-Party Integrations
* [Done] CMS (via Contentful)
* [Done] Commenting (via Disqus)
* [Done] Chat (via Drift/Intercom)
* [Done] SSO (via Auth0)
* Store (via Shopify)
* Subscriptions (via Stripe)

## Administrative Features
* [Done] Web traffic analytics
* Conversion analytics
* Revenue analytics
* Traction analytics (time to conversion)
* User analytics (age, gender, country, etc)
* Landing page optimization (automated A/B testing)
* Market research
* Social media post scheduling
* Social analytics

## Developer Features
* REST API
* Tests