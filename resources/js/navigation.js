// Navigation and mobile menu functionality

class Navigation {
    constructor() {
        this.mobileMenuOpen = false;
        this.activeSection = null;
        this.scrollThreshold = 100;
    }

    init() {
        this.addEventListeners();
        this.initBackToTop();
        this.initSmoothScrolling();
        this.initScrollSpy();
    }

    addEventListeners() {
        // Mobile menu toggle
        const toggleBtn = document.querySelector('.mobile-menu-toggle');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => this.toggleMobileMenu());
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            const mobileMenu = document.getElementById('mobile-menu');
            const toggle = document.querySelector('.mobile-menu-toggle');
            
            if (this.mobileMenuOpen && 
                !mobileMenu?.contains(e.target) && 
                !toggle?.contains(e.target)) {
                this.closeMobileMenu();
            }
        });

        // Handle nav link clicks
        document.querySelectorAll('.nav-link, .mobile-nav-link').forEach(link => {
            link.addEventListener('click', (e) => {
                this.handleNavClick(e, link);
            });
        });
    }

    toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobile-menu');
        const toggle = document.querySelector('.mobile-menu-toggle i');
        
        this.mobileMenuOpen = !this.mobileMenuOpen;
        
        if (this.mobileMenuOpen) {
            mobileMenu?.classList.add('active');
            if (toggle) {
                toggle.classList.remove('fa-bars');
                toggle.classList.add('fa-times');
            }
        } else {
            this.closeMobileMenu();
        }
    }

    closeMobileMenu() {
        const mobileMenu = document.getElementById('mobile-menu');
        const toggle = document.querySelector('.mobile-menu-toggle i');
        
        this.mobileMenuOpen = false;
        mobileMenu?.classList.remove('active');
        if (toggle) {
            toggle.classList.remove('fa-times');
            toggle.classList.add('fa-bars');
        }
    }

    handleNavClick(e, clickedLink) {
        e.preventDefault();
        
        const href = clickedLink.getAttribute('href');
        if (href?.startsWith('#')) {
            const targetId = href.substring(1);
            Utils.scrollToElement(targetId, this.scrollThreshold);
            this.setActiveLink(clickedLink);
            
            // Close mobile menu if open
            if (this.mobileMenuOpen) {
                this.closeMobileMenu();
            }
        }
    }

    setActiveLink(activeLink) {
        // Remove active class from all nav links
        Utils.removeClassFromAll('.nav-link, .mobile-nav-link', 'active');
        
        // Add active class to clicked link
        activeLink.classList.add('active');
        
        // Also set active for corresponding desktop/mobile link
        const href = activeLink.getAttribute('href');
        document.querySelectorAll(`[href="${href}"]`).forEach(link => {
            if (link.classList.contains('nav-link') || 
                link.classList.contains('mobile-nav-link')) {
                link.classList.add('active');
            }
        });
    }

    initSmoothScrolling() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    initScrollSpy() {
        const throttledScrollSpy = Utils.throttle(() => {
            this.updateActiveNavOnScroll();
        }, 100);

        window.addEventListener('scroll', throttledScrollSpy);
    }

    updateActiveNavOnScroll() {
        const sections = ['forms', 'about', 'contact'];
        const scrollPos = window.scrollY + this.scrollThreshold;
        
        sections.forEach(sectionId => {
            const element = document.getElementById(sectionId);
            if (element) {
                const offsetTop = element.offsetTop;
                const offsetBottom = offsetTop + element.offsetHeight;
                
                if (scrollPos >= offsetTop && scrollPos < offsetBottom) {
                    this.setActiveSectionNav(sectionId);
                }
            }
        });
    }

    setActiveSectionNav(sectionId) {
        if (this.activeSection === sectionId) return;
        
        this.activeSection = sectionId;
        Utils.removeClassFromAll('.nav-link, .mobile-nav-link', 'active');
        
        document.querySelectorAll(`[href="#${sectionId}"]`).forEach(link => {
            if (link.classList.contains('nav-link') || 
                link.classList.contains('mobile-nav-link')) {
                link.classList.add('active');
            }
        });
    }

    initBackToTop() {
        const backToTopBtn = document.getElementById('back-to-top');
        if (!backToTopBtn) return;

        // Show/hide button based on scroll position
        const throttledScroll = Utils.throttle(() => {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        }, 100);

        window.addEventListener('scroll', throttledScroll);
        
        // Smooth scroll to top when clicked
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Initialize scroll animations
    initScrollAnimations() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.section-fade-in').forEach(el => {
            observer.observe(el);
        });
    }
}

// Global functions for backward compatibility
function toggleMobileMenu() {
    if (window.navigation) {
        window.navigation.toggleMobileMenu();
    }
}

function closeMobileMenu() {
    if (window.navigation) {
        window.navigation.closeMobileMenu();
    }
}

function setActiveLink(link) {
    if (window.navigation) {
        window.navigation.setActiveLink(link);
    }
}

function scrollToForms() {
    Utils.scrollToElement('forms');
}