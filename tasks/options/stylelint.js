/* eslint-disable-next-line import/no-extraneous-dependencies */
const stylelintFormatter = require('stylelint-formatter-pretty');

module.exports = {
	options: {
		formatter: stylelintFormatter,
	},
	check: {
		options: {
			fix: false,
		},
		src: ['<%= paths.sass.files %>'],
	},
	fix: {
		options: {
			fix: true,
		},
		src: ['<%= paths.sass.files %>'],
	},
};
