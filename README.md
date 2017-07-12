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
* [x] Public (Viewable by Guests)
* [ ] Private (Unlisted, Requires Direct Link)
* [ ] Protected (Requires Password)
* [ ] Premium (Requires Login)
* [ ] Paid (Requires Paid Subscription)
 
## Analytics Features
* [x] Web Traffic
* [x] Popular Pages
* [ ] Search Keywords
* [ ] Content Insights
* [ ] Traction (Conversion Rate)
* [ ] Sales / Subscriptions / Revenue
* [ ] Content analytics (Topic Extraction)
* [ ] Users (Age, Gender, Country, Income, Etc)

## Business Features
* [ ] User Segments
* [ ] Market Research
* [ ] Social Listening
* [ ] Daily KPI Notifications
* [ ] Automatic SEO Optimization
* [ ] Social Media Post Scheduling
* [ ] Landing Page Optimization (Automated A/B Testing)

## Administration Features
* [ ] Admin Panel
* [ ] User Management

## Developer Features
* [ ] Tests
* [ ] REST API
* [ ] Console Commands
* [ ] Automatic Backups
* [x] Content Import/Export
* [ ] Content Caching (Minimize 3rd-Party API Calls)

## Integrations with 3rd-Party Services
##### All of these services are ***best-in-class*** and offer a free plan.
##### Web Hosting
* [x] Contentful (Headless CMS with Mobile & Web App)
* [x] Amazon S3 (File Storage)
* [x] Heroku (Hosting, Auto-Deployment, & Auto-Scaling)
##### Analytics
* [x] Google Analytics (Web Analytics)
* [x] MixPanel (Audience Segmentation)
##### User Engagement
* [x] Disqus (Commenting)
* [x] Drift (Customer Support / Chat)
* [ ] MailChimp (E-mail Marketing Automation)
* [ ] BotPress (Chatbot)
##### Sales & Subscriptions
* [ ] Square (E-commerce / Point of Sale)
* [ ] Stripe (Subscriptions)
##### User Experience
* [ ] Typeform (Forms/Polls)
* [ ] Algolia (Search)
##### Security
* [x] Auth0 (Social Sign On)
##### Business
* [ ] Slack (Internal Chat)
* [ ] Github (Documentation & Issue Tracking)
* [ ] Google AdSense (Text Ads)

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