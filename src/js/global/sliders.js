import EmblaCarousel from 'embla-carousel'

const OPTIONS = {
	loop: false,
}

const emblaNode = document.querySelector('.embla')
let emblaApi = null // Declare globally

if (emblaNode) {
	const viewportNode = emblaNode.querySelector('.embla__viewport')
	const prevBtn = document.querySelector('.embla-nav-back')
	const nextBtn = document.querySelector('.embla-nav-next')

	if (viewportNode) {
		emblaApi = EmblaCarousel(viewportNode, OPTIONS)

		// Click handlers
		prevBtn ?.addEventListener('click', () => emblaApi.scrollPrev())
		nextBtn ?.addEventListener('click', () => emblaApi.scrollNext())

		// Disable/enable nav buttons
		const updateButtons = () => {
			if (!emblaApi) return
			prevBtn ?.classList.toggle('opacity-50', !emblaApi.canScrollPrev())
			prevBtn ?.classList.toggle('pointer-events-none', !emblaApi.canScrollPrev())

			nextBtn ?.classList.toggle('opacity-50', !emblaApi.canScrollNext())
			nextBtn ?.classList.toggle('pointer-events-none', !emblaApi.canScrollNext())
		}

		// Initial + on select
		emblaApi.on('select', updateButtons)
		updateButtons()
	}
}
