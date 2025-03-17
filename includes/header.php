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

// Set SEO details from configuration
if (isset($seoConfig[$currentPage])) {
    $pageConfig = $seoConfig[$currentPage];

    $seo->setTitle($pageConfig['title'])
        ->setDescription($pageConfig['description'])
        ->setKeywords($pageConfig['keywords'])
        ->setCanonicalUrl('/' . $currentPage)
        ->setOgImage($pageConfig['ogImage']);

    $ogGenerator = new OGImageGenerator();
    $ogGenerator->generate(
        $seo->getTitle(),
        $seo->getDescription(),
        $seo->getOgImage()
    );
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Dynamic SEO Meta Tags -->
    <?php
    echo $seo->renderMetaTags();
    echo $seo->renderStructuredData();
    ?>

    <!-- Other head elements -->
    <link rel="stylesheet" href="css/styles.css">
</head>