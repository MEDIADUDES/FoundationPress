const path = require('path');
// eslint-disable-next-line import/no-extraneous-dependencies
const webpack = require('webpack');

module.exports = {
	build: {
		entry: [`${path.resolve()}/<%= paths.js.src %>/app.js`],
		output: {
			path: `${path.resolve()}/<%= paths.js.dest %>`,
			filename: '<%= paths.js.dist_file_name %>',
		},
		stats: {
			colors: true,
			modules: true,
			reasons: true,
		},
		storeStatsTo: 'webpackStats',
		progress: true,
		failOnError: true,
		watch: false,
		devtool: 'source-map',
		plugins: [
			new webpack.ProvidePlugin({
				$: 'jquery',
				jQuery: 'jquery',
				'window.jQuery': 'jquery',
				'window.$': 'jquery',
			}),
		],
		module: {
			rules: [
				{
					test: /\.js$/,
					exclude: /(node_modules|vendor)/,
					use: {
						loader: 'babel-loader',
						options: {
							presets: ['@babel/env', '@babel/preset-react'],
							plugins: [
								'transform-class-properties',
								'@babel/plugin-proposal-object-rest-spread',
							],
						},
					},
				},
			],
		},
	},
};
