<div><img src="https://images.contentful.com/x5o3atz1wqhm/2PWSbcsefYImQyMuqcIuGi/5efaa2c98a4819ef729885a7c3aa381c/App_Icon_2x.png" width="100">
<img src="http://www.luckyrabbit.info/images/lr-logo.png" width="100">
</div>

# About SitePress
SitePress is a beautiful &amp; open-source content platform. Powered by [Webslides](https://github.com/webslides/webslides/), [Laravel](https://laravel.com), and [Contentful](https://contentful.com).

# Demo
A demo of SitePress is online at https://sitepress.herokuapp.com/

# Features 

## Content Types
* [x] Landing Page
* [x] Article
* [ ] Product
* [ ] Service
* [x] Feature
* [ ] Pricing Plan
* [x] Call To Action
* [ ] Video
* [x] Image Galleries
* [x] Attachment (any file format)
* [ ] Form/Poll
* [ ] Custom HTML/CSS/JS

## Content Permissions
* [x] Public (can be viewed by guests)
* [ ] Private (unlisted, requires direct link)
* [ ] Protected (requires password)
* [ ] Premium (requires login)
* [ ] Paid (requires paid subscription)

## Integrations with 3rd-Party Services
##### All of these services are best-in-class and offer a free plan.
* [x] Contentful (Headless CMS with Mobile & Web App)
* [x] Heroku (Hosting & Auto-Deployment, & Data Backups)
* [x] Google Analytics (Web Analytics)
* [x] MixPanel (Audience Segmentation & Engagement)
* [x] Disqus (Commenting)
* [x] Drift (Customer Chat)
* [x] Auth0 (SSO Authentication)
* [ ] Square (E-commerce Store / Point of Sale)
* [ ] Stripe (Subscriptions) 
* [ ] MailChimp (Mailing List)
* [ ] OptiMail (Marketing Automation)
* [ ] Typeform (Forms/Polls)
* [ ] Amazon S3 (Asset Storage)
* [ ] Algolia (Search)
* [ ] BotPress (Marketing Chatbot)
* [ ] Slack/Slackbot (Internal Company Chat/Chatbot)
* [ ] Github (Documentation & Issue Tracking)
* [ ] Google AdSense (Text Ads)
 
## Analytics
* [x] Web Traffic
* [ ] Popular Pages
* [ ] Search Keywords
* [ ] Traction (conversion rate)
* [ ] Sales / Subscriptions / Revenue
* [ ] Content analytics (topic extraction)
* [ ] Users (age, gender, country, income, retention, top users, user segments, etc)

## Business
* [ ] Market Research (audience segment personas)
* [ ] Daily KPI (Key Performance Indicator) Notifications
* [ ] User Funnel Stages
* [ ] Social Media Post Scheduling & Approval
* [ ] Landing Page Optimization (automated A/B testing)
* [ ] Social Listening
* [ ] Automatic SEO Optimization

## Administration
* [ ] Admin Panel / Staff Section
* [ ] User Permissions

## Developer
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