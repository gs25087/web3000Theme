import { LitElement, html } from 'lit';
import CountUp from 'countup.js';

class CountUpNumber extends LitElement {
	static get properties() {
		return {
			startValue: { type: Number },
			endValue: { type: Number },
			duration: { type: Number },
			prefix: { type: String },
			suffix: { type: String },
		};
	}

	constructor() {
		super();
		this.startValue = 0;
		this.endValue = 100;
		this.duration = 2.5;
		this.prefix = '';
		this.suffix = '';
	}

	updated(changedProperties) {
		if (changedProperties.has('endValue')) {
			const options = {
				startVal: this.startValue,
				endVal: this.endValue,
				duration: this.duration,
				prefix: this.prefix,
				suffix: this.suffix,
			};
			this.countUp = new CountUp(
				this.shadowRoot.querySelector('#countup'),
				options
			);
			this.countUp.start();
		}
	}

	render() {
		return html` <span id="countup">0</span> `;
	}
}

customElements.define('countup-number', CountUpNumber);
