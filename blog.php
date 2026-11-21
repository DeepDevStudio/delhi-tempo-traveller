<?php
// Blog listing page SEO variables
require_once 'blog-data.php';

$page_title = 'Tempo Traveller Travel Blog – Delhi Trip Guides, Prices & Tips';
$page_description = 'Read our tempo traveller blog: Delhi tempo traveller price guides, 12/16/20 seater comparisons, Manali, Char Dham and Golden Triangle trip plans, and booking tips for group travel.';
$page_css = ['blog.css'];

$item_list = [];
$pos = 1;
foreach ($blog_posts as $slug => $post) {
    $item_list[] = ['@type' => 'ListItem', 'position' => $pos++, 'url' => 'https://www.delhitempotravelleronrent.com/' . $slug . '.php', 'name' => $post['title']];
}
$page_schema = '    <script type="application/ld+json">' . json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Blog',
    'name' => 'Delhi Tempo Traveller Travel Blog',
    'url' => 'https://www.delhitempotravelleronrent.com/blog.php',
    'publisher' => ['@id' => 'https://www.delhitempotravelleronrent.com/#business'],
    'mainEntity' => ['@type' => 'ItemList', 'itemListElement' => $item_list],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "</script>\n";

$categories = array_values(array_unique(array_column($blog_posts, 'category')));
include 'header.php';
?>

<main>
    <section class="blog-hero2">
        <img class="bh-bg" src="images/uttarakhand-hero-bg.webp" alt="tempo traveller travel blog Delhi" fetchpriority="high">
        <div class="container bh-grid">
            <div class="bh-copy">
                <nav class="ph-crumbs" aria-label="Breadcrumb"><a href="index.php">Home</a><i class="fas fa-chevron-right"></i><span>Blog</span></nav>
                <span class="ph-tag"><i class="fas fa-feather-alt"></i>Travel Blog</span>
                <h1>Tempo Traveller <span>Trip Guides, Prices &amp; Tips</span> from Delhi</h1>
                <p class="ph-lead">Honest, practical guides from our Delhi team: what a tempo traveller on rent in Delhi really costs, which size to book, and complete road trip plans for Manali, Char Dham, the Golden Triangle and more.</p>
                <div class="bh-stats">
                    <div><strong><?php echo count($blog_posts); ?></strong><span>In-depth guides</span></div>
                    <div><strong><?php echo count($categories); ?></strong><span>Topics</span></div>
                    <div><strong>25+</strong><span>Routes &amp; tours covered</span></div>
                </div>
                <div class="bh-topics">
                    <span>Browse:</span>
                    <?php foreach ($categories as $cat): ?>
                        <a href="#posts" data-jump="<?php echo htmlspecialchars($cat); ?>"><?php echo htmlspecialchars($cat); ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <aside class="bh-picks">
                <h2><i class="fas fa-star"></i> Editor’s picks</h2>
                <?php $picks = ['tempo-traveller-on-rent-in-delhi-price-guide', 'char-dham-yatra-by-tempo-traveller-from-delhi', 'delhi-to-manali-by-tempo-traveller-guide'];
                foreach ($picks as $slug): $p = $blog_posts[$slug]; ?>
                    <a class="bh-pick" href="<?php echo $slug; ?>.php">
                        <img src="<?php echo $p['image']; ?>" alt="<?php echo htmlspecialchars($p['image_alt']); ?>" loading="lazy">
                        <span><small><?php echo htmlspecialchars($p['category']); ?> · <?php echo $p['read_time']; ?></small><strong><?php echo htmlspecialchars($p['title']); ?></strong></span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                <?php endforeach; ?>
            </aside>
        </div>
    </section>

    <section class="blog-listing" id="posts">
        <div class="container">
            <div class="blog-filters" role="tablist" aria-label="Filter posts by category">
                <button class="active" data-filter="all">All Posts</button>
                <?php foreach ($categories as $cat): ?>
                    <button data-filter="<?php echo htmlspecialchars($cat); ?>"><?php echo htmlspecialchars($cat); ?></button>
                <?php endforeach; ?>
            </div>

            <div class="blog-grid">
                <?php $first = true; foreach ($blog_posts as $slug => $post): ?>
                    <a class="blog-card<?php echo $first ? ' featured' : ''; ?>" href="<?php echo $slug; ?>.php" data-category="<?php echo htmlspecialchars($post['category']); ?>">
                        <div class="thumb">
                            <img src="<?php echo $post['image']; ?>" alt="<?php echo htmlspecialchars($post['image_alt']); ?>" <?php echo $first ? 'fetchpriority="high"' : 'loading="lazy"'; ?>>
                            <span class="cat"><?php echo htmlspecialchars($post['category']); ?></span>
                        </div>
                        <div class="body">
                            <div class="meta">
                                <span><i class="far fa-calendar-alt"></i><?php echo date('d M Y', strtotime($post['date'])); ?></span>
                                <span><i class="far fa-clock"></i><?php echo $post['read_time']; ?></span>
                            </div>
                            <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                            <p><?php echo htmlspecialchars($post['excerpt']); ?></p>
                            <span class="more">Read full guide <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                <?php $first = false; endforeach; ?>
            </div>

            <div class="blog-cta-band">
                <div>
                    <h2>Planning a group trip from Delhi?</h2>
                    <p>Get a free, no-obligation quote for a 12, 16 or 20 seater tempo traveller in minutes.</p>
                </div>
                <div class="cta-buttons">
                    <a class="cta-btn light" href="tel:+917290885949"><i class="fas fa-phone-alt"></i> +91 7290885949</a>
                    <a class="cta-btn wa" href="https://wa.me/917290885949?text=Hi%2C%20I%20need%20a%20tempo%20traveller%20quote" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    document.querySelectorAll('[data-jump]').forEach(function (a) {
        a.addEventListener('click', function () {
            var b = document.querySelector('.blog-filters button[data-filter="' + a.getAttribute('data-jump') + '"]');
            if (b) b.click();
        });
    });
    document.querySelectorAll('.blog-filters button').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.blog-filters button').forEach(function (b) { b.classList.remove('active'); });
            btn.classList.add('active');
            var filter = btn.getAttribute('data-filter');
            document.querySelectorAll('.blog-card').forEach(function (card) {
                card.style.display = (filter === 'all' || card.getAttribute('data-category') === filter) ? '' : 'none';
            });
        });
    });
</script>

<?php include 'seo_keywords.php'; ?>
<?php include 'footer.php'; ?>
