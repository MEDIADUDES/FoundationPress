// eslint-disable-next-line func-names
module.exports = function (grunt) {
	grunt.registerTask('lint', [
		'phplint',
		'phpcs',
		'eslint:check',
		'stylelint:check',
	]);
};
