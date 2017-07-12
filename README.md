<div><img src="https://images.contentful.com/x5o3atz1wqhm/2PWSbcsefYImQyMuqcIuGi/5efaa2c98a4819ef729885a7c3aa381c/App_Icon_2x.png" width="100">
<img src="http://www.luckyrabbit.info/images/lr-logo.png" width="100">
</div>

# About SitePress
SitePress is a beautiful &amp; open-source content platform. Powered by [Webslides](https://github.com/webslides/webslides/), [Laravel](https://laravel.com), and [Contentful](https://contentful.com).

# Demo
A demo of SitePress is online at https://sitepress.herokuapp.com/

# Features 
#### Everything you need to launch your website/app/business idea.
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
 
##### Make informed decisions with analytics
* [x] Web Traffic
* [x] Popular Pages
* [ ] Content Insights
* [ ] Search Keywords
* [ ] Traction (Conversion Rate)
* [ ] Sales / Subscriptions / Revenue
* [ ] Users (Age, Gender, Country, Income, Etc)

##### Develop your business
* [ ] User Segments
* [ ] Social Listening
* [ ] Market Research
* [ ] Daily KPI Notifications
* [ ] Automatic SEO Optimization
* [ ] Social Media Post Scheduling
* [ ] Landing Page Optimization (Automated A/B Testing)

##### Administrate your site
* [ ] Admin Panel
* [ ] User Management

##### Develop something amazing
* [ ] Tests
* [ ] REST API
* [ ] Automatic Backups
* [ ] Console Commands
* [x] Content Import/Export
* [ ] Content Caching (Minimize 3rd-Party API Calls)

## Integrations with 3rd-Party Services
#### All of these services are ***best-in-class*** and offer a free plan.
##### Hosting
* [x] Heroku (Hosting, Auto-Deployment, & Auto-Scaling)
* [x] Contentful (Content Management via Mobile or Web App)
##### Analytics
* [x] Google Analytics (Web Analytics)
* [x] MixPanel (User Segmentation)
##### User Engagement
* [x] Disqus (Commenting)
* [x] Drift (Customer Support / Chat)
* [ ] MailChimp (E-mail Marketing Automation)
* [ ] BotPress (Chatbot)
##### Sales & Subscriptions
* [ ] Square (E-commerce / Point of Sale)
* [ ] Stripe (Subscriptions)
##### User Experience
* [ ] Algolia (Search)
* [ ] Typeform (Forms/Polls)
##### Business
* [ ] Slack (Internal Chat)
* [ ] Google AdSense (Text Ads)
* [ ] Github (Documentation & Issue Tracking)
##### Security
* [x] Auth0 (Social Sign On)
* [x] Sentry.io (Error Reporting)

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

Your Contentful space is now populated with content.
Simply edit the existing pages or create new ones to administrate your site.