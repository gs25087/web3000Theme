const { detect } = require('detect-browser');
const browser = detect();

if (browser) {
	const root = document.documentElement;
	root.className += ` ${browser.name} ${browser.name}-${browser.version} `;
}
