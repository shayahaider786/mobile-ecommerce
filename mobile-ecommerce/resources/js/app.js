import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const menuBtn = document.getElementById('mobile-menu-btn');
    const closeBtn = document.getElementById('mobile-menu-close');
    const mobileMenu = document.getElementById('mobile-menu');
    const overlay = document.getElementById('mobile-menu-overlay');


    const productsBtn = document.getElementById('products-btn');
    const megaMenu = document.getElementById('mega-menu');

    function openMenu() {
        if (mobileMenu && overlay) {
            mobileMenu.classList.remove('hidden'); // Make it visible in DOM first
            // Force a small browser reflow frame
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
            
            // Wait for slide-out transition to finish before adding hidden back
            setTimeout(() => {
                if (!mobileMenu.classList.contains('open')) {
                    mobileMenu.classList.add('hidden');
                }
            }, 300);
        }
    }

    if (menuBtn) {
        menuBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            openMenu();
        });
    }
    
    if (closeBtn) closeBtn.addEventListener('click', closeMenu);
    if (overlay) overlay.addEventListener('click', closeMenu);

    if (productsBtn && megaMenu) {
        // Toggle on click
        productsBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            megaMenu.classList.toggle('active');
            const svg = productsBtn.querySelector('svg');
            if (svg) {
                svg.style.transform = megaMenu.classList.contains('active') ? 'rotate(180deg)' : 'rotate(0deg)';
            }
        });

        // Close when clicking outside
        document.addEventListener('click', (e) => {
            if (!megaMenu.contains(e.target) && !productsBtn.contains(e.target)) {
                megaMenu.classList.remove('active');
                const svg = productsBtn.querySelector('svg');
                if (svg) {
                    svg.style.transform = 'rotate(0deg)';
                }
            }
        });
    }
});