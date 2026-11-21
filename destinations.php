<?php
// All "Delhi to X" tempo traveller destinations: popular routes, then every destination grouped by state with search + state filter.
$page_title = 'Tempo Traveller from Delhi to 600+ Destinations | From ₹30/km';
$page_description = 'Tempo traveller on rent from Delhi to 600+ destinations in Uttarakhand, Himachal, Rajasthan, Uttar Pradesh, Punjab, Haryana and beyond. 12–25 seater AC tempo travellers from ₹30/km. Call +91 7290885949.';
$page_keywords = 'tempo traveller destinations from Delhi, Delhi outstation tempo traveller, tempo traveller on rent Delhi routes, Delhi to hill station tempo traveller, Delhi to Rajasthan tempo traveller';
$page_css = ['pages.css', 'destinations.css'];
$page_image = 'images/himachal-hero-bg.webp';
require_once 'routes-data.php';
require_once 'trips-index.php';

// Group the canonical destinations (alternate spellings are left out) by state
$state_info = [
    'Uttarakhand' => ['images/uttarakhand-hero-bg.webp', 'fa-mountain', 'Char Dham, Nainital, Rishikesh & Kumaon hills'],
    'Himachal Pradesh' => ['images/himachal-hero-bg.webp', 'fa-snowflake', 'Manali, Shimla, Spiti & Dharamshala'],
    'Rajasthan' => ['images/rajasthan-hero-bg.webp', 'fa-chess-rook', 'Forts, palaces, deserts & Khatu Shyam'],
    'Uttar Pradesh' => ['images/agra-hero-bg.webp', 'fa-place-of-worship', 'Agra, Mathura-Vrindavan, Ayodhya & Varanasi'],
    'Punjab' => ['images/amritsar-hero-bg.webp', 'fa-hands-praying', 'Amritsar, Golden Temple, gurdwaras & Wagah'],
    'Haryana' => ['images/chandigarh-hero-bg.webp', 'fa-road', 'Kurukshetra, Morni Hills & NCR towns'],
    'Jammu and Kashmir' => ['images/kashmir-hero-bg.webp', 'fa-person-hiking', 'Vaishno Devi, Patnitop & Pahalgam'],
    'Madhya Pradesh' => ['images/wildlife-hero-bg.webp', 'fa-paw', 'Gwalior, Orchha, Khajuraho & Ujjain'],
];
$state_order = array_merge(array_keys($state_info), ['Chandigarh', 'Delhi', 'Gujarat', 'Maharashtra']);
$by_state = [];
foreach ($routes_data as $slug => $r) {
    if ($r[5] !== '') continue;
    $by_state[$r[1]][$slug] = $r;
}
uksort($by_state, function ($a, $b) use ($state_order) {
    $ia = array_search($a, $state_order, true); $ib = array_search($b, $state_order, true);
    $ia = $ia === false ? 99 : $ia; $ib = $ib === false ? 99 : $ib;
    return $ia === $ib ? strcmp($a, $b) : $ia - $ib;
});
foreach ($by_state as &$list) { uasort($list, function ($a, $b) { return strcasecmp($a[0], $b[0]); }); }
unset($list);
$total = array_sum(array_map('count', $by_state));
$hill_count = 0;
foreach ($by_state as $list) foreach ($list as $r) if ($r[3]) $hill_count++;
$state_id = function ($s) { return 'st-' . trim(preg_replace('/[^a-z]+/', '-', strtolower($s)), '-'); };
$popular = array_slice(array_filter($trips_index, function ($t) { return $t['kind'] === 'route'; }), 0, 14, true); // 2 large + 12 small fill the grid evenly
$wa_link = 'https://wa.me/917290885949?text=' . rawurlencode('Hi, I need a tempo traveller from Delhi. Please share a quote.');

include 'header.php';
$e = function ($s) { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); };
?>

<main class="pg dest">

    <!-- ============ HERO ============ -->
    <section class="pg-hero dest-hero">
        <img class="pg-hero-bg" src="images/himachal-hero-bg.webp" alt="tempo traveller from Delhi to all destinations" fetchpriority="high">
        <div class="container pg-hero-grid">
            <div>
                <nav class="pg-crumbs" aria-label="Breadcrumb"><a href="index.php">Home</a><i class="fas fa-chevron-right"></i><span>Destinations</span></nav>
                <span class="pg-tag"><i class="fas fa-map-location-dot"></i> All Destinations</span>
                <h1>Tempo Traveller from Delhi to <span><?php echo $total; ?>+ Destinations</span></h1>
                <p class="pg-lead">Hill stations, pilgrimages, weekend getaways and long outstation tours. Hire a 12, 16, 20 or 25 seater AC tempo traveller with an experienced driver, picked up from anywhere in Delhi NCR.</p>
                <form class="dest-search" role="search" onsubmit="return false">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input type="search" id="destSearch" placeholder="Where to? e.g. Manali, Khatu Shyam" aria-label="Search destinations" autocomplete="off">
                    <a class="btn btn-primary" href="#all">Browse all</a>
                </form>
                <p class="dest-try"><span>Popular:</span>
                    <?php foreach (['Manali', 'Khatu Shyam', 'Vrindavan', 'Kedarnath', 'Jim Corbett', 'Vaishno Devi'] as $q): ?>
                        <button type="button" data-q="<?php echo $e($q); ?>"><?php echo $e($q); ?></button>
                    <?php endforeach; ?>
                </p>
            </div>
            <div class="pg-stats">
                <div class="pg-stat"><i class="fas fa-map-pin"></i><strong><?php echo $total; ?>+</strong><span>Destinations from Delhi</span></div>
                <div class="pg-stat"><i class="fas fa-flag"></i><strong><?php echo count($by_state); ?></strong><span>States covered</span></div>
                <div class="pg-stat"><i class="fas fa-mountain-sun"></i><strong><?php echo $hill_count; ?></strong><span>Hill destinations</span></div>
                <div class="pg-stat"><i class="fas fa-tags"></i><strong>₹30<small>/km</small></strong><span>Starting fare</span></div>
            </div>
        </div>
    </section>

    <!-- ============ POPULAR ============ -->
    <section class="pg-sec" id="popular">
        <div class="container">
            <div class="dest-head">
                <div>
                    <span class="eyebrow-tag">Most Booked</span>
                    <h2>Popular Tempo Traveller Routes from Delhi</h2>
                    <p>Our most requested trips, with detailed route guides and fares.</p>
                </div>
                <a class="btn btn-outline" href="#all">See all <?php echo $total; ?> destinations <i class="fas fa-arrow-down"></i></a>
            </div>
            <div class="pop-grid">
                <?php $i = 0; foreach ($popular as $file => $t): ?>
                    <a class="pop-card<?php echo $i < 2 ? ' big' : ''; ?>" href="<?php echo $e($file); ?>">
                        <img src="<?php echo $e($t['image']); ?>" alt="<?php echo $e($t['name']); ?> tempo traveller on rent" loading="lazy">
                        <span class="pop-price">From <?php echo $e($t['price']); ?></span>
                        <span class="pop-body">
                            <strong><?php echo $e($t['name']); ?></strong>
                            <span class="pop-meta"><span><i class="fas fa-road"></i><?php echo $e($t['fact']); ?></span><span><i class="fas fa-clock"></i><?php echo $e($t['fact2']); ?></span></span>
                        </span>
                    </a>
                <?php $i++; endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ============ STATES ============ -->
    <section class="pg-sec pg-soft" id="states">
        <div class="container">
            <div class="pg-head">
                <span class="eyebrow-tag">Explore by State</span>
                <h2>Where would you like to go?</h2>
                <p class="section-sub">Pick a region to see every destination we cover there.</p>
            </div>
            <div class="state-grid">
                <?php foreach ($state_info as $state => $info): if (empty($by_state[$state])) continue; ?>
                    <a class="state-card" href="#<?php echo $state_id($state); ?>" data-state="<?php echo $e($state_id($state)); ?>">
                        <img src="<?php echo $e($info[0]); ?>" alt="tempo traveller from Delhi to <?php echo $e($state); ?>" loading="lazy">
                        <span class="state-body">
                            <span class="state-ico"><i class="fas <?php echo $e($info[1]); ?>"></i></span>
                            <strong><?php echo $e($state); ?></strong>
                            <small><?php echo $e($info[2]); ?></small>
                            <em><?php echo count($by_state[$state]); ?> destinations <i class="fas fa-arrow-right"></i></em>
                        </span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ============ ALL DESTINATIONS ============ -->
    <section class="pg-sec dest-all" id="all">
        <div class="dest-bar" id="destBar">
            <div class="container dest-bar-inner">
                <label class="dest-bar-search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input type="search" id="destSearch2" placeholder="Search destinations" aria-label="Search destinations" autocomplete="off">
                </label>
                <div class="dest-tabs" aria-label="Filter by state">
                    <button type="button" class="active" data-state="all">All <span><?php echo $total; ?></span></button>
                    <?php foreach ($by_state as $state => $list): ?>
                        <button type="button" data-state="<?php echo $e($state_id($state)); ?>"><?php echo $e($state); ?> <span><?php echo count($list); ?></span></button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="container">
            <p class="dest-count" id="destCount" aria-live="polite">Showing all <?php echo $total; ?> destinations</p>
            <div class="dest-empty" id="destEmpty" hidden>
                <i class="fas fa-map-signs"></i>
                <div>
                    <strong>Can’t find your destination?</strong>
                    <p>We go almost anywhere in India. Tell us where and we’ll send a quote.</p>
                </div>
                <a class="btn btn-wa" href="<?php echo $e($wa_link); ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Ask on WhatsApp</a>
            </div>

            <?php foreach ($by_state as $state => $list): ?>
                <div class="dest-group" id="<?php echo $state_id($state); ?>" data-state="<?php echo $e($state_id($state)); ?>">
                    <div class="dest-group-head">
                        <span class="dest-group-ico"><i class="fas <?php echo $e(isset($state_info[$state]) ? $state_info[$state][1] : 'fa-location-dot'); ?>"></i></span>
                        <h2>Tempo Traveller from Delhi to <?php echo $e($state); ?></h2>
                        <span class="dest-group-count"><?php echo count($list); ?></span>
                    </div>
                    <div class="dest-grid">
                        <?php foreach ($list as $slug => $r):
                            $sub = $r[4] ? $r[4][0] : ($r[3] ? 'Hill destination' : $state); ?>
                            <a class="dest-card" href="delhi-to-<?php echo $e($slug); ?>-tempo-on-rent.php" data-name="<?php echo $e(strtolower($r[0] . ' ' . str_replace('-', ' ', $slug) . ' ' . implode(' ', $r[4]))); ?>">
                                <span class="dest-card-top">
                                    <strong>Delhi to <?php echo $e($r[0]); ?></strong>
                                    <span class="dest-tag <?php echo $r[3] ? 'hill' : 'plain'; ?>"><i class="fas <?php echo $r[3] ? 'fa-mountain' : 'fa-road'; ?>"></i><?php echo $r[3] ? 'Hills' : 'Plains'; ?></span>
                                </span>
                                <small class="dest-sub"><?php echo $e($sub); ?></small>
                                <span class="dest-meta">
                                    <span><i class="fas fa-route"></i><?php echo (int) $r[2]; ?> km</span>
                                    <span><i class="fas fa-clock"></i><?php echo $e(route_travel_time($r[2], $r[3])); ?></span>
                                    <i class="fas fa-arrow-right dest-go"></i>
                                </span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- ============ CTA ============ -->
    <section class="pg-sec pg-soft">
        <div class="container">
            <div class="dest-cta">
                <img src="images/maintempotraveller.jpg" alt="tempo traveller on rent in Delhi for outstation trips" loading="lazy">
                <div class="dest-cta-copy">
                    <span class="pg-tag"><i class="fas fa-headset"></i> 24/7 Booking</span>
                    <h2>Planning a group trip from Delhi?</h2>
                    <p>Tell us your destination, dates and group size, and we’ll send the best tempo traveller option and fare on WhatsApp. Only fuel is included; toll, state tax, parking, driver allowance, night charge and GST are extra. AC is switched off in hilly areas.</p>
                    <div class="pg-actions">
                        <a class="btn btn-wa" href="<?php echo $e($wa_link); ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Get Quote on WhatsApp</a>
                        <a class="btn btn-ghost" href="tel:+917290885949"><i class="fas fa-phone-alt"></i> +91 7290885949</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    (function () {
        var inputs = [document.getElementById('destSearch'), document.getElementById('destSearch2')];
        var groups = document.querySelectorAll('.dest-group'), tabs = document.querySelectorAll('.dest-tabs button');
        var empty = document.getElementById('destEmpty'), count = document.getElementById('destCount');
        var all = document.getElementById('all'), bar = document.getElementById('destBar');
        var state = 'all', query = '';

        function apply() {
            var q = query.trim().toLowerCase(), shown = 0;
            groups.forEach(function (g) {
                var inState = state === 'all' || g.getAttribute('data-state') === state, n = 0;
                g.querySelectorAll('.dest-card').forEach(function (a) {
                    var hit = inState && (!q || a.getAttribute('data-name').indexOf(q) !== -1);
                    a.hidden = !hit; if (hit) n++;
                });
                g.hidden = n === 0; shown += n;
            });
            empty.hidden = shown > 0;
            count.textContent = shown ? 'Showing ' + shown + ' destination' + (shown === 1 ? '' : 's') + (q ? ' for “' + query.trim() + '”' : '') : '';
            tabs.forEach(function (t) {
                var on = t.getAttribute('data-state') === state;
                t.classList.toggle('active', on);
                if (on && t.scrollIntoView) t.parentNode.scrollTo({ left: t.offsetLeft - 20, behavior: 'smooth' });
            });
        }
        function jump() { window.scrollTo({ top: all.getBoundingClientRect().top + window.pageYOffset - 70, behavior: 'smooth' }); }

        inputs.forEach(function (inp) {
            inp.addEventListener('input', function () {
                query = inp.value; state = 'all';
                inputs.forEach(function (o) { if (o !== inp) o.value = inp.value; });
                apply();
            });
        });
        inputs[0].addEventListener('keydown', function (ev) { if (ev.key === 'Enter') jump(); });
        document.querySelectorAll('.dest-try button').forEach(function (b) {
            b.addEventListener('click', function () {
                query = b.getAttribute('data-q'); state = 'all';
                inputs.forEach(function (o) { o.value = query; });
                apply(); jump();
            });
        });
        tabs.forEach(function (t) {
            t.addEventListener('click', function () { state = t.getAttribute('data-state'); apply(); jump(); });
        });
        document.querySelectorAll('.state-card').forEach(function (c) {
            c.addEventListener('click', function (ev) {
                ev.preventDefault(); state = c.getAttribute('data-state'); query = '';
                inputs.forEach(function (o) { o.value = ''; });
                apply(); jump();
            });
        });
        // Keep the filter bar just under the sticky site header
        function setTop() { var h = document.getElementById('siteHeader'); if (h) bar.style.top = h.offsetHeight + 'px'; }
        setTop(); window.addEventListener('resize', setTop);
    })();
</script>

<?php include 'footer.php'; ?>
