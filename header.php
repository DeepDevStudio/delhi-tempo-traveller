<?php
// Canonical-host safety net, in case the server ignores .htaccess:
// opened directly -> home; bare domain -> www; /index.php -> /
if (basename($_SERVER['SCRIPT_FILENAME']) === 'header.php') { header('Location: index.php', true, 301); exit; }
$request_host = strtolower(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
$request_path = parse_url(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/', PHP_URL_PATH);
if (in_array($_SERVER['REQUEST_METHOD'] ?? 'GET', ['GET', 'HEAD'], true) && ($request_host === 'delhitempotravelleronrent.com' || ($request_host === 'www.delhitempotravelleronrent.com' && $request_path === '/index.php'))) {
    $redirect_path = $request_path === '/index.php' ? '/' : $_SERVER['REQUEST_URI'];
    header('Location: https://www.delhitempotravelleronrent.com' . $redirect_path, true, 301);
    exit;
}
?>
<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <link rel="icon" type="image/svg+xml" href="images/logo-icon.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32.png">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <meta name="theme-color" content="#f97316">
<?php
    // Per-page SEO: pages set $page_title / $page_description / $canonical_url before including this file.
    $site_url = 'https://www.delhitempotravelleronrent.com';
    $current_page = basename($_SERVER['PHP_SELF']);
    $seo_title = isset($page_title) ? $page_title : 'Tempo Traveller on Rent in Delhi | 9–25 Seater from ₹30/km';
    $seo_description = isset($page_description) ? $page_description : 'Hire a tempo traveller on rent in Delhi NCR – 9, 12, 16 & 20 seater AC and luxury Maharaja vehicles with experienced drivers for local and outstation trips. Call +91 7290885949.';
    if (empty($canonical_url)) {
        $canonical_url = $site_url . '/' . ($current_page === 'index.php' ? '' : $current_page);
    }
    // Google cuts snippets at ~160 characters: trim long descriptions at a sentence (or word) boundary
    if (strlen($seo_description) > 175) {
        $cut = substr($seo_description, 0, 175);
        $dot = strrpos($cut, '. ');
        $seo_description = $dot > 100 ? substr($cut, 0, $dot + 1) : rtrim(substr($cut, 0, strrpos($cut, ' ')), ' ,–-') . '…';
    }
    $og_image_path = isset($page_image) ? $page_image : 'images/maintempotraveller.jpg';
    // Prefer the 1200×630 JPG copy in images/og/ (the size and format Facebook, WhatsApp and LinkedIn previews expect)
    $og_jpg = 'images/og/' . pathinfo($og_image_path, PATHINFO_FILENAME) . '.jpg';
    if (is_file(__DIR__ . '/' . $og_jpg)) $og_image_path = $og_jpg;
    $og_image = $site_url . '/' . $og_image_path;
    $og_image_size = @getimagesize(__DIR__ . '/' . $og_image_path);
    $og_image_alt = isset($page_image_alt) ? $page_image_alt : trim(explode('|', $seo_title)[0]);
    // Optional per-page social copy; falls back to the page title and description
    $seo_og_title = isset($og_title) ? $og_title : $seo_title;
    $seo_og_description = isset($og_description) ? $og_description : $seo_description;
    $seo_twitter_title = isset($twitter_title) ? $twitter_title : $seo_title;
    $seo_twitter_description = isset($twitter_description) ? $twitter_description : $seo_description;

    // Tracking / webmaster verification. Paste the IDs here once the accounts exist.
    $ga4_id = '';              // Google Analytics 4 Measurement ID, e.g. 'G-XXXXXXXXXX'
    $bing_verification = '';   // Bing Webmaster Tools <meta name="msvalidate.01"> content

    // Add width/height (stops layout shift), lazy loading and async decoding to every local <img> on the page
    if (!function_exists('seo_img_filter')) {
        function seo_img_filter($html) {
            $count = 0;
            return preg_replace_callback('#<img\b[^>]*>#i', function ($m) use (&$count) {
                $tag = $m[0];
                $count++;
                if (!preg_match('#\ssrc="([^"]+)"#i', $tag, $src)) return $tag;
                $path = __DIR__ . '/' . ltrim(parse_url($src[1], PHP_URL_PATH), '/');
                $add = '';
                if (stripos($tag, ' width=') === false && stripos($tag, ' height=') === false && strpos($src[1], '//') === false && is_file($path) && ($size = @getimagesize($path))) {
                    $add .= ' width="' . $size[0] . '" height="' . $size[1] . '"';
                }
                // The first images (logo, hero) stay eager so they don't delay the page's main image
                if ($count > 2 && stripos($tag, 'loading=') === false && stripos($tag, 'fetchpriority=') === false) $add .= ' loading="lazy"';
                if (stripos($tag, 'decoding=') === false) $add .= ' decoding="async"';
                return $add === '' ? $tag : preg_replace('#\s*/?>$#', $add . '$0', $tag, 1);
            }, $html);
        }
        ob_start('seo_img_filter');
    }
    ?>
    <title><?php echo htmlspecialchars($seo_title); ?></title>
<?php if (!empty($meta_title)): ?>    <meta name="title" content="<?php echo htmlspecialchars($meta_title); ?>">
<?php endif; ?>
    <meta name="description" content="<?php echo htmlspecialchars($seo_description); ?>">
<?php if (!empty($meta_keywords)): ?>    <meta name="keywords" content="<?php echo htmlspecialchars($meta_keywords); ?>">
<?php endif; ?>
    <meta name="robots" content="<?php echo isset($robots_meta) ? $robots_meta : 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'; ?>">
    <link rel="canonical" href="<?php echo htmlspecialchars($canonical_url); ?>">
    <link rel="alternate" hreflang="en-IN" href="<?php echo htmlspecialchars($canonical_url); ?>">
    <link rel="alternate" hreflang="x-default" href="<?php echo htmlspecialchars($canonical_url); ?>">
    <meta name="author" content="Delhi Tempo Traveller on Rent">
    <meta name="format-detection" content="telephone=yes">
    <meta name="geo.region" content="IN-DL">
    <meta name="geo.placename" content="Delhi">
    <meta name="geo.position" content="28.6139;77.2090">
    <meta name="ICBM" content="28.6139, 77.2090">
<?php if ($bing_verification !== ''): ?>    <meta name="msvalidate.01" content="<?php echo htmlspecialchars($bing_verification); ?>">
<?php endif; ?>
<?php if (!empty($page_image) && empty($no_preload_image)): ?>    <link rel="preload" as="image" href="<?php echo htmlspecialchars($page_image); ?>" fetchpriority="high">
<?php endif; ?>

    <!-- Open Graph / social sharing -->
    <meta property="og:type" content="<?php echo isset($og_type) ? $og_type : 'website'; ?>">
    <meta property="og:site_name" content="Delhi Tempo Traveller on Rent">
    <meta property="og:locale" content="en_IN">
    <meta property="og:title" content="<?php echo htmlspecialchars($seo_og_title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($seo_og_description); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonical_url); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($og_image); ?>">
    <meta property="og:image:secure_url" content="<?php echo htmlspecialchars($og_image); ?>">
<?php if ($og_image_size): ?>    <meta property="og:image:width" content="<?php echo $og_image_size[0]; ?>">
    <meta property="og:image:height" content="<?php echo $og_image_size[1]; ?>">
    <meta property="og:image:type" content="<?php echo $og_image_size['mime']; ?>">
<?php endif; ?>
    <meta property="og:image:alt" content="<?php echo htmlspecialchars($og_image_alt); ?>">
<?php if (isset($og_type) && $og_type === 'article' && isset($post)): ?>    <meta property="article:published_time" content="<?php echo htmlspecialchars($post['date']); ?>">
    <meta property="article:modified_time" content="<?php echo htmlspecialchars($post['date']); ?>">
    <meta property="article:section" content="<?php echo htmlspecialchars($post['category']); ?>">
    <meta property="article:publisher" content="https://www.facebook.com/GetMeCabFB">
<?php endif; ?>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@getmecab">
    <meta name="twitter:url" content="<?php echo htmlspecialchars($canonical_url); ?>">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($seo_twitter_title); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($seo_twitter_description); ?>">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($og_image); ?>">
    <meta name="twitter:image:alt" content="<?php echo htmlspecialchars($og_image_alt); ?>">

    <!-- Structured data: business, website and rate card (shared by every page) -->
<?php
    $business_schema = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => ['LocalBusiness', 'TravelAgency'],
                '@id' => $site_url . '/#business',
                'name' => 'Delhi Tempo Traveller on Rent',
                'alternateName' => 'GetMeCab Tempo Traveller',
                'parentOrganization' => ['@type' => 'Organization', 'name' => 'GetMeCab', 'url' => 'https://www.getmecab.com/'],
                'description' => 'Tempo traveller on rent in Delhi NCR: 12, 16, 20 and 25 seater AC tempo travellers and 9–16 seater Maharaja tempos with drivers for local and outstation trips.',
                'url' => $site_url . '/',
                'image' => $site_url . '/images/maintempotraveller.jpg',
                'logo' => $site_url . '/images/logo.png',
                'telephone' => '+91-7290885949',
                'email' => 'bookingsgetmecab@gmail.com',
                'priceRange' => '₹30–₹43 per km',
                'currenciesAccepted' => 'INR',
                'paymentAccepted' => 'Cash, UPI, Bank Transfer',
                'address' => ['@type' => 'PostalAddress', 'addressLocality' => 'Delhi', 'addressRegion' => 'Delhi', 'addressCountry' => 'IN'],
                'areaServed' => array_map(function ($c) { return ['@type' => 'City', 'name' => $c]; }, ['Delhi', 'New Delhi', 'Noida', 'Greater Noida', 'Gurugram', 'Ghaziabad', 'Faridabad']),
                'openingHoursSpecification' => [
                    '@type' => 'OpeningHoursSpecification',
                    'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                    'opens' => '00:00',
                    'closes' => '23:59',
                ],
                'contactPoint' => [
                    '@type' => 'ContactPoint',
                    'telephone' => '+91-7290885949',
                    'contactType' => 'reservations',
                    'areaServed' => 'IN',
                    'availableLanguage' => ['English', 'Hindi'],
                ],
                'hasOfferCatalog' => [
                    '@type' => 'OfferCatalog',
                    'name' => 'Tempo traveller rental rates',
                    'itemListElement' => array_map(function ($v) {
                        return [
                            '@type' => 'Offer',
                            'itemOffered' => ['@type' => 'Service', 'name' => $v[0] . ' on rent in Delhi'],
                            'priceSpecification' => ['@type' => 'UnitPriceSpecification', 'price' => $v[1], 'priceCurrency' => 'INR', 'unitText' => 'km'],
                        ];
                    }, [['12 Seater Tempo Traveller', 30], ['16 Seater Tempo Traveller', 35], ['20 Seater Tempo Traveller', 40], ['25 Seater Tempo Traveller', 43], ['9/12 Seater Maharaja Tempo Traveller', 35], ['16 Seater Maharaja Tempo Traveller', 40]]),
                ],
                'sameAs' => [
                    'https://www.facebook.com/GetMeCabFB',
                    'https://www.instagram.com/delhitempotravelleronrent',
                    'https://x.com/getmecab',
                    'https://www.youtube.com/@getmecab9627',
                ],
            ],
            [
                '@type' => 'WebSite',
                '@id' => $site_url . '/#website',
                'url' => $site_url . '/',
                'name' => 'Delhi Tempo Traveller on Rent',
                'inLanguage' => 'en-IN',
                'publisher' => ['@id' => $site_url . '/#business'],
            ],
            [
                '@type' => 'WebPage',
                '@id' => $canonical_url . '#webpage',
                'url' => $canonical_url,
                'name' => $seo_title,
                'description' => $seo_description,
                'inLanguage' => 'en-IN',
                'isPartOf' => ['@id' => $site_url . '/#website'],
                'about' => ['@id' => $site_url . '/#business'],
                'primaryImageOfPage' => ['@type' => 'ImageObject', 'url' => $og_image],
                'dateModified' => date('Y-m-d', filemtime($_SERVER['SCRIPT_FILENAME'])),
            ],
        ],
    ];
    // Pages with their own full schema in $page_schema set $skip_site_schema
    if (empty($skip_site_schema)) echo '    <script type="application/ld+json">' . json_encode($business_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "</script>\n";
    ?>
<?php
    if ($current_page !== 'index.php') {
        if (!isset($breadcrumb_items)) {
            $breadcrumb_items = [
                ['Home', $site_url . '/'],
                [trim(explode('|', preg_split('/ [-–] /u', $seo_title)[0])[0]), $canonical_url],
            ];
        }
        $crumbs = [];
        foreach ($breadcrumb_items as $pos => $crumb) {
            $crumbs[] = ['@type' => 'ListItem', 'position' => $pos + 1, 'name' => $crumb[0], 'item' => $crumb[1]];
        }
        echo '    <script type="application/ld+json">' . json_encode(['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $crumbs], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . "</script>\n";
    }
    ?>
<?php if (!empty($page_schema)) echo $page_schema; ?>
    <!-- Icons & fonts -->
    <!-- Loaded without blocking the first paint (faster LCP / Core Web Vitals) -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap">
    </noscript>
    <!-- Global design system, then page-specific stylesheets -->
    <link rel="stylesheet" href="site.css?v=4">
<?php if (!empty($page_css)) foreach ($page_css as $css_file) echo '    <link rel="stylesheet" href="' . htmlspecialchars($css_file) . "?v=9\">\n"; ?>
<?php if ($ga4_id !== ''): ?>
    <!-- Google Analytics 4 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo htmlspecialchars($ga4_id); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo htmlspecialchars($ga4_id); ?>');
        // Count call / WhatsApp taps as conversions
        document.addEventListener('click', function (e) {
            var a = e.target.closest('a[href^="tel:"], a[href*="wa.me/"]');
            if (a) gtag('event', a.href.indexOf('tel:') === 0 ? 'click_call' : 'click_whatsapp', { link_url: a.href, page: location.pathname });
        });
    </script>
<?php endif; ?>
</head>
<?php
// Navigation data (also used by footer.php)
$nav_routes = [
    'agra' => 'Agra', 'jaipur' => 'Jaipur', 'haridwar' => 'Haridwar', 'rishikesh' => 'Rishikesh',
    'manali' => 'Manali', 'shimla' => 'Shimla', 'nainital' => 'Nainital', 'mussoorie' => 'Mussoorie',
    'dehradun' => 'Dehradun', 'dharamshala' => 'Dharamshala', 'amritsar' => 'Amritsar', 'chandigarh' => 'Chandigarh',
    'udaipur' => 'Udaipur', 'jodhpur' => 'Jodhpur', 'lucknow' => 'Lucknow', 'varanasi' => 'Varanasi',
];
$nav_packages = [
    'chardham-tempo-package.php' => ['Char Dham Yatra', 'fa-om'],
    'golden-triangle-tempo-package.php' => ['Golden Triangle Tour', 'fa-landmark'],
    'himachal-tempo-package.php' => ['Himachal Tour', 'fa-mountain'],
    'uttarakhand-tempo-package.php' => ['Uttarakhand Tour', 'fa-tree'],
    'kashmir-tempo-package.php' => ['Kashmir Tour', 'fa-snowflake'],
    'leh-ladakh-tempo-package.php' => ['Leh Ladakh Tour', 'fa-motorcycle'],
    'rajasthan-tempo-package.php' => ['Rajasthan Tour', 'fa-chess-rook'],
    'pilgrimage-tempo-package.php' => ['Pilgrimage Tours', 'fa-place-of-worship'],
    'wildlife-tempo-package.php' => ['Wildlife Safari Tour', 'fa-paw'],
];
$is_route_page = (bool) preg_match('/^delhi-to-.+-tempo-on-rent\.php$/', $current_page);
$is_package_page = isset($nav_packages[$current_page]);
$is_blog_page = $current_page === 'blog.php' || isset($post_slug);
$quote_link = $current_page === 'index.php' ? '#quote' : 'index.php#quote';
function nav_active($condition) { return $condition ? ' class="active" aria-current="page"' : ''; }
?>
<body class="site">
    <a class="sr-only" href="#main-content">Skip to content</a>

    <!-- Top bar -->
    <div class="topbar">
        <div class="container">
            <div class="topbar-info">
                <a href="tel:+917290885949"><i class="fas fa-phone-alt"></i>+91 7290885949</a>
                <a class="topbar-hide-sm" href="mailto:bookingsgetmecab@gmail.com"><i class="fas fa-envelope"></i>bookingsgetmecab@gmail.com</a>
                <span class="topbar-hide-md"><i class="fas fa-clock"></i>24/7 Booking Support</span>
            </div>
            <div class="topbar-right topbar-hide-sm">
                <span class="topbar-area"><i class="fas fa-map-marker-alt"></i>Serving Delhi, Noida, Gurugram, Ghaziabad &amp; Faridabad</span>
                <div class="topbar-social">
                    <a href="https://www.facebook.com/GetMeCabFB" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/delhitempotravelleronrent?stkn=bGZwN2JrMmcwMWVx" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://x.com/getmecab" target="_blank" rel="noopener" aria-label="X (Twitter)"><i class="fab fa-x-twitter"></i></a>
                    <a href="https://www.youtube.com/@getmecab9627" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="site-header" id="siteHeader">
        <div class="container header-inner">
            <div class="logo">
                <a href="index.php" aria-label="Delhi Tempo Traveller on Rent – Home">
                    <img src="images/logo-icon.svg" alt="Delhi tempo traveller on rent logo" width="44" height="44">
                    <span class="logo-text"><strong>Delhi <span>Tempo</span></strong><small>Traveller on Rent</small></span>
                </a>
            </div>

            <nav class="main-nav" id="mainNav" aria-label="Main navigation">
                <div class="nav-drawer-head">
                    <span class="logo-text"><strong>Delhi <span style="color:var(--brand)">Tempo</span></strong><small>Traveller on Rent</small></span>
                    <button class="nav-close" type="button" id="navClose" aria-label="Close menu"><i class="fas fa-times"></i></button>
                </div>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="index.php"<?php echo nav_active($current_page === 'index.php'); ?>>Home</a></li>
                    <li><a href="about.php"<?php echo nav_active($current_page === 'about.php'); ?>>About</a></li>
                    <li><a href="fleet.php"<?php echo nav_active($current_page === 'fleet.php'); ?>>Fleet</a></li>
                    <li class="has-dd">
                        <button class="dd-toggle<?php echo $is_route_page ? ' active' : ''; ?>" type="button" aria-expanded="false">Routes <i class="fas fa-chevron-down"></i></button>
                        <ul class="dropdown mega">
                            <?php foreach ($nav_routes as $slug => $name): ?>
                                <li><a href="delhi-to-<?php echo $slug; ?>-tempo-on-rent.php"><i class="fas fa-route"></i>Delhi to <?php echo $name; ?></a></li>
                            <?php endforeach; ?>
                            <li class="dd-all"><a href="destinations.php"><i class="fas fa-arrow-right"></i>View all destinations</a></li>
                        </ul>
                    </li>
                    <li class="has-dd">
                        <button class="dd-toggle<?php echo $is_package_page ? ' active' : ''; ?>" type="button" aria-expanded="false">Tour Packages <i class="fas fa-chevron-down"></i></button>
                        <ul class="dropdown">
                            <?php foreach ($nav_packages as $file => $pkg): ?>
                                <li><a href="<?php echo $file; ?>"><i class="fas <?php echo $pkg[1]; ?>"></i><?php echo $pkg[0]; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li><a href="destinations.php"<?php echo nav_active($current_page === 'destinations.php'); ?>>Destinations</a></li>
                    <li><a href="services.php"<?php echo nav_active($current_page === 'services.php'); ?>>Services</a></li>
                    <li><a href="testimonials.php"<?php echo nav_active($current_page === 'testimonials.php'); ?>>Reviews</a></li>
                    <li><a href="blog.php"<?php echo nav_active($is_blog_page); ?>>Blog</a></li>
                    <li><a href="contact.php"<?php echo nav_active($current_page === 'contact.php'); ?>>Contact</a></li>
                </ul>
                <div class="nav-drawer-foot">
                    <a class="btn btn-primary btn-block" href="<?php echo $quote_link; ?>"><i class="fas fa-file-invoice"></i> Get Free Quote</a>
                    <a class="btn btn-wa btn-block" href="https://wa.me/917290885949?text=Hi%2C%20I%20need%20a%20tempo%20traveller%20on%20rent" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp Us</a>
                    <a class="btn btn-outline btn-block" href="tel:+917290885949"><i class="fas fa-phone-alt"></i> +91 7290885949</a>
                </div>
            </nav>

            <div class="header-cta">
                <a class="header-phone" href="tel:+917290885949" aria-label="Call +91 7290885949">
                    <span class="icon"><i class="fas fa-phone-alt"></i></span>
                </a>
                <a class="btn btn-primary btn-sm" href="<?php echo $quote_link; ?>">Get Free Quote</a>
                <button class="nav-toggle" type="button" id="navToggle" aria-label="Open menu" aria-controls="mainNav" aria-expanded="false"><span></span></button>
            </div>
        </div>
        <div class="nav-overlay" id="navOverlay"></div>
    </header>

    <!-- Floating contact buttons -->
    <div class="floating-actions">
        <a class="fa-wa" href="https://wa.me/917290885949?text=Hi%2C%20I%20need%20a%20tempo%20traveller%20on%20rent" target="_blank" rel="noopener" aria-label="Chat on WhatsApp"><i class="fab fa-whatsapp"></i></a>
        <a class="fa-call" href="tel:+917290885949" aria-label="Call us"><i class="fas fa-phone-alt"></i></a>
    </div>

    <script>
        (function () {
            var body = document.body;
            var header = document.getElementById('siteHeader');
            var toggle = document.getElementById('navToggle');
            var closeBtn = document.getElementById('navClose');
            var overlay = document.getElementById('navOverlay');
            var mobile = window.matchMedia('(max-width: 1100px)');

            function setNav(open) {
                body.classList.toggle('nav-open', open);
                toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            }
            toggle.addEventListener('click', function () { setNav(!body.classList.contains('nav-open')); });
            closeBtn.addEventListener('click', function () { setNav(false); });
            overlay.addEventListener('click', function () { setNav(false); });
            document.addEventListener('keydown', function (e) { if (e.key === 'Escape') setNav(false); });

            // Dropdowns: tap to open on touch / mobile, hover handled in CSS on desktop
            document.querySelectorAll('.has-dd > .dd-toggle').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var li = btn.parentElement;
                    var isOpen = li.classList.contains('open');
                    document.querySelectorAll('.has-dd.open').forEach(function (o) { if (o !== li) { o.classList.remove('open'); o.firstElementChild.setAttribute('aria-expanded', 'false'); } });
                    li.classList.toggle('open', !isOpen);
                    btn.setAttribute('aria-expanded', !isOpen ? 'true' : 'false');
                });
            });
            document.addEventListener('click', function (e) {
                if (!mobile.matches && !e.target.closest('.has-dd')) {
                    document.querySelectorAll('.has-dd.open').forEach(function (o) { o.classList.remove('open'); });
                }
            });
            document.querySelectorAll('.main-nav a').forEach(function (a) {
                a.addEventListener('click', function () { setNav(false); });
            });
            mobile.addEventListener('change', function () { setNav(false); });

            function onScroll() { header.classList.toggle('scrolled', window.scrollY > 10); }
            window.addEventListener('scroll', onScroll, { passive: true });
            onScroll();
        })();
    </script>

    <div id="main-content"></div>
