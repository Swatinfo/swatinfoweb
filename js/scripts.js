/**
 * Swat Info System - Main JavaScript File
 * Contains all interactive functionality for the website
 */

document.addEventListener('DOMContentLoaded', function () {
    // Initialize all components
    initMobileMenu();
    initFaqAccordion();

    setTimeout(highlightCurrentPage, 100);


    // Add any page-specific initializations
    if (document.querySelector('.testimonial-slider')) {
        initTestimonialSlider();
    }
});

/**
 * Mobile Menu Toggle Functionality
 * Handles the responsive mobile menu open/close
 */
function initMobileMenu() {
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');

    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function () {
            const navMenu = document.querySelector('.nav-menu');
            if (navMenu.style.display === 'flex') {
                navMenu.style.display = 'none';
            } else {
                navMenu.style.display = 'flex';
            }
        });
    }
}

/**
 * FAQ Accordion Functionality
 * Handles the expanding/collapsing of FAQ items
 */
function initFaqAccordion() {
    const faqItems = document.querySelectorAll('.faq-item');

    if (faqItems.length > 0) {
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            if (question) {
                question.addEventListener('click', () => {
                    // Close all other items
                    faqItems.forEach(otherItem => {
                        if (otherItem !== item) {
                            otherItem.classList.remove('active');

                            // Update plus/minus icon if it exists
                            const otherIcon = otherItem.querySelector('.faq-question span:last-child');
                            if (otherIcon) {
                                otherIcon.textContent = '+';
                            }
                        }
                    });

                    // Toggle current item
                    item.classList.toggle('active');

                    // Update plus/minus icon if it exists
                    const icon = question.querySelector('span:last-child');
                    if (icon) {
                        if (item.classList.contains('active')) {
                            icon.textContent = '-';
                        } else {
                            icon.textContent = '+';
                        }
                    }
                });
            }
        });
    }
}

/**
 * Testimonial Slider Functionality
 * If the site has a testimonial slider in the future
 */
function initTestimonialSlider() {
    // This is a placeholder for potential future testimonial slider functionality
    console.log('Testimonial slider initialized');

    // Sample implementation:
    /*
    const testimonials = document.querySelectorAll('.testimonial-item');
    let currentIndex = 0;
    
    function showTestimonial(index) {
        testimonials.forEach((testimonial, i) => {
            testimonial.style.display = i === index ? 'block' : 'none';
        });
    }
    
    // Show first testimonial
    showTestimonial(currentIndex);
    
    // Next button
    document.querySelector('.testimonial-next').addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % testimonials.length;
        showTestimonial(currentIndex);
    });
    
    // Previous button
    document.querySelector('.testimonial-prev').addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + testimonials.length) % testimonials.length;
        showTestimonial(currentIndex);
    });
    */
}

/**
 * Form Validation Functionality
 * For contact forms, quote request forms, etc.
 */
function validateForm(formId) {
    const form = document.getElementById(formId);

    if (!form) return false;

    let isValid = true;
    const requiredFields = form.querySelectorAll('[required]');

    // Reset previous error messages
    const errorMessages = form.querySelectorAll('.error-message');
    errorMessages.forEach(error => error.remove());

    // Check each required field
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            showFieldError(field, 'This field is required');
        } else if (field.type === 'email' && !isValidEmail(field.value)) {
            isValid = false;
            showFieldError(field, 'Please enter a valid email address');
        } else if (field.type === 'tel' && !isValidPhone(field.value)) {
            isValid = false;
            showFieldError(field, 'Please enter a valid phone number');
        }
    });

    return isValid;
}

/**
 * Display field error message
 */
function showFieldError(field, message) {
    // Remove any existing error for this field
    const existingError = field.parentNode.querySelector('.error-message');
    if (existingError) {
        existingError.remove();
    }

    // Create and add error message
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.textContent = message;
    errorDiv.style.color = 'red';
    errorDiv.style.fontSize = '12px';
    errorDiv.style.marginTop = '5px';

    // Add after the field
    field.parentNode.insertBefore(errorDiv, field.nextSibling);

    // Highlight the field
    field.style.borderColor = 'red';

    // Remove highlight when user starts typing again
    field.addEventListener('input', function () {
        this.style.borderColor = '';
        const error = this.parentNode.querySelector('.error-message');
        if (error) {
            error.remove();
        }
    });
}

/**
 * Email validation helper
 */
function isValidEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

/**
 * Phone validation helper
 */
function isValidPhone(phone) {
    // Basic validation - can be adjusted based on requirements
    const regex = /^[\d\s\+\-\(\)]{10,15}$/;
    return regex.test(phone);
}

/**
 * Smooth scroll to element functionality
 */
function scrollToElement(elementId) {
    const element = document.getElementById(elementId);
    if (element) {
        window.scrollTo({
            top: element.offsetTop - 100, // Offset for fixed header
            behavior: 'smooth'
        });
    }
}

/**
 * Initialize any scroll-to-section links
 */
function initSmoothScroll() {
    const scrollLinks = document.querySelectorAll('a[href^="#"]');

    scrollLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            const targetId = this.getAttribute('href').substring(1);
            scrollToElement(targetId);
        });
    });
}

/**
 * Add animation on scroll functionality
 * This can be enabled if you want to add animations when elements come into view
 */
function initScrollAnimations() {
    const animatedElements = document.querySelectorAll('.animate-on-scroll');

    if (animatedElements.length > 0) {
        // Create observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    // Optionally, stop observing after animation
                    // observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        // Observe all elements with the class
        animatedElements.forEach(element => {
            observer.observe(element);
        });
    }
}

/**
 * Lazy loading for images
 */
function initLazyLoading() {
    const lazyImages = document.querySelectorAll('img[data-src]');

    if (lazyImages.length > 0 && 'IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    imageObserver.unobserve(img);
                }
            });
        });

        lazyImages.forEach(img => {
            imageObserver.observe(img);
        });
    } else {
        // Fallback for browsers that don't support IntersectionObserver
        lazyImages.forEach(img => {
            img.src = img.dataset.src;
            img.removeAttribute('data-src');
        });
    }
}

function highlightCurrentPage() {
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
    });
}