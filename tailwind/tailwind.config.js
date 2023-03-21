// Set Preflight flag and Tailwind Typography class name based on the build
// target.
let includePreflight, typographyClassName;
if ('editor' === process.env._TW_TARGET) {
	includePreflight = false;
	typographyClassName = 'block-editor-block-list__layout';
} else {
	includePreflight = true;
	typographyClassName = 'prose';
}

module.exports = {
	presets: [
		// Manage Tailwind Typography's configuration in a separate file.
		require('./tailwind-typography.config.js'),
	],
	content: [
		// Ensure changes to PHP files and `theme.json` trigger a rebuild.
		'./javascript/components/**/*.js',
		'./javascript/components/**/*.css',
		'./web3000theme/**/*.php',
		'./web3000theme/theme.json',
	],
	future: {
		hoverOnlyWhenSupported: true,
	},
	theme: {
		/* fontFamily: {
			sans: ["metric", "sans-serif"],
			serif: ["TimesNow", "serif"],
		}, */
		paddingSafe: {
			padding: {
				1: '1rem',
			},
			suffix: {
				notch: 'notch',
			},
			onlySupportsRules: true,
		},
		// Extend the default Tailwind theme.
		extend: {
			screens: {
				md: '768px',
				lg: '1024px',
				xl: '1280px',
				'2xl': '1536px',
				'3xl': '1920px',
				lgdown: { raw: '(max-width: 767px)' },
				mddown: { raw: '(max-width: 1023px)' },
				lgup: { raw: '(min-width: 1025px)' },
				onlyhover: { raw: '(hover: hover)' },
				print: { raw: 'print' },
			},
			container: {
				center: true,
				padding: {
					DEFAULT: '1rem',
					sm: '2rem',
					lg: '4rem',
					xl: '5rem',
					'2xl': '6rem',
				},
			},
			backgroundImage: {
				closecat:
					'url("/wp-content/themes/web3000theme/images/close.svg")',
				checkmark:
					'url("/wp-content/themes/web3000theme/images/checkbox.svg")',
			},
			backgroundSize: {
				auto: 'auto',
				cover: 'cover',
				contain: 'contain',
				bgSVG: 'calc(100% - 1px)',
			},
			colors: {
				lightgray: '#F5F5F5',
				lightestgray: '#00000029',
				darkgray: '#939090',
				gray: '#E2E2E2',
				green: '#00CE50',
			},
			fontSize: {
				xs: '.875rem',
				sm: '.9rem',
				base: '1rem',
				lg: '2rem',
				xl: '2.625rem',
			},
			spacing: {
				headerHeightMobile: '3.72rem',
				headerHeightDesktop: '3rem',
				wrapMobile: '0.61rem',
				wrapDesktop: '1rem',
			},
		},
	},
	corePlugins: {
		// Disable Preflight base styles in CSS targeting the editor.
		preflight: includePreflight,
	},
	plugins: [
		// Extract colors and widths from `theme.json`.
		require('@_tw/themejson')(require('../web3000theme/theme.json')),

		// Add Tailwind Typography.
		require('@tailwindcss/typography')({
			className: typographyClassName,
		}),
	],
};
