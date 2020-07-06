// eslint-disable-next-line func-names
module.exports = function (grunt) {
	grunt.registerTask('autofix', ['phpcbf', 'eslint:fix', 'stylelint:fix']);
};
