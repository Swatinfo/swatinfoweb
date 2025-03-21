<?php
// Include SEO Manager and Configuration
require_once 'includes/seo-manager.php';
require_once 'includes/seo-config.php';
require_once 'includes/OGImageGenerator.php';

// Determine current page
$currentPage = basename($_SERVER['PHP_SELF'], '.php');
$currentPage = ($currentPage === 'index') ? 'index' : $currentPage;

// Initialize SEO Manager
$seo = new SEOManager();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    // Set SEO details from configuration
    if (isset($seoConfig[$currentPage])) {
        $seoData = applySeoSettings();

        // <!-- SEO Meta Tags -->
        echo $seoData['metaTags'];

        // <!-- Structured Data -->
        echo $seoData['organizationSchema'];
        echo $seoData['breadcrumbSchema'];
        echo $seoData['extraSchema'];
    } else {
        echo $seo->getDefaultMetaTags();
    }
    ?>
<script type='application/ld+json'>
        {
            "@context": "http://www.schema.org",
            "@type": "ProfessionalService",
            "name": "Swat Info System",
            "url": "https://swatinfosyatem.com/",
            "logo": "https://swatinfosyatem.com/assets/images/swatinfo_logo.png",
            "image": "https://swatinfosyatem.com/assets/images/swatinfo_logo.png",
            "description": "We Are Rajkot,Gujarat,India Based Software Development Company. Swat Info System  Provide Services Like Website Development, Digital Marketing, Mobile Application Development,ERP Software,CRM Software,CRM Software Development,ERP Software Development",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "302, Ornate One Silver Stone Main Road, 150 Feet Ring Road, behind Reliance Mall",
                "addressLocality": "Rajkot",
                "addressRegion": "Gujarat",
                "postalCode": "360005",
                "addressCountry": "India"
            },
            "geo": {
                "@type": "GeoCoordinates",
                "latitude": "22.2813022",
                "longitude": "70.7754745"
            },
            "openingHours": "Mo, Tu, We, Th, Fr, Sa 09:30-19:00",
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "+91 (951) 071-7999",
                "contactType": "technical support",
                "email": "info@swatinfosystem.com"
            }
        }
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56772780-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-56772780-1');
    </script>


    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon/favicon-16x16.png">
    <link rel="icon" href="assets/images/favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicon/apple-touch-icon.png">
    <link rel="manifest" href="assets/images/favicon/site.webmanifest">
    <meta name="msapplication-TileColor" content="#2563eb">
    <meta name="theme-color" content="#2563eb">

    <!-- Other head elements -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/custom.css">
</head>