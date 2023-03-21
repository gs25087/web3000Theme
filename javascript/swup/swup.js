import lazySizes from 'lazysizes';
import { swupInit } from './swupInit';

import Swup from 'swup';
//import SwupDebugPlugin from '@swup/debug-plugin';
import SwupScrollPlugin from '@swup/scroll-plugin';
import SwupBodyClassPlugin from '@swup/body-class-plugin';
import SwupPreloadPlugin from '@swup/preload-plugin';
//import SwupGiaPlugin from '@swup/gia-plugin';
import SwupHtmlLangPlugin from '@mashvp/swup-html-lang-plugin';

lazySizes.cfg.init = false;

document.addEventListener('DOMContentLoaded', function () {
	//const swup = new Swup();
	const swup = new Swup({
		containers: ['.nav-inner, #content'],
		animationSelector: '[class*="swup-transition-"]',
		plugins: [
			new SwupHtmlLangPlugin(),
			new SwupBodyClassPlugin(),
			new SwupPreloadPlugin(),
			//new SwupGiaPlugin({ components: components }),
			new SwupScrollPlugin({
				doScrollingRightAway: false,
				animateScroll: false,
			}),
			//new SwupDebugPlugin()
		],
		linkSelector:
			'a[href^="' +
			window.location.origin +
			'"]:not([data-no-swup]):not([href$=".pdf"]):not([href$=".zip"]), a[href^="/"]:not([data-no-swup]):not([href$=".pdf"]):not([href$=".zip"]), a[href^="#"]:not([data-no-swup]):not([href$=".pdf"]):not([href$=".zip"])',
	});

	function swupclickLink() {
		document.querySelector('.menu-close').click();
	}

	function swupUnload() {
		// log("unload swup");
		const html = document.querySelector('html');
		const body = document.querySelector('body');
		html.classList.remove('swupReady');
		body.scrollTop = 0;
	}

	function swupReplace() {
		//console.log("test swup");
		swupInit();
	}

	// this event runs for every page view after initial load
	swup.on('clickLink', swupclickLink);
	swup.on('willReplaceContent', swupUnload);
	swup.on('contentReplaced', swupReplace);

	swupInit();
});
