// Form handling and validation

class FormHandler {
    constructor() {
        this.form = null;
        this.successModal = null;
        this.isSubmitting = false;
    }

    init() {
        this.form = document.getElementById('registration-form');
        this.successModal = document.getElementById('success-modal');
        
        if (!this.form) {
            console.warn('Registration form not found');
            return;
        }

        this.addEventListeners();
    }

    addEventListeners() {
        // Form submission
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));

        // Success modal close
        const closeBtn = document.getElementById('close-success-btn');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => this.closeSuccessModal());
        }

        // Close modal when clicking outside
        if (this.successModal) {
            this.successModal.addEventListener('click', (e) => {
                if (e.target === this.successModal) {
                    this.closeSuccessModal();
                }
            });
        }

        // Real-time validation
        this.addRealTimeValidation();
    }

    addRealTimeValidation() {
        const fields = ['firstname', 'lastname', 'contact', 'email'];
        
        fields.forEach(fieldName => {
            const field = document.getElementById(fieldName);
            if (field) {
                field.addEventListener('blur', () => this.validateField(fieldName));
                field.addEventListener('input', () => this.clearFieldError(fieldName));
            }
        });
    }

    validateField(fieldName) {
        const field = document.getElementById(fieldName);
        if (!field) return true;

        const value = field.value.trim();
        let isValid = true;
        let errorMessage = '';

        switch (fieldName) {
            case 'firstname':
            case 'lastname':
                if (value.length < 2) {
                    isValid = false;
                    errorMessage = 'Name must be at least 2 characters long';
                }
                break;
            
            case 'contact':
                if (!Utils.validatePhoneNumber(value)) {
                    isValid = false;
                    errorMessage = 'Please enter a valid Philippine phone number';
                }
                break;
            
            case 'email':
                if (!Utils.validateEmail(value)) {
                    isValid = false;
                    errorMessage = 'Please enter a valid email address';
                }
                break;
        }

        if (!isValid) {
            this.showFieldError(fieldName, errorMessage);
        } else {
            this.clearFieldError(fieldName);
        }

        return isValid;
    }

    showFieldError(fieldName, message) {
        const field = document.getElementById(fieldName);
        if (!field) return;

        // Add error styling
        field.classList.add('border-red-500', 'bg-red-500/10');
        field.classList.remove('border-white/20');

        // Remove existing error message
        this.clearFieldError(fieldName, false);

        // Create error message
        const errorDiv = document.createElement('div');
        errorDiv.className = 'field-error-message text-red-400 text-sm mt-2';
        errorDiv.innerHTML = `<i class="fas fa-exclamation-circle mr-2"></i>${message}`;

        field.parentNode.appendChild(errorDiv);
    }

    clearFieldError(fieldName, removeStyles = true) {
        const field = document.getElementById(fieldName);
        if (!field) return;

        if (removeStyles) {
            field.classList.remove('border-red-500', 'bg-red-500/10');
            field.classList.add('border-white/20');
        }

        // Remove error message
        const errorMsg = field.parentNode.querySelector('.field-error-message');
        if (errorMsg) {
            errorMsg.remove();
        }
    }

    async handleSubmit(e) {
        e.preventDefault();
        
        if (this.isSubmitting) return;

        const submitButton = this.form.querySelector('button[type="submit"]');
        const originalButtonText = submitButton.innerHTML;
        
        try {
            // Show loading state
            this.isSubmitting = true;
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>PROCESSING...';
            
            // Clear previous errors
            this.clearAllFormErrors();
            this.hideErrorMessage();
            
            // Validate form
            if (!this.validateForm()) {
                throw new Error('Form validation failed');
            }

            // Submit form
            const result = await this.submitForm();
            
            if (result.success) {
                this.handleSuccess(result);
            } else {
                this.handleError(result);
            }
            
        } catch (error) {
            console.error('Form submission error:', error);
            this.handleError({ message: Utils.handleError(error, 'Form submission') });
        } finally {
            // Restore button after delay
            setTimeout(() => {
                this.isSubmitting = false;
                submitButton.disabled = false;
                submitButton.innerHTML = originalButtonText;
            }, APP_CONFIG.form.submitTimeout);
        }
    }

    validateForm() {
        const requiredFields = ['firstname', 'lastname', 'contact', 'email'];
        let isValid = true;

        // Validate required fields
        requiredFields.forEach(fieldName => {
            if (!this.validateField(fieldName)) {
                isValid = false;
            }
        });

        // Check terms agreement
        const termsCheckbox = document.getElementById('terms');
        if (termsCheckbox && !termsCheckbox.checked) {
            this.showErrorMessage('Please agree to the terms and conditions');
            isValid = false;
        }

        return isValid;
    }

    async submitForm() {
        const csrfToken = Utils.getCSRFToken();
        if (!csrfToken) {
            throw new Error('CSRF token not found. Please refresh the page.');
        }

        const formData = new FormData();
        formData.append('_token', csrfToken);
        formData.append('firstname', Utils.sanitizeInput(document.getElementById('firstname').value));
        formData.append('lastname', Utils.sanitizeInput(document.getElementById('lastname').value));
        formData.append('middlename', Utils.sanitizeInput(document.getElementById('middlename').value));
        formData.append('contact', Utils.sanitizeInput(document.getElementById('contact').value));
        formData.append('email', Utils.sanitizeInput(document.getElementById('email').value));
        
        if (document.getElementById('terms').checked) {
            formData.append('terms', '1');
        }

        const response = await fetch(this.form.dataset.action || this.form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: formData
        });

        const result = await response.json();
        
        if (!response.ok) {
            result.success = false;
        }

        return result;
    }

    handleSuccess(result) {
        // Show celebration effect
        Utils.showSuccessCelebration();
        
        // Reset form
        this.form.reset();
        
        // Show success modal after celebration
        setTimeout(() => {
            this.showSuccessModal(result);
        }, 1000);
    }

    handleError(result) {
        if (result.errors) {
            this.displayFormErrors(result.errors);
        } else {
            this.showErrorMessage(result.message || 'Registration failed. Please try again.');
        }
        this.shakeForm();
    }

    showSuccessModal(result) {
        if (!this.successModal) return;

        const memberName = result.data ? result.data.full_name : 'New Member';
        
        // Update modal content with personalized message
        const nameElement = this.successModal.querySelector('h2');
        if (nameElement && result.data) {
            nameElement.textContent = `Welcome ${result.data.full_name.split(' ')[0]}!`;
        }

        this.successModal.style.display = 'flex';
        this.successModal.style.opacity = '0';
        
        // Animate modal appearance
        setTimeout(() => {
            this.successModal.style.transition = 'opacity 0.4s ease';
            this.successModal.style.opacity = '1';
        }, 100);
    }

    closeSuccessModal() {
        if (this.successModal) {
            this.successModal.style.display = 'none';
        }
    }

    displayFormErrors(errors) {
        this.clearAllFormErrors();
        
        Object.keys(errors).forEach(fieldName => {
            const errorMessages = errors[fieldName];
            if (errorMessages.length > 0) {
                this.showFieldError(fieldName, errorMessages[0]);
            }
        });
        
        // Scroll to first error
        const firstError = document.querySelector('.field-error-message');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }

    clearAllFormErrors() {
        const fields = ['firstname', 'lastname', 'middlename', 'contact', 'email'];
        fields.forEach(fieldName => this.clearFieldError(fieldName));
    }

    showErrorMessage(message) {
        const errorDiv = document.getElementById('form-error');
        if (errorDiv) {
            const messageEl = errorDiv.querySelector('p');
            if (messageEl) {
                messageEl.textContent = message;
            }
            errorDiv.classList.remove('hidden');
            errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
            
            // Auto-hide after delay
            setTimeout(() => {
                this.hideErrorMessage();
            }, APP_CONFIG.form.errorDisplayDuration);
        }
    }

    hideErrorMessage() {
        const errorDiv = document.getElementById('form-error');
        if (errorDiv) {
            errorDiv.classList.add('hidden');
        }
    }

    shakeForm() {
        if (this.form) {
            this.form.style.animation = 'shake 0.6s ease-in-out';
            setTimeout(() => {
                this.form.style.animation = '';
            }, 600);
        }
    }
}