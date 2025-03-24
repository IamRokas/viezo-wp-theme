const {
	merge
} = require('webpack-merge');
const common = require('./webpack.config.js');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const ImageminPlugin = require('imagemin-webpack-plugin').default;
const TerserPlugin = require("terser-webpack-plugin");

/**
 * Webpack config (Production mode)
 */
module.exports = merge(common, {
	plugins: [
		/**
		 * Uses Imagemin to compress source images.
		 */
		new ImageminPlugin({
			disable: false,
			test: /\.(jpe?g|png|gif|svg)$/i,
			gifsicle: {
				interlaced: true,
			},
			optipng: {
				optimizationLevel: 3,
			},
			jpegtran: {
				quality: 70,
				progressive: true,
			},
			svgo: null,
		}),
	],
	optimization: {
		minimizer: [
			/**
			 * Minify CSS.
			 */
			new CssMinimizerPlugin({
				minimizerOptions: {
					preset: [
						'default',
						{
							discardComments: {
								removeAll: true
							},
						},
					],
				},
			}),
			new TerserPlugin()
		],
	},
});
