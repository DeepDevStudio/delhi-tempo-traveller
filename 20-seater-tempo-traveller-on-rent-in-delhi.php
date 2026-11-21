<?php
// 20 Seater Tempo Traveller on Rent in Delhi — vehicle landing page, rendered by trip-page.php (kind 'local').
require_once 'landing-common.php';
$page_title = '20 Seater Tempo Traveller on Rent in Delhi – ₹40/km';
$page_description = 'Hire a 20 seater tempo traveller on rent in Delhi NCR at ₹40/km. AC pushback seats, experienced driver, local & outstation trips. Call +91 7290885949.';
$canonical_url = 'https://www.delhitempotravelleronrent.com/20-seater-tempo-traveller-on-rent-in-delhi.php';

$trip = [
    'kind' => 'local',
    'place' => 'Delhi',
    'name' => '20 Seater Tempo Traveller on Rent in Delhi',
    'h1' => '20 Seater Tempo Traveller on Rent in Delhi',
    'hero_image' => 'images/tempo12.webp',
    'hero_alt' => '20 seater tempo traveller on rent in Delhi',
    'price_from' => '₹40',
    'price_unit' => '/km',
    'lead' => 'Book a 20 seater AC tempo traveller in Delhi NCR with an experienced driver, ideal for large families, wedding baraats, corporate teams, schools and pilgrim groups of 17 to 20 people. Doorstep pickup across Delhi, Noida, Gurugram, Ghaziabad and Faridabad at ₹40/km.',
    'facts' => [
        ['₹40/km', 'Per-km Rate', 'fas fa-tags'],
        ['17–20 pushback seats', 'Seating', 'fas fa-chair'],
        ['Rear boot + roof carrier', 'Luggage', 'fas fa-suitcase-rolling'],
        ['Large groups & events', 'Best For', 'fas fa-users'],
    ],
    'intro' => [
        'Our <strong>20 seater tempo traveller on rent in Delhi</strong> is built for large families, wedding baraats, corporate teams, schools and pilgrim groups of 17 to 20 people. Every vehicle comes with a verified, experienced driver, and you can book it for a day out in Delhi NCR, an outstation trip or a multi-day tour.',
        'The 20 seater is the biggest tempo traveller in our regular fleet. It keeps a group of up to 20 together in one vehicle, which is cheaper and easier to manage than booking two cars or two smaller tempos. It is popular for weddings, company outings, school trips and group yatras to Haridwar, Rishikesh, Vrindavan and Khatu Shyam.',
    ],
    'features' => $landing_features,
    'about' => [
        'The 20 seater is charged at <strong>₹40 per km</strong>. Billable km is the round-trip distance or 250 km per day, whichever is higher, so a 1-day trip starts at ₹10,000 and a 2-day trip at ₹20,000. Only fuel is included; toll, state tax, parking, driver allowance, driver night charge and GST are extra.',
        'Need a different size? Compare the <a href="12-seater-tempo-traveller-on-rent-in-delhi.php">12 seater</a> <a href="16-seater-tempo-traveller-on-rent-in-delhi.php">16 seater</a> tempo travellers, or the luxury <a href="maharaja-tempo-traveller-on-rent-in-delhi.php">Maharaja tempo traveller</a>. See every vehicle on our <a href="fleet.php">fleet page</a>.',
    ],
    'localities' => [],
    'extras_strip' => true,
    'guide' => [],
    'highlights' => $landing_examples('20 seater', 40),
    'price_rows' => $landing_price_rows(),
    'reviews' => [],
    'faqs' => array_merge([
        ['What is the 20 seater tempo traveller rent per km in Delhi?', 'A 20 seater tempo traveller in Delhi costs <strong>₹40 per km</strong>, billed on the round-trip distance or 250 km per day, whichever is higher. A 1-day outstation trip starts at ₹10,000 (250 km) before extras.'],
        ['How many people can travel in a 20 seater tempo traveller?', 'Up to 20 passengers plus the driver. For groups larger than 20 we also have a 25 seater at ₹43/km, or we can send two vehicles that travel together.'],
        ['Is a 20 seater tempo traveller cheaper than two cars?', 'Usually yes. Two Innova Crystas cost more per km than one 20 seater, and the group stays together with one driver and one set of tolls and parking.'],
    ], $landing_common_faqs),
    'searches' => ['20 Seater Tempo Traveller on Rent in Delhi', '20 Seater Tempo Traveller Price per km', '20 Seater Tempo Traveller Delhi NCR', '20 Seater Tempo Traveller for Outstation', '20 Seater Tempo Hire Delhi'],
    'region' => 'uk',
    'calculator' => $landing_calculator('20 Seater Tempo Traveller on Rent in Delhi', 280, 1),
    'text' => [
        'eyebrow' => '20 Seater Tempo Traveller',
        'service_type' => '20 seater tempo traveller rental',
        'overview_h2' => '20 Seater Tempo Traveller Hire in Delhi NCR',
        'fares_h2' => '20 Seater Tempo Traveller Price in Delhi',
        'highlights_tag' => 'Example Fares',
        'highlights_h2' => 'Popular Trips in a 20 Seater Tempo Traveller',
        'highlights_intro' => 'Round-trip examples at ₹40/km (billable km = round trip or 250 km/day, whichever is higher). Toll, state tax, parking, driver allowance and GST are extra.',
        'highlights_alt' => '20 seater tempo traveller hire in Delhi',
        'faq_intro' => 'Quick answers about hiring a 20 seater tempo traveller in Delhi.',
        'about_tag' => '20 Seater Pricing',
        'about_h2' => '20 Seater Tempo Traveller Price & Options',
    ],
];

include 'trip-page.php';
