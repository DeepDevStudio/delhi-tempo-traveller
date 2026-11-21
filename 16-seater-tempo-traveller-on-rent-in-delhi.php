<?php
// 16 Seater Tempo Traveller on Rent in Delhi — vehicle landing page, rendered by trip-page.php (kind 'local').
require_once 'landing-common.php';
$page_title = '16 Seater Tempo Traveller on Rent in Delhi – ₹35/km';
$page_description = 'Hire a 16 seater tempo traveller on rent in Delhi NCR at ₹35/km. AC pushback seats, experienced driver, local & outstation trips. Call +91 7290885949.';
$canonical_url = 'https://www.delhitempotravelleronrent.com/16-seater-tempo-traveller-on-rent-in-delhi.php';

$trip = [
    'kind' => 'local',
    'place' => 'Delhi',
    'name' => '16 Seater Tempo Traveller on Rent in Delhi',
    'h1' => '16 Seater Tempo Traveller on Rent in Delhi',
    'hero_image' => 'images/tempo12.webp',
    'hero_alt' => '16 seater tempo traveller on rent in Delhi',
    'price_from' => '₹35',
    'price_unit' => '/km',
    'lead' => 'Book a 16 seater AC tempo traveller in Delhi NCR with an experienced driver, ideal for extended families, wedding parties, school and college groups and office teams of 13 to 16 people. Doorstep pickup across Delhi, Noida, Gurugram, Ghaziabad and Faridabad at ₹35/km.',
    'facts' => [
        ['₹35/km', 'Per-km Rate', 'fas fa-tags'],
        ['13–16 pushback seats (2x1)', 'Seating', 'fas fa-chair'],
        ['Rear boot + roof carrier', 'Luggage', 'fas fa-suitcase-rolling'],
        ['Mid-size groups & weddings', 'Best For', 'fas fa-users'],
    ],
    'intro' => [
        'Our <strong>16 seater tempo traveller on rent in Delhi</strong> is built for extended families, wedding parties, school and college groups and office teams of 13 to 16 people. Every vehicle comes with a verified, experienced driver, and you can book it for a day out in Delhi NCR, an outstation trip or a multi-day tour.',
        'The 16 seater is longer than the 12 seater, with extra rows of pushback seats, more legroom and space for the bags of a bigger group. It is the popular choice for wedding guest transfers, corporate offsites, college trips and pilgrimages like Char Dham, Vaishno Devi and Khatu Shyam.',
    ],
    'features' => $landing_features,
    'about' => [
        'The 16 seater is charged at <strong>₹35 per km</strong>. Billable km is the round-trip distance or 250 km per day, whichever is higher, so a 1-day trip starts at ₹8,750 and a 2-day trip at ₹17,500. Only fuel is included; toll, state tax, parking, driver allowance, driver night charge and GST are extra.',
        'Need a different size? Compare the <a href="12-seater-tempo-traveller-on-rent-in-delhi.php">12 seater</a> <a href="20-seater-tempo-traveller-on-rent-in-delhi.php">20 seater</a> tempo travellers, or the luxury <a href="maharaja-tempo-traveller-on-rent-in-delhi.php">Maharaja tempo traveller</a>. See every vehicle on our <a href="fleet.php">fleet page</a>.',
    ],
    'localities' => [],
    'extras_strip' => true,
    'guide' => [],
    'highlights' => $landing_examples('16 seater', 35),
    'price_rows' => $landing_price_rows(),
    'reviews' => [],
    'faqs' => array_merge([
        ['What is the 16 seater tempo traveller rent per km in Delhi?', 'A 16 seater tempo traveller in Delhi costs <strong>₹35 per km</strong>, billed on the round-trip distance or 250 km per day, whichever is higher. A 1-day outstation trip starts at ₹8,750 (250 km) before extras.'],
        ['How many people can travel in a 16 seater tempo traveller?', 'Up to 16 passengers plus the driver. With heavy luggage on a long trip, 13–15 adults is the most comfortable. Smaller group? See the <a href="12-seater-tempo-traveller-on-rent-in-delhi.php">12 seater tempo traveller</a>; bigger group? See the <a href="20-seater-tempo-traveller-on-rent-in-delhi.php">20 seater</a>.'],
        ['Is the 16 seater tempo traveller available as a Maharaja (luxury) version?', 'Yes. We also have a 16 seater Maharaja tempo with luxury recliner seats, LED lights and a music system at ₹40/km. See <a href="maharaja-tempo-traveller-on-rent-in-delhi.php">Maharaja tempo traveller on rent in Delhi</a>.'],
    ], $landing_common_faqs),
    'searches' => ['16 Seater Tempo Traveller on Rent in Delhi', '16 Seater Tempo Traveller Price per km', '16 Seater Tempo Traveller Delhi NCR', '16 Seater Tempo Traveller for Outstation', '16 Seater Tempo Hire Delhi'],
    'region' => 'uk',
    'calculator' => $landing_calculator('16 Seater Tempo Traveller on Rent in Delhi', 280, 1),
    'text' => [
        'eyebrow' => '16 Seater Tempo Traveller',
        'service_type' => '16 seater tempo traveller rental',
        'overview_h2' => '16 Seater Tempo Traveller Hire in Delhi NCR',
        'fares_h2' => '16 Seater Tempo Traveller Price in Delhi',
        'highlights_tag' => 'Example Fares',
        'highlights_h2' => 'Popular Trips in a 16 Seater Tempo Traveller',
        'highlights_intro' => 'Round-trip examples at ₹35/km (billable km = round trip or 250 km/day, whichever is higher). Toll, state tax, parking, driver allowance and GST are extra.',
        'highlights_alt' => '16 seater tempo traveller hire in Delhi',
        'faq_intro' => 'Quick answers about hiring a 16 seater tempo traveller in Delhi.',
        'about_tag' => '16 Seater Pricing',
        'about_h2' => '16 Seater Tempo Traveller Price & Options',
    ],
];

include 'trip-page.php';
