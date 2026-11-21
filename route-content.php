<?php
// The owner's page copy, meta tags and schema for every "Delhi to X" route page (November 2026).
// Included by trip-page.php after the page file has set $trip, so it covers generated and hand-written route pages alike.
// Fares, the calculator, the route guide, reviews, the About section and pickup points stay as they are.
if (basename($_SERVER['SCRIPT_FILENAME']) === 'route-content.php') { header('Location: destinations.php', true, 301); exit; }
require_once 'routes-data.php';

$rc_slug = isset($route_slug) ? $route_slug : preg_replace('/^delhi-to-(.+)-tempo-on-rent\.php$/', '$1', basename($_SERVER['PHP_SELF']));
$rc_route = isset($routes_data[$rc_slug]) ? $routes_data[$rc_slug] : null;
$rc_place = $trip['place'];
$rc_state = $rc_route ? $rc_route[1] : '';
$rc_km = (int) $trip['distance_km'];
$rc_hill = $rc_route ? $rc_route[3] : false;

// Two different towns with the same name (e.g. Pratapgarh) get the state in the title so the titles stay unique
$rc_title_place = $rc_place;
foreach ($routes_data as $other_slug => $other) {
    if ($rc_route && $other_slug !== $rc_slug && $other[0] === $rc_place && $other[5] === '' && $rc_route[5] === '' && $other[1] !== $rc_state) {
        $rc_title_place = $rc_place . ' (' . $rc_state . ')';
        break;
    }
}

// Words that change with the destination
if ($rc_hill) $rc_kind = 'scenic and refreshing hill destination';
elseif ($rc_km <= 80) $rc_kind = 'lively and well-connected place';
else $rc_kind = 'culturally rich and vibrant place';

$rc_nicknames = [
    'jaipur' => 'the Pink City', 'jodhpur' => 'the Blue City', 'udaipur' => 'the City of Lakes', 'jaisalmer' => 'the Golden City',
    'shimla' => 'the Queen of Hills', 'mussoorie' => 'the Queen of the Hills', 'nainital' => 'the Lake District of India',
    'rishikesh' => 'the Yoga Capital of the World', 'varanasi' => 'the Spiritual Capital of India', 'agra' => 'the City of the Taj',
    'amritsar' => 'the Holy City', 'lucknow' => 'the City of Nawabs', 'chandigarh' => 'the City Beautiful',
];
$rc_trip_to = isset($rc_nicknames[$rc_slug]) ? $rc_nicknames[$rc_slug] : $rc_place;

$rc_hour_words = [2 => 'two', 3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six', 7 => 'seven', 8 => 'eight', 9 => 'nine', 10 => 'ten', 11 => 'eleven', 12 => 'twelve'];
$rc_hours = (int) round(route_drive_hours($rc_km, $rc_hill));
$rc_duration = isset($rc_hour_words[$rc_hours]) ? 'for ' . $rc_hour_words[$rc_hours] . ' hours' : 'for the whole journey';
$rc_summer = 'the peak summer months of ' . ($rc_state !== '' ? $rc_state : 'North India');
$rc_crossing = $rc_state === 'Delhi' ? 'across the city' : 'across state lines';

// Keywords, highlighted wherever they appear in the copy
$rc_kw = [
    'tempo traveller on rent from delhi to {P}',
    '9 seater tempo traveller on rent in delhi for {P}',
    '12 seater tempo traveller hire in delhi for {P}',
    'book 16 seater luxury tempo traveller from delhi to {P}',
    '20 seater tempo traveller on rent from delhi to {P}',
    '26 seater tempo traveller hire from delhi to {P}',
    'online tempo traveller booking delhi to {P}',
];
$rc_fill = function ($text) use ($rc_place, $rc_kind, $rc_duration, $rc_summer, $rc_crossing) {
    return strtr($text, ['{P}' => $rc_place, '{KIND}' => $rc_kind, '{DURATION}' => $rc_duration, '{SUMMER}' => $rc_summer, '{CROSSING}' => $rc_crossing]);
};
$rc_body = function ($text) use ($rc_fill, $rc_kw) {
    $html = htmlspecialchars($rc_fill($text), ENT_NOQUOTES, 'UTF-8');
    foreach ($rc_kw as $i => $kw) {
        if ($i === 0) continue; // handled last: it is also part of the 20 seater phrase
        $kw = htmlspecialchars($rc_fill($kw), ENT_NOQUOTES, 'UTF-8');
        $html = str_replace($kw, '<strong>' . $kw . '</strong>', $html);
    }
    $kw = htmlspecialchars($rc_fill($rc_kw[0]), ENT_NOQUOTES, 'UTF-8');
    $html = preg_replace('/(?<!seater )' . preg_quote($kw, '/') . '/', '<strong>' . $kw . '</strong>', $html);
    return str_replace('The Delhi Tempo Traveller on Rent', 'The <strong>Delhi Tempo Traveller on Rent</strong>', $html);
};

// ---------------------------------------------------------------------------
// Page copy
// ---------------------------------------------------------------------------
$trip['lead'] = $rc_fill('Book a 9, 12, 16 luxury, 20, or 26 seater tempo traveller on rent from Delhi to {P}. Enjoy premium seats, expert drivers, and seamless online booking.');

$trip['intro'] = [$rc_body(<<<'TXT'
Embarking on a road trip with a large group of people is an incredibly exciting experience, especially when your destination is a {KIND} like {P}. The Delhi Tempo Traveller on Rent offers beautiful landscapes, amazing local food stops, and the perfect opportunity to bond with your family, friends, or colleagues. However, the success of any group trip relies heavily on the quality of your transportation. When you choose us as your dedicated travel service provider, you are not just hiring a vehicle; you are investing in comfort, safety, and absolute peace of mind. We understand the specific demands of highway travel and have built a fleet of premium commercial vehicles designed to make your journey completely stress-free. Whether you need a compact vehicle for a small family or a massive coach for a grand corporate event, we provide a seamless travel solution tailored to your exact group size and budget.
TXT
)];

$trip['main_copy'] = [$rc_fill('Tempo Traveller On Rent From Delhi To {P}'), $rc_body(<<<'TXT'
Planning a group vacation requires careful coordination, and figuring out the transportation is usually the most challenging part. Deciding to get a tempo traveller on rent from delhi to {P} is the most practical and enjoyable decision you can make for your group. When you travel in separate cars, the group gets divided, the drivers arrive exhausted from navigating heavy highway traffic, and the overall fun of a shared journey is lost. By choosing a dedicated multi-seater vehicle, your entire group stays together under one roof, sharing stories, watching movies, and enjoying the highway experience as a single unit. As a responsible service provider, we ensure that every vehicle in our fleet undergoes strict quality checks before it reaches your pickup location. The engines are regularly serviced to prevent any breakdowns, the air conditioning systems are optimized for long journeys, and the interiors are thoroughly cleaned and sanitized. When you search for a tempo traveller on rent from delhi to {P}, you are looking for reliability, and that is exactly what we deliver. Our drivers are highly experienced professionals who understand highway driving dynamics perfectly. They know exactly how to maintain a smooth and steady speed so that the passengers in the back rows do not feel any bumps, harsh braking, or sharp turns. By selecting our rental services, you are choosing ultimate comfort, allowing you to simply recline your seat, relax, and watch the beautiful transition of landscapes through the large panoramic windows.
TXT
)];

$trip['vehicle_copy'] = [
    ['fa-van-shuttle', $rc_fill('9 Seater Tempo Traveller On Rent In Delhi For {P}'), $rc_body(<<<'TXT'
Small families and tight-knit friend circles often struggle to decide whether to cram into a single standard SUV or take two separate sedans for their road trip. Taking a 9 seater tempo traveller on rent in delhi for {P} completely eliminates this confusion and provides a massive upgrade in travel quality. This compact yet highly spacious vehicle is the perfect middle ground for groups of seven to nine people. It offers the cozy intimacy of a personal car but provides the generous legroom, headroom, and aisle space of a commercial travel coach. You no longer have to fight for elbow room or sit with heavy travel bags on your lap {DURATION}. We have designed the interiors of our nine-seater vehicles to maximize passenger comfort, ensuring that even the last row feels just as comfortable and spacious as the front captain seats. If you are looking for a 9 seater tempo traveller on rent in delhi for {P}, you will be thrilled with our dedicated rear luggage compartment that easily swallows up all your weekend bags, leaving the main passenger cabin completely clutter-free. The air conditioning system in this compact model is highly efficient, rapidly cooling the entire cabin evenly even during {SUMMER}. Our clients constantly praise the agility of this specific vehicle, as it navigates through city traffic smoothly while providing a stable, highly comfortable, and quiet ride on the open highway.
TXT
    )],
    ['fa-people-group', $rc_fill('12 Seater Tempo Traveller Hire In Delhi For {P}'), $rc_body(<<<'TXT'
When two families decide to travel together, or when you are organizing a trip with an extended group of relatives, a slightly larger vehicle becomes absolutely essential. Opting for a 12 seater tempo traveller hire in delhi for {P} is specifically designed for these mid-sized groups. This vehicle category bridges the gap seamlessly between small family vans and heavy-duty commercial coaches. The seating arrangement is carefully configured to provide a comfortable center aisle, allowing passengers to move around, swap seats, and interact with each other easily without stepping over anyone. Each seat is designed with superior ergonomic back support and high-quality cushioning, ensuring that the several hours spent on the road do not result in any backaches or travel fatigue. We understand that mid-sized groups often carry a significant amount of luggage, which is why when you choose our 12 seater tempo traveller hire in delhi for {P}, you get a vehicle featuring an extended boot space area to keep your bags secure. As a premium service provider, we also ensure that the entertainment system in this vehicle is top-notch, featuring excellent speakers and seamless Bluetooth connectivity so your group can play their favorite road trip playlists continuously. The heavy-duty suspension system on our twelve-seater fleet is specifically tuned for long highway cruising, absorbing uneven road surfaces effortlessly and delivering a whisper-quiet cabin experience so you can chat or sleep without any disturbance.
TXT
    )],
    ['fa-crown', $rc_fill('Book 16 Seater Luxury Tempo Traveller From Delhi To {P}'), $rc_body(<<<'TXT'
There are certain journeys that demand an elevated level of comfort, sophistication, and a touch of elegance. If you are traveling with senior corporate executives, hosting foreign delegates, or simply want to treat your family to a VIP road trip experience, you should definitely book 16 seater luxury tempo traveller from delhi to {P} with our agency. We have customized this specific luxury segment to meet the absolute highest standards of hospitality and premium comfort. The interiors of these premium vehicles are vastly different from standard transport models. You are immediately greeted by rich, high-quality upholstery, superior push-back reclining captain seats that offer airline-level comfort, and elegant ambient LED lighting that sets a relaxing mood for evening or night journeys. The legroom is extraordinarily generous, allowing even the tallest passengers to stretch their legs fully and sleep peacefully. When you decide to book 16 seater luxury tempo traveller from delhi to {P}, you also get an advanced climate control system that is highly precise, featuring individual overhead AC vents for every single passenger so they can adjust the airflow exactly to their liking. Our chauffeurs assigned to these luxury vehicles are highly trained in professional etiquette, always arriving in crisp uniforms and ready to assist you politely with your luggage. When you choose this premium service, you are not just booking a ride; you are securing a highly sophisticated travel environment that reflects your exquisite taste and high standards.
TXT
    )],
    ['fa-bus', $rc_fill('20 Seater Tempo Traveller On Rent From Delhi To {P}'), $rc_body(<<<'TXT'
Managing transportation for a large gathering can quickly turn into a logistical nightmare if not handled properly by professionals. Coordinating multiple small cabs, ensuring everyone leaves the pickup point at the exact same time, and making sure nobody gets lost on the highway is exhausting and stressful. Taking a 20 seater tempo traveller on rent from delhi to {P} solves all these massive logistical headaches instantly. This highly capable, heavy-duty vehicle is the absolute favorite for college industrial visits, large wedding parties, and major corporate team-building outings. Keeping twenty people together in one moving space creates an incredible atmosphere of fun, laughter, and bonding that you simply cannot replicate in divided transport. Despite its large physical size, we ensure that the vehicle maintains a high standard of individual passenger comfort. If you are searching for a 20 seater tempo traveller on rent from delhi to {P}, our fleet guarantees powerful dual air-conditioning compressors to ensure that the chilled air reaches the very last row effortlessly, even during afternoon journeys. The wide sliding doors and low steps make boarding and alighting completely hassle-free, which is incredibly helpful for elderly passengers and young children. As your service provider, we also take the responsibility of luggage management very seriously. This vehicle comes with massive storage capacities, including a deep rear boot space and internal overhead racks for smaller carry-on items, ensuring the passenger gangway remains completely clear and safe.
TXT
    )],
    ['fa-bus-simple', $rc_fill('26 Seater Tempo Traveller Hire From Delhi To {P}'), $rc_body(<<<'TXT'
For the grandest of travel plans and the biggest of groups, our highest capacity vehicles stand ready to serve you with unmatched reliability. Opting for a 26 seater tempo traveller hire from delhi to {P} is the ultimate, most cost-effective solution for massive family reunions, significant corporate offsite events, or moving an entire wedding guest list {CROSSING} comfortably. Operating a vehicle of this massive size requires a deep, unwavering commitment to safety and mechanical maintenance, and we take this responsibility very seriously. These high-capacity coaches are built on heavy-duty commercial chassis and equipped with advanced braking systems to handle the weight of twenty-six passengers and their heavy luggage completely securely. The sheer size of the cabin feels incredibly vast and spacious, closely resembling a private chartered bus rather than a standard van. When you finalize a 26 seater tempo traveller hire from delhi to {P} with us, we maintain rigorous pre-trip safety protocols, conducting thorough tire tread inspections, brake fluid tests, and steering alignments before every single dispatch. The drivers assigned to these large coaches possess specialized commercial heavy-vehicle licenses and have decades of proven experience handling large vehicle dimensions on busy highways. They drive with extreme caution, prioritizing a smooth, steady pace over aggressive overtaking, ensuring that your massive group travels with the absolute highest level of security, stability, and comfort.
TXT
    )],
    ['fa-laptop', $rc_fill('Online Tempo Traveller Booking Delhi To {P}'), $rc_body(<<<'TXT'
We live in a fast-paced digital world where convenience, speed, and transparency are highly valued by every traveler. We have completely streamlined our reservation process so that securing your group vehicle is completely stress-free and takes only a few minutes. Through our seamless online tempo traveller booking delhi to {P} system, you can finalize your entire travel plans from the comfort of your home or office without ever needing to visit a physical taxi stand or negotiate with local brokers. We believe in building long-term trust with our clients through absolute transparency, which is why our digital booking process clearly displays all the costs upfront. There are absolutely no hidden fees, no surprise driver charges at the end of the trip, and no ambiguous toll tax calculations to worry about. Everything is discussed, documented, and emailed clearly before you confirm your ride. Using our online tempo traveller booking delhi to {P} platform guarantees that your selected vehicle is instantly blocked in our inventory for your specific travel dates. Our dedicated customer support team is always available online and over the phone to help you choose the right seating capacity for your group, accommodate any special routing requests, and provide you with the exact vehicle number and driver details well before your departure time. We have built our strong SEO presence and industry reputation as a reliable service provider by simply keeping our promises, respecting your time, and delivering a flawless travel experience.
TXT
    )],
];

// The owner's seating range everywhere the page states one
foreach ($trip['facts'] as $rc_i => $rc_fact) {
    if ($rc_fact[1] === 'Vehicle Options') $trip['facts'][$rc_i][0] = '9-26 Seats';
}
foreach ($trip['features'] as $rc_i => $rc_feature) {
    if (stripos($rc_feature, 'Seater') !== false) $trip['features'][$rc_i] = '9/12/16/20/26 Seater Tempo';
}

// Visible FAQs use the full answers, the FAQ schema uses the owner's shorter ones
$trip['faqs'] = [
    ['How do you determine the pricing and billing for a group trip?', 'We operate with a completely transparent billing policy that we share with you before the journey begins. The total cost is calculated based on a fixed per-kilometer rate depending on the seating capacity of the vehicle you choose. We also clearly outline the daily driver allowance, state taxes, and expected toll booth charges so you have a precise budget in mind. There are absolutely no hidden costs or surprise demands made at the end of your trip.'],
    ['Are your drivers comfortable and experienced with driving late at night?', 'Yes, night driving safety is one of our top priorities. We only employ highly experienced commercial drivers who are fully accustomed to highway travel at all hours. They are well-rested before night trips and strictly follow safe driving protocols. You and your group can comfortably recline your seats and sleep peacefully knowing that a seasoned professional is navigating the roads securely.'],
    ['How does the luggage space work for vehicles with maximum seating capacity?', 'We carefully match the luggage capacity with the seating capacity of every vehicle in our fleet. For smaller groups, the rear boot space is more than sufficient. For larger groups booking the twenty or twenty-six-seater options, the vehicles are equipped with deepened rear storage areas and overhead cabin racks to accommodate heavy suitcases securely without cluttering the passenger seating area or blocking the aisle.'],
    ['What is the procedure to confirm a reservation and block a vehicle?', 'Confirming your ride with us is a very straightforward process. Once you select your desired vehicle and travel dates, we request a nominal advance token payment. This advance payment instantly blocks the vehicle in our system specifically for you, guaranteeing its availability on your travel day. The remaining balance can be settled easily during the trip itself directly with the driver or via our online payment portals.'],
];
$trip['faq_schema'] = [
    [$trip['faqs'][0][0], 'We operate with a completely transparent billing policy based on a fixed per-kilometer rate depending on the seating capacity. We clearly outline the daily driver allowance, state taxes, and toll booth charges with absolutely no hidden costs.'],
    [$trip['faqs'][1][0], 'Yes, night driving safety is one of our top priorities. We employ highly experienced commercial drivers who are fully accustomed to highway travel at all hours and strictly follow safe driving protocols.'],
    [$trip['faqs'][2][0], 'We carefully match luggage capacity with seating capacity. For 20 or 26-seater options, vehicles are equipped with deepened rear storage areas and overhead cabin racks to accommodate heavy suitcases securely without blocking the aisle.'],
    [$trip['faqs'][3][0], 'Once you select your desired vehicle and travel dates, we request a nominal advance token payment. This instantly blocks the vehicle in our system for your travel day. The remaining balance can be settled during the trip.'],
];

// ---------------------------------------------------------------------------
// Title, meta tags and social cards (rendered by header.php)
// ---------------------------------------------------------------------------
$page_title = 'Tempo Traveller on Rent from Delhi to ' . $rc_title_place . ' | 9 to 26 Seater';
if (strlen($page_title) > 70) $page_title = 'Tempo Traveller on Rent from Delhi to ' . $rc_title_place;
$page_description = 'Book a 9, 12, 16 luxury, 20, or 26 seater tempo traveller on rent from Delhi to ' . $rc_title_place . '. Enjoy premium seats, expert drivers, and seamless online booking.';
$meta_keywords = implode(', ', array_map(function ($kw) use ($rc_fill) { return $rc_fill($kw); }, $rc_kw));
$og_title = 'Tempo Traveller on Rent from Delhi to ' . $rc_title_place . ' | Book Online';
$og_description = 'Planning a group trip to ' . $rc_trip_to . '? Hire 9 to 26 seater premium and luxury tempo travellers from Delhi to ' . $rc_place . ' with transparent pricing and no hidden costs.';
$twitter_title = $og_title;
$twitter_description = 'Hire 9, 12, 16 luxury, 20, and 26 seater tempo travellers from Delhi to ' . $rc_place . '. Safe, comfortable, and affordable group travel.';
$page_image_alt = 'Tempo Traveller on Rent from Delhi to ' . $rc_title_place;

// ---------------------------------------------------------------------------
// AutoRental schema (the FAQ schema is built by trip-page.php from $trip['faq_schema'])
// ---------------------------------------------------------------------------
$trip['rental_schema'] = [
    '@context' => 'https://schema.org',
    '@type' => 'AutoRental',
    'name' => 'Delhi Tempo Traveller On Rent',
    'url' => $canonical_url,
    'image' => 'https://www.delhitempotravelleronrent.com/' . $trip['hero_image'],
    'description' => 'Premium service provider offering 9, 12, 16, 20, and 26 seater tempo travellers on rent from Delhi to ' . $rc_place . ' for family, friends, and corporate groups.',
    'telephone' => '+91-7290885949',
    'priceRange' => '$$',
    'address' => ['@type' => 'PostalAddress', 'addressLocality' => 'Delhi', 'addressRegion' => 'Delhi', 'addressCountry' => 'IN'],
    'areaServed' => ['@type' => 'City', 'name' => $rc_place],
    'serviceArea' => [
        '@type' => 'GeoCircle',
        'geoMidpoint' => ['@type' => 'GeoCoordinates', 'latitude' => '28.6139', 'longitude' => '77.2090'],
        'geoRadius' => (string) max(300000, $rc_km * 1000), // must reach the destination, however far it is
    ],
];
