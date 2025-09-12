// Benefits Carousel functionality

class BenefitsCarousel {
    constructor() {
        this.currentIndex = 0;
        this.slides = [];
        this.dots = [];
        this.autoRotateTimer = null;
        this.totalSlides = 0;
    }

    init() {
        this.slides = document.querySelectorAll('.benefit-slide');
        this.totalSlides = this.slides.length;
        
        if (this.totalSlides === 0) {
            console.warn('No benefit slides found');
            return;
        }

        this.generateNavigation();
        this.startAutoRotation();
        this.addEventListeners();
        
        // Set first slide as active
        this.updateCarousel();
    }

    generateNavigation() {
        const navContainer = document.getElementById('carousel-nav');
        if (!navContainer) return;

        // Clear existing dots
        navContainer.innerHTML = '';

        // Generate navigation dots
        for (let i = 0; i < this.totalSlides; i++) {
            const dot = document.createElement('div');
            dot.className = `carousel-dot ${i === 0 ? 'active' : ''}`;
            dot.onclick = () => this.goToSlide(i);
            navContainer.appendChild(dot);
        }

        this.dots = navContainer.querySelectorAll('.carousel-dot');
    }

    updateCarousel() {
        const carousel = document.getElementById('benefits-carousel');
        if (!carousel) return;

        // Update carousel position
        carousel.style.transform = `translateX(-${this.currentIndex * 100}%)`;

        // Update active slide
        this.slides.forEach((slide, index) => {
            slide.classList.toggle('active', index === this.currentIndex);
        });

        // Update active dot
        this.dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === this.currentIndex);
        });
    }

    nextSlide() {
        this.currentIndex = (this.currentIndex + 1) % this.totalSlides;
        this.updateCarousel();
    }

    previousSlide() {
        this.currentIndex = (this.currentIndex - 1 + this.totalSlides) % this.totalSlides;
        this.updateCarousel();
    }

    goToSlide(index) {
        if (index >= 0 && index < this.totalSlides) {
            this.currentIndex = index;
            this.updateCarousel();
            this.restartAutoRotation();
        }
    }

    startAutoRotation() {
        this.autoRotateTimer = setInterval(() => {
            this.nextSlide();
        }, APP_CONFIG.carousel.autoRotateInterval);
    }

    stopAutoRotation() {
        if (this.autoRotateTimer) {
            clearInterval(this.autoRotateTimer);
            this.autoRotateTimer = null;
        }
    }

    restartAutoRotation() {
        this.stopAutoRotation();
        this.startAutoRotation();
    }

    addEventListeners() {
        // Pause auto-rotation on hover
        const container = document.querySelector('.benefits-carousel-container');
        if (container) {
            container.addEventListener('mouseenter', () => this.stopAutoRotation());
            container.addEventListener('mouseleave', () => this.startAutoRotation());
        }

        // Add keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (this.isCarouselInView()) {
                switch(e.key) {
                    case 'ArrowLeft':
                        e.preventDefault();
                        this.previousSlide();
                        this.restartAutoRotation();
                        break;
                    case 'ArrowRight':
                        e.preventDefault();
                        this.nextSlide();
                        this.restartAutoRotation();
                        break;
                }
            }
        });
    }

    isCarouselInView() {
        const container = document.querySelector('.benefits-carousel-container');
        return container && Utils.isInViewport(container);
    }

    // Benefit detail modal functionality
    showBenefitDetail(benefitId) {
        const benefits = this.getBenefitDetails();
        const benefit = benefits[benefitId];
        
        if (!benefit) return;

        const modal = document.getElementById('benefit-detail-modal');
        const titleEl = document.getElementById('detail-title');
        const iconEl = document.getElementById('detail-icon');
        const contentEl = document.getElementById('detail-content');

        if (titleEl) titleEl.textContent = benefit.title;
        if (iconEl) iconEl.innerHTML = `<i class="${benefit.icon} text-2xl text-white"></i>`;
        if (contentEl) contentEl.innerHTML = benefit.content;
        if (modal) modal.style.display = 'flex';
    }

    getBenefitDetails() {
        return {
            'discounts': {
                title: 'Lifestyle Partner Discounts',
                icon: 'fas fa-percentage',
                content: `
                    <p class="mb-4"><strong>Exclusive Savings on:</strong></p>
                    <ul class="list-disc list-inside space-y-2 mb-4">
                        <li><strong>Fuel:</strong> Discounts at major gas stations</li>
                        <li><strong>Hotels:</strong> Special rates at partner accommodations</li>
                        <li><strong>Restaurants:</strong> Dining discounts at selected establishments</li>
                        <li><strong>Car Maintenance:</strong> Parts and service discounts</li>
                        <li><strong>Shopping:</strong> Retail partner discounts</li>
                    </ul>
                    <p class="text-yellow-400 font-semibold">Save up to 20% on everyday expenses!</p>
                `
            },
            'autocare': {
                title: 'AAP Autocare Services',
                icon: 'fas fa-tools',
                content: `
                    <p class="mb-4"><strong>Professional Automotive Services:</strong></p>
                    <ul class="list-disc list-inside space-y-2 mb-4">
                        <li><strong>10% discount</strong> on labor charges</li>
                        <li>Certified technicians and mechanics</li>
                        <li>Quality parts and genuine accessories</li>
                        <li>Multiple service centers nationwide</li>
                        <li>Express service options available</li>
                    </ul>
                    <p class="text-yellow-400 font-semibold">Keep your Toyota running at peak performance!</p>
                `
            }
            // Add other benefit details as needed
        };
    }

    destroy() {
        this.stopAutoRotation();
    }
}

// Global carousel functions for backward compatibility
function nextBenefit() {
    if (window.benefitsCarousel) {
        window.benefitsCarousel.nextSlide();
    }
}

function previousBenefit() {
    if (window.benefitsCarousel) {
        window.benefitsCarousel.previousSlide();
    }
}

function goToBenefit(index) {
    if (window.benefitsCarousel) {
        window.benefitsCarousel.goToSlide(index);
    }
}

function showBenefitDetail(benefitId) {
    if (window.benefitsCarousel) {
        window.benefitsCarousel.showBenefitDetail(benefitId);
    }
}