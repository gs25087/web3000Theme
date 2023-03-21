module.exports = {
	proxy: {
		target: 'https://theme2.web3000.net',
	},
	watch: true,
	files: [
		'web3000theme/**/*.php',
		'web3000theme/style.css',
		'web3000theme/js/*.js',
		{
			match: ['wp-content/themes/**/*.php'],
			options: {
				ignore: ['.history/**/*'],
			},
			fn: function (event, file) {
				/** Custom event handler **/
			},
		},
	],
	serveStatic: ['.'],
  https: true,
	browser: 'google chrome',
	reloadDelay: 500,
	reloadDebounce: 2000,
};

/* 	files: ['./web3000theme/style.css', './web3000theme/js/script.min.js', ],
 */
