// Main application initialization

class App {
    constructor() {
        this.navigation = null;
        this.benefitsCarousel = null;
        this.formHandler = null;
        this.coinRenderer = null;
    }

    init() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.initializeApp());
        } else {
            this.initializeApp();
        }
    }

    initializeApp() {
        try {
            console.log('Initializing Toyota × AAP Partnership App...');

            // Initialize core components
            this.initComponents();
            
            // Initialize 3D coin
            this.init3DCoin();
            
            // Add global event listeners
            this.addGlobalEventListeners();
            
            console.log('App initialized successfully');
            
        } catch (error) {
            console.error('Failed to initialize app:', error);
            this.handleInitError(error);
        }
    }

    initComponents() {
        // Initialize navigation
        this.navigation = new Navigation();
        this.navigation.init();
        this.navigation.initScrollAnimations();
        
        // Initialize benefits carousel
        this.benefitsCarousel = new BenefitsCarousel();
        this.benefitsCarousel.init();
        
        // Initialize form handler
        this.formHandler = new FormHandler();
        this.formHandler.init();
        
        // Make instances globally available for backward compatibility
        window.navigation = this.navigation;
        window.benefitsCarousel = this.benefitsCarousel;
        window.formHandler = this.formHandler;
    }

    init3DCoin() {
        // Check if Three.js is available
        if (typeof THREE === 'undefined') {
            console.warn('Three.js not loaded, skipping 3D coin initialization');
            return;
        }

        try {
            if (window.coinRenderer) {
                window.coinRenderer.init3DCoin();
            } else {
                // Fallback: create new instance
                this.coinRenderer = new CoinRenderer();
                this.coinRenderer.init3DCoin();
                window.coinRenderer = this.coinRenderer;
            }
        } catch (error) {
            console.error('Failed to initialize 3D coin:', error);
        }
    }

    addGlobalEventListeners() {
        // Handle window resize
        window.addEventListener('resize', Utils.debounce(() => {
            this.handleResize();
        }, 250));

        // Handle visibility change (for performance optimization)
        document.addEventListener('visibilitychange', () => {
            this.handleVisibilityChange();
        });

        // Add error handling for unhandled promise rejections
        window.addEventListener('unhandledrejection', (event) => {
            console.error('Unhandled promise rejection:', event.reason);
            // Prevent default browser behavior
            event.preventDefault();
        });

        // Add global error handler
        window.addEventListener('error', (event) => {
            console.error('Global error:', event.error);
        });
    }

    handleResize() {
        // Notify components of resize
        if (this.coinRenderer) {
            this.coinRenderer.onWindowResize();
        }
    }

    handleVisibilityChange() {
        if (document.hidden) {
            // Page is hidden, pause any heavy operations
            if (this.benefitsCarousel) {
                this.benefitsCarousel.stopAutoRotation();
            }
        } else {
            // Page is visible again, resume operations
            if (this.benefitsCarousel) {
                this.benefitsCarousel.startAutoRotation();
            }
        }
    }

    handleInitError(error) {
        // Show user-friendly error message
        const errorContainer = document.createElement('div');
        errorContainer.innerHTML = `
            <div style="
                position: fixed;
                top: 20px;
                right: 20px;
                background: linear-gradient(135deg, rgba(220, 38, 127, 0.9), rgba(255, 69, 0, 0.9));
                color: white;
                padding: 1rem;
                border-radius: 12px;
                box-shadow: 0 8px 25px rgba(220, 38, 127, 0.3);
                z-index: 10000;
                font-family: 'Inter', sans-serif;
            ">
                <div style="display: flex; align-items: center; margin-bottom: 0.5rem;">
                    <i class="fas fa-exclamation-triangle" style="margin-right: 0.5rem;"></i>
                    <strong>Initialization Error</strong>
                </div>
                <p style="margin: 0; font-size: 0.9rem;">
                    Some features may not work correctly. Please refresh the page.
                </p>
            </div>
        `;
        
        document.body.appendChild(errorContainer);
        
        // Auto-remove after 10 seconds
        setTimeout(() => {
            if (errorContainer.parentNode) {
                errorContainer.parentNode.removeChild(errorContainer);
            }
        }, 10000);
    }

    // Cleanup method for when the app needs to be destroyed
    destroy() {
        // Stop any running intervals/timers
        if (this.benefitsCarousel) {
            this.benefitsCarousel.destroy();
        }

        // Cleanup 3D resources
        if (this.coinRenderer) {
            this.coinRenderer.dispose();
        }

        // Remove global references
        window.navigation = null;
        window.benefitsCarousel = null;
        window.formHandler = null;
        window.coinRenderer = null;
    }
}

// Create and initialize the app
const app = new App();
app.init();

// Make app globally available for debugging
window.app = app;

// Expose global utility functions
window.scrollToForms = () => Utils.scrollToElement('forms');

// Legacy support - these functions are called from HTML onclick attributes
window.nextBenefit = nextBenefit;
window.previousBenefit = previousBenefit;
window.goToBenefit = goToBenefit;
window.showBenefitDetail = showBenefitDetail;
window.toggleMobileMenu = toggleMobileMenu;
window.closeMobileMenu = closeMobileMenu;
window.setActiveLink = setActiveLink;
window.scrollToForms = scrollToForms;