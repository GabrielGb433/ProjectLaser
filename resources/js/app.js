const header = document.querySelector('[data-header]');
const menuToggle = document.querySelector('[data-menu-toggle]');
const mobileMenu = document.querySelector('[data-mobile-menu]');

const updateHeader = () => {
    header?.classList.toggle('is-scrolled', window.scrollY > 28);
};

const closeMenu = () => {
    if (!menuToggle || !mobileMenu || !header) return;

    menuToggle.setAttribute('aria-expanded', 'false');
    menuToggle.setAttribute('aria-label', 'Abrir menu');
    mobileMenu.classList.remove('is-open');
    header.classList.remove('is-menu-open');
    document.body.classList.remove('menu-is-open');
};

const toggleMenu = () => {
    if (!menuToggle || !mobileMenu || !header) return;

    const isOpen = menuToggle.getAttribute('aria-expanded') === 'true';

    menuToggle.setAttribute('aria-expanded', String(!isOpen));
    menuToggle.setAttribute('aria-label', isOpen ? 'Abrir menu' : 'Fechar menu');
    mobileMenu.classList.toggle('is-open', !isOpen);
    header.classList.toggle('is-menu-open', !isOpen);
    document.body.classList.toggle('menu-is-open', !isOpen);
};

window.addEventListener('scroll', updateHeader, { passive: true });
updateHeader();

menuToggle?.addEventListener('click', toggleMenu);
mobileMenu?.querySelectorAll('a').forEach((link) => link.addEventListener('click', closeMenu));

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') closeMenu();
});

const revealElements = document.querySelectorAll('[data-reveal]');
const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

if (reduceMotion || !('IntersectionObserver' in window)) {
    revealElements.forEach((element) => element.classList.add('is-visible'));
} else {
    const revealObserver = new IntersectionObserver(
        (entries, observer) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;

                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            });
        },
        { threshold: 0.12, rootMargin: '0px 0px -40px' },
    );

    revealElements.forEach((element) => revealObserver.observe(element));
}

const slider = document.querySelector('[data-slider]');

if (slider) {
    const slides = [...slider.querySelectorAll('[data-slide]')];
    const dots = [...slider.querySelectorAll('[data-slide-dot]')];
    const previousButton = slider.querySelector('[data-slide-prev]');
    const nextButton = slider.querySelector('[data-slide-next]');
    const captionTitle = slider.querySelector('[data-slide-title]');
    const captionCategory = slider.querySelector('[data-slide-category]');
    let activeIndex = 0;
    let autoplayTimer;

    const showSlide = (index) => {
        if (slides.length < 2) return;

        activeIndex = (index + slides.length) % slides.length;

        slides.forEach((slide, slideIndex) => {
            const isActive = slideIndex === activeIndex;
            slide.classList.toggle('is-active', isActive);
            slide.setAttribute('aria-hidden', String(!isActive));
        });

        dots.forEach((dot, dotIndex) => {
            const isActive = dotIndex === activeIndex;
            dot.classList.toggle('is-active', isActive);
            dot.setAttribute('aria-selected', String(isActive));
        });

        const activeSlide = slides[activeIndex];
        const title = activeSlide.querySelector('img')?.getAttribute('alt');
        const dot = dots[activeIndex];

        if (captionTitle && title) captionTitle.textContent = title;
        if (captionCategory && dot?.dataset.category) captionCategory.textContent = dot.dataset.category;
    };

    const stopAutoplay = () => window.clearInterval(autoplayTimer);
    const startAutoplay = () => {
        stopAutoplay();
        if (slides.length > 1 && !reduceMotion) {
            autoplayTimer = window.setInterval(() => showSlide(activeIndex + 1), 5000);
        }
    };

    previousButton?.addEventListener('click', () => {
        showSlide(activeIndex - 1);
        startAutoplay();
    });

    nextButton?.addEventListener('click', () => {
        showSlide(activeIndex + 1);
        startAutoplay();
    });

    dots.forEach((dot) => {
        dot.addEventListener('click', () => {
            showSlide(Number(dot.dataset.slideDot));
            startAutoplay();
        });
    });

    slider.addEventListener('mouseenter', stopAutoplay);
    slider.addEventListener('mouseleave', startAutoplay);
    slider.addEventListener('focusin', stopAutoplay);
    slider.addEventListener('focusout', startAutoplay);
    document.addEventListener('visibilitychange', () => (document.hidden ? stopAutoplay() : startAutoplay()));

    startAutoplay();
}

const galleryItems = [...document.querySelectorAll('[data-gallery-item]')];
const galleryViewer = document.querySelector('[data-gallery-viewer]');

if (galleryItems.length && galleryViewer) {
    const viewerImage = galleryViewer.querySelector('[data-gallery-image]');
    const viewerTitle = galleryViewer.querySelector('[data-gallery-title]');
    const viewerCategory = galleryViewer.querySelector('[data-gallery-category]');
    const viewerCount = galleryViewer.querySelector('[data-gallery-count]');
    const previousButton = galleryViewer.querySelector('[data-gallery-prev]');
    const nextButton = galleryViewer.querySelector('[data-gallery-next]');
    const closeButtons = galleryViewer.querySelectorAll('[data-gallery-close]');
    let activeIndex = 0;
    let triggerElement;

    const showGalleryItem = (index) => {
        activeIndex = (index + galleryItems.length) % galleryItems.length;
        const item = galleryItems[activeIndex];

        viewerImage.src = item.dataset.gallerySrc;
        viewerImage.alt = item.dataset.galleryTitle;
        viewerTitle.textContent = item.dataset.galleryTitle;
        viewerCategory.textContent = item.dataset.galleryCategory;
        viewerCount.textContent = `${activeIndex + 1} / ${galleryItems.length}`;

        const hasMultipleItems = galleryItems.length > 1;
        previousButton.hidden = !hasMultipleItems;
        nextButton.hidden = !hasMultipleItems;
    };

    const openGallery = (index, trigger) => {
        triggerElement = trigger;
        showGalleryItem(index);
        galleryViewer.classList.add('is-open');
        galleryViewer.setAttribute('aria-hidden', 'false');
        document.body.classList.add('gallery-is-open');
        galleryViewer.querySelector('.gallery-viewer-close').focus();
    };

    const closeGallery = () => {
        galleryViewer.classList.remove('is-open');
        galleryViewer.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('gallery-is-open');
        viewerImage.src = '';
        triggerElement?.focus();
    };

    galleryItems.forEach((item, index) => {
        item.addEventListener('click', () => openGallery(index, item));
        item.addEventListener('keydown', (event) => {
            if (event.key !== 'Enter' && event.key !== ' ') return;
            event.preventDefault();
            openGallery(index, item);
        });
    });

    previousButton.addEventListener('click', () => showGalleryItem(activeIndex - 1));
    nextButton.addEventListener('click', () => showGalleryItem(activeIndex + 1));
    closeButtons.forEach((button) => button.addEventListener('click', closeGallery));

    document.addEventListener('keydown', (event) => {
        if (!galleryViewer.classList.contains('is-open')) return;

        if (event.key === 'Escape') closeGallery();
        if (event.key === 'ArrowLeft') showGalleryItem(activeIndex - 1);
        if (event.key === 'ArrowRight') showGalleryItem(activeIndex + 1);
        if (event.key === 'Tab') {
            const focusableElements = [...galleryViewer.querySelectorAll('button:not([hidden])')]
                .filter((element) => element.tabIndex !== -1);
            const firstElement = focusableElements[0];
            const lastElement = focusableElements[focusableElements.length - 1];

            if (event.shiftKey && document.activeElement === firstElement) {
                event.preventDefault();
                lastElement.focus();
            } else if (!event.shiftKey && document.activeElement === lastElement) {
                event.preventDefault();
                firstElement.focus();
            }
        }
    });
}
