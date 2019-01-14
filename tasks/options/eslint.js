module.exports = {
	options: {
		configFile: '.eslintrc',
		useEslintrc: false,
	},
	check: {
		options: {
			fix: false,
		},
		src: ['<%= paths.js.files %>'],
	},
	fix: {
		options: {
			fix: true,
		},
		src: ['<%= paths.js.files %>'],
	},
};
