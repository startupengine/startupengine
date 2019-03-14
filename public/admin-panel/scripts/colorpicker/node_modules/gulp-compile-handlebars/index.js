var gutil = require('gulp-util');
var through = require('through2');
var Handlebars = require('handlebars');
var fs = require('fs');
var extend = require('util')._extend;
var path = require('path');

function handlebars(data, opts) {

	var options = opts || {};
	    
	//Go through a partials object
	if(options.partials){
		for(var p in options.partials){
			Handlebars.registerPartial(p, options.partials[p]);
		}
	}
	//Go through a helpers object
	if(options.helpers){
		for(var h in options.helpers){
			Handlebars.registerHelper(h, options.helpers[h]);
		}
	}

	// Do not search for more than 10 nestings
	var maxDepth = 10;
	// Process only files with given extension names
	var allowedExtensions = ['hb', 'hbs', 'handlebars', 'html'];

	var isDir = function (filename) {
		var stats = fs.statSync(filename);
		return stats && stats.isDirectory();
	};

	var isHandlebars = function (filename) {
		return allowedExtensions.indexOf(filename.split('.').pop()) !== -1;
	};

	var partialName = function (filename, base) {
		var name = path.join(path.dirname(filename), path.basename(filename, path.extname(filename)));
		if (name.indexOf(base) === 0) {
			name = name.slice(base.length);
		}
		// Change the name of the partial to use / in the partial name, not \
		name = name.replace(/\\/g, '/');

		// Remove leading _ and / character
		var firstChar = name.charAt(0);
		if( firstChar === '_' || firstChar === '/'  ){
			name = name.substring(1);
		}
		
		return name;
	};

	var registerPartial = function (filename, base) {
		if (!isHandlebars(filename)) { return; }
		var name = partialName(filename, base);
		var template = fs.readFileSync(filename, 'utf8');

		Handlebars.registerPartial(name, template);
	};

	var registerPartials = function (dir, base, depth) {
		if (depth > maxDepth) { return; }
		base = base || dir;
		fs.readdirSync(dir).forEach(function (basename) {
			var filename = path.join(dir, basename);
			if (isDir(filename)) {
				registerPartials(filename, base);
			} else {
				registerPartial(filename, base);
			}
		});
	};

	// Go through a partials directory array
	if(options.batch){
		// Allow single string
		if(typeof options.batch === 'string') options.batch = [options.batch];

		options.batch.forEach(function (dir) {
			dir = path.normalize(dir);
			registerPartials(dir, dir, 0);
		});
	}

	/**
	 * For handling unknown partials
	 * @method mockPartials
	 * @param  {string}     content Contents of handlebars file
	 */
	var mockPartials = function(content){
		var regex = /{{> (.*)}}/gim, match, partial;
		if(content.match(regex)){
			while((match = regex.exec(content)) !== null){
				partial = match[1];
				//Only register an empty partial if the partial has not already been registered
				if(!Handlebars.partials.hasOwnProperty(partial)){
					Handlebars.registerPartial(partial, '');
				}
			}
		}
	};


	return through.obj(function (file, enc, cb) {
		var _data = extend({}, data);

		if (file.isNull()) {
			this.push(file);
			return cb();
		}

		if (file.isStream()) {
			this.emit('error', new gutil.PluginError('gulp-compile-handlebars', 'Streaming not supported'));
			return cb();
		}

		try {
			var fileContents = file.contents.toString();
			if(options.ignorePartials){
				mockPartials(fileContents);
			}

			// Enable gulp-data usage, Extend default data with data from file.data
			if(file.data){
				_data = extend(_data, file.data);
			}
			var template = Handlebars.compile(fileContents, options.compile);
			file.contents = new Buffer(template(_data));
		} catch (err) {
			this.emit('error', new gutil.PluginError('gulp-compile-handlebars', err));
		}

		this.push(file);
		cb();
	});
}

// Expose the Handlebars object
handlebars.Handlebars = Handlebars;

module.exports = handlebars;
