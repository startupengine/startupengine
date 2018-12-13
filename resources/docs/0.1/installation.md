# Installation

---

- [Sign Up](#managed-edition)
- [Installing Locally](#local-installation)
- [Installing on Heroku](#heroku-installation)


<a id="managed-edition"></a>
## Sign Up for a managed Startup Engine account

The simplest way to get started with Startup Engine is to create an account at [www.startupengine.io](https://www.startupengine.io). 

With managed accounts, your copy of Startup Engine is hosted in the cloud and automatically kept up-to-date. If you would prefer to install Startup Engine on your own server, follow the instructions below.  

<a id="local-installation"></a>
## Installing Locally

Startup Engine is open-source, so you may install a copy on your own server or development machine any time you want.

> {warning} **Note:**  If you would like to install Startup Engine on your own server, you'll need to be familiar with the command line interface.
 
First, you'll need to clone  and install the repository by running these commands in the command line.

   ```bash   
    git clone https://github.com/StartupEngineIO/StartupEngine
    cd startupengine-master
    composer install
    npm install  
    php artisan keys:generate
   ```
   
Then edit the .env file to include `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`.  The database must be a [PostgreSQL](https://www.postgresql.org/) database.

Next, run:
   
   
   ```bash   
    php artisan serve
   ```
   
You should be able to access your local instance by going to http://127.0.0.1:8000 in your browser.

The default username is `admin@example.com` and the default password is `password`.

<a id="heroku-installation"></a>
## Installing on Heroku

### via Browser
Click here to deploy to Heroku:

<div style="cursor:pointer;width:147px;height:32px;background:url('https://www.herokucdn.com/deploy/button.svg');" onclick="window.open('https://heroku.com/deploy?template=https://github.com/luckyrabbitllc/StartupEngine')"></div>

### via Command Line

> {warning} **Note:** The following requires the **[Heroku CLI](https://devcenter.heroku.com/articles/heroku-cli)** to be installed on your computer.

After installing locally, run the following to push it to Heroku:

```bash
    heroku create
    git push heroku master
    heroku open
```