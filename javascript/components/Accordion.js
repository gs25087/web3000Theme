import { LitElement, html } from 'lit';

class Accordion extends LitElement {
	constructor() {
		super();
		this._headings = Array.from(
			this.querySelectorAll('.accordion__item__heading')
		);
		this._panels = Array.from(
			this.querySelectorAll('.accordion__item__content')
		);

		this._headings.forEach((heading) => {
			heading.addEventListener(
				'click',
				() => {
					const panel = heading.nextElementSibling;
					if (heading.classList.contains('show')) {
						heading.classList.remove('show');
						panel.style.maxHeight = null;
					} else {
						this._headings.forEach((h) => {
							h.classList.remove('show');
							h.nextElementSibling.style.maxHeight = null;
						});
						heading.classList.add('show');
						panel.style.maxHeight = `${panel.scrollHeight}px`;
					}
				},
				false
			);
		});
	}

	render() {
		return html`<slot></slot>`;
	}
}

customElements.define('accordion-element', Accordion);
