/* eslint import/no-dynamic-require:0 */
/* eslint global-require:0 */
/* eslint-disable-next-line func-names */
module.exports = function (grunt) {
	// Utility to load the different option files
	// based on their names
	function loadConfig(path) {
		const glob = require('glob');
		const object = {};
		let key;
		glob.sync('*', { cwd: path }).forEach((option) => {
			key = option.replace(/\.js$/, '');
			object[key] = require(path + option);
		});
		return object;
	}

	// Initial config
	const config = {
		pkg: grunt.file.readJSON('package.json'),
		env: process.env,
		paths: {
			// PHP assets
			php: {
				files_std: [
					// Standard file match
					'**/*.php',
					'!node_modules/**/*.php',
					'!vendor/**/*.php',
				],
				files: '<%= paths.php.files_std %>', // Dynamic file match
			},

			// Files which should be prettified with Prettier.
			prettier: {
				files_std: [
					// Standard file match
					'<%= paths.js.files %>',
					'<%= paths.sass.files %>',
					'<%= paths.json.files %>',
				],
				files: '<%= paths.prettier.files_std %>', // Dynamic file match
			},

			// JavaScript assets
			js: {
				grunt: {
					tasks: 'tasks/**/*.js',
					gruntfile: 'Gruntfile.js',
				},
				src: 'src/assets/js', // Development code
				dest: 'dist/assets/js', // Production code
				dist_file_name: 'app.js',
				files_std: [
					// Standard file match
					'<%= paths.js.src %>/**/*.js',
					'!<%= paths.js.dest %>/**/*',
					'<%= paths.js.grunt.tasks %>',
					'<%= paths.js.grunt.gruntfile %>',
				],
				files: '<%= paths.js.files_std %>', // Dynamic file match
			},

			// Sass assets
			sass: {
				src: 'src/assets/scss', // Source files dir
				dest: 'dist/assets/css', // Compiled files dir
				files_std: [
					// Standard file match
					'<%= paths.sass.src %>/**/*.scss',
				],
				files: '<%= paths.sass.files_std %>', // Dynamic file match
			},

			// CSS assets
			css: {
				src: 'dist/assets/css', // Source files dir
				files_std: [
					// Standard file match
					'<%= paths.css.src %>/*.css',
				],
				files: '<%= paths.css.files_std %>', // Dynamic file match
			},

			// JSON assets
			json: {
				files_std: [
					// Standard file match
					'**/*.json',
					'.eslintrc',
					'.prettierrc',
					'.stylelintrc.json',
					'!package-lock.json',
					'!node_modules/**/*.json',
					'!vendor/**/*.json',
				],
				files: '<%= paths.json.files_std %>', // Dynamic file match
			},

			// html assets
			html: {
				src: '.', // Source files dir
				files_std: [
					// Standard file match
					'<%= paths.html.src %>/**/*.{html,htm}',
					'!./node_modules/**/*.{html,htm}',
					'!./vendor/**/*.{html,htm}',
				],
				files: '<%= paths.html.files_std %>', // Dynamic file match
			},

			// Images
			img: {
				ext: 'png,jpg,gif,svg,jpeg',
				src: 'src/assets/images/**/*.{<%= paths.img.ext %>}', // Source files
				dest: 'dist/assets/images', // destination files dir
				files_std: [
					// Standard file match
					'<%= paths.img.src %>',
					'!<%= paths.img.dest %>',
				],
				files: '<%= paths.img.files_std %>', // Dynamic file match
			},
		},
	};

	// Load tasks from the tasks folder
	grunt.loadTasks('tasks');

	// Load all task options in tasks/options
	grunt.util._.extend(config, loadConfig('./tasks/options/'));

	/**
	 * Adds input source map for babel task.
	 * Because grunt tries to read the map before it was generated, this has to be done
	 * in a task. configureBabelInputSourceMap task must always be called before babel task.
	 */
	function setBabelInputSourceMap() {
		config.babel.options.inputSourceMap = grunt.file.readJSON(
			`${config.paths.js.dest}/${config.paths.js.dist_file_name}.js.map`,
		);
	}
	grunt.task.registerTask(
		'configureBabelInputSourceMap',
		'configures babel input source map',
		setBabelInputSourceMap,
	);

	grunt.initConfig(config);

	grunt.event.on('watch', (action, filepath) => {
		// Determine task based on filepath
		function getExt(path) {
			let ret = '';
			const i = path.lastIndexOf('.');
			if (i !== -1 && i <= path.length) {
				ret = path.substr(i + 1);
			}
			return ret;
		}

		switch (getExt(filepath)) {
			// PHP
			case 'php':
				grunt.config('paths.php.files', [filepath]);
				break;
			// JavaScript
			case 'js':
				grunt.config('paths.js.files', [filepath]);
				grunt.config('paths.prettier.files', [filepath]);
				break;
			// SASS / SCSS
			case 'sass':
			case 'scss':
				grunt.config('paths.sass.files', [filepath]);
				grunt.config('paths.prettier.files', [filepath]);
				break;
			// CSS
			case 'css':
				grunt.config('paths.css.files', [filepath]);
				break;
			// JSON
			case 'json':
			case 'eslintrc':
			case 'prettierrc':
				grunt.config('paths.json.files', [filepath]);
				grunt.config('paths.prettier.files', [filepath]);
				break;
			// html
			case 'htm':
			case 'html':
				grunt.config('paths.html.files', [filepath]);
				break;
			// Images
			case 'png':
			case 'jpg':
			case 'gif':
			case 'svg':
			case 'jpeg':
				grunt.config('paths.img.files', [filepath]);
				break;
			default:
				break;
		}
	});

	// loads any tasks listed in devDependencies in package.json
	require('load-grunt-tasks')(grunt);
};
