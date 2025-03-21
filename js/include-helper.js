/**
 * Swat Info System - HTML Include Helper
 * This script loads HTML snippets from external files into specified elements
 */

document.addEventListener('DOMContentLoaded', function () {
    // Include all HTML components
    includeHTML();
});

/**
 * Loads HTML content from external files
 * Usage: Add attribute "w3-include-html" with the file path to any element
 * Example: <div w3-include-html="includes/header.html"></div>
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
                element.innerHTML = 'Page not found.';
            }
        } catch (error) {
            console.error(`Error loading ${file}: ${error.message}`);
            element.innerHTML = 'Error loading component.';
        }
    }

    // Re-initialize event listeners for newly added content
    if (elements.length > 0) {
        if (typeof initMobileMenu === 'function') {
            initMobileMenu();
        }
    }
}

/**
 * Execute scripts in included HTML
 * This is necessary because scripts in innerHTML don't execute automatically
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