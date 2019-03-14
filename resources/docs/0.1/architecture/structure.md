# File Structure

---

- [Base App](#base-app)

<a id="base-app"></a>
## Base App

The file structure of Startup Engine is essentially a standard [`Laravel`](https://www.laravel.com) app. You can read about it in the [Laravel docs](https://laravel.com/docs/5.6/structure).

Noteworthy directories which are specific to Startup Engine:

- `/app/helpers` contains custom helper functions.
- `/app/traits` contains the trait classes which give [resources](/docs/latest/architecture/resources) their shared functionality.
- `/resources/views/theme` contains the views and templates for the front-end UI.
- `/resources/storage/schemas` contains the json files for the various [resources](/docs/latest/architecture/resources) used by the app.
- `/resources/storage/docs` contains the markdown files for the app's documentation.
