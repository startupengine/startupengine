<div>
     <img src="https://images.contentful.com/x5o3atz1wqhm/2PWSbcsefYImQyMuqcIuGi/5efaa2c98a4819ef729885a7c3aa381c/App_Icon_2x.png" width="100">
     <img src="http://www.luckyrabbit.info/images/lr-logo.png" width="100">
</div>

# About SitePress
SitePress is a beautiful &amp; open-source content platform. Powered by [Webslides](https://github.com/webslides/webslides/), [Laravel](https://laravel.com), and [Contentful](https://contentful.com).

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

##### Refine your business/product/concept
* [ ] User Segments
* [ ] Social Listening
* [ ] Market Research
* [ ] Daily KPI Notifications
* [ ] Automatic SEO Optimization
* [ ] Social Media Post Scheduling
* [ ] Landing Page Optimization (Automated A/B Testing)

##### Administrate your site
* [ ] Admin Panel
* [x] User Management
* [x] Role Based Access Control for Staff (Authors, Editors, & Admins)

##### Develop something amazing
* [ ] Tests
* [ ] REST API
* [ ] Auto-Scaling
* [ ] Easy Migrations
* [ ] Console Commands
* [ ] Server Monitoring
* [ ] Automatic Backups
* [x] One-click Deployment
* [x] Free SSL Certificate
* [x] Content Import/Export
* [x] No Vendor Lock-In (Completely Open-Source)
* [ ] Content Caching (Minimize 3rd-Party API Calls)

## Integrations with 3rd-Party Services
All of these services are ***best-in-class*** and offer a free plan.

##### Hosting
* [x] Heroku (Hosting, Auto-Deployment, & Auto-Scaling)
* [x] Contentful (Content Management via Mobile or Web App)
* [ ] File storage via S3/Dropbox/Google Drive
##### Analytics
* [x] Google Analytics (Web Analytics)
* [x] MixPanel (User Segmentation)
##### User Engagement
* [ ] BotPress (Chatbots)
* [x] Disqus (Commenting)
* [x] Drift (Customer Support / Chat)
* [ ] MailChimp (E-mail Marketing Automation)
##### Social Media
* [ ] Twitter
* [ ] Facebook
* [ ] Reddit
##### User Experience
* [ ] Algolia (Search)
* [ ] Typeform (Forms/Polls)
##### Business Administration
* [ ] Slack (Internal Chat)
* [ ] Github (Documentation & Issue Tracking)
##### Sales / Subscriptions / Monetization
* [ ] Stripe (Subscriptions)
* [ ] Google AdSense (Text Ads)
* [ ] Square (E-commerce / Point of Sale)
* [ ] Shopify (E-commerce / Point of Sale)
##### Security
* [x] Auth0 (Social Authentication)
* [x] Sentry.io (Error Reporting)

# Requirements
You will need a free [Contentful](https://contentful.com) account to manage your content on SitePress.

Simply specify your account credentials (Space ID, API Key, and Management Token) during deployment.

# Deploying
Click the button below to deploy a new instance of SitePress to Heroku instantly.

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
