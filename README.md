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
    - [Create pages](#create-pages)
    - [Components](#components-you-can-include-in-a-page)
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

##### Create pages
* [x] Landing pages
* [X] Product pages
* [X] Service pages
* [X] Subscription pages
* [x] Blog posts
* [x] Help/documentation

##### Components you can include in a page
* [x] Text
* [x] Images
* [x] Videos
* [x] File attachments
* [x] Lists/tables
* [x] Pricing plans
* [x] Call-to-action
* [x] Forms
* [x] Custom HTML/JS

##### Control access to your content
* [x] Public (viewable by guests)
* [ ] Private (unlisted, requires direct link)
* [ ] Protected (requires password)
* [ ] Premium (requires login)
* [ ] Paid (requires paid subscription)

##### Accept Payments 
* [ ] For Products
* [ ] For Services (i.e., for consulting or web development)
* [ ] For Subscriptions (i.e., for an app) 
* [ ] For Premium Content (i.e., music or video tutorials)
* [ ] Via easy & secure credit card processing
* [ ] All without leaving the site
 
##### Make informed decisions with analytics
* [x] Web analytics - visitors and page views
* [ ] Content analytics - top performing pages, topics, and keywords
* [ ] Product analytics - top selling products
* [ ] Subscription analytics - top selling subscriptions
* [ ] User analytics - breakdown by age, gender, country, etc
* [ ] Social analytics - which platforms and posts are bringing in the most visitors?
* [ ] Search analytics - top search terms & traffic sources
* [ ] Traction (conversion rate)

##### Refine your strategy
* [ ] Monitor user funnels to know where you're gaining/losing leads
* [ ] Monitor what people are saying about your company on social media 
* [ ] Conduct market research to gain insight into your customers' psychological needs
* [ ] Optimize your landing page with automatic A/B Testing
* [ ] Automatically optimize your site for search engines
* [ ] Get daily notifications about how your business is performing
* [ ] Schedule social media posts ahead of time

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
All of these products are **best-in-class** and cost nothing to start.

* [x] Auth0
* [x] Algolia
* [ ] BotPress
* [x] Contentful
* [x] Disqus
* [x] Drift
* [ ] Facebook
* [x] Github
* [ ] Google AdSense
* [x] Google Analytics
* [x] Heroku
* [ ] MailChimp
* [x] MixPanel
* [ ] Reddit
* [x] Sentry
* [ ] Slack
* [ ] Square
* [ ] Stripe
* [ ] Twitter
* [ ] Typeform
* [ ] ZenHub

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
At minimum, you will need a free [Contentful](https://contentful.com) account to manage your content on SitePress.

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
