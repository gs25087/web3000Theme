import lazySizes from 'lazysizes';

export const swupInit = () => {
	// log("init swup");

	lazySizes.cfg.customMedia = {
		'--small': '(max-width: 375px)',
		'--medium': '(max-width: 768px)',
		'--big': '(max-width: 1024px)',
		'--large': '(max-width: 1920px)',
		'--retina': '(max-width: 2560px)',
	};

	lazySizes.init();

	const paragraphs = document.querySelectorAll('p');
	paragraphs.forEach(function (paragraph) {
		paragraph.innerHTML = paragraph.innerHTML.replace(/\u2028/g, ' ');
	});

	const pdfLinks = document.querySelectorAll('a[href$=".pdf"]');
	pdfLinks.forEach(function (pdfLink) {
		pdfLink.setAttribute('target', '_blank');
	});

	const allLinks = document.querySelectorAll(
		'a:not([href^="tel"]):not([href^="mailto"])'
	);
	allLinks.forEach(function (link) {
		const regex = new RegExp('/' + window.location.host + '/');
		if (!regex.test(link.href)) {
			link.setAttribute('target', '_blank');
		}
	});

	const audioElements = document.querySelectorAll('audio');
	audioElements.forEach(function (audio) {
		audio.setAttribute('controlsList', 'nodownload');
	});

	const audioContextMenuHandler = function (event) {
		event.preventDefault();
	};
	audioElements.forEach(function (audio) {
		audio.addEventListener('contextmenu', audioContextMenuHandler);
	});

	// right mouse click
	/*if (document.addEventListener) {
          document.addEventListener('contextmenu', function (e) {
              e.preventDefault();
          }, false);
      } else {
          document.attachEvent('oncontextmenu', function () {
              window.event.returnValue = false;
          });
      }*/

	const images = document.querySelectorAll('img');
	images.forEach(function (image) {
		image.setAttribute('draggable', false);
		image.setAttribute('unselectable', 'on');
		image.addEventListener(
			'dragstart',
			function (event) {
				event.preventDefault();
			},
			{ passive: true }
		);
	});
	window.ondragstart = function () {
		return false;
	};

	setTimeout(function () {
		const html = document.querySelector('html');
		html.classList.add('swupReady');
	}, 200);
};
