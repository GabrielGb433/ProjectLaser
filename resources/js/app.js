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
