<!-- Navigation Menu Template -->
<header>
    <div class="container header-container">
        <!-- Logo Container with Flexible Options -->
        <a href="index" class="logo">
            <div class="logo-container">
                <!-- Conditionally display logo image if available -->
                <?php if (file_exists('assets/images/swatinfo_logo.svg') || file_exists('assets/images/swatinfo_logo.png') || file_exists('assets/images/swatinfo_logo.jpg')): ?>
                    <img src="assets/images/swatinfo_logo.png" alt="Swat Info System Logo" class="logo-image" onerror="this.style.display='none';">
                <?php endif; ?>

                <!-- Text Logo -->
                <span class="logo-text">
                    <!-- Swat<span>InfoSystem</span> -->
                </span>
            </div>
        </a>
        <div class="mobile-menu-btn">☰</div>
        <nav class="nav-menu">
            <a href="index" class="nav-link">Home</a>
            <a href="about" class="nav-link">About Us</a>
            <div class="dropdown">
                <a href="service" class="nav-link">Services</a>
                <div class="dropdown-content">
                    <a href="website_development" class="dropdown-link">Website Development</a>
                    <a href="webapp_development" class="dropdown-link">Web App Development</a>
                    <a href="mobileapp_development" class="dropdown-link">Mobile App Development</a>
                    <a href="digital_marketing" class="dropdown-link">Digital Marketing</a>
                    <a href="ux_ui" class="dropdown-link">UX/UI Design</a>
                    <a href="desktop_application" class="dropdown-link">Desktop Applications</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="solution" class="nav-link">Solutions</a>
                <div class="dropdown-content">
                    <a href="automobile" class="dropdown-link">Automobile</a>
                    <a href="business" class="dropdown-link">Business</a>
                    <a href="education" class="dropdown-link">Education</a>
                    <a href="tours_travel" class="dropdown-link">Tours & Travel</a>
                    <a href="real_estate" class="dropdown-link">Real Estate</a>
                    <a href="online_shopping" class="dropdown-link">Online Shopping</a>
                </div>
            </div>
            <a href="contact" class="nav-link">Contact</a>
            <a href="get-quote" class="cta-button">Get a Quote</a>
        </nav>
    </div>
</header>