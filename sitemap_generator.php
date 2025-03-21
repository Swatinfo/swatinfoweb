<?php

/**
 * XML Sitemap Generator for Swat Info System
 * 
 * This script generates a complete XML sitemap for all pages of the website.
 * Save this file as generate-sitemap.php and run it periodically to keep your sitemap updated.
 */

// Configuration
$baseUrl = 'https://swatinfosystem.com/';
$sitemapPath = $_SERVER['DOCUMENT_ROOT'] . '/sitemap.xml';

// Define all website pages with their change frequency and priority
$pages = [
    // Main pages
    ['url' => '', 'changefreq' => 'weekly', 'priority' => '1.0', 'lastmod' => date('c')],
    ['url' => 'about', 'changefreq' => 'monthly', 'priority' => '0.8', 'lastmod' => date('c')],
    ['url' => 'service', 'changefreq' => 'weekly', 'priority' => '0.9', 'lastmod' => date('c')],
    ['url' => 'solution', 'changefreq' => 'weekly', 'priority' => '0.9', 'lastmod' => date('c')],
    ['url' => 'contact', 'changefreq' => 'monthly', 'priority' => '0.8', 'lastmod' => date('c')],
    ['url' => 'get-quote', 'changefreq' => 'monthly', 'priority' => '0.8', 'lastmod' => date('c')],

    // Service pages
    ['url' => 'website_development', 'changefreq' => 'monthly', 'priority' => '0.8', 'lastmod' => date('c')],
    ['url' => 'webapp_development', 'changefreq' => 'monthly', 'priority' => '0.8', 'lastmod' => date('c')],
    ['url' => 'mobile_app_development', 'changefreq' => 'monthly', 'priority' => '0.8', 'lastmod' => date('c')],
    ['url' => 'digital_marketing', 'changefreq' => 'monthly', 'priority' => '0.8', 'lastmod' => date('c')],
    ['url' => 'ux_ui', 'changefreq' => 'monthly', 'priority' => '0.8', 'lastmod' => date('c')],
    ['url' => 'desktop_application', 'changefreq' => 'monthly', 'priority' => '0.8', 'lastmod' => date('c')],

    // Solution pages
    ['url' => 'automobile', 'changefreq' => 'monthly', 'priority' => '0.7', 'lastmod' => date('c')],
    ['url' => 'business', 'changefreq' => 'monthly', 'priority' => '0.7', 'lastmod' => date('c')],
    ['url' => 'education', 'changefreq' => 'monthly', 'priority' => '0.7', 'lastmod' => date('c')],
    ['url' => 'tours_travel', 'changefreq' => 'monthly', 'priority' => '0.7', 'lastmod' => date('c')],
    ['url' => 'real_estate', 'changefreq' => 'monthly', 'priority' => '0.7', 'lastmod' => date('c')],
    ['url' => 'online_shopping', 'changefreq' => 'monthly', 'priority' => '0.7', 'lastmod' => date('c')]
];

// Create XML document
$xml = new DOMDocument('1.0', 'UTF-8');
$xml->formatOutput = true;

// Create urlset element
$urlset = $xml->createElement('urlset');
$urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
$xml->appendChild($urlset);

// Add URLs to sitemap
foreach ($pages as $page) {
    $url = $xml->createElement('url');

    // Create and append loc element
    $loc = $xml->createElement('loc');
    $loc->appendChild($xml->createTextNode($baseUrl . $page['url']));
    $url->appendChild($loc);

    // Create and append lastmod element
    $lastmod = $xml->createElement('lastmod');
    $lastmod->appendChild($xml->createTextNode($page['lastmod']));
    $url->appendChild($lastmod);

    // Create and append changefreq element
    $changefreq = $xml->createElement('changefreq');
    $changefreq->appendChild($xml->createTextNode($page['changefreq']));
    $url->appendChild($changefreq);

    // Create and append priority element
    $priority = $xml->createElement('priority');
    $priority->appendChild($xml->createTextNode($page['priority']));
    $url->appendChild($priority);

    // Add url to urlset
    $urlset->appendChild($url);
}

// Save the XML file
$xml->save($sitemapPath);

echo "Sitemap generated successfully at: " . $sitemapPath;
