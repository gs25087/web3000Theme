import Cookies from 'js-cookie';

let $cookieNotice = document.querySelector('#cookie-popup');
let cookieName = 'cookieconsent_status';
let $cookie_timer = 1500;
let $gaID = '2323123';

/*
window.dataLayer = window.dataLayer || [];

function gtag() {
  dataLayer.push(arguments);
}
gtag('js', new Date());
gtag('config', $gaID, { 'anonymize_ip': true });

function setGACookies() {
  if (window.location.href.indexOf('https://drivingt') > -1) {
    var s = document.createElement('script');
    s.type = "text/javascript";
    s.async = "true";
    s.src = "https://www.googletagmanager.com/gtag/js?id=" + $gaID;
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
  } 
  document.querySelectorAll('.img-nocookie').forEach(function(element) {
    element.style.display = 'none';
  });
  document.querySelectorAll('.iframe-accept-cookies').forEach(function(element) {
    element.setAttribute('src', element.getAttribute('data-src'));
  });
  document.querySelectorAll('.img-acceptedcookie').forEach(function(element) {
    element.style.display = 'block';
  });
}
*/

function marketingCookies() {
	// const url = window.location.href;
	// if (url.indexOf('https://drivingt') > -1) {
	//     const s = document.createElement('script');
	//     s.type = "text/javascript"
	//     s.async = "true";
	//     s.src = "https://www.googletagmanager.com/gtag/js?id=" + $gaID;
	//     const x = document.getElementsByTagName('script')[0];
	//     x.parentNode.insertBefore(s, x);
	// }
	// document.querySelectorAll('.img-nocookie').forEach(function (el) {
	//     el.style.display = 'none';
	// });
	document.querySelectorAll('.iframe-accept-cookies').forEach(function (el) {
		el.setAttribute('src', el.getAttribute('data-src'));
	});
	const iframeCookieCover = document.querySelector('.iframe-cookie-cover');
	if (iframeCookieCover) {
		iframeCookieCover.style.display = 'none';
	}
	console.log('marketing accepted');
	// document.querySelectorAll('.img-acceptedcookie').forEach(function (el) {
	//     el.style.display = 'block';
	// });
}

function statisticsCookies() {
	console.log('statistic accepted');
	console.log('do matomo');
}

export function swupCookies() {
	if (
		Cookies.get('cookieconsent_status') == 'marketing' ||
		Cookies.get('cookieconsent_status') == 'all'
	) {
		marketingCookies();
	}
}

function cookieBanner() {
	var cookieconsentStatus = Cookies.get('cookieconsent_status');
	if (cookieconsentStatus === 'all') {
		$cookieNotice.remove();
		statisticsCookies();
		marketingCookies();
		// setGACookies();
	} else if (cookieconsentStatus === 'marketing') {
		$cookieNotice.remove();
		marketingCookies();
	} else if (cookieconsentStatus === 'statistics') {
		$cookieNotice.remove();
		statisticsCookies();
		// setGACookies();
	} else if (cookieconsentStatus === 'basic') {
		if (document.querySelector('.iframe-cookie-cover')) {
			document.querySelector('.iframe-cookie-cover').style.display =
				'block';
		}
		$cookieNotice.remove();
		console.log('basic accepted');
	} else {
		console.log('cookies not selected');
		document.querySelector('#cookie-category-marketing').click();
		document.querySelector('#cookie-category-statistics').click();
		if (document.querySelector('.iframe-cookie-cover')) {
			document.querySelector('.iframe-cookie-cover').style.display =
				'block';
		}
		setTimeout(function () {
			$cookieNotice.classList.add('active');
		}, $cookie_timer);
	}
}

cookieBanner();

function setAcceptanceCookie(acceptTracking) {
	console.log('setAcceptanceCookie', acceptTracking);
	var expires = new Date(
		new Date().setFullYear(new Date().getFullYear() + 1)
	);
	if (acceptTracking == 'all') {
		document.cookie =
			cookieName + '=' + 'all' + '; expires=' + expires + '; secure=true';
		marketingCookies();
		statisticsCookies();
	} else if (acceptTracking == 'marketing') {
		document.cookie =
			cookieName +
			'=' +
			'marketing' +
			'; expires=' +
			expires +
			'; secure=true';
		//setGACookies();
	} else if (acceptTracking == 'statistics') {
		document.cookie =
			cookieName +
			'=' +
			'statistics' +
			'; expires=' +
			expires +
			'; secure=true';
		//setGACookies();
	} else {
		document.cookie =
			cookieName +
			'=' +
			'basic' +
			'; expires=' +
			expires +
			'; secure=true';
	}
	$cookieNotice.classList.remove('active');
}

document.addEventListener('click', function (event) {
	var clickedElement = event.target;

	if (clickedElement.classList.contains('cookie-arrow')) {
		var popupText = document.querySelector('#popup-text');
		var cookiePopup = document.querySelector('#cookie-popup');

		popupText.classList.toggle('active');
		cookiePopup.classList.toggle('show-cookie-text');
	}

	if (clickedElement.classList.contains('cookie-agree-all-button')) {
		setAcceptanceCookie('all');
	}
});

const savePreferencesBtn = document.querySelector(
	'.eu-cookie-compliance-save-preferences-button'
);

if (savePreferencesBtn) {
	savePreferencesBtn.addEventListener('click', function (e) {
		const statisticsChecked = document.querySelector(
			'#cookie-category-statistics'
		).checked;
		console.log(statisticsChecked);
		const marketingChecked = document.querySelector(
			'#cookie-category-marketing'
		).checked;
		console.log(marketingChecked);

		if (statisticsChecked && marketingChecked) {
			setAcceptanceCookie('all');
		} else if (statisticsChecked) {
			setAcceptanceCookie('statistics');
		} else if (marketingChecked) {
			setAcceptanceCookie('marketing');
		} else {
			setAcceptanceCookie('basic');
		}
	});
}

const rejectButton = document.querySelector(
	'.eu-cookie-compliance-reject-preferences-button'
);
const statisticsBefore = document.querySelector(
	'.cookie-category-statistics-before'
);
const marketingBefore = document.querySelector(
	'.cookie-category-marketing-before'
);

if (rejectButton) {
	rejectButton.addEventListener('click', function (e) {
		setAcceptanceCookie('basic');
	});
}

if (statisticsBefore) {
	statisticsBefore.addEventListener('click', function (e) {
		document.querySelector('#cookie-category-statistics').click();
	});
}

if (marketingBefore) {
	marketingBefore.addEventListener('click', function (e) {
		document.querySelector('#cookie-category-marketing').click();
	});
}

/* $('.img-nocookie').on('click', function(e) {
    $cookieNotice.addClass('active');
}); */

/* $('.img-acceptedcookie').on('click', function(e) {
    $('.livestream').attr('src', $('.livestream').attr('data-src'));
    $('.img-acceptedcookie').hide();
}); */
