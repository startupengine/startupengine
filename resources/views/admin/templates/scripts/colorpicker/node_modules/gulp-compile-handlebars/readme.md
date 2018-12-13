# gulp-compile-handlebars
Forked from [gulp-template](https://github.com/sindresorhus/gulp-template)
Inspired by [grunt-compile-handlebars](https://github.com/patrickkettner/grunt-compile-handlebars)

> Compile [Handlebars templates](http://www.handlebarsjs.com/)

## Install

Install with [npm](https://npmjs.org/package/gulp-compile-handlebars)

```
npm install --save-dev gulp-compile-handlebars
```


## Example

### `src/hello.handlebars`

```handlebars
{{> header}}
<p>Hello {{firstName}}</p>
<p>HELLO! {{capitals firstName}}</p>
{{> footer}}
```

### `src/partials/header.handlebars`

```handlebars
<h1>Header</h1>
```

### `gulpfile.js`

```js
var gulp = require('gulp');
var handlebars = require('gulp-compile-handlebars');
var rename = require('gulp-rename');

gulp.task('default', function () {
	var templateData = {
		firstName: 'Kaanon'
	},
	options = {
		ignorePartials: true, //ignores the unknown footer2 partial in the handlebars template, defaults to false
		partials : {
			footer : '<footer>the end</footer>'
		},
		batch : ['./src/partials'],
		helpers : {
			capitals : function(str){
				return str.toUpperCase();
			}
		}
	}

	return gulp.src('src/hello.handlebars')
		.pipe(handlebars(templateData, options))
		.pipe(rename('hello.html'))
		.pipe(gulp.dest('dist'));
});
```

### `dist/hello.html`

```html
<h1>Header</h1>
<p>Hello Kaanon</p>
<p>HELLO! KAANON</p>
<footer>the end</footer>
```

## Options

- __ignorePartials__ : ignores any unknown partials. Useful if you only want to handle part of the file
- __partials__ : Javascript object that will fill in partials using strings
- __batch__ : Javascript array of filepaths to use as partials
- __helpers__: javascript functions to stand in for helpers used in the handlebars files
- __compile__: compile options. See [handlebars reference](http://handlebarsjs.com/reference.html#base-compile) for possible values

## handlebars.Handlebars

You can access the Handlebars library from the `handlebars.Handlebars` property.

```js
var handlebars = require('gulp-compile-handlebars');
var safestring = new handlebars.Handlebars.SafeString('<strong>HELLO! KAANON</strong>');
```

## handlebars.Handlebars

You can access the Handlebars library from the `handlebars.Handlebars` property.

```js
var handlebars = require('gulp-compile-handlebars');
var safestring = new handlebars.Handlebars.SafeString('<strong>HELLO! KAANON</strong>');
```

## Works with gulp-data

Use gulp-data to pass a data object to the template based on the handlebars file being processed.
If you pass in template data this will be extended with the object from gulp-data.

See [gulp-data](https://www.npmjs.org/package/gulp-data) for usage examples.

## License

[MIT](http://opensource.org/licenses/MIT) © [Kaanon MacFarlane](http://kaanon.com)
