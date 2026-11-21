<?php
// 12 Seater Tempo Traveller on Rent in Delhi — vehicle landing page, rendered by trip-page.php (kind 'local').
require_once 'landing-common.php';
$page_title = '12 Seater Tempo Traveller on Rent in Delhi – ₹30/km';
$page_description = 'Hire a 12 seater tempo traveller on rent in Delhi NCR at ₹30/km. AC pushback seats, experienced driver, local & outstation trips. Call +91 7290885949.';
$canonical_url = 'https://www.delhitempotravelleronrent.com/12-seater-tempo-traveller-on-rent-in-delhi.php';

$trip = [
    'kind' => 'local',
    'place' => 'Delhi',
    'name' => '12 Seater Tempo Traveller on Rent in Delhi',
    'h1' => '12 Seater Tempo Traveller on Rent in Delhi',
    'hero_image' => 'images/tempo12.webp',
    'hero_alt' => '12 seater tempo traveller on rent in Delhi',
    'price_from' => '₹30',
    'price_unit' => '/km',
    'lead' => 'Book a 12 seater AC tempo traveller in Delhi NCR with an experienced driver, ideal for families, small office teams and friends groups of 8 to 12 people. Doorstep pickup across Delhi, Noida, Gurugram, Ghaziabad and Faridabad at ₹30/km.',
    'facts' => [
        ['₹30/km', 'Per-km Rate', 'fas fa-tags'],
        ['9–12 pushback seats (2x1)', 'Seating', 'fas fa-chair'],
        ['Rear boot + roof carrier', 'Luggage', 'fas fa-suitcase-rolling'],
        ['Families & small groups', 'Best For', 'fas fa-users'],
    ],
    'intro' => [
        'Our <strong>12 seater tempo traveller on rent in Delhi</strong> is built for families, small office teams and friends groups of 8 to 12 people. Every vehicle comes with a verified, experienced driver, and you can book it for a day out in Delhi NCR, an outstation trip or a multi-day tour.',
        'The 12 seater is our most booked vehicle. It has 9–12 pushback seats in a 2x1 layout, a separate luggage area at the back and roof carrier, AC with individual vents, and enough headroom to walk to your seat. It is the right choice for a family trip to Agra, Haridwar or Jaipur, a Char Dham Yatra for a small group, or airport and wedding transfers.',
    ],
    'features' => $landing_features,
    'about' => [
        'The 12 seater is charged at <strong>₹30 per km</strong>. Billable km is the round-trip distance or 250 km per day, whichever is higher, so a 1-day trip starts at ₹7,500 and a 2-day trip at ₹15,000. Only fuel is included; toll, state tax, parking, driver allowance, driver night charge and GST are extra.',
        'Need a different size? Compare the <a href="16-seater-tempo-traveller-on-rent-in-delhi.php">16 seater</a> <a href="20-seater-tempo-traveller-on-rent-in-delhi.php">20 seater</a> tempo travellers, or the luxury <a href="maharaja-tempo-traveller-on-rent-in-delhi.php">Maharaja tempo traveller</a>. See every vehicle on our <a href="fleet.php">fleet page</a>.',
    ],
    'localities' => [],
    'extras_strip' => true,
    'guide' => [],
    'highlights' => $landing_examples('12 seater', 30),
    'price_rows' => $landing_price_rows(),
    'reviews' => [],
    'faqs' => array_merge([
        ['What is the 12 seater tempo traveller rent per km in Delhi?', 'A 12 seater tempo traveller in Delhi costs <strong>₹30 per km</strong>, billed on the round-trip distance or 250 km per day, whichever is higher. A 1-day outstation trip starts at ₹7,500 (250 km) before extras.'],
        ['How many people can travel in a 12 seater tempo traveller?', 'Up to 12 passengers plus the driver. For a comfortable long trip with luggage we suggest 9–11 adults; for bigger groups, see our <a href="16-seater-tempo-traveller-on-rent-in-delhi.php">16 seater tempo traveller</a>.'],
        ['Is a 12 seater tempo traveller good for hill stations?', 'Yes. The 12 seater is compact enough for hill roads to Shimla, Manali, Mussoorie and Nainital, and our drivers are experienced on mountain routes. The AC is switched off in hilly areas.'],
    ], $landing_common_faqs),
    'searches' => ['12 Seater Tempo Traveller on Rent in Delhi', '12 Seater Tempo Traveller Price per km', '12 Seater Tempo Traveller Delhi NCR', '12 Seater Tempo Traveller for Outstation', '12 Seater Tempo Hire Delhi'],
    'region' => 'uk',
    'calculator' => $landing_calculator('12 Seater Tempo Traveller on Rent in Delhi', 230, 1),
    'text' => [
        'eyebrow' => '12 Seater Tempo Traveller',
        'service_type' => '12 seater tempo traveller rental',
        'overview_h2' => '12 Seater Tempo Traveller Hire in Delhi NCR',
        'fares_h2' => '12 Seater Tempo Traveller Price in Delhi',
        'highlights_tag' => 'Example Fares',
        'highlights_h2' => 'Popular Trips in a 12 Seater Tempo Traveller',
        'highlights_intro' => 'Round-trip examples at ₹30/km (billable km = round trip or 250 km/day, whichever is higher). Toll, state tax, parking, driver allowance and GST are extra.',
        'highlights_alt' => '12 seater tempo traveller hire in Delhi',
        'faq_intro' => 'Quick answers about hiring a 12 seater tempo traveller in Delhi.',
        'about_tag' => '12 Seater Pricing',
        'about_h2' => '12 Seater Tempo Traveller Price & Options',
    ],
];

include 'trip-page.php';
