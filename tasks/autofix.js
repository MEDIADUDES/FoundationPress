// eslint-disable-next-line func-names
module.exports = function (grunt) {
	grunt.registerTask('autofix', [
		'phpcbf',
		'prettier',
		'eslint:fix',
		'stylelint:fix',
	]);
};
