module.exports = {
	dist: {
		options: {
			style: 'compressed',
		},
		files: {
			'<%= paths.sass.dest %>/app.css': '<%= paths.sass.src %>/app.scss',
			'<%= paths.sass.dest %>/editor.css': '<%= paths.sass.src %>/editor.scss',
		},
	},
};
