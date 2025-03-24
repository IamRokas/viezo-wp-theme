/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		'./**/*.php',
		'./src/js/**/*.js'
	],
	theme: {
		fontSize: {
			'2xs': '0.75rem',
			xs: '0.875rem',
			sm: '1rem',
			base: '1.125rem',
			lg: '1.25rem',
			xl: '1.625rem',
			'2xl': '2rem',
			'3xl': '3.25rem',
			'4xl': '5.25rem'
		},
		fontWeight: {
			extralight: 300,
			light: 300,
			normal: 400,
			medium: 500,
			semibold: 600,
			bold: 700,
			black: 900
		},
		colors: {
			transparent: 'transparent',
			current: 'currentColor',
			white: '#ffffff',
			black: '#000000',
			'primary-green': '#46af87',
			'primary-blue': '#14497d',
			'darkest-grey': '#3a3a3a',
			'dark-grey': '#222222',
			'light-grey': '#f9f9f9',
			'button-hover-green': '#50cf9f',
			'button-hover-blue': '#1661ab',
			'dark-green': '#1c8d62',
			'border-gray': '#BCBCBC',
		},
		fontFamily: {
			'osp-din': 'OSP-DIN, "Saira ExtraCondensed", sans-serif',
			'saira': '"Saira ExtraCondensed", sans-serif',
			'hiragino-sans': '"Hiragino Sans", "Work Sans", "Open Sans", sans-serif'
		},
		boxShadow: {
			'card-shadow': '0px 4px 4px 0px rgba(0,0,0,0.08)',
			'mano-card': '2px 4px 24px 0px rgba(80,108,205,0.15)',
			shad: '0px 3px 16px 3px rgba(80,108,205,0.1)',
		},
		borderRadius: {
			none: '0',
			xs: '0.125rem',
			sm: '0.25rem',
			default: '0.3125rem',
			lg: '0.375rem',
			xl: '0.625rem',
			'2xl': '0.75rem',
			'3xl': '1.25rem',
			full: '9999px'
		},
		spacing: {
			px: '1px',
			0: '0',
			8: '0.5rem',
			10: '0.625rem',
			12: '0.75rem',
			16: '1rem',
			20: '1.25rem',
			24: '1.5rem',
			28: '1.75rem',
			32: '2rem',
			40: '2.5rem',
			44: '2.75rem',
			48: '3rem',
			56: '3.5rem',
			58: '3.625rem',
			64: '4rem',
			68: '4.25rem',
			72: '4.5rem',
			76: '4.75rem',
			80: '5rem',
			84: '5.25rem',
			92: '5.75rem',
			104: '6.5rem',
			140: '8.75rem',
			192: '12rem',
			// Additional custom heights that might be useful
			'300': '300px',
			'400': '400px',
			'500': '500px',
			'600': '600px',
		},
		screens: {
			phone: '300px',
			md: '768px',
			'tablet-landscape': '900px',
			desktop: '1024px',
			desktopLarge: '1440px',
		},
		container: (theme) => ({
			center: true,
			screens: {
				phone: '100%',
				desktopLarge: '1140px',
			},
			padding: {
				DEFAULT: theme('spacing.24'),
				desktop: theme('spacing.16'),
				desktopLarge: '0',
			},
		}),

		'big-container': (theme) => ({
			center: true,
			screens: {
				phone: '100%',
				desktopLarge: '1440px',
			},
			padding: {
				DEFAULT: theme('spacing.24'),
				desktop: theme('spacing.16'),
				desktopLarge: '0',
			},
		}),

		extend: {
			backgroundOpacity: {
				10: '0.1',
			},
			// Add arbitrary value support for specific properties
			height: {
				// Additional custom heights
			},
			width: {
				// Additional custom widths
			},
			spacing: {
				// Additional spacing values
			}
		},
	},
	plugins: [
		function ({
			addBase,
			config
		}) {
			addBase({
				html: {
					fontWeight: 200,
				},
				'h1,h2,h3,h4,h5,h6,.h1,.h2': {
					fontFamily: config('theme.fontFamily.osp-din'),
					textTransform: 'uppercase',
					lineHeight: '1.12',
					letterSpacing: '1.5px',
					//textShadow: '0px 4px 4px rgba(0, 0, 0, 0.25)',
				},
				'h1,.h1': {
					fontSize: config('theme.fontSize.4xl'),
				},
				'h2,.h2': {
					fontSize: config('theme.fontSize.3xl'),
				},
				'h3,.h3': {
					fontSize: '2rem',
				},
				'h4,.h4': {
					fontSize: config('theme.fontSize.xl'),
					letterSpacing: '0.5px',
					lineHeight: 1.23
				},
				'h5,.h5': {
					fontSize: '1.5rem',
				},
				'h6,.h6': {
					fontSize: '1.5rem',
				},

				'.font-header-text': {
					fontFamily: config('theme.fontFamily.osp-din'),
					lineHeight: 1.25,
					letterSpacing: '0.5px',
					textTransform: 'uppercase',
					fontFeatureSettings: "'salt' on, 'liga' off",
					color: config('theme.color.darkestGrey'),
				},
				a: {
					textDecoration: 'none',
				},
				p: {
					marginBottom: config('theme.spacing.16'),
					'&:last-child': {
						marginBottom: '0',
					},
				},
				'.button': {
					padding: config('theme.spacing.16'),
				},
				'table,dl,ol,ul,address,pre,blockquote,iframe': {
					marginBottom: config('theme.spacing.16'),
				},
				pre: {
					overflow: 'auto',
				},
			});
		},
		function ({
			addComponents,
			config
		}) {
			const screenReaderText = {
				'.screen-reader-text': {
					clip: 'rect(1px, 1px, 1px, 1px)',
					height: '1px',
					overflow: 'hidden',
					position: 'absolute',
					whiteSpace: 'nowrap',
					width: '1px',
					'&:hover,&:active,&:focus': {
						backgroundColor: config('theme.colors.black'),
						clip: 'auto',
						color: config('theme.colors.white'),
						display: 'block',
						fontSize: config('theme.fontSize.base'),
						fontWeight: config('theme.fontWeight.medium'),
						height: 'auto',
						left: '5px',
						lineHeight: 'normal',
						padding: config('theme.spacing.8'),
						textDecoration: 'none',
						top: '5px',
						width: 'auto',
						zIndex: '100000',
					},
				},
			};

			addComponents(screenReaderText, {
				variants: ['hover', 'active', 'focus'],
			});
		},
	],
	safelist: [
		// Add classes that might be generated dynamically
		// or not detected by the purge process
	],
};
