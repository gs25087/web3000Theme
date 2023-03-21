import { html, LitElement } from 'lit';

class Hamburger extends LitElement {
	createRenderRoot() {
		return this;
	}
	render() {
		return html`
			<div
				class=" fixed top-0 right-0  z-50 flex flex-col justify-center lg:hidden"
			>
				<div class="relative mx-auto py-3 sm:max-w-xl">
					<button
						class="relative h-10 w-10 bg-white text-gray-500 focus:outline-none"
						@click="${this.toggleMenu}"
					>
						<span class="sr-only">Open main menu</span>
						<div
							class="absolute left-1/2 top-1/2 block w-5 -translate-x-1/2 -translate-y-1/2 transform"
						>
							<span
								aria-hidden="true"
								class="${this.open
									? 'rotate-45'
									: '-translate-y-1.5'} hamburger-span"
							></span>
							<span
								aria-hidden="true"
								class="${this.open
									? 'opacity-0'
									: ''} hamburger-span"
							></span>
							<span
								aria-hidden="true"
								class="${this.open
									? '-rotate-45'
									: 'translate-y-1.5'} hamburger-span"
							></span>
						</div>
					</button>
				</div>
			</div>
		`;
	}

	static get properties() {
		return {
			open: { type: Boolean },
		};
	}

	constructor() {
		super();
		this.open = false;
	}

	toggleMenu() {
		this.open = !this.open;
	}
}

customElements.define('hamburger-element', Hamburger);
