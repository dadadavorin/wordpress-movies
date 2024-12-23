import domReady from '@wordpress/dom-ready';

domReady(async () => {
	const selector = '.js-block-carousel';
	const elements = document.querySelectorAll(selector);

	if (!elements.length) {
		return;
	}

	const eventName = new CustomEvent('carouselInit');
	const { CarouselSlider } = await import('./carousel-slider');

	[...elements].forEach((element) => {
		const carouselSlider = new CarouselSlider({
			element,
			blockClass: 'block-carousel',
			nextElement: `${selector}-next`,
			prevElement: `${selector}-prev`,
			paginationElement: `${selector}-pagination`,
			eventName,
		});

		carouselSlider.init();
	});
});
