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

    <!-- Favicon -->
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Other head elements -->
    <link rel="stylesheet" href="css/styles.css">
</head>