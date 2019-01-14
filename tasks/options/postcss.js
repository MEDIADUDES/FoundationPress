/* eslint import/no-extraneous-dependencies:0 */
/* eslint global-require:0 */
module.exports = {
	options: {
		// or
		map: {
			inline: false, // save all sourcemaps as separate files...
			annotation: '', // ...to the specified directory
		},
		processors: [
			require('pixrem')(),
			require('autoprefixer')({ browsers: 'last 3 versions' }), // add vendor prefixes
		],
	},
	dist: {
		src: '<%= paths.sass.dest %>/style.css',
	},
};
