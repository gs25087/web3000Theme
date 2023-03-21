import { LitElement, html, css } from 'lit';

class MyMarqueeElement extends LitElement {
	static get properties() {
		return {
			text: { type: String },
		};
	}

	static get styles() {
		return css`
			.marquee-wrapper {
				overflow: hidden;
				width: 100%;
			}

			.marquee {
				display: inline-block;
				white-space: nowrap;
				animation: marquee 5s linear infinite;
			}

			@keyframes marquee {
				0% {
					transform: translateX(0);
				}
				100% {
					transform: translateX(-100%);
				}
			}
		`;
	}

	constructor() {
		super();
		this.text = 'Hello, world! ';
		this.fullText = this.text.repeat(10);
	}

	render() {
		return html`
			<div class="marquee-wrapper">
				<div class="marquee">${this.fullText}</div>
			</div>
		`;
	}

	handleAnimationIteration() {
		console.log('Animation iteration');
		// Get the first copy of the text
		const firstCopy = this.fullText.substring(0, this.text.length);

		// Remove the first copy from the full text and add it to the end
		this.fullText = this.fullText.substring(this.text.length) + firstCopy;

		// Update the text content
		this.shadowRoot.querySelector('.marquee').textContent = this.fullText;
	}
}

customElements.define('marquee-element', MyMarqueeElement);
