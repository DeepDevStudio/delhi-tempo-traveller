<?php
// Shared template for every "Delhi to X" route page and every tour package page.
// Each page file sets the SEO variables and a $trip array, then includes this file.
if (!isset($trip)) { header('Location: index.php', true, 301); exit; }

require_once 'trips-index.php';
$is_route = $trip['kind'] === 'route';
$is_local = $trip['kind'] === 'local'; // city / vehicle landing pages (e.g. tempo traveller in Noida, 12 seater)
// Every route page uses the owner's copy and meta tags, filled in for its destination
if ($is_route) require 'route-content.php';
// Optional per-page wording overrides: $trip['text'][key]
$txt = function ($key, $default) use ($trip) { return isset($trip['text'][$key]) ? $trip['text'][$key] : $default; };
$whatsapp_number = '917290885949';

// ---------------------------------------------------------------------------
// Booking form handler → WhatsApp (works without JavaScript)
// ---------------------------------------------------------------------------
$quote_errors = [];
$quote = ['name' => '', 'phone' => '', 'pickup' => '', 'destination' => '', 'trip_type' => '', 'travel_date' => '', 'return_date' => '', 'vehicle' => ''];
$trip_types = ['Round Trip'];
$default_trip_type = 'Round Trip';
$default_destination = $is_route ? $trip['place'] : ($trip['kind'] === 'local' ? '' : $trip['name']);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quote_submit'])) {
    foreach ($quote as $key => $unused) {
        $quote[$key] = trim(strip_tags((string) filter_input(INPUT_POST, $key)));
    }
    if (!empty($_POST['website'])) { header('Location: ' . basename($_SERVER['PHP_SELF'])); exit; }
    if ($quote['name'] === '') $quote_errors[] = 'Please enter your name.';
    if (!preg_match('/^[0-9+\s-]{10,15}$/', $quote['phone'])) $quote_errors[] = 'Please enter a valid mobile number.';
    if (!in_array($quote['trip_type'], $trip_types, true)) $quote['trip_type'] = $default_trip_type;
    $is_round = $quote['trip_type'] === 'Round Trip';
    $date_ok = function ($d) { return (bool) preg_match('/^\d{4}-\d{2}-\d{2}$/', $d); };
    if ($quote['travel_date'] !== '' && !$date_ok($quote['travel_date'])) $quote_errors[] = 'Please choose a valid travel date.';
    if (!$is_round) {
        $quote['return_date'] = '';
    } elseif ($quote['return_date'] === '') {
        $quote_errors[] = 'Please choose a return date for your round trip.';
    } elseif (!$date_ok($quote['return_date'])) {
        $quote_errors[] = 'Please choose a valid return date.';
    } elseif ($quote['travel_date'] === '') {
        $quote_errors[] = 'Please choose your travel date as well as the return date.';
    } elseif ($quote['return_date'] < $quote['travel_date']) {
        $quote_errors[] = 'The return date cannot be before the travel date.';
    }
    if (empty($quote_errors)) {
        $message = 'New Enquiry: ' . ($is_route ? 'Delhi to ' . $trip['place'] : $trip['name'] . ($is_local ? '' : ' Package')) . "\n"
            . "Name: {$quote['name']}\nMobile: {$quote['phone']}\n"
            . 'Pickup Location: ' . ($quote['pickup'] !== '' ? $quote['pickup'] : 'Delhi NCR') . "\n"
            . 'Destination: ' . ($quote['destination'] !== '' ? $quote['destination'] : ($default_destination !== '' ? $default_destination : 'Not decided')) . "\n"
            . 'Trip Type: ' . $quote['trip_type'] . "\n"
            . 'Travel Date: ' . ($quote['travel_date'] !== '' ? date('d M Y', strtotime($quote['travel_date'])) : 'Not decided') . "\n"
            . ($is_round ? 'Return Date: ' . date('d M Y', strtotime($quote['return_date'])) . "\n" : '')
            . 'Vehicle: ' . ($quote['vehicle'] !== '' ? $quote['vehicle'] : 'Please suggest');
        header('Location: https://wa.me/' . $whatsapp_number . '?text=' . rawurlencode($message));
        exit;
    }
}

// ---------------------------------------------------------------------------
// SEO: styles, breadcrumb, FAQ schema
// ---------------------------------------------------------------------------
$page_css = ['trip.css'];
$page_image = $trip['hero_image'];
$breadcrumb_items = [
    ['Home', 'https://www.delhitempotravelleronrent.com/'],
    $is_route ? ['Routes', 'https://www.delhitempotravelleronrent.com/destinations.php'] : ($is_local ? ['Services', 'https://www.delhitempotravelleronrent.com/services.php'] : ['Tour Packages', 'https://www.delhitempotravelleronrent.com/']),
    [$trip['h1'], $canonical_url],
];
$faq_entities = [];
foreach (isset($trip['faq_schema']) ? $trip['faq_schema'] : $trip['faqs'] as $faq) {
    $faq_entities[] = ['@type' => 'Question', 'name' => $faq[0], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags($faq[1])]];
}
$page_schema = '    <script type="application/ld+json">' . json_encode(['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $faq_entities], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "</script>\n";
// Service schema: the rental itself, with the fares shown in the price table as offers
$service_offers = [];
foreach ($trip['price_rows'] as $row) {
    foreach ($row['prices'] as $cell) {
        $amount = (int) preg_replace('/[^0-9]/', '', explode('/', $cell[1])[0]);
        if ($amount <= 0) continue;
        $offer = [
            '@type' => 'Offer',
            'name' => trim($row['seats'] . ' ' . $row['vehicle']) . ' – ' . $cell[0],
            'price' => $amount,
            'priceCurrency' => 'INR',
            'availability' => 'https://schema.org/InStock',
            'url' => $canonical_url,
        ];
        if (stripos($cell[1], '/day') !== false) $offer['priceSpecification'] = ['@type' => 'UnitPriceSpecification', 'price' => $amount, 'priceCurrency' => 'INR', 'unitText' => 'DAY'];
        $service_offers[] = $offer;
    }
}
$service_schema = [
    '@context' => 'https://schema.org',
    '@type' => 'Service',
    'name' => $trip['h1'],
    'serviceType' => $txt('service_type', $trip['kind'] === 'route' ? 'Outstation tempo traveller rental' : 'Tempo traveller tour package'),
    'description' => isset($page_description) ? $page_description : strip_tags($trip['lead']),
    'image' => 'https://www.delhitempotravelleronrent.com/' . $trip['hero_image'],
    'url' => $canonical_url,
    'provider' => ['@id' => 'https://www.delhitempotravelleronrent.com/#business'],
    'areaServed' => [['@type' => 'City', 'name' => 'Delhi'], ['@type' => 'Place', 'name' => $trip['kind'] === 'route' ? $trip['place'] : $trip['name']]],
];
if ($service_offers) $service_schema['offers'] = $service_offers;
$page_schema .= '    <script type="application/ld+json">' . json_encode($service_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "</script>\n";
if (!empty($trip['rental_schema'])) $page_schema .= '    <script type="application/ld+json">' . json_encode($trip['rental_schema'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "</script>\n";

include 'header.php';

// ---------------------------------------------------------------------------
// View helpers
// ---------------------------------------------------------------------------
$e = function ($s) { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); };
$trip_label = $is_route ? 'Delhi to ' . $trip['place'] : $trip['name'];
$wa = function ($text) use ($whatsapp_number) { return 'https://wa.me/' . $whatsapp_number . '?text=' . rawurlencode($text); };
$vehicle_options = array_map(function ($r) { return trim($r['seats'] . ' ' . $r['vehicle']); }, $trip['price_rows']);
$guide_icons = ['distance' => 'fa-road', 'route' => 'fa-route', 'stops' => 'fa-mug-hot', 'places' => 'fa-map-location-dot', 'time' => 'fa-calendar-days', 'tip' => 'fa-lightbulb'];
$guide_icon = function ($label) use ($guide_icons) {
    $l = strtolower($label);
    if (strpos($l, 'distance') !== false) return $guide_icons['distance'];
    if (strpos($l, 'route') !== false) return $guide_icons['route'];
    if (strpos($l, 'stop') !== false) return $guide_icons['stops'];
    if (strpos($l, 'places') !== false) return $guide_icons['places'];
    if (strpos($l, 'time') !== false) return $guide_icons['time'];
    return $guide_icons['tip'];
};
// Keep <strong> only on keyword phrases (containing "tempo"), so the copy doesn't look shouty
$soften = function ($html) {
    return preg_replace_callback('#<strong>(.*?)</strong>#s', function ($m) {
        return stripos($m[1], 'tempo') !== false ? $m[0] : $m[1];
    }, $html);
};
$show_rate = (bool) array_filter(array_column($trip['price_rows'], 'rate'));
// Related trips: same region first, then the rest of the same kind
$related = [];
foreach ($trips_index as $file => $t) {
    if ($file !== $current_page && $t['kind'] === ($is_local ? 'route' : $trip['kind']) && $t['region'] === $trip['region']) $related[$file] = $t;
}
foreach ($trips_index as $file => $t) {
    if (count($related) >= 4) break;
    if ($file !== $current_page && $t['kind'] === ($is_local ? 'route' : $trip['kind']) && !isset($related[$file])) $related[$file] = $t;
}
$related = array_slice($related, 0, 4, true);
// Nearby destinations (same state first, closest distance) so every route page links to its neighbours
$nearby = [];
if ($is_route && preg_match('/^delhi-to-(.+)-tempo-on-rent\.php$/', $current_page, $slug_match)) {
    require_once 'routes-data.php';
    $this_slug = $slug_match[1];
    if (isset($routes_data[$this_slug])) {
        $this_route = $routes_data[$this_slug];
        $candidates = [];
        foreach ($routes_data as $slug => $r) {
            if ($slug === $this_slug || $r[5] !== '' || ($this_route[5] !== '' && $slug === $this_route[5])) continue;
            $score = abs($r[2] - $this_route[2]) + ($r[1] === $this_route[1] ? 0 : 100000);
            $candidates[$slug] = $score;
        }
        asort($candidates);
        foreach (array_slice($candidates, 0, 12, true) as $slug => $unused) {
            $nearby['delhi-to-' . $slug . '-tempo-on-rent.php'] = $routes_data[$slug][0];
        }
    }
}
?>

<main class="trip<?php echo $is_route ? ' trip-route' : ''; ?>">

    <!-- ============ HERO ============ -->
    <section class="trip-hero">
        <img class="trip-hero-bg" src="<?php echo $e($trip['hero_image']); ?>" alt="<?php echo $e($trip['hero_alt']); ?>" fetchpriority="high">
        <div class="container trip-hero-grid">
            <div class="trip-hero-copy">
                <nav class="trip-crumbs" aria-label="Breadcrumb">
                    <a href="index.php">Home</a><i class="fas fa-chevron-right"></i>
                    <?php if ($is_route): ?><a href="destinations.php">Routes</a><?php elseif ($is_local): ?><a href="services.php">Services</a><?php else: ?><a href="index.php#packages">Tour Packages</a><?php endif; ?><i class="fas fa-chevron-right"></i>
                    <span><?php echo $e($trip_label); ?></span>
                </nav>
                <span class="trip-eyebrow"><i class="fas <?php echo $is_route ? 'fa-route' : ($is_local ? 'fa-van-shuttle' : 'fa-suitcase-rolling'); ?>"></i><?php echo $e($txt('eyebrow', $is_route ? 'Outstation Tempo Traveller' : 'Tempo Traveller Tour Package')); ?></span>
                <h1><?php echo $e($trip['h1']); ?></h1>
                <p class="trip-lead"><?php echo strip_tags($trip['lead']); ?></p>
                <ul class="trip-pills">
                    <?php foreach ($trip['facts'] as $f): ?>
                        <li><i class="<?php echo $e($f[2]); ?>"></i><span><strong><?php echo $e($f[0]); ?></strong><small><?php echo $e($f[1]); ?></small></span></li>
                    <?php endforeach; ?>
                </ul>
                <div class="trip-actions">
                    <a class="btn btn-primary" href="tel:+917290885949"><i class="fas fa-phone-alt"></i> Call +91 7290885949</a>
                    <a class="btn btn-ghost" href="<?php echo $wa('Hi, I need a tempo traveller for ' . $trip_label); ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                </div>
            </div>

            <aside class="trip-book" id="book">
                <div class="trip-book-price">
                    <span>Starting from</span>
                    <strong><?php echo $e($trip['price_from']); ?><em><?php echo $e($trip['price_unit']); ?></em></strong>
                    <small><i class="fas fa-circle-info"></i> Only fuel included. Toll, state tax, parking, driver allowance, night charge &amp; GST extra. AC switched off in hilly areas</small>
                </div>
                <form class="trip-form" method="post" action="<?php echo $e($current_page); ?>#book" novalidate>
                    <?php if (!empty($quote_errors)): ?>
                        <div class="form-errors" role="alert"><?php echo implode('<br>', array_map($e, $quote_errors)); ?></div>
                    <?php endif; ?>
                    <div class="tf-row">
                        <label class="tf"><span>Your name</span><input name="name" type="text" autocomplete="name" placeholder="Full name" required value="<?php echo $e($quote['name']); ?>"></label>
                        <label class="tf"><span>Mobile number</span><input name="phone" type="tel" inputmode="tel" autocomplete="tel" placeholder="10-digit mobile" required pattern="[0-9+\s-]{10,15}" value="<?php echo $e($quote['phone']); ?>"></label>
                    </div>
                    <?php $sel_trip = $quote['trip_type'] !== '' ? $quote['trip_type'] : $default_trip_type; $show_return = $sel_trip === 'Round Trip'; ?>
                    <div class="tf-row">
                        <label class="tf"><span>Pickup location</span><input name="pickup" type="text" placeholder="e.g. Dwarka, Noida" value="<?php echo $e($quote['pickup']); ?>"></label>
                        <label class="tf"><span>Destination</span><input name="destination" type="text" placeholder="e.g. <?php echo $e($default_destination !== '' ? $default_destination : 'Agra, Haridwar'); ?>" value="<?php echo $e($quote['destination'] !== '' ? $quote['destination'] : $default_destination); ?>"></label>
                    </div>
                    <div class="tf-row">
                        <label class="tf"><span>Trip type</span>
                            <select name="trip_type" id="tfTripType">
                                <?php foreach ($trip_types as $tt): ?><option<?php echo $sel_trip === $tt ? ' selected' : ''; ?>><?php echo $tt; ?></option><?php endforeach; ?>
                            </select>
                        </label>
                        <label class="tf"><span>Vehicle</span>
                            <select name="vehicle">
                            <option value="">Help me choose</option>
                            <?php foreach ($vehicle_options as $opt): ?><option<?php echo $quote['vehicle'] === $opt ? ' selected' : ''; ?>><?php echo $e($opt); ?></option><?php endforeach; ?>
                        </select>
                        </label>
                    </div>
                    <div class="tf-row tf-dates<?php echo $show_return ? '' : ' single'; ?>" id="tfDates">
                        <label class="tf"><span>Travel date</span><input name="travel_date" id="tfTravelDate" type="date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo $e($quote['travel_date']); ?>"></label>
                        <label class="tf tf-return" id="tfReturn"<?php echo $show_return ? '' : ' hidden'; ?>><span>Return date</span><input name="return_date" id="tfReturnDate" type="date" min="<?php echo $e($quote['travel_date'] !== '' ? $quote['travel_date'] : date('Y-m-d')); ?>" value="<?php echo $e($quote['return_date']); ?>"<?php echo $show_return ? ' required' : ''; ?>></label>
                    </div>
                    <div class="hp-field" aria-hidden="true"><input name="website" type="text" tabindex="-1" autocomplete="off"></div>
                    <button class="btn btn-primary btn-block" type="submit" name="quote_submit" value="1"><i class="fab fa-whatsapp"></i> Get Free Quote on WhatsApp</button>
                    <p class="tf-note"><i class="fas fa-lock"></i> Quick reply · No spam · Free quote</p>
                </form>
                <script>
                    (function () {
                        var type = document.getElementById('tfTripType'), wrap = document.getElementById('tfReturn'),
                            rows = document.getElementById('tfDates'), ret = document.getElementById('tfReturnDate'),
                            travel = document.getElementById('tfTravelDate');
                        function sync() {
                            var round = type.value === 'Round Trip';
                            wrap.hidden = !round;
                            rows.classList.toggle('single', !round);
                            ret.required = round;
                            if (!round) ret.value = '';
                        }
                        type.addEventListener('change', sync);
                        travel.addEventListener('change', function () {
                            if (travel.value) {
                                ret.min = travel.value;
                                if (ret.value && ret.value < travel.value) ret.value = travel.value;
                            }
                        });
                        sync();
                    })();
                </script>
            </aside>
        </div>
    </section>

    <!-- ============ IN-PAGE NAV ============ -->
    <nav class="trip-subnav" aria-label="On this page">
        <div class="container">
            <a href="#overview">Overview</a>
            <?php if (!empty($trip['about'])): ?><a href="#about-place"><?php echo $e($txt('about_tag', 'About ' . $trip['place'])); ?></a><?php endif; ?>
            <a href="#fares">Fares</a>
            <a href="#calculator">Instant Quote</a>
            <?php if (!empty($trip['vehicle_copy'])): ?><a href="#vehicles">Vehicles</a><?php endif; ?>
            <?php if ($is_route ? !empty($trip['guide']) : !empty($trip['highlights'])): ?><a href="<?php echo $is_route ? '#guide' : '#highlights'; ?>"><?php echo $is_route ? 'Route Guide' : 'Highlights'; ?></a><?php endif; ?>
            <?php if (!empty($trip['reviews'])): ?><a href="#reviews">Reviews</a><?php endif; ?>
            <a href="#faq">FAQs</a>
            <a class="subnav-cta" href="#book">Book Now</a>
        </div>
    </nav>

    <!-- ============ OVERVIEW ============ -->
    <section class="trip-sec" id="overview">
        <div class="container trip-overview">
            <div class="trip-prose">
                <span class="eyebrow-tag">Overview</span>
                <h2><?php echo $e($txt('overview_h2', $is_route ? 'Delhi to ' . $trip['place'] . ' Tempo Traveller Service' : $trip['name'] . ' by Tempo Traveller from Delhi')); ?></h2>
                <?php foreach ($trip['intro'] as $p): ?><p><?php echo $soften($p); ?></p><?php endforeach; ?>
                <?php if (!empty($trip['main_copy'])): ?>
                    <h2><?php echo $e($trip['main_copy'][0]); ?></h2>
                    <p><?php echo $trip['main_copy'][1]; ?></p>
                <?php endif; ?>
                <h3>Why travel with us</h3>
                <ul class="check-grid">
                    <?php foreach ($trip['features'] as $f): ?><li><i class="fas fa-circle-check"></i><?php echo $e($f); ?></li><?php endforeach; ?>
                </ul>
            </div>
            <aside class="glance">
                <h3>Trip at a glance</h3>
                <dl>
                    <?php foreach ($trip['facts'] as $f): ?>
                        <div><dt><i class="<?php echo $e($f[2]); ?>"></i><?php echo $e($f[1]); ?></dt><dd><?php echo $e($f[0]); ?></dd></div>
                    <?php endforeach; ?>
                    <div><dt><i class="fas fa-tags"></i>Starting fare</dt><dd><?php echo $e($trip['price_from'] . $trip['price_unit']); ?></dd></div>
                    <div><dt><i class="fas fa-location-dot"></i>Pickup</dt><dd>Anywhere in Delhi NCR</dd></div>
                    <div><dt><i class="fas fa-receipt"></i>Extra charges</dt><dd>Everything except fuel: toll, state tax, parking, driver allowance, driver night charge &amp; GST</dd></div>
                </dl>
                <div class="glance-help">
                    <i class="fas fa-headset"></i>
                    <div><strong>Talk to a travel expert</strong><a href="tel:+917290885949">+91 7290885949</a></div>
                </div>
            </aside>
        </div>
    </section>

    <!-- ============ FARES ============ -->
    <section class="trip-sec trip-soft" id="fares">
        <div class="container">
            <div class="sec-head-left">
                <span class="eyebrow-tag">Fares</span>
                <h2><?php echo $e($txt('fares_h2', $trip_label . ' Tempo Traveller Fare')); ?></h2>
                <p>Transparent starting prices for every vehicle. Tap <strong>Book</strong> to get availability and an exact quote on WhatsApp.</p>
            </div>
            <div class="fare-table" role="table" aria-label="<?php echo $e($trip_label); ?> fares" style="--cols: <?php echo ($show_rate ? 1 : 0) + count($trip['price_rows'][0]['prices']); ?>">
                <div class="fare-row fare-head" role="row">
                    <span role="columnheader">Vehicle</span>
                    <?php if ($show_rate): ?><span role="columnheader">Rate</span><?php endif; ?>
                    <?php foreach ($trip['price_rows'][0]['prices'] as $p): ?><span role="columnheader"><?php echo $e($p[0]); ?></span><?php endforeach; ?>
                    <span role="columnheader" class="sr-only">Book</span>
                </div>
                <?php foreach ($trip['price_rows'] as $r): $is_lux = stripos($r['vehicle'], 'maharaja') !== false; ?>
                    <div class="fare-row" role="row">
                        <span role="cell" class="fare-vehicle"><i class="fas <?php echo $is_lux ? 'fa-crown' : 'fa-van-shuttle'; ?>"></i><span><strong><?php echo $e($r['seats']); ?></strong><small><?php echo $e($r['vehicle']); ?></small></span></span>
                        <?php if ($is_lux): // Maharaja prices are quoted on WhatsApp only ?>
                        <span role="cell" class="fare-quote"><a href="<?php echo $wa('Hi, please share the price of a ' . trim($r['seats'] . ' ' . $r['vehicle']) . ' for ' . $trip_label . '.'); ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Get price on WhatsApp</a></span>
                        <?php else: ?>
                        <?php if ($show_rate): ?><span role="cell" data-label="Rate" class="fare-rate"><?php echo $e($r['rate'] !== '' ? $r['rate'] : '—'); ?></span><?php endif; ?>
                        <?php foreach ($r['prices'] as $p): ?><span role="cell" data-label="<?php echo $e($p[0]); ?>" class="fare-price"><?php echo $e($p[1]); ?></span><?php endforeach; ?>
                        <?php endif; ?>
                        <span role="cell" class="fare-book"><a class="btn btn-sm btn-wa" href="<?php echo $wa('Hi, I want to book a ' . trim($r['seats'] . ' ' . $r['vehicle']) . ' for ' . $trip_label . '. Please share ' . ($is_lux ? 'availability and price.' : 'availability.')); ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?php echo $is_lux ? 'Get Quote' : 'Book'; ?></a></span>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if (!empty($trip['extras_strip'])): ?>
            <div class="extras-strip" role="note">
                <i class="fas fa-triangle-exclamation"></i>
                <p><span>Only fuel charge is included.</span> <strong>Everything else is extra: toll tax, state tax, parking, driver allowance, driver night charge and GST.</strong> <span>Note: AC will be switched off in hilly areas.</span></p>
            </div>
            <p class="fare-note"><i class="fas fa-circle-info"></i> Starting prices; the final fare depends on your dates, route and number of days.</p>
            <?php else: ?>
            <p class="fare-note"><i class="fas fa-circle-info"></i> <strong>Only fuel charge is included.</strong> Everything else is extra: toll tax, state tax, parking, driver allowance, driver night charge and GST. <strong>Note: AC will be switched off in hilly areas.</strong> Starting prices; the final fare depends on your dates, route and number of days.</p>
            <?php endif; ?>

            <?php if (!empty($trip['calculator'])): $calc = $trip['calculator']; ?>
                <div class="calculator" id="calculator" data-whatsapp="<?php echo $whatsapp_number; ?>"
                     data-mode="<?php echo $e($calc['mode']); ?>"
                     data-title="<?php echo $e($calc['message_title']); ?>"
                     data-extra-label="<?php echo $e($calc['extra_line'][0] ?? ''); ?>"
                     data-extra-value="<?php echo $e($calc['extra_line'][1] ?? ''); ?>">
                    <div class="calc-head">
                        <h3><i class="fas fa-calculator"></i> Get Instant Quote</h3>
                        <span class="calc-badge"><i class="fas fa-bolt"></i> Quick Estimate</span>
                    </div>
                    <div class="calc-body">
                        <div class="calc-grid<?php echo !empty($calc['trips']) ? ' four' : ''; ?>">
                            <label class="tf"><span><i class="fas fa-van-shuttle"></i> Choose Vehicle</span>
                                <select id="calcVehicle">
                                    <?php foreach ($calc['vehicles'] as $v): $v_lux = stripos($v[1], 'maharaja') !== false; ?><option value="<?php echo $e($v[0]); ?>"<?php echo $v_lux ? ' data-quote="1"' : ''; ?>><?php echo $e($v_lux ? preg_replace('/\s*-\s*₹.*$/u', '', $v[1]) : $v[1]); ?></option><?php endforeach; ?>
                                </select>
                            </label>
                            <label class="tf"><span><i class="fas fa-road"></i> <?php echo $e($calc['distance_label']); ?></span>
                                <input id="calcDistance" type="number" min="1" inputmode="numeric" value="<?php echo (int) $calc['distance']; ?>">
                            </label>
                            <label class="tf"><span><i class="fas fa-calendar-day"></i> Number of Days</span>
                                <input id="calcDays" type="number" min="1" max="60" inputmode="numeric" value="<?php echo (int) $calc['days']; ?>">
                            </label>
                            <?php if (!empty($calc['trips'])): ?>
                            <label class="tf"><span><i class="fas fa-suitcase-rolling"></i> <?php echo $e($calc['trip_label']); ?></span>
                                <select id="calcTrip">
                                    <?php foreach ($calc['trips'] as $t): ?><option value="<?php echo $e($t[0]); ?>"><?php echo $e($t[1]); ?></option><?php endforeach; ?>
                                </select>
                            </label>
                            <?php endif; ?>
                        </div>
                        <div class="calc-grid two">
                            <label class="tf"><span><i class="fas fa-user"></i> Your Name</span><input id="calcName" type="text" autocomplete="name" placeholder="Enter your name"></label>
                            <label class="tf"><span><i class="fab fa-whatsapp"></i> WhatsApp Number</span><input id="calcPhone" type="tel" inputmode="tel" autocomplete="tel" placeholder="Enter phone number"></label>
                        </div>
                        <p class="calc-error" id="calcError" role="alert" hidden>Please enter your WhatsApp number so we can send your quote.</p>
                        <div class="calc-result">
                            <div>
                                <span class="calc-label">Estimated Total Price</span>
                                <strong class="calc-total">₹<span id="calcTotal">0</span></strong>
                                <small class="calc-extra"><i class="fas fa-road"></i> <span id="calcKm"></span> (round trip, min 250 km/day)</small>
                                <small class="calc-extra"><i class="fas fa-circle-info"></i> Only fuel included. Toll, state tax, parking, driver allowance, night charge &amp; GST extra. AC switched off in hilly areas.</small>
                            </div>
                            <button type="button" class="btn btn-wa" id="calcSend"><i class="fab fa-whatsapp"></i> Get Quote on WhatsApp</button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php if (!empty($trip['vehicle_copy'])): ?>
    <!-- ============ VEHICLES + ONLINE BOOKING (owner's copy) ============ -->
    <section class="trip-sec" id="vehicles">
        <div class="container">
            <div class="sec-head-left">
                <span class="eyebrow-tag">Our Vehicles</span>
                <h2>Choose Your Tempo Traveller from Delhi to <?php echo $e($trip['place']); ?></h2>
            </div>
            <div class="vehicle-grid">
                <?php foreach ($trip['vehicle_copy'] as $v): ?>
                    <article class="vehicle-card">
                        <span class="guide-ico"><i class="fas <?php echo $e($v[0]); ?>"></i></span>
                        <h3><?php echo $e($v[1]); ?></h3>
                        <p><?php echo $v[2]; ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if ($is_route && $trip['guide']): ?>
    <!-- ============ ROUTE GUIDE ============ -->
    <section class="trip-sec trip-soft" id="guide">
        <div class="container">
            <div class="sec-head-left">
                <span class="eyebrow-tag">Route Guide</span>
                <h2>Delhi to <?php echo $e($trip['place']); ?> Route Guide</h2>
                <p>Everything you need to plan the drive, from the best route and stops to the ideal time to travel.</p>
            </div>
            <div class="guide-grid">
                <?php foreach ($trip['guide'] as $g): ?>
                    <article class="guide-card">
                        <span class="guide-ico"><i class="fas <?php echo $guide_icon($g[0]); ?>"></i></span>
                        <h3><?php echo $e($g[0]); ?></h3>
                        <p><?php echo $g[1]; ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if (!$is_route && $trip['highlights']): ?>
    <!-- ============ PACKAGE HIGHLIGHTS ============ -->
    <section class="trip-sec" id="highlights">
        <div class="container highlights-wrap">
            <div class="highlights-media">
                <img src="<?php echo $e($trip['hero_image']); ?>" alt="<?php echo $e($txt('highlights_alt', $trip['name'] . ' tour by tempo traveller')); ?>" loading="lazy">
            </div>
            <div>
                <span class="eyebrow-tag"><?php echo $e($txt('highlights_tag', 'Package Highlights')); ?></span>
                <h2><?php echo $e($txt('highlights_h2', $trip['name'] . ' Package Highlights')); ?></h2>
                <p class="muted"><?php echo $e($txt('highlights_intro', 'A flexible itinerary planned around your group, with a dedicated tempo traveller and driver for the whole tour.')); ?></p>
                <ul class="highlight-list">
                    <?php foreach ($trip['highlights'] as $i => $h): ?>
                        <li><span><?php echo str_pad($i + 1, 2, '0', STR_PAD_LEFT); ?></span><?php echo $e($h); ?></li>
                    <?php endforeach; ?>
                </ul>
                <a class="btn btn-primary" href="#book"><i class="fas fa-calendar-check"></i> Plan my trip</a>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($trip['reviews'])): ?>
    <!-- ============ REVIEWS ============ -->
    <section class="trip-sec trip-dark" id="reviews">
        <div class="container">
            <div class="sec-head-left light">
                <span class="eyebrow-tag">Reviews</span>
                <h2>What Travellers Say About Our <?php echo $e($is_route ? $trip['place'] : $trip['name']); ?> Trips</h2>
            </div>
            <div class="review-grid">
                <?php foreach (array_slice($trip['reviews'], 0, 6) as $rv):
                    $initials = implode('', array_map(function ($w) { return strtoupper(substr($w, 0, 1)); }, array_slice(explode(' ', $rv[1]), 0, 2))); ?>
                    <figure class="t-review">
                        <div class="stars" aria-label="5 out of 5 stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        <blockquote><?php echo $rv[0]; ?></blockquote>
                        <figcaption><span class="avatar"><?php echo $e($initials); ?></span><span><strong><?php echo $e($rv[1]); ?></strong><small><?php echo $e($rv[2]); ?></small></span></figcaption>
                    </figure>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ============ FAQ ============ -->
    <section class="trip-sec" id="faq">
        <div class="container trip-faq">
            <div class="faq-intro">
                <span class="eyebrow-tag">FAQs</span>
                <h2>Frequently Asked Questions</h2>
                <p><?php echo $e($txt('faq_intro', 'Quick answers about travelling ' . ($is_route ? 'from Delhi to ' . $trip['place'] : 'on our ' . $trip['name'] . ' package') . ' by tempo traveller.')); ?></p>
                <div class="faq-help">
                    <strong>Still have a question?</strong>
                    <a class="btn btn-wa btn-sm" href="<?php echo $wa('Hi, I have a question about ' . $trip_label . ' by tempo traveller'); ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Ask on WhatsApp</a>
                </div>
            </div>
            <div class="faq-list">
                <?php foreach ($trip['faqs'] as $i => $faq): ?>
                    <details class="t-faq"<?php echo $i === 0 ? ' open' : ''; ?>>
                        <summary><?php echo $e($faq[0]); ?></summary>
                        <div><?php echo $faq[1]; ?></div>
                    </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ============ RELATED ============ -->
    <section class="trip-sec trip-soft" id="more">
        <div class="container">
            <div class="sec-head-left">
                <span class="eyebrow-tag"><?php echo $is_route || $is_local ? 'More Routes' : 'More Tours'; ?></span>
                <h2><?php echo $is_route || $is_local ? 'Popular Tempo Traveller Routes from Delhi' : 'More Tempo Traveller Tour Packages'; ?></h2>
            </div>
            <div class="related-grid">
                <?php foreach ($related as $file => $t): ?>
                    <a class="related-card" href="<?php echo $e($file); ?>">
                        <img src="<?php echo $e($t['image']); ?>" alt="<?php echo $e($t['name']); ?> tempo traveller" loading="lazy">
                        <span class="related-body">
                            <strong><?php echo $e($t['name']); ?></strong>
                            <small><i class="fas <?php echo $t['kind'] === 'route' ? 'fa-road' : 'fa-calendar'; ?>"></i><?php echo $e($t['fact']); ?> · From <?php echo $e($t['price']); ?></small>
                        </span>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="all-trips">
                <h3>All routes &amp; tour packages</h3>
                <div class="chip-cloud">
                    <?php foreach ($trips_index as $file => $t): if ($file === $current_page) continue; ?>
                        <a href="<?php echo $e($file); ?>"><?php echo $e($t['name']); ?></a>
                    <?php endforeach; ?>
                </div>
                <?php if ($nearby): ?>
                    <h3>More tempo traveller routes near <?php echo $e($trip['place']); ?></h3>
                    <div class="chip-cloud">
                        <?php foreach ($nearby as $file => $name): ?>
                            <a href="<?php echo $e($file); ?>">Delhi to <?php echo $e($name); ?> Tempo Traveller</a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php if ($trip['kind'] === 'package'): ?>
                    <p class="searches">Travelling alone or as a couple? Join a fixed-date <a href="https://www.getmeyatra.com/" target="_blank" rel="noopener"><strong>group yatra or tour package with GetMeYatra</strong></a>, our sister company.</p>
                <?php endif; ?>
                <p class="searches"><a href="destinations.php"><strong>View all 600+ tempo traveller destinations from Delhi &rarr;</strong></a></p>
                <?php if (!empty($trip['searches'])): ?>
                    <p class="searches"><strong>Popular searches:</strong> <?php echo $e(implode(' · ', $trip['searches'])); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php if (!empty($trip['about']) || !empty($trip['localities'])): ?>
    <!-- ============ ABOUT THE DESTINATION + PICKUP POINTS ============ -->
    <section class="trip-sec" id="about-place">
        <div class="container">
            <div class="about-place">
                <?php if (!empty($trip['about'])): ?>
                <div class="about-place-copy">
                    <span class="eyebrow-tag"><?php echo $e($txt('about_tag', 'About ' . $trip['place'])); ?></span>
                    <h2><?php echo $e($txt('about_h2', 'About ' . $trip['place'] . ' & Your Tempo Traveller Trip from Delhi')); ?></h2>
                    <?php foreach ((array) $trip['about'] as $para): ?><p class="about-place-text"><?php echo $para; ?></p><?php endforeach; ?>
                </div>
                <?php endif; ?>
                <?php if (!empty($trip['localities'])): ?>
                <div class="pickup-areas">
                    <h3><i class="fas fa-location-dot"></i> <?php echo $e($txt('pickup_h3', $trip['place'] . ' Tempo Traveller Pickup from Anywhere in Delhi NCR')); ?></h3>
                    <p><?php echo $e($txt('pickup_intro', 'We pick up your group from your home, hotel, airport, railway station or metro station. Popular pickup points:')); ?></p>
                    <?php foreach ($trip['localities'] as $group => $g): ?>
                        <h4 class="pickup-group"><i class="fas <?php echo $e($g['icon']); ?>"></i> <?php echo $e($group); ?></h4>
                        <ul class="pickup-list">
                            <?php foreach ($g['items'] as $loc): ?><li><i class="fas fa-van-shuttle"></i><strong><?php echo $e($loc); ?></strong></li><?php endforeach; ?>
                        </ul>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
</main>

<?php if (!empty($trip['calculator'])): ?>
<script src="calculator.js?v=3" defer></script>
<?php endif; ?>

<?php include 'seo_keywords.php'; ?>
<?php include 'footer.php'; ?>
