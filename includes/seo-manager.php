<?php

/**
 * SEO Configuration File for Swat Info System
 * This file defines SEO metadata for all pages of the website
 */

class SeoManager
{
    private $title;
    private $description;
    private $keywords;
    private $canonicalUrl;
    private $robots;
    private $ogTitle;
    private $ogDescription;
    private $ogImage;
    private $ogType;
    private $twitterCard;

    // Default configuration
    private $defaultConfig = [
        'companyName' => 'Swat Info System',
        'defaultTitle' => 'Leading IT Services & Digital Solutions Provider',
        'defaultDescription' => 'Transform your business with comprehensive IT services including web development, mobile apps, digital marketing, and custom software solutions by Swat Info System.',
        'defaultKeywords' => 'IT services, web development, mobile app development, digital marketing, software solutions, business transformation',
        'defaultImage' => '/assets/images/og-default.jpg',
        'baseUrl' => 'https://www.swatinfosystem.com/'
    ];

    /**
     * Constructor - Initialize with default values
     */
    public function __construct()
    {
        $this->title = $this->defaultConfig['defaultTitle'];
        $this->description = $this->defaultConfig['defaultDescription'];
        $this->keywords = $this->defaultConfig['defaultKeywords'];
        $this->canonicalUrl = $this->getCurrentPageUrl();
        $this->robots = 'index, follow';
        $this->ogType = 'website';
        $this->ogTitle = $this->title;
        $this->ogDescription = $this->description;
        $this->ogImage = $this->defaultConfig['defaultImage'];
        $this->twitterCard = 'summary_large_image';
    }

    /**
     * Set page title
     */
    public function setTitle($title)
    {
        $this->title = htmlspecialchars(trim($title)) . ' | ' . $this->defaultConfig['companyName'];
        $this->ogTitle = $this->title;
        return $this;
    }

    /**
     * Set page description
     */
    public function setDescription($description)
    {
        $this->description = htmlspecialchars(trim($description));
        $this->ogDescription = $this->description;
        return $this;
    }

    /**
     * Set page keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = htmlspecialchars(trim($keywords));
        return $this;
    }

    /**
     * Set canonical URL
     */
    public function setCanonicalUrl($url)
    {
        if (strpos($url, 'http') !== 0) {
            $url = $this->defaultConfig['baseUrl'] . ltrim($url, '/');
        }
        $this->canonicalUrl = $url;
        return $this;
    }

    /**
     * Set robots directive
     */
    public function setRobots($robots)
    {
        $this->robots = htmlspecialchars(trim($robots));
        return $this;
    }

    /**
     * Set Open Graph image
     */
    public function setOgImage($image)
    {
        if (strpos($image, 'http') !== 0) {
            $image = $this->defaultConfig['baseUrl'] . ltrim($image, '/');
        }
        $this->ogImage = $image;
        return $this;
    }

    /**
     * Set Open Graph type
     */
    public function setOgType($type)
    {
        $this->ogType = htmlspecialchars(trim($type));
        return $this;
    }

    /**
     * Set Twitter card type
     */
    public function setTwitterCard($card)
    {
        $this->twitterCard = htmlspecialchars(trim($card));
        return $this;
    }

    /**
     * Get default configuration
     */
    public function getDefaultConfig()
    {
        return $this->defaultConfig;
    }

    /**
     * Get default meta tags
     */
    public function getDefaultMetaTags()
    {
        return [
            'title' => $this->defaultConfig['defaultTitle'],
            'description' => $this->defaultConfig['defaultDescription'],
            'keywords' => $this->defaultConfig['defaultKeywords'],
            'ogImage' => $this->defaultConfig['defaultImage']
        ];
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getKeywords()
    {
        return $this->keywords;
    }

    public function getCanonicalUrl()
    {
        return $this->canonicalUrl;
    }

    public function getOgType()
    {
        return $this->ogType;
    }

    public function getOgImage()
    {
        return $this->ogImage;
    }

    public function getTwitterCard()
    {
        return $this->twitterCard;
    }

    /**
     * Get current page URL
     */
    private function getCurrentPageUrl()
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'] ?? 'swatinfosystem.com';
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        return "{$protocol}://{$host}{$uri}";
    }

    /**
     * Render meta tags for the current page
     */
    public function renderMetaTags()
    {
        $metaTags = [
            // Standard Meta Tags
            "<title>{$this->title}</title>",
            "<meta name='description' content='{$this->description}'>",
            "<meta name='keywords' content='{$this->keywords}'>",
            "<meta name='robots' content='{$this->robots}'>",
            "<meta name='viewport' content='width=device-width, initial-scale=1.0'>",

            // Canonical URL
            "<link rel='canonical' href='{$this->canonicalUrl}'>",

            // Open Graph Meta Tags
            "<meta property='og:title' content='{$this->ogTitle}'>",
            "<meta property='og:description' content='{$this->ogDescription}'>",
            "<meta property='og:type' content='{$this->ogType}'>",
            "<meta property='og:url' content='{$this->canonicalUrl}'>",
            "<meta property='og:image' content='{$this->ogImage}'>",
            "<meta property='og:site_name' content='{$this->defaultConfig['companyName']}'>",

            // Twitter Card Meta Tags
            "<meta name='twitter:card' content='{$this->twitterCard}'>",
            "<meta name='twitter:title' content='{$this->ogTitle}'>",
            "<meta name='twitter:description' content='{$this->ogDescription}'>",
            "<meta name='twitter:image' content='{$this->ogImage}'>"
        ];

        return implode("\n    ", $metaTags);
    }

    /**
     * Generate structured data for organization
     */
    public function renderOrganizationSchema()
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $this->defaultConfig['companyName'],
            'url' => $this->defaultConfig['baseUrl'],
            'logo' => $this->defaultConfig['baseUrl'] . 'assets/images/logo.png',
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+1-555-123-4567',
                'contactType' => 'customer service',
                'areaServed' => 'US',
                'availableLanguage' => ['English']
            ],
            'sameAs' => [
                'https://www.facebook.com/swatinfosystem',
                'https://www.linkedin.com/company/swatinfosystem',
                'https://twitter.com/swatinfosystem'
            ]
        ];

        return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }

    /**
     * Generate structured data for service
     */
    public function renderServiceSchema($serviceName, $serviceDescription, $serviceUrl)
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'serviceType' => $serviceName,
            'provider' => [
                '@type' => 'Organization',
                'name' => $this->defaultConfig['companyName'],
                'url' => $this->defaultConfig['baseUrl']
            ],
            'description' => $serviceDescription,
            'url' => $serviceUrl
        ];

        return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }

    /**
     * Generate breadcrumb structured data
     */
    public function renderBreadcrumbSchema($items)
    {
        $breadcrumbItems = [];
        $position = 1;

        foreach ($items as $name => $url) {
            $breadcrumbItems[] = [
                '@type' => 'ListItem',
                'position' => $position,
                'name' => $name,
                'item' => strpos($url, 'http') === 0 ? $url : $this->defaultConfig['baseUrl'] . ltrim($url, '/')
            ];
            $position++;
        }

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $breadcrumbItems
        ];

        return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }

    /**
     * Generate FAQ structured data
     */
    public function renderFaqSchema($faqs)
    {
        $faqItems = [];

        foreach ($faqs as $faq) {
            $faqItems[] = [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer']
                ]
            ];
        }

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $faqItems
        ];

        return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }
}


/**
 * Function to apply SEO settings for the current page
 */
function applySeoSettings()
{
    global $seoConfig;

    // Determine current page
    $currentPage = basename($_SERVER['PHP_SELF'], '.php');
    $currentPage = ($currentPage === 'index') ? 'index' : $currentPage;

    // Initialize SEO Manager
    $seo = new SeoManager();

    // Set SEO settings if configuration exists for this page
    if (isset($seoConfig[$currentPage])) {
        $pageConfig = $seoConfig[$currentPage];

        $seo->setTitle($pageConfig['title'])
            ->setDescription($pageConfig['description'])
            ->setKeywords($pageConfig['keywords'])
            ->setCanonicalUrl('/' . $currentPage)
            ->setOgImage($pageConfig['ogImage']);
    }

    // Generate breadcrumb data based on current page
    $breadcrumbs = ['Home' => '/'];

    // Add parent level if applicable
    if (in_array($currentPage, ['website_development', 'webapp_development', 'mobileapp_development', 'digital_marketing', 'ux_ui', 'desktop_application'])) {
        $breadcrumbs['Services'] = '/service';
    } else if (in_array($currentPage, ['automobile', 'business', 'education', 'tours_travel', 'real_estate', 'online_shopping'])) {
        $breadcrumbs['Solutions'] = '/solution';
    }

    // Add current page name (format nicely)
    if ($currentPage !== 'index') {
        $breadcrumbs[formatPageTitle($currentPage)] = '/' . $currentPage;
    }

    // Generate schema for specific page types
    $extraSchema = [];

    // Add FAQ schema for pages with FAQs
    if (in_array($currentPage, ['website_development', 'webapp_development', 'mobileapp_development', 'digital_marketing', 'ux_ui', 'desktop_application', 'get-quote'])) {
        // We would extract FAQs from the page, but for now let's use placeholder data
        $faqs = [
            ['question' => 'How long does it take to develop a website?', 'answer' => 'The timeline varies depending on complexity, but typically ranges from 4-12 weeks.'],
            ['question' => 'How much does it cost?', 'answer' => 'Costs vary based on specific requirements. Contact us for a personalized quote.']
        ];
        $extraSchema[] = $seo->renderFaqSchema($faqs);
    }

    // Add service schema for service pages
    if (in_array($currentPage, ['website_development', 'webapp_development', 'mobileapp_development', 'digital_marketing', 'ux_ui', 'desktop_application'])) {
        $serviceName = isset($pageConfig['title']) ? $pageConfig['title'] : formatPageTitle($currentPage);
        $serviceDesc = isset($pageConfig['description']) ? $pageConfig['description'] : '';
        $serviceUrl = $seo->getDefaultConfig()['baseUrl'] . $currentPage;

        $extraSchema[] = $seo->renderServiceSchema($serviceName, $serviceDesc, $serviceUrl);
    }

    // Return all SEO tags and schemas
    return [
        'metaTags' => $seo->renderMetaTags(),
        'organizationSchema' => $seo->renderOrganizationSchema(),
        'breadcrumbSchema' => $seo->renderBreadcrumbSchema($breadcrumbs),
        'extraSchema' => implode("\n", $extraSchema)
    ];
}

/**
 * Helper function to format page title from slug
 */
function formatPageTitle($slug)
{
    // Special cases
    $specialCases = [
        'mobileapp_development' => 'Mobile App Development',
        'webapp_development' => 'Web App Development',
        'ux_ui' => 'UX/UI Design',
        'real_estate' => 'Real Estate',
        'online_shopping' => 'E-commerce & Retail',
        'tours_travel' => 'Tours & Travel',
        'get-quote' => 'Get a Quote'
    ];

    if (isset($specialCases[$slug])) {
        return $specialCases[$slug];
    }

    // General case: convert underscores to spaces and capitalize each word
    return ucwords(str_replace('_', ' ', $slug));
}
