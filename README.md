<div><img src="https://images.contentful.com/x5o3atz1wqhm/2PWSbcsefYImQyMuqcIuGi/5efaa2c98a4819ef729885a7c3aa381c/App_Icon_2x.png" width="100">
<img src="http://www.luckyrabbit.info/images/lr-logo.png" width="100">
</div>

# About SitePress
SitePress is a beautiful &amp; open-source content platform. Powered by [Webslides](https://github.com/webslides/webslides/), [Laravel](https://laravel.com), and [Contentful](https://contentful.com).

# Demo
A demo instance is online at https://sitepress.herokuapp.com/

# Features 
## Content Types
* [x] Public (can be viewed by guests)
* [ ] Private (requires password)
* [ ] Premium (requires login)
* [ ] Paid (requires paid subscription)

## UI Components
* [x] Landing pages
* [x] Articles (blog posts)
* [x] Galleries
* [x] Lightbox
* [ ] Products
* [ ] Services
* [x] Features
* [ ] Pricing Plans
* [x] Call To Action
* [ ] Embedded Video / Video Backgrounds
* [ ] Custom Themes

## 3rd-Party Integrations
* [x] Mobile & Browser-Based CMS (via Contentful)
* [x] Commenting (via Disqus)
* [x] Chat (via Drift/Intercom)
* [x] SSO (via Auth0)
* [ ] Store (via Shopify)
* [ ] Subscriptions (via Stripe)
* [ ] Mailing Lists (via Active Campaign & MailChimp)
* [ ] Forms/Polls (via Typeform)
* [ ] Asset Storage (via AWS S3)
* [ ] Search (via Algolia)

## Administrative Features
* [x] Content analytics (topics, keywords, etc)
* [x] Web traffic analytics
* [ ] Conversion Analytics
* [ ] Revenue Analytics
* [ ] Traction Analytics (i.e., average time to conversion)
* [ ] User Analytics (age, gender, country, income, etc)
* [ ] Social Analytics
* [ ] Market Research
* [ ] Social Media Post Scheduling
* [ ] Landing Page Optimization (automated A/B testing)
* [ ] Site Settings
* [ ] KPI Notifications

## Developer Features 
* [x] Content Import/Export
* [ ] Content Caching (to minimize 3rd-Party API calls)
* [ ] REST API
* [ ] Console Commands
* [ ] Tests
* [ ] Automatic Backups

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