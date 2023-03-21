// import imagesLoaded from 'imagesloaded';
// import device from 'current-device';
import 'lazysizes';
import 'lazysizes/plugins/parent-fit/ls.parent-fit';
// import function to register Swiper custom elements
import { register } from 'swiper/element';

// Components
// import './components/detect-browser';
import './components/TickerComponent';
import './components/Accordion.js';
import './components/Hamburger/Hamburger.js';
import './swup/swup';
import './components/cookieBanner';

register();

const msg = '%c Coded by 🔥 web3000.net 🔥';
const styles = [
	'font-size: 12px',
	'font-family: monospace',
	'background: white',
	'display: inline-block',
	'color: black !important',
	'padding: 8px 19px',
	'border: 1px dashed;',
].join(';');
console.log(msg, styles);
