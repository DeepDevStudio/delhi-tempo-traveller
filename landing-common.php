<?php
// Shared rates and helpers for the city and vehicle landing pages (kind 'local', rendered by trip-page.php).
// Rates follow the fleet.php rate card. Fare = max(2 × one-way km, days × 250) × per-km rate.
if (basename($_SERVER['SCRIPT_FILENAME']) === 'landing-common.php') { header('Location: index.php', true, 301); exit; }

$landing_rates = [
    ['12 Seater', 'Tempo Traveller', 30],
    ['16 Seater', 'Tempo Traveller', 35],
    ['20 Seater', 'Tempo Traveller', 40],
];
$landing_inr = function ($n) {
    $n = (string) (int) round($n);
    $last3 = substr($n, -3);
    $rest = substr($n, 0, -3);
    if ($rest !== '') $last3 = ',' . $last3;
    return '₹' . preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $rest) . $last3;
};
// Fare table rows: per-km rate plus the 1-day (250 km) and 2-day (500 km) minimum billing; Maharaja quoted on WhatsApp
$landing_price_rows = function (array $only_seats = []) use ($landing_rates, $landing_inr) {
    $rows = [];
    foreach ($landing_rates as $r) {
        if ($only_seats && !in_array($r[0], $only_seats, true)) continue;
        $rows[] = [
            'vehicle' => $r[1],
            'seats' => $r[0],
            'rate' => '₹' . $r[2] . '/km',
            'prices' => [
                ['1 Day (min. 250 km)', $landing_inr(250 * $r[2])],
                ['2 Days (min. 500 km)', $landing_inr(500 * $r[2])],
            ],
        ];
    }
    $rows[] = [
        'vehicle' => 'Maharaja Tempo',
        'seats' => '9-16 Seater',
        'rate' => '₹35-40/km',
        'prices' => [['1 Day (min. 250 km)', ''], ['2 Days (min. 500 km)', '']],
    ];
    return $rows;
};
$landing_calculator = function ($title, $distance = 200, $days = 1) {
    return [
        'mode' => 'route',
        'distance' => $distance,
        'vehicles' => [
            [30, '12 Seater - ₹30/km'],
            [35, '16 Seater - ₹35/km'],
            [40, '20 Seater - ₹40/km'],
            [43, '25 Seater - ₹43/km'],
            [35, 'Maharaja 9/12 Seater - ₹35/km'],
            [40, 'Maharaja 16 Seater - ₹40/km'],
        ],
        'distance_label' => 'One-way Distance (km)',
        'days' => $days,
        'message_title' => $title,
        'extra_line' => null,
    ];
};
$landing_features = [
    '12/16/20/25 Seater Tempo',
    'Verified, Experienced Drivers',
    'Transparent Per-km Pricing',
    '24/7 Call & WhatsApp Support',
    'Fully Insured Vehicles',
    'Clean & Sanitized',
    'Doorstep Pickup',
    'Instant Confirmation',
];
// FAQs every landing page shares (pricing rules), appended after the page's own questions
$landing_common_faqs = [
    ['What is included in the tempo traveller fare?', 'Only <strong>fuel</strong> is included in the per-km rate. Toll tax, state tax, parking, driver allowance, driver night charge and GST are extra. Please note that the AC is switched off in hilly areas.'],
    ['How is the fare calculated?', 'Fare = billable km × per-km rate, where billable km is the round-trip distance or 250 km per day, whichever is higher. For example, a 2-day trip in a 12 seater is billed for at least 500 km × ₹30 = ₹15,000.'],
    ['How do I book?', 'Call or WhatsApp <a href="tel:+917290885949">+91 7290885949</a> with your pickup point, destination, dates and group size, or use the quote form on this page. We confirm availability and the exact fare on WhatsApp.'],
];
// Example round-trip fares for a vehicle, for the vehicle landing pages: [place, one-way km, days, page]
$landing_examples = function ($seats, $rate) use ($landing_inr) {
    $trips = [['Agra', 230, 1, 'agra'], ['Haridwar', 220, 1, 'haridwar'], ['Jaipur', 280, 2, 'jaipur'], ['Rishikesh', 240, 2, 'rishikesh'], ['Shimla', 350, 3, 'shimla'], ['Manali', 540, 4, 'manali']];
    $out = [];
    foreach ($trips as $t) {
        $km = max(2 * $t[1], $t[2] * 250);
        $out[] = 'Delhi to ' . $t[0] . ' & back, ' . $t[2] . ' day' . ($t[2] > 1 ? 's' : '') . ' (' . $km . ' km): ' . $landing_inr($km * $rate) . ' in a ' . $seats . ' + extras';
    }
    return $out;
};
