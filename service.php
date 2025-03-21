<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="css/service.css">
<body>
    <!-- Header Include -->
    <?php include('includes/header_menu.php'); ?>

    <section class="page-banner">
        <div class="container">
            <h1>Our Technology Services</h1>
            <p>Innovative digital solutions that transform businesses through cutting-edge technology and strategic expertise</p>
        </div>
    </section>

    <div class="breadcrumbs">
        <div class="container breadcrumbs-container">
            <a href="index">Home</a>
            <span class="separator">/</span>
            <span class="current">Services</span>
        </div>
    </div>

    <section class="services-intro animate-on-scroll">
        <div class="container">
            <div class="section-header">
                <h2>Turning Vision into Digital Reality</h2>
                <p>At Swat Info System, we don't just provide services; we craft comprehensive digital solutions that empower businesses to thrive in the technological landscape. Our expert team delivers innovative, scalable, and reliable solutions tailored to your unique challenges.</p>
            </div>
        </div>
    </section>

    <section class="main-services">
        <div class="container">
            <div class="services-grid">
                <?php
                $services = [
                    [
                        'icon' => 'assets/images/Website_Development.webp',
                        'title' => 'Website Development',
                        'description' => 'Custom-built, responsive websites that engage visitors and drive conversions with modern design and functionality.',
                        'features' => [
                            'Responsive Web Design',
                            'E-commerce Solutions',
                            'CMS Integration',
                            'SEO Optimization'
                        ],
                        'link' => 'website_development'
                    ],
                    [
                        'icon' => 'assets/images/Web_Application_Development.webp',
                        'title' => 'Web App Development',
                        'description' => 'Powerful, scalable web applications that streamline processes and enhance productivity for your business.',
                        'features' => [
                            'Custom Web Applications',
                            'SaaS Solutions',
                            'Progressive Web Apps',
                            'API Development & Integration'
                        ],
                        'link' => 'webapp_development'
                    ],
                    [
                        'icon' => 'assets/images/Mobile_App_Development.webp',
                        'title' => 'Mobile App Development',
                        'description' => 'Native and cross-platform mobile applications that deliver exceptional user experiences across all devices.',
                        'features' => [
                            'iOS App Development',
                            'Android App Development',
                            'Cross-Platform Solutions',
                            'App Maintenance & Support'
                        ],
                        'link' => 'mobileapp_development'
                    ],
                    [
                        'icon' => 'assets/images/Digital_Marketing.webp',
                        'title' => 'Digital Marketing',
                        'description' => 'Strategic digital marketing services to increase brand visibility, drive traffic, and generate qualified leads.',
                        'features' => [
                            'Search Engine Optimization (SEO)',
                            'Pay-Per-Click (PPC) Advertising',
                            'Social Media Marketing',
                            'Content Marketing'
                        ],
                        'link' => 'digital_marketing'
                    ],
                    [
                        'icon' => 'assets/images/UXUI_Design.webp',
                        'title' => 'UX/UI Design',
                        'description' => 'User-centric design that creates intuitive, engaging interfaces to enhance user satisfaction and loyalty.',
                        'features' => [
                            'User Research & Personas',
                            'Wireframing & Prototyping',
                            'UI Design & Branding',
                            'User Experience Strategy'
                        ],
                        'link' => 'ux_ui'
                    ],
                    [
                        'icon' => 'assets/images/Desktop_Applications.webp',
                        'title' => 'Desktop Applications',
                        'description' => 'Custom desktop solutions that optimize workflows and provide powerful tools for your specific needs.',
                        'features' => [
                            'Windows Application Development',
                            'macOS Application Development',
                            'Cross-Platform Solutions',
                            'Legacy System Integration'
                        ],
                        'link' => 'desktop_application'
                    ]
                ];

                foreach ($services as $service): ?>
                    <div class="service-card hover-lift">
                        <!-- <div class="service-icon"><?php echo $service['icon']; ?></div> -->
                        <div class="service-img">
                            <img src="<?php echo $service['icon']; ?>" alt="<?php echo $service['title']; ?>" width="100%">
                        </div>
                        <h3><?php echo $service['title']; ?></h3>
                        <p><?php echo $service['description']; ?></p>
                        <ul class="service-features">
                            <?php foreach ($service['features'] as $feature): ?>
                                <li><?php echo $feature; ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <a href="<?php echo $service['link']; ?>" class="learn-more"> Learn More →</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="header-service">
            <h1>Our Comprehensive Development Process</h1>
            <p class="subtitle">A strategic, systematic approach that ensures project success, client satisfaction, and exceptional digital solutions</p>
        </div>

        <div class="process-grid">
            <div class="process-card">
                <div class="process-number">01</div>
                <div class="process-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M12 6v6l4 2"></path>
                    </svg>
                </div>
                <h3>Discovery & Strategy</h3>
                <p>Deep dive into your business goals, target audience, and project requirements to develop a strategic roadmap.</p>
                
            </div>

            <div class="process-card">
                <div class="process-number">02</div>
                <div class="process-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                    </svg>
                </div>
                <h3>Design & Conceptualization</h3>
                <p>Create wireframes, prototypes, and user experience designs that align with your vision and user needs.</p>
                
            </div>

            <div class="process-card">
                <div class="process-number">03</div>
                <div class="process-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2"></polygon>
                        <line x1="12" y1="22" x2="12" y2="15.5"></line>
                        <polyline points="22 8.5 12 15.5 2 8.5"></polyline>
                        <polyline points="2 15.5 12 8.5 22 15.5"></polyline>
                        <line x1="12" y1="2" x2="12" y2="8.5"></line>
                    </svg>
                </div>
                <h3>Development & Integration</h3>
                <p>Utilize cutting-edge technologies to build robust, scalable solutions with seamless system integrations.</p>
                
            </div>

            <div class="process-card">
                <div class="process-number">04</div>
                <div class="process-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v12c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2v-2"></path>
                        <path d="M18 14v4"></path>
                        <path d="M18 10v4"></path>
                        <path d="M12 12H4"></path>
                        <path d="M12 16H4"></path>
                        <path d="M8 8H4"></path>
                    </svg>
                </div>
                <h3>Testing & Quality Assurance</h3>
                <p>Rigorous testing across devices, performance benchmarks, and security protocols to ensure top-tier quality.</p>
                
            </div>

            <div class="process-card">
                <div class="process-number">05</div>
                <div class="process-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"></path>
                        <path d="M12 12v9"></path>
                        <path d="m8 17 4 4 4-4"></path>
                    </svg>
                </div>
                <h3>Deployment & Launch</h3>
                <p>Smooth implementation with minimal disruption, providing comprehensive support during transition.</p>
                
            </div>

            <div class="process-card">
                <div class="process-number">06</div>
                <div class="process-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 9V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h7"></path>
                        <path d="M16 16v6"></path>
                        <path d="M12 16v6"></path>
                        <path d="M20 16v6"></path>
                        <path d="M16 4v2.5"></path>
                        <path d="M12 4v2.5"></path>
                        <path d="M8 4v2.5"></path>
                    </svg>
                </div>
                <h3>Continuous Support</h3>
                <p>Ongoing maintenance, updates, and optimization to keep your digital solutions at the forefront of technology.</p>
                
            </div>
        </div>
    </div>

    <section class="tech-stack bg-light">
        <div class="container">
            <div class="section-header">
                <h2>Technology Innovation Powerhouse</h2>
                <p>A curated ecosystem of world-class technologies enabling next-generation digital solutions</p>
            </div>
            <div class="technologies-showcase">
                <?php
                $technologies = [
                    'Frontend' => [
                        ['name' => 'React', 'logo' => 'react.webp', 'color' => '#61DAFB'],
                        ['name' => 'Vue.js', 'logo' => 'vue.webp', 'color' => '#4FC08D'],
                        ['name' => 'Angular', 'logo' => 'angularjs.webp', 'color' => '#DD0031'],
                        ['name' => 'Next.js', 'logo' => 'nextjs.webp', 'color' => '#000000'],
                        ['name' => 'Tailwind', 'logo' => 'tailwind.webp', 'color' => '#06B6D4']
                    ],
                    'Backend' => [
                        ['name' => 'Node.js', 'logo' => 'nodejs.webp', 'color' => '#339933'],
                        ['name' => 'Python', 'logo' => 'python.webp', 'color' => '#3776AB'],
                        // ['name' => '.NET', 'logo' => 'dotnet.webp', 'color' => '#512BD4'],
                        // ['name' => 'Java', 'logo' => 'java.webp', 'color' => '#007396'],
                        ['name' => 'PHP', 'logo' => 'php.webp', 'color' => '#777BB3']
                    ],
                    'Mobile' => [
                        ['name' => 'React Native', 'logo' => 'react.webp', 'color' => '#61DAFB'],
                        ['name' => 'Flutter', 'logo' => 'flutter.webp', 'color' => '#02569B'],
                        ['name' => 'Swift', 'logo' => 'swift.webp', 'color' => '#F05138'],
                        ['name' => 'Kotlin', 'logo' => 'kotlin.webp', 'color' => '#7F52FF']
                    ],
                    'Database' => [
                        ['name' => 'MySQL', 'logo' => 'mysql.webp', 'color' => '#4479A1'],
                        ['name' => 'PostgreSQL', 'logo' => 'postgresql.webp', 'color' => '#336791'],
                        ['name' => 'MongoDB', 'logo' => 'mongodb.webp', 'color' => '#47A248'],
                        ['name' => 'Firebase', 'logo' => 'firebase.webp', 'color' => '#FFCA28']
                    ]
                ];
                ?>
                <div class="tech-categories-grid">
                    <?php foreach ($technologies as $category => $techs): ?>
                        <div class="tech-category animate-on-scroll">
                            <h3><?php echo $category; ?></h3>
                            <div class="tech-logos-grid">
                                <?php foreach ($techs as $tech): ?>
                                    <div class="tech-logo-item" title="<?php echo $tech['name']; ?>">
                                        <div class="tech-logo-wrapper" style="background-color: <?php echo $tech['color']; ?>1A;">
                                            <img
                                                src="/assets/images/tech-logos/<?php echo $tech['logo']; ?>"
                                                alt="<?php echo $tech['name']; ?> Logo"
                                                class="tech-logo">
                                        </div>
                                        <span class="tech-name"><?php echo $tech['name']; ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="tech-disclaimer text-center mt-4">
                    <p class="text-gray">Our technology choices are dynamic and evolve with cutting-edge innovations</p>
                </div>
            </div>
        </div>
    </section>


    <section class="additional-services bg-light">
        <div class="container">
            <div class="section-header">
                <h2>Complementary Digital Solutions</h2>
                <p>Specialized services to enhance and fortify your digital ecosystem</p>
            </div>
            <div class="services-grid">
                <?php
                $additionalServices = [
                    [
                        'icon' => '📊',
                        'title' => 'Advanced Analytics',
                        'description' => 'Deep insights through comprehensive data analysis, visualization, and actionable intelligence.'
                    ],
                    [
                        'icon' => '🛡️',
                        'title' => 'Cybersecurity Services',
                        'description' => 'Robust protection strategies to safeguard your digital assets and sensitive information.'
                    ],
                    [
                        'icon' => '☁️',
                        'title' => 'Cloud Solutions',
                        'description' => 'Scalable cloud infrastructure and migration services for enhanced performance and flexibility.'
                    ],
                    [
                        'icon' => '💾',
                        'title' => 'Data Management',
                        'description' => 'Comprehensive database design, optimization, and management solutions.'
                    ]
                ];

                foreach ($additionalServices as $service): ?>
                    <div class="service-card hover-lift">
                        <div class="service-icon"><?php echo $service['icon']; ?></div>
                        <h3><?php echo $service['title']; ?></h3>
                        <p><?php echo $service['description']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="cta">
        <div class="container">
            <h2>Ready to Transform Your Digital Vision?</h2>
            <p>Let's discuss how our comprehensive technology services can help you innovate, grow, and lead in your industry.</p>
            <a href="get-quote" class="secondary-button">Get a Free Consultation</a>
        </div>
    </section>

    <!-- Footer Include -->
    <?php include('includes/footer.php'); ?>

    <!-- Scripts -->
    <script src="js/include-helper.js"></script>
    <script src="js/main.js"></script>
</body>

</html>