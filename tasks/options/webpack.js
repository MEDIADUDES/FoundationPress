const path = require('path');
/* eslint-disable import/no-extraneous-dependencies */
const webpack = require('webpack');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const glob = require('glob');

const jsBlocks = glob.sync(`${path.resolve()}/src/assets/js/blocks/*.js`);
const scssFiles = glob.sync(`${path.resolve()}/src/assets/scss/**/[!_]*.scss`);

let entries = [`${path.resolve()}/<%= paths.js.src %>/app.js`];
entries = entries.concat(jsBlocks, scssFiles);

const isJSBlock = (filepath) => {
	const regex = /\/js\/blocks\//g;
	return filepath.match(regex) !== null;
};

const isSCSSFile = (filepath) => {
	const regex = /\/scss\//g;
	return filepath.match(regex) !== null;
};

// convert array to object with filenames as keys
entries = entries.reduce((acc, filepath) => {
	const filenameRegex = /([\w\d_-]*)\.?[^\\/]*$/i;
	const name = filepath.match(filenameRegex)[1];

	if (isJSBlock(filepath)) {
		acc[`jsblock_${name}`] = {
			import: filepath,
			filename: `blocks/${name}.js`,
			dependOn: 'app',
		};
	} else if (isSCSSFile(filepath)) {
		const subfolderRegex = /\/scss\/([\w\d_-]*\/)?([\w\d_-]*)\.scss$/i;
		const subfolder = filepath.match(subfolderRegex)[1];

		acc[`scss_${name}`] = {
			import: filepath,
			filename: `scss/${subfolder || ''}${name}.js`,
		};
	} else {
		acc[name] = filepath;
	}

	return acc;
}, {});

module.exports = {
	build: {
		mode: process.env.NODE_ENV === 'development' ? 'development' : 'production',
		entry: entries,
		output: {
			path: `${path.resolve()}/<%= paths.js.dest %>`,
			filename: '[name].js',
		},
		optimization: {
			runtimeChunk: 'single',
		},
		stats: {
			colors: true,
			errorDetails: true,
		},
		storeStatsTo: 'webpackStats',
		progress: true,
		failOnError: true,
		watch: false,
		externals: {
			jquery: 'jQuery',
		},
		devtool:
			process.env.NODE_ENV === 'development'
				? 'inline-cheap-module-source-map' // fix FF wrong line numbers while developing
				: 'nosources-source-map',
		plugins: [
			new webpack.ProvidePlugin({
				$: 'jquery',
			}),
			new MiniCssExtractPlugin({
				// Options similar to the same options in webpackOptions.output
				// both options are optional
				filename: (pathData) => {
					const filepath = pathData.chunk.filenameTemplate;
					const subfolderRegex = /scss\/([\w\d_-]*\/)?([\w\d_\-[\]]*)\.js$/i;
					const subfolder = filepath.match(subfolderRegex)[1];
					const filename = filepath.match(subfolderRegex)[2];
					return `../css/${subfolder || ''}${filename}.css`;
				},
			}),
			new CopyWebpackPlugin({
				patterns: [
					{
						from: `${path.resolve()}/src/assets/images`,
						to: `${path.resolve()}/dist/assets/images`,
					},
					{
						from: `${path.resolve()}/src/assets/fonts`,
						to: `${path.resolve()}/dist/assets/fonts`,
					},
				],
			}),
		],
		module: {
			rules: [
				{
					test: /\.js$/,
					exclude:
						process.env.NODE_ENV === 'development'
							? /(node_modules|vendor)/
							: /(vendor)/,
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
							loader: 'css-loader',
							options: {
								url: false,
								sourceMap: true,
							},
						},
						{
							loader: 'postcss-loader',
							options: {
								postcssOptions: {
									parser: 'postcss-scss',
									plugins: [['autoprefixer', {}]],
								},
								sourceMap: true,
							},
						},
						{
							loader: 'sass-loader',
							options: {
								sourceMap: true,
							},
						},
					],
				},
			],
		},
	},
};
