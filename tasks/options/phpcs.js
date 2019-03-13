module.exports = {
	all: {
		src: ['<%= paths.php.files %>'],
	},
	options: {
		// hack: args not directly supported by grunt-phpcs can be added in the bin path
		bin:
			'vendor/bin/phpcs -s -p --colors --extensions=php --ignore=.sass-cache,.phpintel,node_modules,vendor',
		standard: 'phpcs.ruleset.xml',
	},
};
