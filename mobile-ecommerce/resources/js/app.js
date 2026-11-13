import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    // --- 1. Mobile Menu Logic ---
    const menuBtn = document.getElementById('mobile-menu-btn');
    const closeBtn = document.getElementById('mobile-menu-close');
    const mobileMenu = document.getElementById('mobile-menu');
    const overlay = document.getElementById('mobile-menu-overlay');

    function openMenu() {
        if (mobileMenu && overlay) {
            mobileMenu.classList.remove('hidden');
            void mobileMenu.offsetWidth;
            mobileMenu.classList.add('open');
            overlay.classList.add('open');
            document.body.classList.add('overflow-hidden');
        }
    }

    function closeMenu() {
        if (mobileMenu && overlay) {
            mobileMenu.classList.remove('open');
            overlay.classList.remove('open');
            document.body.classList.remove('overflow-hidden');
            setTimeout(() => {
                if (!mobileMenu.classList.contains('open')) {
                    mobileMenu.classList.add('hidden');
                }
            }, 300);
        }
    }

    if (menuBtn) menuBtn.addEventListener('click', (e) => { e.stopPropagation(); openMenu(); });
    if (closeBtn) closeBtn.addEventListener('click', closeMenu);
    if (overlay) overlay.addEventListener('click', closeMenu);

    // --- 2. Mega Menu Logic ---
    const productsBtn = document.getElementById('products-btn');
    const megaMenu = document.getElementById('mega-menu');

    if (productsBtn && megaMenu) {
        productsBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            megaMenu.classList.toggle('active');
            const svg = productsBtn.querySelector('svg');
            if (svg) svg.style.transform = megaMenu.classList.contains('active') ? 'rotate(180deg)' : 'rotate(0deg)';
        });

        document.addEventListener('click', (e) => {
            if (!megaMenu.contains(e.target) && !productsBtn.contains(e.target)) {
                megaMenu.classList.remove('active');
                const svg = productsBtn.querySelector('svg');
                if (svg) svg.style.transform = 'rotate(0deg)';
            }
        });
    }

    // --- 3. Categories Slider Logic ---
    const slider = document.getElementById('category-slider');
    const prevBtn = document.getElementById('category-prev');
    const nextBtn = document.getElementById('category-next');

    if (slider && prevBtn && nextBtn) {
        const scrollAmount = 250;
        nextBtn.addEventListener('click', () => slider.scrollBy({ left: scrollAmount, behavior: 'smooth' }));
        prevBtn.addEventListener('click', () => slider.scrollBy({ left: -scrollAmount, behavior: 'smooth' }));
    }

    // --- 4. Custom Hero Banner Slider Logic ---
    const heroSlider = document.getElementById('hero-slider');
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.hero-dot');

    if (heroSlider && slides.length > 0) {
        let currentIndex = 0;
        const totalSlides = slides.length;
        let autoSlideInterval;

        function updateSlider(index) {
            currentIndex = index;
            heroSlider.style.transform = `translateX(-${currentIndex * 100}%)`;

            // Update active dot style
            dots.forEach((dot, i) => {
                if (i === currentIndex) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }

        // Initialize first dot
        updateSlider(0);

        // Auto slide every 4 seconds
        function startAutoSlide() {
            autoSlideInterval = setInterval(() => {
                currentIndex = (currentIndex + 1) % totalSlides;
                updateSlider(currentIndex);
            }, 4000);
        }

        startAutoSlide();

        // Click on dots to change slide
        dots.forEach((dot) => {
            dot.addEventListener('click', (e) => {
                clearInterval(autoSlideInterval);
                const index = parseInt(e.target.getAttribute('data-index'));
                updateSlider(index);
                startAutoSlide();
            });
        });
    }


    // --- 5. Dynamic Product Sliders (Home Page) ---
    document.querySelectorAll('.product-swiper').forEach(function (swiperElement) {
        new Swiper(swiperElement, {
            modules: [Navigation, Autoplay, Pagination],
            slidesPerView: 2,
            spaceBetween: 16,
            breakpoints: {
                640: { slidesPerView: 3, spaceBetween: 20 },
                1024: { slidesPerView: 4, spaceBetween: 24 }
            },
            pagination: {
                el: swiperElement.querySelector('.swiper-pagination'),
                clickable: true,
            },
        });
    });
});