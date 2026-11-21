<?php
// Builds the $trip array for a "Delhi to X" destination page from routes-data.php, then renders it with trip-page.php.
// Title, meta tags, schema, main copy and FAQs come from route-content.php (shared with the 16 hand-written route pages).
// Each destination file only sets $route_slug and includes this file. Rates follow the fleet.php rate card.
if (!isset($route_slug)) { header('Location: destinations.php', true, 301); exit; }
require_once 'routes-data.php';
require_once 'route-about.php';
if (!isset($routes_data[$route_slug])) { header('Location: destinations.php', true, 301); exit; }

list($place, $state, $km, $is_hill, $attractions, $canonical_slug) = $routes_data[$route_slug];
$site_url = 'https://www.delhitempotravelleronrent.com';
if ($canonical_slug !== '') $canonical_url = $site_url . '/delhi-to-' . $canonical_slug . '-tempo-on-rent.php';

// Rate card (same as fleet.php): [seats, vehicle, ₹/km]
$route_rates = [
    ['12 Seater', 'Tempo Traveller', 30],
    ['16 Seater', 'Tempo Traveller', 35],
    ['20 Seater', 'Tempo Traveller', 40],
];
$inr = function ($n) {
    $n = (string) (int) round($n);
    if (strlen($n) <= 3) return '₹' . $n;
    $last3 = substr($n, -3);
    $rest = substr($n, 0, -3);
    $rest = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $rest);
    return '₹' . $rest . ',' . $last3;
};
$round_km = 2 * $km;
$one_day_km = max($round_km, 250);
$two_day_km = max($round_km, 500);
// Suggested trip length for the calculator: about 400 km of driving per day
$suggested_days = max(1, (int) ceil(($round_km - 100) / 400));
$suggested_km = max($round_km, $suggested_days * 250);

$hours = route_drive_hours($km, $is_hill);
$travel_time = route_travel_time($km, $is_hill);

// Sub-regions used for route and season text
$kumaon = ['almora', 'bhimtal', 'bhowali-range', 'binsar', 'bageshwar', 'champawat', 'chaubatia', 'chaukhutiya', 'chaukori', 'dharchula', 'dwarahat', 'haldwani', 'jeolikote', 'kathgodam', 'kausani', 'kapkot', 'lalkuan', 'mukteshwar', 'munsiyari', 'munsyari', 'naukuchiatal', 'pithoragarh', 'ranikhet', 'reetha-sahib', 'sattal', 'someshwar', 'tanakpur', 'khatima', 'sitarganj', 'kichha', 'rudrapur', 'pantnagar', 'gadarpur', 'bazpur', 'kashipur-uttarakhand', 'jaspur', 'ramnagar', 'jim-corbett'];
$char_dham = ['badrinath', 'kedarnath', 'gangotri', 'yamunotri', 'hemkunt-sahib', 'gaurikund'];
$high_altitude = ['kaza', 'spiti-valley', 'keylong', 'rohtang-la-pass', 'kalpa', 'kinnaur', 'pahalgam', 'auli', 'munsiyari', 'munsyari', 'dharchula', 'chopta', 'sankri'];

if ($km <= 60) {
    $route_text = 'A short drive across Delhi NCR. Your driver picks the quickest road on the day (expressways, ring roads or city roads) to avoid traffic.';
} elseif ($km >= 1000) {
    $route_text = 'A long-distance drive of about ' . $km . ' km on the national highway and expressway network. It is usually covered over two days with a night halt on the way.';
} else {
    switch ($state) {
        case 'Uttarakhand':
            $route_text = in_array($route_slug, $kumaon, true)
                ? 'Delhi → Hapur → Moradabad → Rampur → Rudrapur/Haldwani on NH-9, then ' . ($is_hill ? 'Kumaon hill roads' : 'local roads') . ' to ' . $place . '.'
                : 'Delhi → Meerut Expressway → Muzaffarnagar → Roorkee → Haridwar/Dehradun, then ' . ($is_hill ? 'Garhwal hill roads' : 'local roads') . ' to ' . $place . '.';
            break;
        case 'Himachal Pradesh':
            $route_text = 'Delhi → Panipat → Karnal → Ambala on NH-44, then via Chandigarh, Kiratpur or Una (whichever is shortest) into the hills to ' . $place . '.';
            break;
        case 'Punjab':
        case 'Chandigarh':
            $route_text = 'Delhi → Panipat → Karnal → Ambala on NH-44 (GT Road), the main four-lane highway to Punjab, then on to ' . $place . '.';
            break;
        case 'Haryana':
            $route_text = 'The nearest highway out of Delhi: NH-44, NH-48, NH-9 or the KMP Expressway, depending on which side of Delhi ' . $place . ' is.';
            break;
        case 'Rajasthan':
        case 'Gujarat':
            $route_text = 'Out of Delhi on NH-48 (Delhi–Jaipur highway) or the Delhi–Mumbai Expressway, then on state highways to ' . $place . '.';
            break;
        case 'Jammu and Kashmir':
            $route_text = 'Delhi → Panipat → Ambala → Ludhiana → Jalandhar → Pathankot → Jammu on NH-44' . ($route_slug === 'jammu' ? '.' : ', then on to ' . $place . '.');
            break;
        case 'Madhya Pradesh':
            $route_text = 'Delhi → Yamuna Expressway → Agra → Gwalior on NH-44, then onwards to ' . $place . '.';
            break;
        default:
            $route_text = 'Out of Delhi on the Yamuna Expressway, Agra–Lucknow Expressway or NH-9, depending on which part of the state ' . $place . ' is in.';
    }
}

if (in_array($route_slug, $char_dham, true)) {
    $best_time = 'May–June and September–October. The shrine is open roughly from May to November and closes in winter; avoid the July–August monsoon.';
    $best_short = 'May-Oct';
} elseif (in_array($route_slug, $high_altitude, true)) {
    $best_time = 'May/June to October, when the high roads are open. Heavy snow can close the route in winter.';
    $best_short = 'May-Oct';
} elseif ($is_hill) {
    $best_time = 'March to June and September to November are the most pleasant. Winter brings snow at higher places; the July–August monsoon can cause landslides.';
    $best_short = 'Mar-Jun';
} else {
    $best_time = 'October to March is the most comfortable. Summer afternoons (April–June) get very hot, so start early.';
    $best_short = 'Oct-Mar';
}

if ($hours >= 12) {
    $tip = 'This is a long drive, so plan a night halt on the way. If the driver drives between 10 PM and 6 AM, a driver night charge applies.' . ($is_hill ? ' The AC is switched off on hill roads.' : '');
} elseif ($is_hill) {
    $tip = 'Start from Delhi early (5–6 am) to reach the hills in daylight. The AC is switched off on hill roads, so keep a light jacket and motion-sickness tablets handy.';
} elseif ($km <= 150) {
    $tip = 'An easy same-day trip: leave by 7–8 am and you can be back in Delhi the same evening. Billing is a minimum of 250 km per day.';
} else {
    $tip = 'Leave Delhi early to beat city traffic. Tell us your stops in advance and we will plan the halts and timings for your group.';
}

$attr_text = $attractions ? implode(', ', $attractions) : '';
$region = in_array($state, ['Himachal Pradesh', 'Punjab', 'Haryana', 'Chandigarh', 'Jammu and Kashmir'], true) ? 'hp'
    : ($state === 'Uttarakhand' ? 'uk' : (in_array($state, ['Rajasthan', 'Gujarat'], true) ? 'raj' : 'up'));
$hero_by_state = [
    'Rajasthan' => 'images/rajasthan-hero-bg.webp',
    'Gujarat' => 'images/rajasthan-hero-bg.webp',
    'Uttarakhand' => 'images/uttarakhand-hero-bg.webp',
    'Himachal Pradesh' => 'images/himachal-hero-bg.webp',
    'Jammu and Kashmir' => 'images/kashmir-hero-bg.webp',
    'Punjab' => 'images/amritsar-hero-bg.webp',
    'Haryana' => 'images/chandigarh-hero-bg.webp',
    'Chandigarh' => 'images/chandigarh-hero-bg.webp',
];
$hero_image = isset($hero_by_state[$state]) ? $hero_by_state[$state] : 'images/maintempotraveller.jpg';
$in_state = $state !== '' ? ' in ' . $state : '';

// Price rows: One Way = max(2d, 250) × (rate − 2); 1-Day = max(2d, 250) × rate; 2-Day = max(2d, 500) × rate
$price_rows = [];
foreach ($route_rates as $r) {
    $price_rows[] = [
        'vehicle' => $r[1],
        'seats' => $r[0],
        'rate' => '₹' . $r[2] . '/km',
        'prices' => [
            ['One Way', $inr($one_day_km * ($r[2] - 2))],
            ['1-Day Round Trip', $inr($one_day_km * $r[2])],
            ['2-Day Round Trip', $inr($two_day_km * $r[2])],
        ],
    ];
}
$price_rows[] = [
    'vehicle' => 'Maharaja Tempo',
    'seats' => '9-16 Seater',
    'rate' => '₹35-40/km',
    'prices' => [
        ['One Way', ''],
        ['1-Day Round Trip', ''],
        ['2-Day Round Trip', ''],
    ],
];

$guide = [
    ['Distance & time', 'About ' . $km . ' km by road, usually ' . $travel_time . ' in a tempo traveller depending on traffic and breaks.'],
    ['Best route', $route_text],
    $attr_text !== ''
        ? ['Places to visit', $attr_text . '.']
        : ['Places to visit', 'Tell us your plans and we will cover local temples, markets and sights in and around ' . $place . ' in the same trip.'],
    ['Best time to go', $best_time],
    ['Travel tip', $tip],
];

$days_word = $suggested_days === 1 ? '1 day' : $suggested_days . ' days';
// ---------------------------------------------------------------------------
// About the destination: hand-written intro (route-about.php) + paragraphs built from this route's data
// ---------------------------------------------------------------------------
$about_slug = $canonical_slug !== '' ? $canonical_slug : $route_slug;
$about_intro = isset($route_about[$about_slug]) ? $route_about[$about_slug] : '';
$is_placeholder = strpos($about_intro, 'Share your exact location') !== false;
$kw = ' <strong>Delhi to ' . $place . ' tempo traveller</strong>';

// What kind of trip is this? Decides the "who goes there" paragraph.
$haystack = strtolower($about_intro . ' ' . $attr_text . ' ' . $route_slug);
$has = function (array $words) use ($haystack) {
    foreach ($words as $w) if (strpos($haystack, $w) !== false) return true;
    return false;
};
if ($km <= 80) $trip_type = 'ncr';
elseif ($has(['national park', 'tiger', 'safari', 'wildlife sanctuary', 'corbett'])) $trip_type = 'wildlife';
elseif ($has(['temple', 'mandir', 'gurdwara', 'dargah', 'shrine', 'jyotirlinga', 'dham', 'sahib', 'balaji', 'shakti', 'pilgrim', 'holy', 'sacred', 'krishna', 'ganga'])) $trip_type = 'pilgrimage';
elseif ($is_hill) $trip_type = 'hill';
elseif ($has(['fort', 'palace', 'haveli', 'unesco', 'monument', 'heritage'])) $trip_type = 'heritage';
elseif ($has(['industrial', 'industry', 'university', 'airport'])) $trip_type = 'business';
else $trip_type = 'general';

$about = [];
if ($about_intro !== '') $about[] = $about_intro;

// Getting there
$p = 'By road, ' . $place . ' is about <strong>' . $km . ' km</strong> from Delhi' . $in_state . ', usually <strong>' . $travel_time . '</strong> in a tempo traveller. ' . $route_text;
if ($km >= 1000) {
    $p .= ' Because of the distance we plan this as a multi-day drive with comfortable night halts, so the group and the driver stay fresh.';
} elseif ($is_hill) {
    $p .= ' The last part of the drive is on mountain roads, so we send drivers who regularly drive in the hills and know the safe halts, viewpoints and fuel stops on the way.';
} elseif ($km <= 150) {
    $p .= ' It is short enough for a same-day return trip, so you can leave in the morning and be back in Delhi by night.';
} else {
    $p .= ' We plan breakfast, lunch and tea stops at clean highway dhabas and restaurants, so the drive never feels tiring.';
}
$about[] = $p;

// Who goes there
$who = [
    'ncr' => 'Being so close to Delhi, our' . $kw . ' is booked mostly for office staff transport, airport and station transfers, wedding baraats, school and college outings and family functions. Billing is per km, with a minimum of 250 km per day.',
    'wildlife' => 'Nature lovers, families and school groups book our' . $kw . ' for safari weekends. The vehicle drops you at the safari gate and resort, waits while you are in the park, and keeps everyone together with their bags and camera gear.',
    'pilgrimage' => 'Most of our' . $kw . ' bookings are families, satsang groups and temple committees going for darshan. Your driver plans the timings around aarti and darshan, waits while you visit, and the big boot carries luggage, prasad and puja items for the whole group.',
    'hill' => 'Our' . $kw . ' is a favourite for summer holidays, college trips, friends\' getaways and office offsites. The whole group travels together, stops for photos whenever you like, and the high roof and pushback seats make long hill drives far more comfortable than cramming into cars.',
    'heritage' => 'History lovers, families and student groups book our' . $kw . ' for heritage tours. You can cover forts, palaces and old markets at your own pace, with the vehicle waiting at each stop, and add nearby towns to the same trip.',
    'business' => 'Our' . $kw . ' is regularly booked for business visits, factory and plant staff movement, university admissions and convocations, and family trips. Tell us your schedule and we will plan pickups and waiting time around it.',
    'general' => 'Our' . $kw . ' is booked for family functions, weddings, group visits to relatives, business trips and sightseeing. Tell us your plan and we will suggest the right vehicle size, timings and stops.',
];
$about[] = $who[$trip_type];

// Best time + things to see
if (!$is_placeholder) {
    $p = '<strong>Best time to visit:</strong> ' . $best_time;
    $p .= $attr_text !== ''
        ? ' Popular places to cover on the trip include ' . $attr_text . '. Your tempo traveller stays with you, so local sightseeing is easy to add.'
        : ' Your tempo traveller stays with you, so you can add local sightseeing and nearby towns to the same trip.';
    $about[] = $p;
}

// Cost per person
$per_head = (int) round($suggested_km * 30 / 12);
$about[] = 'A tempo traveller also works out cheaper than booking several cabs. A 12 seater for a ' . $days_word . ' round trip to ' . $place . ' (about ' . $suggested_km . ' km) costs around <strong>' . $inr($suggested_km * 30) . '</strong>, roughly <strong>' . $inr($per_head) . ' per person</strong> for a full group of 12, plus toll, state tax, parking, driver allowance, night charge and GST. Use the calculator above for your own dates, or call <strong>+91 7290885949</strong> for an exact quote.';

// ---------------------------------------------------------------------------
// Pickup points: "{point} to {place} tempo on rent", grouped
// ---------------------------------------------------------------------------
$pickup_groups = [
    'Delhi Areas' => ['fa-location-dot', ['Rohini', 'Nangloi', 'Dwarka', 'Janakpuri', 'Pitampura', 'Shalimar Bagh', 'Ashok Vihar', 'Model Town', 'Mukherjee Nagar', 'Burari', 'Narela', 'Mundka', 'Paschim Vihar', 'Punjabi Bagh', 'Rajouri Garden', 'Tilak Nagar', 'Vikaspuri', 'Uttam Nagar', 'Najafgarh', 'Palam', 'Vasant Kunj', 'Mahipalpur', 'Saket', 'Malviya Nagar', 'Hauz Khas', 'Greater Kailash', 'Kalkaji', 'Lajpat Nagar', 'Defence Colony', 'Sarita Vihar', 'Badarpur', 'Okhla', 'Connaught Place', 'Karol Bagh', 'Paharganj', 'Chandni Chowk', 'Patel Nagar', 'Laxmi Nagar', 'Mayur Vihar', 'Preet Vihar', 'Shahdara', 'Dilshad Garden', 'Vivek Vihar', 'Yamuna Vihar']],
    'Airport, Railway Stations & Bus Terminals' => ['fa-train', ['Delhi Airport (IGI) T1', 'Delhi Airport (IGI) T3', 'New Delhi Railway Station', 'Old Delhi Railway Station', 'Hazrat Nizamuddin Railway Station', 'Anand Vihar Railway Terminal', 'Delhi Sarai Rohilla Railway Station', 'Delhi Cantt Railway Station', 'ISBT Kashmere Gate', 'ISBT Anand Vihar', 'ISBT Sarai Kale Khan']],
    'Metro Stations' => ['fa-train-subway', ['Rajiv Chowk Metro', 'Kashmere Gate Metro', 'Central Secretariat Metro', 'New Delhi Metro', 'Chandni Chowk Metro', 'Hauz Khas Metro', 'Saket Metro', 'Qutub Minar Metro', 'Kalkaji Mandir Metro', 'Lajpat Nagar Metro', 'Mandi House Metro', 'Karol Bagh Metro', 'Rajouri Garden Metro', 'Janakpuri West Metro', 'Dwarka Sector 21 Metro', 'Rithala Metro', 'Samaypur Badli Metro', 'Azadpur Metro', 'Akshardham Metro', 'Anand Vihar Metro', 'Botanical Garden Metro', 'Noida City Centre Metro', 'Millennium City Centre Gurugram Metro', 'Aerocity Metro']],
    'Famous Hotels in Delhi' => ['fa-hotel', ['The Taj Mahal Hotel New Delhi', 'Taj Palace New Delhi', 'The Leela Palace New Delhi', 'The Oberoi New Delhi', 'ITC Maurya', 'The Imperial New Delhi', 'Hyatt Regency Delhi', 'Shangri-La Eros New Delhi', 'The Lalit New Delhi', 'Le Meridien New Delhi', 'The Claridges New Delhi', 'Radisson Blu Plaza Mahipalpur', 'JW Marriott Aerocity', 'Andaz Aerocity', 'Pullman Aerocity', 'Roseate House Aerocity', 'Sheraton New Delhi Saket', 'Eros Hotel Nehru Place', 'Crowne Plaza Okhla', 'Holiday Inn Mayur Vihar', 'Vivanta Dwarka', 'Radisson Blu Dwarka', 'Radisson Blu Paschim Vihar', 'Hotels in Paharganj', 'Hotels in Karol Bagh']],
    'Landmarks' => ['fa-landmark', ['India Gate', 'Red Fort', 'Qutub Minar', 'Akshardham Temple', 'Lotus Temple', 'Chhatarpur Mandir', 'Gurudwara Bangla Sahib', 'Jama Masjid', 'ISKCON Temple East of Kailash', 'Pragati Maidan', 'Bharat Mandapam', 'Yashobhoomi Dwarka', 'Jawaharlal Nehru Stadium', 'AIIMS Delhi', 'Delhi University North Campus']],
    'Delhi NCR' => ['fa-city', ['Noida', 'Greater Noida', 'Gurugram', 'Ghaziabad', 'Faridabad', 'Indirapuram', 'Vaishali', 'Noida Extension']],
];
$short_place = trim(preg_replace('/\s*\(.*?\)/', '', $place)); // "Kedarnath (Gaurikund)" -> "Kedarnath"
$localities = [];
foreach ($pickup_groups as $group => $g) {
    $items = [];
    foreach ($g[1] as $point) {
        if (stripos($point, $short_place) === false && stripos($short_place, $point) === false) $items[] = $point . ' to ' . $short_place . ' tempo on rent';
    }
    if ($items) $localities[$group] = ['icon' => $g[0], 'items' => $items];
}

$trip = [
    'kind' => 'route',
    'place' => $place,
    'name' => $place,
    'h1' => 'Delhi to ' . $place . ' Tempo Traveller on Rent',
    'hero_image' => $hero_image,
    'hero_alt' => 'Delhi to ' . $place . ' tempo traveller on rent',
    'price_from' => '₹30',
    'price_unit' => '/km',
    'distance_km' => $km,
    'facts' => [
        [$km . ' km', 'Distance', 'fas fa-road'],
        [$travel_time, 'Travel Time', 'fas fa-clock'],
        ['12-25 Seats', 'Vehicle Options', 'fas fa-users'],
        [$best_short, 'Best Time', 'fas fa-calendar-check'],
    ],
    'features' => [
        '12/16/20/25 Seater Tempo',
        'Experienced Outstation Drivers',
        'Transparent Per-km Pricing',
        '24/7 Customer Support',
        'Fully Insured Vehicles',
        'Clean & Sanitized',
        'Pickup Anywhere in Delhi NCR',
        'Instant Confirmation',
    ],
    'about' => $about,
    'localities' => $localities,
    'extras_strip' => true,
    'guide' => $guide,
    'highlights' => [],
    'price_rows' => $price_rows,
    'reviews' => [],
    'searches' => [
        'Delhi to ' . $place . ' Tempo Traveller',
        'Delhi to ' . $place . ' Tempo on Rent',
        $place . ' Tempo Traveller Hire',
        '12 Seater Tempo Traveller Delhi to ' . $place,
        'Delhi to ' . $place . ' Group Travel',
    ],
    'region' => $region,
    'calculator' => [
        'mode' => 'route',
        'distance' => $km,
        'vehicles' => [
            [30, '12 Seater - ₹30/km'],
            [35, '16 Seater - ₹35/km'],
            [40, '20 Seater - ₹40/km'],
            [43, '25 Seater - ₹43/km'],
            [35, 'Maharaja 9/12 Seater - ₹35/km'],
            [40, 'Maharaja 16 Seater - ₹40/km'],
        ],
        'distance_label' => 'One-way Distance (km)',
        'days' => $suggested_days,
        'message_title' => 'Delhi to ' . $place . ' Tempo on Rent',
        'extra_line' => null,
    ],
];

include 'trip-page.php';
