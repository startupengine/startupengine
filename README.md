# SitePress: the CMS for Startups

SitePress is a beautiful &amp; open-source content, marketing, and analytics platform **for startups**. 

Powered by [Contentful](https://contentful.com), [Laravel](https://laravel.com), and [Webslides](https://github.com/webslides/webslides/).

<div>
     <img src="https://images.contentful.com/x5o3atz1wqhm/2PWSbcsefYImQyMuqcIuGi/5efaa2c98a4819ef729885a7c3aa381c/App_Icon_2x.png" width="100">
     <img src="http://www.luckyrabbit.info/images/lr-logo.png" width="100">
</div>

**Table of Contents** 

- [Screenshots](#screenshots)
- [Demo](#demo)
- [Features](#features)
    - [Publish content](#publish-content)
    - [Control access to your content](#control-access-to-your-content)
    - [Accept payments](#accept-payments)
    - [Make informed decisions with analytics](#make-informed-decisions-with-analytics)
    - [Refine your strategy](#refine-your-strategy)
    - [Administrate your site](#administrate-your-site)
    - [Developer tools](#developer-tools)
    - [Integrations with 3rd-Party Services](#integrations-with-3rd-party-services)
    - [Strategic Benefits](#strategic-benefits)
- [Deploying](#deploying)

# Screenshots
<div>
     <img src="/storage/app/docs/screenshots/Home.png" width="250">
     <img src="/storage/app/docs/screenshots/Content.png" width="250">
     <img src="/storage/app/docs/screenshots/Analytics.png" width="250">     
</div>

# Demo
A demo of SitePress is online at https://luckyrabbitllc.herokuapp.com/

# Features 
Everything you need to launch your website/app/business idea.

###### Note:
* [x] Means this feature is currently in development.
* [ ] Means this feature is planned for a future release.

##### Publish content
* [x] Landing Pages
* [x] Articles
* [ ] Products
* [ ] Services
* [x] Features
* [ ] Pricing
* [ ] Videos
* [x] Gallery
* [ ] Forms/Polls
* [ ] Lists/Tables
* [x] Call To Action
* [x] File Attachments
* [ ] Custom HTML/CSS/JS

##### Control access to your content
* [x] Public (Viewable by Guests)
* [ ] Private (Unlisted, Requires Direct Link)
* [ ] Protected (Requires Password)
* [ ] Premium (Requires Login)
* [ ] Paid (Requires Paid Subscription)

##### Accept Payments
* [ ] Easy & secure credit card processing
 
##### Make informed decisions with analytics
* [ ] Content Analytics (top performing topics and keywords)
* [ ] User Analytics (breakdown by age, gender, country, income, etc)
* [x] Web Analytics (popular pages, number of visitors and pageviews)
* [ ] Search Analytics (top search terms, traffic sources)
* [ ] Traction (conversion rate)
* [ ] Sales / Subscriptions / Revenue

##### Refine your strategy
* [ ] Break down your users into segments
* [ ] Monitor what people are saying about your company on social media 
* [ ] Conduct market research to gain pychological insight into your customers
* [ ] Get daily notifications about how your business is performing 
* [ ] Automatically optimize your site for search engines
* [ ] Schedule social media posts ahead of time
* [ ] Optimize your landing page with automatic A/B Testing

##### Administrate your site
* [x] Admin Panel
* [x] User Management
* [x] Role Based Access Control for Staff (Authors, Editors, & Admins)

##### Developer tools
* [ ] Tests
* [ ] REST API
* [x] Auto-Scaling
* [x] Easy Migrations
* [x] Console Commands
* [x] Server Monitoring
* [x] Automatic Backups
* [x] Free SSL Certificate
* [x] One-click Deployment
* [x] Content Import/Export
* [ ] Content Caching (Minimize 3rd-Party API Calls)

##### Integrations with 3rd-Party Services
All of these services are **best-in-class** and offer a free plan.

* [x] Heroku
* [x] Contentful
* [x] Google Analytics
* [x] MixPanel
* [ ] BotPress
* [x] Disqus
* [x] Drift
* [ ] MailChimp
* [ ] Twitter
* [ ] Facebook
* [ ] Reddit
* [x] Algolia
* [ ] Typeform
* [ ] Slack
* [ ] Github
* [ ] Stripe
* [ ] Google AdSense
* [ ] Square
* [ ] Shopify
* [x] Auth0
* [x] Sentry

##### Strategic Benefits
* SitePress is designed specifically for the needs of a startup (unlike Wordpress, Ghost, and other open-source CMS offerings.)

* Stop wasting time and effort making your own CMS or modifying another one to suit your needs. SitePress leverages the latest technologies, practices, and services, so you can focus on running your business.

* Custom coding not required. No plugins to install. Just enter your account information and go.

* No worries about vendor lock-in like you might have with services like Instapage, LeadPages, Wix, etc.

* Automatic updates via Github & Heroku. No need to pay for server automation services like Jekins, DeployBot, CodeShip, etc.

* Don't have funding? It's ok, you can run SitePress on your own at little or no cost.
 
* You're not on your own. Paid professional support is available when you need it.

* Launch a site, business, or campaign in under 5 minutes. 

# Deploying

## Requirements
At the minimum, you will need a free [Contentful](https://contentful.com) account to manage your content on SitePress.

Simply specify your account credentials (Space ID, API Key, and Management Token) during deployment.

## Deploy to Heroku
Click the button below to deploy a new instance of SitePress to Heroku instantly.

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy?template=https://github.com/luckyrabbitllc/SitePress)

## Import Default Content
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

Your Contentful space is now populated with content.

Simply edit the existing pages or create new ones to administrate your site.
