
# Configuration

---

- [Configuring Locally](#local-configuration)
- [Configuring on Heroku](#heroku-configuration)


<a id="local-configuration"></a>
## Configuring Locally

At a minimum, you will need to edit the .env file to include information about the database.  Simply edit the .env like so:

`DB_CONNECTION=pgsql-local`

`DB_HOST=127.0.0.1`

`DB_PORT=5432`

`DB_DATABASE=startupengine`

`DB_USERNAME=admin`

`DB_PASSWORD=password`

You may configure many other settings (such as your Stripe credentials, E-mail credentials, Amazon S3 credentials, etc) in the same way.   


<a id="heroku-configuration"></a>
## Configuring on Heroku

To set environment variables on Heroku, use the CLI's config:set command, like so:

```bash 
    heroku config:set DB_HOST=127.0.0.1                      
```

Alternatively, you may do this via web browser from the settings panel of your Heroku app. 

> {warning} **Note:** The database is already confgured if you've deployed to Heroku. 