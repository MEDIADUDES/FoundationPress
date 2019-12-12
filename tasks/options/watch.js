module.exports = {
	options: {
		livereload: true,
		spawn: false,
	},

	scripts: {
		files: ['<%= paths.js.files_std %>'],
		tasks: ['prettier', 'eslint:fix', 'webpack'],
	},

	sass: {
		files: ['<%= paths.sass.files_std %>'],
		tasks: ['prettier', 'stylelint:fix', 'webpack'],
		options: {
			livereload: false,
		},
	},

	css: {
		files: ['<%= paths.css.files_std %>'],
		tasks: [],
	},

	json: {
		files: ['<%= paths.json.files_std %>'],
		tasks: ['prettier'],
	},

	html: {
		files: ['<%= paths.html.files_std %>'],
		tasks: [],
	},

	php: {
		files: ['<%= paths.php.files_std %>'],
		tasks: ['phplint', 'phpcbf', 'phpcs'],
	},

	images: {
		files: ['<%= paths.img.files_std %>'],
		tasks: ['webpack'],
	},
};
