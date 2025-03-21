<?php
class OGImageGenerator
{
    private $width;
    private $height;
    private $backgroundColor;
    private $textColor;
    private $fontPath;

    public function __construct($width = 1200, $height = 630)
    {
        $this->width = $width;
        $this->height = $height;
        $this->backgroundColor = [36, 99, 235]; // Primary color
        $this->textColor = [255, 255, 255]; // White
        $this->fontPath =  '../assets/fonts/static/Inter_18pt-Bold.ttf';
    }

    public function generate($title, $subtitle = '', $outputPath = null)
    {
        // Create image
        $image = imagecreatetruecolor($this->width, $this->height);

        // Background color
        $bgColor = imagecolorallocate(
            $image,
            $this->backgroundColor[0],
            $this->backgroundColor[1],
            $this->backgroundColor[2]
        );
        imagefill($image, 0, 0, $bgColor);

        // Text color
        $textColor = imagecolorallocate(
            $image,
            $this->textColor[0],
            $this->textColor[1],
            $this->textColor[2]
        );

        // Title
        $titleFontSize = 70;
        $titleBBox = imagettfbbox($titleFontSize, 0, $this->fontPath, $title);
        $titleWidth = $titleBBox[2] - $titleBBox[0];
        $titleX = ($this->width - $titleWidth) / 2;
        $titleY = $this->height / 2 - 50;

        // Subtitle
        $subtitleFontSize = 40;
        $subtitleBBox = imagettfbbox($subtitleFontSize, 0, $this->fontPath, $subtitle);
        $subtitleWidth = $subtitleBBox[2] - $subtitleBBox[0];
        $subtitleX = ($this->width - $subtitleWidth) / 2;
        $subtitleY = $this->height / 2 + 50;

        // Add logo or company name
        $logoText = "Swat Info System";
        $logoFontSize = 30;
        $logoBBox = imagettfbbox($logoFontSize, 0, $this->fontPath, $logoText);
        $logoWidth = $logoBBox[2] - $logoBBox[0];
        $logoX = ($this->width - $logoWidth) / 2;
        $logoY = $this->height - 100;

        // Render text
        imagettftext($image, $titleFontSize, 0, $titleX, $titleY, $textColor, $this->fontPath, $title);

        if (!empty($subtitle)) {
            imagettftext($image, $subtitleFontSize, 0, $subtitleX, $subtitleY, $textColor, $this->fontPath, $subtitle);
        }

        imagettftext($image, $logoFontSize, 0, $logoX, $logoY, $textColor, $this->fontPath, $logoText);

        // Output or save
        if ($outputPath) {
            // Ensure directory exists
            $dir = dirname($outputPath);
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            imagepng($image, $outputPath);
        } else {
            header('Content-Type: image/png');
            imagepng($image);
        }

        // Free up memory
        imagedestroy($image);
    }

    // Generate OG images for all pages
    public function generateAllOGImages()
    {
        $pages = [
            ['title' => 'Swat Info System', 'subtitle' => 'Digital Transformation Solutions', 'file' => 'og-home.jpg'],
            ['title' => 'About Us', 'subtitle' => 'Our Journey & Vision', 'file' => 'og-about.jpg'],
            ['title' => 'IT Services', 'subtitle' => 'Web, Mobile & Digital Solutions', 'file' => 'og-services.jpg'],
            ['title' => 'Business Solutions', 'subtitle' => 'Industry-Specific ERP', 'file' => 'og-solutions.jpg'],
            ['title' => 'Contact Us', 'subtitle' => 'Get in Touch', 'file' => 'og-contact.jpg']
        ];

        foreach ($pages as $page) {
            $this->generate(
                $page['title'],
                $page['subtitle'],
                $_SERVER['DOCUMENT_ROOT'] . "/assets/og-images/{$page['file']}"
            );
        }
    }


    // Example usage
    // Uncomment to generate images
    // $generator = new OGImageGenerator();
    // $generator->generateAllOGImages();

    // Alternate method for dynamic OG image generation
    public function generateDynamicOGImage($pageData)
    {
        // Create a more dynamic OG image generation method
        $image = imagecreatetruecolor($this->width, $this->height);

        // Gradient background
        $primaryColor = imagecolorallocate($image, 37, 99, 235);
        $secondaryColor = imagecolorallocate($image, 16, 185, 129);

        // Create a gradient background
        for ($y = 0; $y < $this->height; $y++) {
            $ratio = $y / $this->height;
            $r = $this->interpolateColor(37, 16, $ratio);
            $g = $this->interpolateColor(99, 185, $ratio);
            $b = $this->interpolateColor(235, 129, $ratio);

            $color = imagecolorallocate($image, $r, $g, $b);
            imagefilledrectangle($image, 0, $y, $this->width, $y + 1, $color);
        }

        // Add logo or watermark
        $logoPath = $_SERVER['DOCUMENT_ROOT'] . '/assets/logo.png';
        if (file_exists($logoPath)) {
            $logo = imagecreatefrompng($logoPath);
            $logoWidth = imagesx($logo);
            $logoHeight = imagesy($logo);

            // Scale logo
            $newLogoWidth = 200;
            $scaleFactor = $newLogoWidth / $logoWidth;
            $newLogoHeight = $logoHeight * $scaleFactor;

            $resizedLogo = imagecreatetruecolor($newLogoWidth, $newLogoHeight);
            imagealphablending($resizedLogo, false);
            imagesavealpha($resizedLogo, true);

            imagecopyresampled(
                $resizedLogo,
                $logo,
                0,
                0,
                0,
                0,
                $newLogoWidth,
                $newLogoHeight,
                $logoWidth,
                $logoHeight
            );

            // Position logo
            imagecopy(
                $image,
                $resizedLogo,
                ($this->width - $newLogoWidth) / 2,
                $this->height - $newLogoHeight - 50,
                0,
                0,
                $newLogoWidth,
                $newLogoHeight
            );
        }

        // Return image resource or save
        return $image;
    }

    // Helper method for color interpolation
    private function interpolateColor($start, $end, $ratio)
    {
        return round($start + ($end - $start) * $ratio);
    }

    // SEO Audit Method
    public function performSEOAudit()
    {
        $auditResults = [
            'title_length' => [
                'min' => 30,
                'max' => 60,
                'current' => strlen($this->title),
                'status' => null
            ],
            'description_length' => [
                'min' => 50,
                'max' => 160,
                'current' => strlen($this->description),
                'status' => null
            ],
            'keywords' => [
                'count' => substr_count($this->keywords, ',') + 1,
                'max_recommended' => 10,
                'status' => null
            ]
        ];

        // Validate title length
        $auditResults['title_length']['status'] =
            ($auditResults['title_length']['current'] >= $auditResults['title_length']['min'] &&
                $auditResults['title_length']['current'] <= $auditResults['title_length']['max'])
            ? 'PASS' : 'FAIL';

        // Validate description length
        $auditResults['description_length']['status'] =
            ($auditResults['description_length']['current'] >= $auditResults['description_length']['min'] &&
                $auditResults['description_length']['current'] <= $auditResults['description_length']['max'])
            ? 'PASS' : 'FAIL';

        // Validate keywords count
        $auditResults['keywords']['status'] =
            $auditResults['keywords']['count'] <= $auditResults['keywords']['max_recommended']
            ? 'PASS' : 'FAIL';

        return $auditResults;
    }

    // Robots.txt Generator
    public function generateRobotsTxt()
    {
        $robotsTxt = "# Robots.txt for Swat Info System\n\n";
        $robotsTxt .= "User-agent: *\n";
        $robotsTxt .= "Disallow: /admin/\n";
        $robotsTxt .= "Disallow: /includes/\n";
        $robotsTxt .= "Disallow: /temp/\n\n";
        $robotsTxt .= "Sitemap: {$this->defaultConfig['baseUrl']}sitemap.xml\n";

        // Write to file
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/robots.txt', $robotsTxt);
    }

    // Sitemap Generator
    public function generateSitemap()
    {
        $pages = [
            ['loc' => '/', 'priority' => '1.0', 'changefreq' => 'daily'],
            [
                'loc' => '/about',
                'priority' => '0.8',
                'changefreq' => 'weekly'
            ],
            [
                'loc' => '/services',
                'priority' => '0.9',
                'changefreq' => 'weekly'
            ],
            [
                'loc' => '/contact',
                'priority' => '0.7',
                'changefreq' => 'monthly'
            ]
        ];

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');

        foreach ($pages as $page) {
            $url = $xml->addChild('url');
            $url->addChild('loc', $this->defaultConfig['baseUrl'] . ltrim($page['loc'], '/'));
            $url->addChild('priority', $page['priority']);
            $url->addChild('changefreq', $page['changefreq']);
            $url->addChild('lastmod', date('c'));
        }

        // Save sitemap
        $xml->asXML($_SERVER['DOCUMENT_ROOT'] . '/sitemap.xml');
    }
}
