const path = require('path');
/* eslint-disable import/no-extraneous-dependencies */
const webpack = require('webpack');
const autoprefixer = require('autoprefixer');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
	build: {
		mode: process.env.NODE_ENV === 'production' ? 'production' : 'development',
		entry: {
			app: `${path.resolve()}/<%= paths.js.src %>/app.js`,
			main: `${path.resolve()}/<%= paths.sass.src %>/main.scss`,
			editor: `${path.resolve()}/<%= paths.sass.src %>/editor.scss`,
		},
		output: {
			path: `${path.resolve()}/<%= paths.js.dest %>`,
			filename: '[name].js',
		},
		stats: {
			colors: true,
		},
		storeStatsTo: 'webpackStats',
		progress: true,
		failOnError: true,
		watch: false,
		devtool: 'nosources-source-map',
		plugins: [
			new webpack.ProvidePlugin({
				$: 'jquery',
				jQuery: 'jquery',
				'window.jQuery': 'jquery',
				'window.$': 'jquery',
			}),
			new webpack.LoaderOptionsPlugin({
				options: {
					postcss: [autoprefixer()],
				},
			}),
			new MiniCssExtractPlugin({
				// Options similar to the same options in webpackOptions.output
				// both options are optional
				filename: '../css/[name].css',
			}),
			new CopyWebpackPlugin([
				{
					from: `${path.resolve()}/src/assets/images`,
					to: `${path.resolve()}/dist/assets/images`,
				},
			]),
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
				{
					test: /\.scss$/,
					use: [
						{
							loader: MiniCssExtractPlugin.loader,
						},
						{
							loader: 'css-loader?-url&sourceMap',
						},
						{
							loader: 'postcss-loader',
							options: {
								parser: 'postcss-scss',
								sourceMap: true,
							},
						},
						{
							loader: 'sass-loader',
							query: {
								outputStyle:
									process.env.NODE_ENV === 'production'
										? 'compressed'
										: 'extended',
								sourceMap: true,
								sourceMapContents: false,
							},
						},
					],
				},
			],
		},
	},
};
