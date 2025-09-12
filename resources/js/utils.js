// Utility functions for common operations

class Utils {
    // Smooth scroll to element
    static scrollToElement(elementId, offset = 0) {
        const element = document.getElementById(elementId);
        if (element) {
            const elementPosition = element.offsetTop - offset;
            window.scrollTo({
                top: elementPosition,
                behavior: 'smooth'
            });
        }
    }

    // Get CSRF token from meta tag
    static getCSRFToken() {
        const csrfElement = document.querySelector('meta[name="csrf-token"]');
        return csrfElement ? csrfElement.getAttribute('content') : null;
    }

    // Debounce function for performance optimization
    static debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Throttle function for scroll events
    static throttle(func, limit) {
        let lastFunc;
        let lastRan;
        return function(...args) {
            if (!lastRan) {
                func.apply(this, args);
                lastRan = Date.now();
            } else {
                clearTimeout(lastFunc);
                lastFunc = setTimeout(function() {
                    if ((Date.now() - lastRan) >= limit) {
                        func.apply(this, args);
                        lastRan = Date.now();
                    }
                }, limit - (Date.now() - lastRan));
            }
        };
    }

    // Validate email format
    static validateEmail(email) {
        return APP_CONFIG.form.validationRules.email.test(email);
    }

    // Validate Philippine phone number
    static validatePhoneNumber(phone) {
        return APP_CONFIG.form.validationRules.phone.test(phone);
    }

    // Format phone number display
    static formatPhoneNumber(phone) {
        if (phone.startsWith('+63')) {
            return phone.replace('+63', '+63 ').replace(/(\d{3})(\d{3})(\d{4})/, '$1 $2 $3');
        }
        if (phone.startsWith('09')) {
            return phone.replace(/(\d{2})(\d{3})(\d{3})(\d{4})/, '$1$2 $3 $4');
        }
        return phone;
    }

    // Create celebration particle
    static createCelebrationParticle(delay = 0) {
        setTimeout(() => {
            const celebration = document.createElement('div');
            celebration.style.cssText = `
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 20px;
                height: 20px;
                background: linear-gradient(45deg, #ffd700, #ff6b35, #dc267f);
                border-radius: 50%;
                pointer-events: none;
                z-index: 10000;
                animation: celebrationBounce 2s ease-out forwards;
            `;
            
            document.body.appendChild(celebration);
            
            // Remove element after animation
            setTimeout(() => {
                if (celebration.parentNode) {
                    celebration.parentNode.removeChild(celebration);
                }
            }, 2000);
        }, delay);
    }

    // Show success celebration
    static showSuccessCelebration() {
        for (let i = 0; i < APP_CONFIG.animations.celebrationCount; i++) {
            Utils.createCelebrationParticle(i * 100);
        }
    }

    // Generic error handler
    static handleError(error, context = 'Unknown') {
        console.error(`Error in ${context}:`, error);
        
        let userMessage = 'An unexpected error occurred. Please try again.';
        
        if (error.name === 'TypeError' && error.message.includes('Failed to fetch')) {
            userMessage = 'Connection error. Please check your internet connection and try again.';
        } else if (error.message.includes('CSRF')) {
            userMessage = 'Security token expired. Please refresh the page and try again.';
        }
        
        return userMessage;
    }

    // Check if element is in viewport
    static isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    // Animate counter from 0 to target value
    static animateCounter(element, target, duration = 2000) {
        let start = 0;
        const increment = target / (duration / 16);
        
        const timer = setInterval(() => {
            start += increment;
            element.textContent = Math.floor(start);
            
            if (start >= target) {
                element.textContent = target;
                clearInterval(timer);
            }
        }, 16);
    }

    // Generate random number between min and max
    static random(min, max) {
        return Math.random() * (max - min) + min;
    }

    // Add class with animation delay
    static addClassWithDelay(element, className, delay = 0) {
        setTimeout(() => {
            element.classList.add(className);
        }, delay);
    }

    // Remove all classes from elements matching selector
    static removeClassFromAll(selector, className) {
        document.querySelectorAll(selector).forEach(el => {
            el.classList.remove(className);
        });
    }

    // Wait for element to exist in DOM
    static waitForElement(selector, timeout = 5000) {
        return new Promise((resolve, reject) => {
            const startTime = Date.now();
            
            function checkElement() {
                const element = document.querySelector(selector);
                if (element) {
                    resolve(element);
                } else if (Date.now() - startTime > timeout) {
                    reject(new Error(`Element ${selector} not found within ${timeout}ms`));
                } else {
                    setTimeout(checkElement, 100);
                }
            }
            
            checkElement();
        });
    }

    // Deep clone object
    static deepClone(obj) {
        return JSON.parse(JSON.stringify(obj));
    }

    // Sanitize input string
    static sanitizeInput(input) {
        return input.trim().replace(/[<>]/g, '');
    }
}