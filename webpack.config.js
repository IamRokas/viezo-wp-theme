const path = require( 'path' );
const CopyPlugin = require( 'copy-webpack-plugin' );
const SVGSpritemapPlugin = require( 'svg-spritemap-webpack-plugin' );
const { CleanWebpackPlugin } = require( 'clean-webpack-plugin' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const ESLintPlugin = require( 'eslint-webpack-plugin' );
const StylelintPlugin = require( 'stylelint-webpack-plugin' );

const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const { reload } = require('browser-sync');

// change these variables to fit your project
const jsPath= './src';
const cssPath = './src/scss';
const outputPath = 'build';
const localDomain = 'https://viezo2.padarom.lt';


/**
 * Webpack config (Development mode)
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-scripts/#provide-your-own-webpack-config
 */
module.exports = {
	entry: './src/index.js',
	output: {
		path: path.resolve(__dirname, outputPath),
		filename: 'index.js',
	},
	stats: {
        // Configure the console output
        errorDetails: false, //this does show errors
        colors: true,
        modules: false,
        reasons: true
    },
	devServer: {
		https: true,
		headers: {
			"Access-Control-Allow-Origin": "*",
		},
		// ....
	},
	module: {
		rules: [
			{
				test: /\.js$/i,
				include: path.resolve(__dirname, 'src'),
				use: {
					loader: 'babel-loader', options: {
						presets: ['@babel/preset-env'],
          			},
				},
			},
			{
				test: /\.(webp|png|jpe?g|gif)$/,
				type: 'asset/resource',
				generator: {
					filename: 'images/[name][ext]',
				},
			},
			{
				test: /\.(sa|sc|c)ss$/,
				exclude: '/node_modules',
				use: [
					MiniCssExtractPlugin.loader,
					'css-loader',
					'postcss-loader',
					{
						loader: "sass-loader",
						options: {
						// Prefer `dart-sass`
						implementation: require("sass"),
						},
					},
				],
			},
			{
				test: /\.svg$/,
				type: 'asset/inline',
			},
			{
				test: /\.(woff(2)?|ttf|eot)$/,
				type: 'asset/resource',
				generator: {
					filename: "fonts/[name][ext]",
				},
			},
		],
	},
	plugins: [

		new BrowserSyncPlugin({
		proxy: localDomain,
		host: 'viezo2.padarom.lt',
		files: [
			outputPath + '/*.css',
			outputPath + '/*.js',
			'**/*.php'
			],
		injectCss: true,
		open: false
		}, { reload: false, }),

		new MiniCssExtractPlugin(),

		/**
		 * Copy source files/directories to a build directory.
		 *
		 * @see https://www.npmjs.com/package/copy-webpack-plugin
		 */
		new CopyPlugin( {
			patterns: [
				{
					from: '**/*.{jpg,jpeg,png,gif,svg,ico}',
					to: 'images/[path][name][ext]',
					context: path.resolve( process.cwd(), 'src/images' ),
				},
				{
					from: '*.svg',
					to: 'images/icons/[name][ext]',
					context: path.resolve( process.cwd(), 'src/images/icons' ),
				},
			],
		} ),

		/**
		 * Generate an SVG sprite.
		 *
		 * @see https://github.com/cascornelissen/svg-spritemap-webpack-plugin
		 */
		new SVGSpritemapPlugin( 'src/images/icons/*.svg', {
			output: {
				filename: 'images/icons/sprite.svg',
			},
			sprite: {
				prefix: 'vicons-',
			},
			styles: {
				filename: 'src/scss/sprites.scss',
				keepAttributes: true,
			},
		} ),

		/**
		 * Clean build directory.
		 *
		 * @see https://www.npmjs.com/package/clean-webpack-plugin
		 */
		new CleanWebpackPlugin( {
			cleanAfterEveryBuildPatterns: [ '!fonts/**', '!*.woff2' ],
		} ),

		/**
		 * Report JS warnings and errors to the command line.
		 *
		 * @see https://www.npmjs.com/package/eslint-webpack-plugin
		 */
		//new ESLintPlugin(),

		/**
		 * Report css warnings and errors to the command line.
		 *
		 * @see https://www.npmjs.com/package/stylelint-webpack-plugin
		 */
		//new StylelintPlugin(),
	],
};
