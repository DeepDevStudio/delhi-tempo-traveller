<?php
// Template partial: redirect if opened directly.
if (!isset($post_slug)) { header('Location: blog.php', true, 301); exit; }
// Shared bottom half of every blog post (pairs with blog-post-start.php).
$post_content = ob_get_clean();

// Table of contents from the post's <h2 id="...">...</h2> headings, placed after the intro paragraph.
preg_match_all('/<h2 id="([^"]+)">(.*?)<\/h2>/s', $post_content, $toc_matches, PREG_SET_ORDER);
if (count($toc_matches) >= 3) {
    $toc = "<nav class=\"toc\" aria-label=\"Table of contents\">\n<h2>In this guide</h2>\n<ol>\n";
    foreach ($toc_matches as $m) {
        $toc .= '<li><a href="#' . $m[1] . '">' . strip_tags($m[2]) . "</a></li>\n";
    }
    $toc .= ($post_faqs ?? null) ? "<li><a href=\"#faq\">Frequently asked questions</a></li>\n" : '';
    $toc .= "</ol>\n</nav>\n";
    $first_p_end = strpos($post_content, '</p>');
    $post_content = $first_p_end === false ? $toc . $post_content : substr_replace($post_content, "</p>\n" . $toc, $first_p_end, 4);
}
echo $post_content;
?>

<?php if (!empty($post_faqs)): ?>
                    <section class="post-faq">
                        <h2 id="faq">Frequently Asked Questions</h2>
                        <?php foreach ($post_faqs as $faq): ?>
                            <details>
                                <summary><?php echo htmlspecialchars($faq[0]); ?></summary>
                                <p><?php echo $faq[1]; ?></p>
                            </details>
                        <?php endforeach; ?>
                    </section>
<?php endif; ?>

                    <div class="post-inline-cta">
                        <h3>Book your tempo traveller in Delhi today</h3>
                        <p>12, 16 &amp; 20 seater AC tempo travellers and luxury Maharaja tempos with experienced drivers. Tell us your dates and route and get a free quote in minutes.</p>
                        <div class="cta-buttons">
                            <a class="cta-btn light" href="tel:+917290885949"><i class="fas fa-phone-alt"></i> Call +91 7290885949</a>
                            <a class="cta-btn wa" href="https://wa.me/917290885949?text=<?php echo rawurlencode('Hi, I read "' . $post['title'] . '" and need a tempo traveller quote'); ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp Us</a>
                        </div>
                    </div>

                    <div class="post-tags">
                        <?php foreach ($post['keywords'] as $kw): ?>
                            <span>#<?php echo htmlspecialchars($kw); ?></span>
                        <?php endforeach; ?>
                    </div>

                    <div class="author-box">
                        <img src="images/logo-icon.svg" alt="Delhi tempo traveller on rent" width="60" height="60" loading="lazy">
                        <div>
                            <h4>Delhi Tempo Traveller Team</h4>
                            <p>We run tempo traveller trips from Delhi NCR every week, from same-day Agra runs to 12-day Char Dham yatras. These guides are written from what our drivers and customers tell us on the road.</p>
                        </div>
                    </div>
                </div>
            </article>

            <aside class="post-sidebar">
                <div class="side-card quote">
                    <h3><i class="fas fa-bolt"></i> Get an Instant Quote</h3>
                    <p>Fares from ₹30/km for a 12 seater. Toll, state tax &amp; driver allowance included. Parking, GST &amp; ₹500 driver night charge (10 PM – 6 AM) extra. 24/7 support on call and WhatsApp.</p>
                    <a class="cta-btn light" href="tel:+917290885949"><i class="fas fa-phone-alt"></i> Call Now</a>
                    <a class="cta-btn wa" href="https://wa.me/917290885949?text=Hi%2C%20I%20need%20a%20tempo%20traveller%20quote" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                </div>

                <div class="side-card">
                    <h3><i class="fas fa-route"></i> Popular Routes</h3>
                    <ul>
                        <li><a href="delhi-to-agra-tempo-on-rent.php">Delhi to Agra Tempo Traveller <i class="fas fa-chevron-right"></i></a></li>
                        <li><a href="delhi-to-jaipur-tempo-on-rent.php">Delhi to Jaipur Tempo Traveller <i class="fas fa-chevron-right"></i></a></li>
                        <li><a href="delhi-to-manali-tempo-on-rent.php">Delhi to Manali Tempo Traveller <i class="fas fa-chevron-right"></i></a></li>
                        <li><a href="delhi-to-rishikesh-tempo-on-rent.php">Delhi to Rishikesh Tempo Traveller <i class="fas fa-chevron-right"></i></a></li>
                        <li><a href="delhi-to-shimla-tempo-on-rent.php">Delhi to Shimla Tempo Traveller <i class="fas fa-chevron-right"></i></a></li>
                        <li><a href="chardham-tempo-package.php">Char Dham Tempo Package <i class="fas fa-chevron-right"></i></a></li>
                        <li><a href="fleet.php">View Our Fleet <i class="fas fa-chevron-right"></i></a></li>
                    </ul>
                </div>

                <div class="side-card">
                    <h3><i class="fas fa-newspaper"></i> Recent Guides</h3>
                    <ul>
                        <?php $shown = 0; foreach ($blog_posts as $slug => $p): if ($slug === $post_slug || $shown >= 4) continue; $shown++; ?>
                            <li><a class="recent-post" href="<?php echo $slug; ?>.php"><img src="<?php echo $p['image']; ?>" alt="<?php echo htmlspecialchars($p['image_alt']); ?>" loading="lazy"><span><?php echo htmlspecialchars($p['title']); ?></span></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </aside>
        </div>
    </section>

    <section class="related-posts">
        <div class="container">
            <h2 class="section-title">You May Also Like</h2>
            <div class="blog-grid">
                <?php
                // Same-category posts first, then the rest, three in total.
                $others = array_filter($blog_posts, function ($p, $slug) use ($post_slug) { return $slug !== $post_slug; }, ARRAY_FILTER_USE_BOTH);
                uasort($others, function ($a, $b) use ($post) { return ($b['category'] === $post['category']) <=> ($a['category'] === $post['category']); });
                foreach (array_slice($others, 0, 3, true) as $slug => $p):
                ?>
                    <a class="blog-card" href="<?php echo $slug; ?>.php">
                        <div class="thumb">
                            <img src="<?php echo $p['image']; ?>" alt="<?php echo htmlspecialchars($p['image_alt']); ?>" loading="lazy">
                            <span class="cat"><?php echo htmlspecialchars($p['category']); ?></span>
                        </div>
                        <div class="body">
                            <div class="meta"><span><i class="far fa-clock"></i><?php echo $p['read_time']; ?></span></div>
                            <h3><?php echo htmlspecialchars($p['title']); ?></h3>
                            <p><?php echo htmlspecialchars($p['excerpt']); ?></p>
                            <span class="more">Read guide <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<script>
    (function () {
        // Reading progress bar
        var bar = document.getElementById('readProgress'), article = document.querySelector('.post-article');
        if (bar && article) {
            var update = function () {
                var rect = article.getBoundingClientRect(), total = article.offsetHeight - window.innerHeight;
                var p = total > 0 ? Math.min(1, Math.max(0, -rect.top / total)) : 0;
                bar.style.width = (p * 100) + '%';
            };
            window.addEventListener('scroll', update, { passive: true });
            window.addEventListener('resize', update);
            update();
        }
        // Copy link button
        var copyBtn = document.querySelector('.ph-copy-link');
        if (copyBtn) copyBtn.addEventListener('click', function () {
            var url = copyBtn.getAttribute('data-url');
            var done = function () { copyBtn.classList.add('copied'); copyBtn.innerHTML = '<i class="fas fa-check"></i>'; setTimeout(function () { copyBtn.classList.remove('copied'); copyBtn.innerHTML = '<i class="fas fa-link"></i>'; }, 1800); };
            if (navigator.clipboard) navigator.clipboard.writeText(url).then(done, done); else done();
        });
    })();
</script>

<?php include 'seo_keywords.php'; ?>
<?php include 'footer.php'; ?>
