/**
 * Swat Info System - Main JavaScript
 * Comprehensive script handling all interactive functionality
 * Version: 2.0
 */

(function () {
    'use strict';

    // Initialize when DOM is fully loaded
    document.addEventListener('DOMContentLoaded', function () {
        // Core initializations
        initNavigation();
        initMobileMenu();
        initDropdowns();
        initSmoothScroll();
        initFaqAccordion();
        initFormValidation();
        initAnimations();

        // Optional features - initialize if elements exist
        if (document.querySelector('.testimonial-slider')) {
            initTestimonialSlider();
        }

        if (document.querySelector('.stats-counter')) {
            initStatsCounter();
        }

        if (document.querySelector('[w3-include-html]')) {
            includeHTML();
        }

        // Initialize current page highlighting after a slight delay
        // to ensure all DOM manipulations are complete
        setTimeout(highlightCurrentPage, 100);

        const submitForm = document.querySelector('.validateFormData');
        if (submitForm) {
            // Toggle menu visibility
            submitForm.addEventListener('click', function (e) {
                e.preventDefault();

                const firstForm = document.querySelector('form');
                const formId = firstForm.getAttribute('id');

                const formSubmitURL = firstForm.getAttribute('action');
                console.log("formSubmitURL: " + formSubmitURL);

                // console.log("came here to submit form" + formId);
                if (validateForm(formId)) {
                    console.log("form is valid");

                    setupFormSubmission(formId, formSubmitURL);

                } else {
                    console.log("form is invalid");
                }
            });
        }
    });

    /**
     * Initialize main navigation functionality
     */
    function initNavigation() {
        // Add hover behavior for desktop devices
        if (window.innerWidth > 991) {
            const navItems = document.querySelectorAll('.nav-menu > .nav-link, .dropdown > .nav-link');

            navItems.forEach(item => {
                item.addEventListener('mouseenter', function () {
                    this.classList.add('hover');
                });

                item.addEventListener('mouseleave', function () {
                    this.classList.remove('hover');
                });
            });
        }

        // Add accessibility support for keyboard navigation
        const dropdowns = document.querySelectorAll('.dropdown');

        dropdowns.forEach(dropdown => {
            const link = dropdown.querySelector('.nav-link');
            const content = dropdown.querySelector('.dropdown-content');

            if (link && content) {
                // Add aria attributes for accessibility
                link.setAttribute('aria-haspopup', 'true');
                link.setAttribute('aria-expanded', 'false');

                // Handle keyboard navigation
                link.addEventListener('keydown', function (e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        const expanded = this.getAttribute('aria-expanded') === 'true' || false;
                        this.setAttribute('aria-expanded', !expanded);
                        dropdown.classList.toggle('active');

                        if (!expanded) {
                            const firstLink = content.querySelector('a');
                            if (firstLink) {
                                setTimeout(() => firstLink.focus(), 100);
                            }
                        }
                    }
                });
            }
        });
    }

    /**
     * Initialize mobile menu functionality
     */
    function initMobileMenu() {
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const navMenu = document.querySelector('.nav-menu');

        if (mobileMenuBtn && navMenu) {
            // Toggle menu visibility
            mobileMenuBtn.addEventListener('click', function () {
                const isExpanded = this.getAttribute('aria-expanded') === 'true' || false;
                this.setAttribute('aria-expanded', !isExpanded);
                navMenu.style.display = isExpanded ? 'none' : 'flex';

                // Toggle hamburger/close icon (if using text content for the button)
                this.textContent = isExpanded ? '☰' : '✕';

                // Prevent body scrolling when menu is open
                document.body.style.overflow = isExpanded ? '' : 'hidden';
            });

            // Set initial aria attributes
            mobileMenuBtn.setAttribute('aria-expanded', 'false');
            mobileMenuBtn.setAttribute('aria-label', 'Toggle navigation menu');

            // Close menu when clicking outside
            document.addEventListener('click', function (e) {
                if (window.innerWidth <= 991 &&
                    !e.target.closest('.nav-menu') &&
                    !e.target.closest('.mobile-menu-btn') &&
                    navMenu.style.display === 'flex') {
                    navMenu.style.display = 'none';
                    mobileMenuBtn.setAttribute('aria-expanded', 'false');
                    mobileMenuBtn.textContent = '☰';
                    document.body.style.overflow = '';
                }
            });

            // Handle mobile dropdowns
            const dropdownLinks = document.querySelectorAll('.dropdown > .nav-link');

            dropdownLinks.forEach(link => {
                if (window.innerWidth <= 991) {
                    link.addEventListener('click', function (e) {
                        if (window.innerWidth <= 991) {
                            e.preventDefault();
                            const dropdown = this.parentElement;
                            const dropdownContent = dropdown.querySelector('.dropdown-content');

                            // Close all other dropdowns
                            document.querySelectorAll('.dropdown').forEach(otherDropdown => {
                                if (otherDropdown !== dropdown) {
                                    otherDropdown.classList.remove('active');
                                    const otherContent = otherDropdown.querySelector('.dropdown-content');
                                    if (otherContent) {
                                        otherContent.style.display = 'none';
                                    }
                                }
                            });

                            // Toggle current dropdown
                            dropdown.classList.toggle('active');
                            if (dropdownContent) {
                                dropdownContent.style.display = dropdown.classList.contains('active') ? 'block' : 'none';
                            }
                        }
                    });
                }
            });

            // Adjust on resize
            window.addEventListener('resize', function () {
                if (window.innerWidth > 991 && navMenu.style.display === 'flex') {
                    navMenu.style.display = '';
                    mobileMenuBtn.setAttribute('aria-expanded', 'false');
                    mobileMenuBtn.textContent = '☰';
                    document.body.style.overflow = '';
                }
            });
        }
    }

    /**
     * Initialize dropdown menu functionality
     */
    function initDropdowns() {
        // For mobile devices, we need an extra click handler
        if (window.innerWidth <= 991) {
            const dropdowns = document.querySelectorAll('.dropdown');

            dropdowns.forEach(dropdown => {
                dropdown.addEventListener('click', function (e) {
                    if (window.innerWidth <= 991) {
                        e.stopPropagation();
                    }
                });
            });
        }
    }

    /**
     * Highlight the current page in navigation
     */
    function highlightCurrentPage() {
        // Get the current path
        const currentPath = window.location.pathname;

        // Clean up the path for comparison
        let path = currentPath;
        if (path.endsWith('/')) {
            path = path.slice(0, -1);
        }

        // Special case for home page
        if (path === '' || path === '/') {
            const homeLink = document.querySelector('.nav-link[href="/"], .nav-link[href="index"], .nav-link[href="index.php"]');
            if (homeLink) {
                homeLink.classList.add('active');
            }
            return;
        }

        // Handle PHP or non-php paths
        const pathWithoutExt = path.replace('.php', '');

        // Find all navigation links
        const navLinks = document.querySelectorAll('.nav-link');

        // Check each link for a match
        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (!href) return;

            // Clean up href for comparison
            let linkPath = href;
            if (linkPath.endsWith('/')) {
                linkPath = linkPath.slice(0, -1);
            }

            // Remove .php for comparison
            const linkPathWithoutExt = linkPath.replace('.php', '');

            // Check if this link matches the current page
            if (path === linkPath ||
                path === linkPath + '.php' ||
                pathWithoutExt === linkPath ||
                pathWithoutExt === linkPathWithoutExt) {
                link.classList.add('active');

                // If it's in a dropdown, also highlight the parent
                const parentDropdown = link.closest('.dropdown');
                if (parentDropdown) {
                    const parentLink = parentDropdown.querySelector('> .nav-link');
                    if (parentLink) {
                        parentLink.classList.add('active');
                    }
                }
            }
        });
    }

    /**
     * Initialize smooth scrolling for anchor links
     */
    function initSmoothScroll() {
        const scrollLinks = document.querySelectorAll('a[href^="#"]:not([href="#"])');

        scrollLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();

                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    // Calculate header height for offset
                    const headerHeight = document.querySelector('header') ?
                        document.querySelector('header').offsetHeight : 0;

                    // Calculate target position with offset
                    const targetPosition = targetElement.getBoundingClientRect().top +
                        window.pageYOffset - headerHeight - 20;

                    // Smooth scroll
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });

                    // Update URL without refreshing the page
                    history.pushState(null, null, `#${targetId}`);

                    // Set focus on the target for accessibility
                    targetElement.setAttribute('tabindex', '-1');
                    targetElement.focus();
                }
            });
        });
    }

    /**
     * Initialize FAQ accordion functionality
     */
    function initFaqAccordion() {
        const faqItems = document.querySelectorAll('.faq-item');

        if (faqItems.length > 0) {
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');
                const answer = item.querySelector('.faq-answer');

                if (question && answer) {
                    // Set initial ARIA attributes
                    question.setAttribute('aria-expanded', 'false');
                    answer.setAttribute('aria-hidden', 'true');

                    // For accessibility, ensure div is focusable
                    question.setAttribute('tabindex', '0');

                    // Add click event
                    question.addEventListener('click', function () {
                        toggleFaqItem(item);
                    });

                    // Add keyboard support
                    question.addEventListener('keydown', function (e) {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            toggleFaqItem(item);
                        }
                    });
                }
            });
        }
    }

    /**
     * Toggle FAQ item open/closed state
     * @param {HTMLElement} item - The FAQ item to toggle
     */
    function toggleFaqItem(item) {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        const plusMinusIcon = question.querySelector('span:last-child');
        const isExpanded = question.getAttribute('aria-expanded') === 'true';

        // Close all other FAQ items
        document.querySelectorAll('.faq-item').forEach(otherItem => {
            if (otherItem !== item && otherItem.classList.contains('active')) {
                const otherQuestion = otherItem.querySelector('.faq-question');
                const otherAnswer = otherItem.querySelector('.faq-answer');
                const otherIcon = otherQuestion ? otherQuestion.querySelector('span:last-child') : null;

                otherItem.classList.remove('active');

                if (otherQuestion) otherQuestion.setAttribute('aria-expanded', 'false');
                if (otherAnswer) otherAnswer.setAttribute('aria-hidden', 'true');
                if (otherIcon) otherIcon.textContent = '+';
            }
        });

        // Toggle current item
        item.classList.toggle('active');

        // Update ARIA attributes
        question.setAttribute('aria-expanded', !isExpanded);
        answer.setAttribute('aria-hidden', isExpanded);

        // Update plus/minus icon if it exists
        if (plusMinusIcon) {
            plusMinusIcon.textContent = !isExpanded ? '-' : '+';
        }
    }

    /**
  * Form validation functionality
  * This is a fixed version of the form validation code
  */

    // Initialize form validation
    function initFormValidation() {
        // console.log('Initializing form validation');
        const forms = document.querySelectorAll('form');
        // console.log(`Found ${forms.length} forms on the page`);

        forms.forEach(form => {
            // Don't override forms with existing validation
            if (!form.hasAttribute('data-validation-initialized')) {
                // console.log(`Setting up validation for form: ${form.id || 'unnamed form'}`);

                form.addEventListener('submit', function (e) {
                    // console.log('Form submission detected');
                    const formId = this.getAttribute('id');

                    // Make sure we stop default action early if validation fails
                    if (formId) {
                        // If form has validateForm function (from the global scope)
                        if (typeof window.validateForm === 'function') {
                            // console.log('Using window.validateForm function');
                            if (!window.validateForm(formId)) {
                                // console.log('Validation failed');
                                e.preventDefault();
                                return false;
                            }
                        } else {
                            // Use our own validation
                            // console.log('Using internal validation function');
                            if (!validateFormFields(this)) {
                                // console.log('Validation failed');
                                e.preventDefault();
                                return false;
                            }
                        }
                    }
                    // console.log('Validation passed');
                });

                // Mark as initialized to prevent duplicate handlers
                form.setAttribute('data-validation-initialized', 'true');
                // console.log('Form validation initialized');
            }
        });
    }

    /**
     * Validate all required fields in a form
     * @param {HTMLFormElement} form - The form to validate
     * @returns {boolean} - True if valid, false if invalid
     */
    function validateFormFields(form) {
        // console.log('Validating form fields');
        let isValid = true;
        const requiredFields = form.querySelectorAll('[required]');
        // console.log(`Found ${requiredFields.length} required fields`);

        // Remove previous error messages
        const previousErrors = form.querySelectorAll('.error-message');
        // console.log(`Removing ${previousErrors.length} previous error messages`);
        previousErrors.forEach(el => el.remove());

        // Check each required field
        requiredFields.forEach(field => {
            // Reset field styling
            field.style.borderColor = '';

            const fieldName = getHumanReadableFieldName(field);
            // console.log(`Checking field: ${fieldName}`);

            if (field.type === 'checkbox' || field.type === 'radio') {
                // For checkbox groups with the same name
                if (field.name) {
                    const checkboxGroup = form.querySelectorAll(`input[name="${field.name}"]:checked`);
                    if (checkboxGroup.length === 0) {
                        isValid = false;
                        // console.log(`Checkbox group ${field.name} is invalid`);
                        showFieldError(field, 'Please select at least one option');
                    }
                } else if (!field.checked) {
                    isValid = false;
                    // console.log(`Checkbox/radio ${field.id || 'unnamed'} is invalid`);
                    showFieldError(field, `${fieldName}` + ' is required');
                }
            } else if (!field.value.trim()) {
                isValid = false;
                // console.log(`Field ${field.name || field.id || 'unnamed'} is empty`);
                showFieldError(field, `${fieldName}` + ' is required');
            } else if (field.type === 'email' && !isValidEmail(field.value)) {
                isValid = false;
                // console.log(`Email ${field.value} is invalid`);
                showFieldError(field, 'Please enter a valid email address');
            } else if (field.type === 'tel' && !isValidPhone(field.value)) {
                isValid = false;
                // console.log(`Phone ${field.value} is invalid`);
                showFieldError(field, 'Please enter a valid phone number');
            } else if (field.type === 'password' && field.dataset.minLength &&
                field.value.length < parseInt(field.dataset.minLength)) {
                isValid = false;
                // console.log(`Password is too short`);
                showFieldError(field, `Password must be at least ${field.dataset.minLength} characters`);
            }
        });

        // Check password confirmation if present
        const password = form.querySelector('input[type="password"]');
        const passwordConfirm = form.querySelector('input[data-match-password]');

        if (password && passwordConfirm && password.value !== passwordConfirm.value) {
            isValid = false;
            // console.log('Passwords do not match');
            showFieldError(passwordConfirm, 'Passwords do not match');
        }

        return isValid;
    }

    /**
     * Display error message for a form field
     * @param {HTMLElement} field - The field with an error
     * @param {string} message - Error message to display
     */
    function showFieldError(field, message) {
        // console.log(`Showing error for field: ${field.name || field.id || 'unnamed'} - ${message}`);

        // Get the parent element (typically a form-group div)
        const parent = field.closest('.form-group') || field.parentNode;
        // console.log(`Parent element found: ${parent.tagName}.${parent.className}`);

        parent.querySelector('label').style.color = 'red';

        // Create error element
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.textContent = message;
        errorDiv.style.color = 'red';
        errorDiv.style.fontSize = '0.875rem';
        errorDiv.style.marginTop = '0.3125rem';

        // Add it after the field
        if (field.nextElementSibling) {
            // console.log('Inserting before next sibling');
            parent.insertBefore(errorDiv, field.nextElementSibling);
        } else {
            // console.log('Appending to parent');
            parent.appendChild(errorDiv);
        }

        // Highlight the field
        field.style.borderColor = 'red';

        // Remove error when the user interacts with the field
        const clearError = function () {
            // console.log('Clearing error on field interaction');
            field.style.borderColor = '';
            parent.querySelector('label').style.color = '';
            const error = parent.querySelector('.error-message');
            if (error) {
                error.remove();
            }
            // Remove event listeners after first trigger
            field.removeEventListener('input', clearError);
            field.removeEventListener('change', clearError);
        };

        field.addEventListener('input', clearError);
        field.addEventListener('change', clearError);
    }

    /**
     * Validate email format
     * @param {string} email - Email address to validate
     * @returns {boolean} - True if valid, false if invalid
     */
    function isValidEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    /**
     * Validate phone number format
     * @param {string} phone - Phone number to validate
     * @returns {boolean} - True if valid, false if invalid
     */
    function isValidPhone(phone) {
        // Allow for international formats with country codes
        const regex = /^[\d\s\+\-\(\)]{7,20}$/;
        return regex.test(phone);
    }

    function validateForm(formId) {
        const form = document.getElementById(formId);
        // console.log("came here to validate form");
        if (!form) {
            console.error(`Form with ID ${formId} not found`);
            return false;
        }

        return validateFormFields(form);
    }
    // Make the validation functions available globally
    window.validateForm = validateForm;
    window.validateFormFields = validateFormFields;
    window.showFieldError = showFieldError;
    window.isValidEmail = isValidEmail;
    window.isValidPhone = isValidPhone;





    /**
     * Initialize testimonial slider if present
     */
    function initTestimonialSlider() {
        const testimonialContainer = document.querySelector('.testimonial-slider');
        if (!testimonialContainer) return;

        const testimonials = testimonialContainer.querySelectorAll('.testimonial-item');
        if (testimonials.length <= 1) return;

        // Add navigation if it doesn't exist
        if (!testimonialContainer.querySelector('.testimonial-nav')) {
            const nav = document.createElement('div');
            nav.className = 'testimonial-nav';

            const prevBtn = document.createElement('button');
            prevBtn.className = 'testimonial-prev';
            prevBtn.innerHTML = '&larr;';
            prevBtn.setAttribute('aria-label', 'Previous testimonial');

            const nextBtn = document.createElement('button');
            nextBtn.className = 'testimonial-next';
            nextBtn.innerHTML = '&rarr;';
            nextBtn.setAttribute('aria-label', 'Next testimonial');

            nav.appendChild(prevBtn);
            nav.appendChild(nextBtn);
            testimonialContainer.appendChild(nav);
        }

        // Add dots/indicators if they don't exist
        if (!testimonialContainer.querySelector('.testimonial-dots')) {
            const dots = document.createElement('div');
            dots.className = 'testimonial-dots';

            for (let i = 0; i < testimonials.length; i++) {
                const dot = document.createElement('button');
                dot.className = 'testimonial-dot';
                dot.setAttribute('data-index', i);
                dot.setAttribute('aria-label', `Go to testimonial ${i + 1}`);
                dots.appendChild(dot);
            }

            testimonialContainer.appendChild(dots);
        }

        // Initialize slider state
        let currentIndex = 0;
        let isAnimating = false;
        const animationDuration = 300; // ms

        // Style testimonials for the slider
        testimonials.forEach((testimonial, index) => {
            testimonial.style.position = 'absolute';
            testimonial.style.top = '0';
            testimonial.style.left = '0';
            testimonial.style.width = '100%';
            testimonial.style.opacity = index === 0 ? '1' : '0';
            testimonial.style.zIndex = index === 0 ? '1' : '0';
            testimonial.style.transition = `opacity ${animationDuration}ms ease`;
            testimonial.setAttribute('aria-hidden', index === 0 ? 'false' : 'true');
        });

        // Update dots to show current slide
        updateDots();

        // Add event listeners
        const prevBtn = testimonialContainer.querySelector('.testimonial-prev');
        const nextBtn = testimonialContainer.querySelector('.testimonial-next');
        const dots = testimonialContainer.querySelectorAll('.testimonial-dot');

        if (prevBtn) {
            prevBtn.addEventListener('click', showPreviousTestimonial);
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', showNextTestimonial);
        }

        dots.forEach(dot => {
            dot.addEventListener('click', function () {
                if (isAnimating) return;
                const index = parseInt(this.getAttribute('data-index'));
                showTestimonial(index);
            });
        });

        // Set up auto-rotation if desired
        let autoRotateInterval = null;

        if (testimonialContainer.hasAttribute('data-auto-rotate')) {
            const interval = parseInt(testimonialContainer.getAttribute('data-auto-rotate')) || 5000;
            autoRotateInterval = setInterval(showNextTestimonial, interval);

            // Pause rotation on hover
            testimonialContainer.addEventListener('mouseenter', function () {
                clearInterval(autoRotateInterval);
            });

            testimonialContainer.addEventListener('mouseleave', function () {
                autoRotateInterval = setInterval(showNextTestimonial, interval);
            });
        }

        // Navigation functions
        function showPreviousTestimonial() {
            if (isAnimating) return;
            const newIndex = (currentIndex - 1 + testimonials.length) % testimonials.length;
            showTestimonial(newIndex);
        }

        function showNextTestimonial() {
            if (isAnimating) return;
            const newIndex = (currentIndex + 1) % testimonials.length;
            showTestimonial(newIndex);
        }

        function showTestimonial(index) {
            if (isAnimating || index === currentIndex) return;

            isAnimating = true;

            // Hide current testimonial
            testimonials[currentIndex].style.opacity = '0';
            testimonials[currentIndex].style.zIndex = '0';
            testimonials[currentIndex].setAttribute('aria-hidden', 'true');

            // Show new testimonial
            testimonials[index].style.opacity = '1';
            testimonials[index].style.zIndex = '1';
            testimonials[index].setAttribute('aria-hidden', 'false');

            // Update current index
            currentIndex = index;

            // Update dots
            updateDots();

            // Reset animation flag after transition
            setTimeout(() => {
                isAnimating = false;
            }, animationDuration);
        }

        function updateDots() {
            const dots = testimonialContainer.querySelectorAll('.testimonial-dot');
            dots.forEach((dot, index) => {
                if (index === currentIndex) {
                    dot.classList.add('active');
                    dot.setAttribute('aria-current', 'true');
                } else {
                    dot.classList.remove('active');
                    dot.removeAttribute('aria-current');
                }
            });
        }

        // Add keyboard navigation
        testimonialContainer.setAttribute('tabindex', '0');
        testimonialContainer.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowLeft') {
                showPreviousTestimonial();
            } else if (e.key === 'ArrowRight') {
                showNextTestimonial();
            }
        });

        // Add touch support
        let touchStartX = 0;
        let touchEndX = 0;

        testimonialContainer.addEventListener('touchstart', function (e) {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        testimonialContainer.addEventListener('touchend', function (e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });

        function handleSwipe() {
            const swipeThreshold = 50; // minimum distance for swipe
            if (touchEndX < touchStartX - swipeThreshold) {
                // Swipe left - show next
                showNextTestimonial();
            } else if (touchEndX > touchStartX + swipeThreshold) {
                // Swipe right - show previous
                showPreviousTestimonial();
            }
        }
    }

    /**
     * Initialize animations on scroll
     */
    function initAnimations() {
        const animatedElements = document.querySelectorAll('.animate-on-scroll');

        if (animatedElements.length > 0 && 'IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.2, rootMargin: '0px 0px -100px 0px' });

            animatedElements.forEach(element => {
                observer.observe(element);
            });
        } else {
            // Fallback for browsers without IntersectionObserver
            animatedElements.forEach(element => {
                element.classList.add('animated');
            });
        }
    }

    /**
     * Initialize stats counter animation
     */
    function initStatsCounter() {
        const statElements = document.querySelectorAll('.stat-item h3');

        if (statElements.length > 0 && 'IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const element = entry.target;
                        const target = parseInt(element.getAttribute('data-count') || element.innerText);

                        animateCounter(element, 0, target, 2000);
                        observer.unobserve(element);
                    }
                });
            }, { threshold: 0.5 });

            statElements.forEach(element => {
                // Store the target number
                if (!element.hasAttribute('data-count')) {
                    element.setAttribute('data-count', element.innerText);
                }
                element.innerText = '0';
                observer.observe(element);
            });
        }
    }

    /**
     * Animate a counter from start to end
     * @param {HTMLElement} element - Element to update
     * @param {number} start - Starting value
     * @param {number} end - Ending value
     * @param {number} duration - Animation duration in ms
     */
    function animateCounter(element, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);

            // Get the original text to preserve any suffix like + or %
            const originalText = element.getAttribute('data-count');
            const suffix = originalText.replace(/[0-9]/g, '');

            // Calculate the current value
            let value;
            if (end < 100) {
                // For small numbers, use decimals
                value = Math.floor(progress * (end - start) + start);
            } else {
                // For large numbers, use easing
                value = Math.floor(easeOutQuad(progress) * (end - start) + start);
            }

            element.textContent = value + suffix;

            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };

        window.requestAnimationFrame(step);
    }

    /**
     * Easing function for smooth animations
     * @param {number} t - Progress value between 0 and 1
     * @returns {number} - Eased value
     */
    function easeOutQuad(t) {
        return t * (2 - t);
    }

    /**
     * Include HTML components
     */
    async function includeHTML() {
        const elements = document.querySelectorAll('[w3-include-html]');

        for (const element of elements) {
            const file = element.getAttribute('w3-include-html');

            try {
                const response = await fetch(file);
                if (response.ok) {
                    const html = await response.text();
                    element.innerHTML = html;
                    element.removeAttribute('w3-include-html');

                    // Execute any scripts within the included HTML
                    executeScripts(element);
                } else {
                    element.innerHTML = '<div class="error">Page not found.</div>';
                }
            } catch (error) {
                console.error(`Error loading ${file}: ${error.message}`);
                element.innerHTML = '<div class="error">Error loading component.</div>';
            }
        }

        // Re-initialize event listeners for newly added content
        if (elements.length > 0) {
            initMobileMenu();
            initFaqAccordion();
            initFormValidation();
        }
    }

    /**
     * Execute scripts in included HTML
     * @param {HTMLElement} element - Container element with scripts
     */
    function executeScripts(element) {
        // Find all script tags
        const scripts = element.querySelectorAll('script');

        scripts.forEach(oldScript => {
            // Create a new script element
            const newScript = document.createElement('script');

            // Copy all attributes from the old script to the new one
            Array.from(oldScript.attributes).forEach(attr => {
                newScript.setAttribute(attr.name, attr.value);
            });

            // Copy the content
            newScript.appendChild(document.createTextNode(oldScript.innerHTML));

            // Replace the old script with the new one
            oldScript.parentNode.replaceChild(newScript, oldScript);
        });
    }

    function getHumanReadableFieldName(field) {
        // 1. Try aria-label (accessibility attribute)
        if (field.getAttribute('aria-label')) {
            return field.getAttribute('aria-label');
        }

        // 2. Try data-label (custom attribute)
        if (field.dataset.label) {
            return field.dataset.label;
        }

        // 3. Try associated label element
        if (field.id) {
            const label = document.querySelector(`label[for="${field.id}"]`);
            if (label && label.textContent) {
                return label.textContent.trim();
            }
        }

        // 4. Try parent label (when field is inside the label)
        const parentLabel = field.closest('label');
        if (parentLabel) {
            const clone = parentLabel.cloneNode(true);
            Array.from(clone.querySelectorAll('input, select, textarea, button')).forEach(el => el.remove());
            const labelText = clone.textContent.trim();
            if (labelText) {
                return labelText;
            }
        }

        // 5. Try placeholder as fallback
        if (field.placeholder) {
            return field.placeholder;
        }

        // 6. Last resort: humanize the field name or ID
        const identifier = field.name || field.id || '';
        if (identifier) {
            return humanizeFieldName(identifier);
        }

        // If all else fails
        return "Field";
    }

    function humanizeFieldName(name) {
        return name
            .replace(/([A-Z])/g, ' $1')
            .replace(/_/g, ' ')
            .replace(/-/g, ' ')
            .replace(/^\w/, c => c.toUpperCase())
            .trim();
    }

    function setupFormSubmission(formId, endpoint) {
        const form = document.getElementById(formId);
        if (!form) return;

        /* form.addEventListener('submit', function (e) {
             e.preventDefault();
 
             // Validate the form first
             if (!validateForm(this)) {
                 return false;
             }*/

        // Show loading state
        const submitButton = form.querySelector('[type="submit"]');
        const originalButtonText = submitButton.innerHTML;
        submitButton.innerHTML = 'Sending...';
        submitButton.disabled = true;

        // Get form data
        const formData = new FormData(form);

        // If you need to see the data (for debugging)
        /*
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }
        */

        // Submit the form data
        fetch(endpoint, {
            method: 'POST',
            body: formData
        })
            .then(response => {
                // Check if the response is OK
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Reset button
                submitButton.innerHTML = originalButtonText;
                submitButton.disabled = false;

                if (data.success) {
                    // Success case
                    showMessage(formId, data.message || 'Your submission was successful!', 'success');
                    form.reset();
                } else {
                    // Server returned an error
                    showMessage(formId, data.message || 'There was a problem with your submission.', 'error');
                }
            })
            .catch(error => {
                // Reset button
                submitButton.innerHTML = originalButtonText;
                submitButton.disabled = false;

                console.error('Error:', error);
                showMessage(formId, 'An error occurred while sending your data. Please try again later.', 'error');
            });
        // });
    }
})();