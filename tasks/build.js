// eslint-disable-next-line func-names
module.exports = function (grunt) {
	grunt.registerTask('build', ['lint', 'webpack']);
};
