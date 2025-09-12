// Configuration constants and global settings

const APP_CONFIG = {
    // Carousel settings
    carousel: {
        autoRotateInterval: 5000,
        transitionDuration: 600
    },
    
    // Animation settings
    animations: {
        fadeInDelay: 200,
        scrollOffset: 100,
        celebrationCount: 15
    },
    
    // Form settings
    form: {
        submitTimeout: 1000,
        errorDisplayDuration: 8000,
        validationRules: {
            phone: /^(\+63|0)[0-9]{10}$/,
            email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/
        }
    },
    
    // 3D coin settings
    coin: {
        rotation: {
            main: 0.03,
            nav: 0.03
        },
        camera: {
            position: {
                main: { z: 3 },
                nav: { z: 2 }
            },
            fov: 75
        },
        geometry: {
            main: { radius: 1.5, height: 0.2 },
            nav: { radius: 0.8, height: 0.15 }
        }
    },
    
    // Asset paths
    assets: {
        images: {
            toyota: 'images/toyota-red.png',
            aap: 'images/aap-logo.png',
            backgroundGifs: {
                test: 'images/test.gif',
                palm: 'images/palm.gif',
                cars: 'images/cars.gif',
                slow: 'images/slow.gif',
                move: 'images/move.gif'
            }
        }
    },
    
    // External links
    links: {
        facebook: 'https://www.facebook.com/aaphilippines/',
        instagram: 'https://www.instagram.com/aaphilippines/?hl=en',
        youtube: 'https://www.youtube.com/@automobileassociationPH',
        privacyPolicy: 'https://aap.org.ph/privacy-policy',
        contact: 'https://aap.org.ph/contactus',
        dpoDocument: 'images/logo-dpo-dps.pdf'
    }
};

// Global state
const APP_STATE = {
    benefitsPanelOpen: false,
    currentBenefitIndex: 0,
    mobileMenuOpen: false,
    isSubmittingForm: false
};

// Export for use in other modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { APP_CONFIG, APP_STATE };
}