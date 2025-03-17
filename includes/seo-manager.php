<?php
class SEOManager
{
    private $title;
    private $description;
    private $keywords;
    private $canonicalUrl;
    private $robots;
    private $ogType;
    private $ogTitle;
    private $ogDescription;
    private $ogImage;
    private $twitterCard;

    // Default configuration
    private $defaultConfig = [
        'companyName' => 'Swat Info System',
        'defaultDescription' => 'Leading IT services provider offering web development, mobile apps, digital marketing, and custom software solutions.',
        'defaultKeywords' => 'IT services, web development, mobile app development, digital marketing, software solutions',
        'defaultImage' => '/assets/og-image.jpg',
        'baseUrl' => 'https://www.swatinfosystem.com'
    ];

    public function __construct()
    {
        // Set default values
        $this->title = $this->defaultConfig['companyName'];
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

    // Setters with validation
    public function setTitle($title)
    {
        $this->title = htmlspecialchars(trim($title)) . ' | ' . $this->defaultConfig['companyName'];
        $this->ogTitle = $this->title;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = htmlspecialchars(trim($description));
        $this->ogDescription = $this->description;
        return $this;
    }

    public function setKeywords($keywords)
    {
        $this->keywords = htmlspecialchars(trim($keywords));
        return $this;
    }

    public function setCanonicalUrl($url)
    {
        $this->canonicalUrl = $this->defaultConfig['baseUrl'] . ltrim($url, '/');
        return $this;
    }

    public function setRobots($robots)
    {
        $this->robots = htmlspecialchars(trim($robots));
        return $this;
    }

    public function setOgType($type)
    {
        $this->ogType = htmlspecialchars(trim($type));
        return $this;
    }

    public function setOgImage($image)
    {
        $this->ogImage = htmlspecialchars(trim($image));
        return $this;
    }

    public function setTwitterCard($card)
    {
        $this->twitterCard = htmlspecialchars(trim($card));
        return $this;
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

    // Generate meta tags
    public function renderMetaTags()
    {
        $metaTags = [
            // Standard Meta Tags
            "<title>{$this->title}</title>",
            "<meta name='description' content='{$this->description}'>",
            "<meta name='keywords' content='{$this->keywords}'>",
            "<meta name='robots' content='{$this->robots}'>",

            // Canonical URL
            "<link rel='canonical' href='{$this->canonicalUrl}'>",

            // Open Graph Meta Tags
            "<meta property='og:title' content='{$this->ogTitle}'>",
            "<meta property='og:description' content='{$this->ogDescription}'>",
            "<meta property='og:type' content='{$this->ogType}'>",
            "<meta property='og:url' content='{$this->canonicalUrl}'>",
            "<meta property='og:image' content='{$this->defaultConfig['baseUrl']}{$this->ogImage}'>",
            "<meta property='og:site_name' content='{$this->defaultConfig['companyName']}'>",

            // Twitter Card Meta Tags
            "<meta name='twitter:card' content='{$this->twitterCard}'>",
            "<meta name='twitter:title' content='{$this->ogTitle}'>",
            "<meta name='twitter:description' content='{$this->ogDescription}'>",
            "<meta name='twitter:image' content='{$this->defaultConfig['baseUrl']}{$this->ogImage}'>"
        ];

        return implode("\n\t", $metaTags);
    }

    // Get current page URL
    private function getCurrentPageUrl()
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'];
        $uri = $_SERVER['REQUEST_URI'];
        return "{$protocol}://{$host}{$uri}";
    }

    // Structured Data (JSON-LD)
    public function renderStructuredData()
    {
        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => $this->defaultConfig['companyName'],
            'url' => $this->defaultConfig['baseUrl'],
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => "{$this->defaultConfig['baseUrl']}search?q={search_term_string}",
                'query-input' => 'required name=search_term_string'
            ]
        ];

        return "<script type='application/ld+json'>" .
            json_encode($structuredData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) .
            "</script>";
    }
}
