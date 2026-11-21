<?php
// Template partial: redirect if opened directly.
if (!isset($post_slug)) { header('Location: blog.php', true, 301); exit; }
// Shared top half of every blog post.
// A post file sets $post_slug (and optionally $post_faqs = [[question, answer], ...]) and then includes this file.
require_once 'blog-data.php';

$site_url = 'https://www.delhitempotravelleronrent.com';
$post = $blog_posts[$post_slug];
$post_url = $site_url . '/' . $post_slug . '.php';

$page_title = $post['seo_title'];
$page_description = $post['description'];
$page_image = $post['image'];
$canonical_url = $post_url;
$og_type = 'article';
$page_css = ['blog.css'];
$breadcrumb_items = [
    ['Home', $site_url . '/'],
    ['Blog', $site_url . '/blog.php'],
    [$post['title'], $post_url],
];

$json_flags = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;
$page_schema = '    <script type="application/ld+json">' . json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BlogPosting',
    'headline' => $post['title'],
    'description' => $post['description'],
    'image' => $site_url . '/' . $post['image'],
    'datePublished' => $post['date'],
    'dateModified' => $post['date'],
    'author' => ['@type' => 'Organization', 'name' => 'Delhi Tempo Traveller on Rent', 'url' => $site_url . '/'],
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'Delhi Tempo Traveller on Rent',
        'logo' => ['@type' => 'ImageObject', 'url' => $site_url . '/images/logo.png'],
    ],
    'mainEntityOfPage' => $post_url,
    'keywords' => implode(', ', $post['keywords']),
    'articleSection' => $post['category'],
], $json_flags) . "</script>\n";

if (!empty($post_faqs)) {
    $faq_entities = [];
    foreach ($post_faqs as $faq) {
        $faq_entities[] = ['@type' => 'Question', 'name' => $faq[0], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags($faq[1])]];
    }
    $page_schema .= '    <script type="application/ld+json">' . json_encode(['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $faq_entities], $json_flags) . "</script>\n";
}

include 'header.php';
?>

<main>
    <div class="read-progress" aria-hidden="true"><span id="readProgress"></span></div>

    <section class="post-hero2">
        <img class="ph-bg" src="<?php echo $post['image']; ?>" alt="<?php echo htmlspecialchars($post['image_alt']); ?>" fetchpriority="high">
        <div class="container ph-grid">
            <div class="ph-copy">
                <nav class="ph-crumbs" aria-label="Breadcrumb">
                    <a href="index.php">Home</a><i class="fas fa-chevron-right"></i>
                    <a href="blog.php">Blog</a><i class="fas fa-chevron-right"></i>
                    <span><?php echo htmlspecialchars($post['category']); ?></span>
                </nav>
                <div class="ph-tags">
                    <span class="ph-tag"><i class="fas fa-tag"></i><?php echo htmlspecialchars($post['category']); ?></span>
                    <span class="ph-tag ghost"><i class="far fa-clock"></i><?php echo $post['read_time']; ?></span>
                </div>
                <h1><?php echo htmlspecialchars($post['title']); ?></h1>
                <p class="ph-lead"><?php echo htmlspecialchars($post['excerpt']); ?></p>
                <div class="ph-meta">
                    <div class="ph-author">
                        <img src="images/logo-icon.svg" alt="Delhi tempo traveller on rent" width="44" height="44">
                        <span><strong>Delhi Tempo Traveller Team</strong><small>Updated <?php echo date('d M Y', strtotime($post['date'])); ?> · <?php echo $post['read_time']; ?></small></span>
                    </div>
                    <?php $share_url = rawurlencode($post_url); $share_text = rawurlencode($post['title']); ?>
                    <div class="ph-share">
                        <span>Share</span>
                        <a href="https://wa.me/?text=<?php echo $share_text . '%20' . $share_url; ?>" target="_blank" rel="noopener" aria-label="Share on WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>" target="_blank" rel="noopener" aria-label="Share on Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://x.com/intent/post?url=<?php echo $share_url; ?>&amp;text=<?php echo $share_text; ?>" target="_blank" rel="noopener" aria-label="Share on X"><i class="fab fa-x-twitter"></i></a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $share_url; ?>" target="_blank" rel="noopener" aria-label="Share on LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <button type="button" class="ph-copy-link" data-url="<?php echo htmlspecialchars($post_url); ?>" aria-label="Copy link"><i class="fas fa-link"></i></button>
                    </div>
                </div>
            </div>

            <aside class="ph-card">
                <span class="ph-card-eyebrow"><i class="fas fa-van-shuttle"></i> Planning this trip?</span>
                <h2>Book a tempo traveller from Delhi</h2>
                <ul>
                    <li><i class="fas fa-check"></i>12, 16 &amp; 20 seater AC and Maharaja tempos</li>
                    <li><i class="fas fa-check"></i>Experienced drivers, doorstep pickup in Delhi NCR</li>
                    <li><i class="fas fa-check"></i>Free, itemised quote on WhatsApp</li>
                </ul>
                <div class="ph-card-price"><span>Starting from</span><strong>₹30<em>/km</em></strong></div>
                <a class="btn btn-primary btn-block" href="index.php#quote"><i class="fas fa-file-invoice"></i> Get Free Quote</a>
                <a class="btn btn-wa btn-block" href="https://wa.me/917290885949?text=<?php echo rawurlencode('Hi, I read "' . $post['title'] . '" and need a tempo traveller quote'); ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Chat on WhatsApp</a>
                <small><i class="fas fa-circle-info"></i> Toll, state tax &amp; driver allowance included. Parking, GST &amp; ₹500 driver night charge (10 PM – 6 AM) extra</small>
            </aside>
        </div>
    </section>

    <section class="post-wrap">
        <div class="container post-layout">
            <article class="post-article">
                <div class="post-body">
<?php
// Capture the post content so blog-post-end.php can build the table of contents from its <h2 id="..."> headings.
ob_start();
