import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';

export class CarouselSlider {
	constructor(options) {
		this.element = options.element;
		this.blockClass = options.blockClass;
		this.nextElement = options.nextElement;
		this.prevElement = options.prevElement;
		this.paginationElement = options.paginationElement;
		this.eventName = options.eventName;

	}

	init() {
		const item = this.element;

		new Swiper(item, {
			loop: item.getAttribute('data-swiper-loop') ?? false,
			loopedSlides: 6,
			slideClass: `${this.blockClass}__item`,
			slidesPerView: 'auto',
			watchOverflow: true,
			modules: [
				Navigation,
				Pagination,
			],
			keyboard: {
				enabled: true,
			},
			grabCursor: true,
			breakpointsInverse: true,
			threshold: 20,
			navigation: {
				nextEl: this.nextElement,
				prevEl: this.prevElement,
			},
			pagination: {
				el: this.paginationElement,
				type: 'bullets',
				clickable: true,
			},
			on: {
				init: () => {
					window.dispatchEvent(this.eventName);
				},
			},
		});
	}
}
