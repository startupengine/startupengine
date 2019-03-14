# Packages

---

- [About Packages](#packages)
- [File Structure](#file-structure)
- [Templates](#templates)
- [Pages](#pages)

<a id="packages"></a>
## About Packages
 
<larecipe-card shadow>
    <larecipe-badge type="warning" circle class="mr-3" icon="fa fa-lightbulb-o"></larecipe-badge> <b>Concept: Packages</b>
    <br><br>
    Packages are <a href="https://git-scm.com/">Git repositories</a> that include one or more folders of code in a file structure mirroring Startup Engine's base file structure.     
</larecipe-card>

<a id="file-structure"></a>
## File Structure

You can write your own packages to extend Startup Engine's functionality.
<br>
- The root directory must contain a file called `package.json`
- Page view templates must be placed inside a `resources/views/theme/pages` directory.
- Content view templates must be placed inside a `resources/views/theme/templates` directory.
- And so on...

<a id="templates"></a>
## Templates

You may create custom templates for your content types in either PHP or HTML. You are free to use any front-end CSS or Javascript frameworks you like.
 
A template consists of...
  
- a folder inside `resources/views/themes/templates`
- a `schema.json` file inside that folder
- a `template.html` or `template.blade.php` file, or HTML or PHP partials for header, footer, body, scripts, and css (i.e. `scripts.html` or `scripts.blade.php`)

<a id="pages"></a>
## Pages

You may create custom pages in either PHP or HTML. You are free to use any front-end CSS or Javascript frameworks you like.
 
A page consists of...
  
- a folder inside `resources/views/themes/pages`
- a `page.json` file inside that folder
- a `page.html` or `page.blade.php` file, or HTML or PHP partials for header, footer, body, scripts, and css (i.e. `scripts.html` or `scripts.blade.php`)