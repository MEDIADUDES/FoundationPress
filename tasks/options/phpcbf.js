module.exports = {
	files: {
		src: ['<%= paths.php.files %>'],
	},
	options: {
		// hack: args not directly supported by grunt-phpcbf can be added in the bin path
		bin:
			'vendor/bin/phpcbf -p --colors --extensions=php --ignore=.sass-cache,.phpintel,node_modules,vendor --standard=phpcs.ruleset.xml --warning-severity=1',
		noPatch: false,
	},
};
