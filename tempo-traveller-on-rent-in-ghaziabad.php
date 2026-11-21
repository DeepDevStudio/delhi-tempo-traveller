<?php
// Tempo Traveller on Rent in Ghaziabad — city landing page, rendered by trip-page.php (kind 'local').
require_once 'landing-common.php';
$page_title = 'Tempo Traveller on Rent in Ghaziabad – ₹30/km | 12–20 Seater';
$page_description = 'Tempo traveller on rent in Ghaziabad, Indirapuram & Vaishali from ₹30/km. 12, 16, 20 seater AC and Maharaja tempo with driver. Call +91 7290885949.';
$canonical_url = 'https://www.delhitempotravelleronrent.com/tempo-traveller-on-rent-in-ghaziabad.php';

$trip = [
    'kind' => 'local',
    'place' => 'Ghaziabad',
    'name' => 'Tempo Traveller on Rent in Ghaziabad',
    'h1' => 'Tempo Traveller on Rent in Ghaziabad',
    'hero_image' => 'images/haridwar-hero-bg.webp',
    'hero_alt' => 'tempo traveller on rent in Ghaziabad',
    'price_from' => '₹30',
    'price_unit' => '/km',
    'lead' => 'Hire a 12, 16 or 20 seater AC tempo traveller in Ghaziabad with an experienced driver. Doorstep pickup from Indirapuram, Vaishali, Raj Nagar Extension, Kaushambi and Crossings Republik, from ₹30/km.',
    'facts' => [
        ['From ₹30/km', 'Starting Fare', 'fas fa-tags'],
        ['12–25 Seats', 'Vehicle Options', 'fas fa-users'],
        ['All Ghaziabad', 'Pickup Area', 'fas fa-location-dot'],
        ['24/7', 'Booking Support', 'fas fa-headset'],
    ],
    'intro' => [
        'Booking a <strong>tempo traveller on rent in Ghaziabad</strong> is the easiest way for families, wedding parties and pilgrim groups to travel together. We pick you up from home in any part of Ghaziabad, so nobody has to cross into Delhi first.',
        'Ghaziabad is the gateway to Uttarakhand: the <strong>Delhi–Meerut Expressway</strong> gets you onto the Haridwar highway within minutes, which makes Haridwar, Rishikesh, Mussoorie, Nainital and Jim Corbett the most popular trips from here. Groups also book us for Mathura–Vrindavan darshan, Agra day trips and Char Dham Yatra.',
    ],
    'features' => $landing_features,
    'about' => [
        'From Ghaziabad, Haridwar is about 190 km (around 4 hours) and Rishikesh about 215 km via the Meerut Expressway and NH-334, so an early-morning start puts you on the ghats by lunchtime. Our drivers know the society gates in Indirapuram, Vaishali and Raj Nagar Extension, and plan pickups around NH-9 traffic.',
        'Fares follow our Delhi rate card: ₹30/km for a 12 seater, ₹35/km for a 16 seater and ₹40/km for a 20 seater, billed on the round-trip distance or 250 km a day, whichever is higher.',
    ],
    'localities' => [
        'Ghaziabad' => ['icon' => 'fa-city', 'items' => ['Indirapuram', 'Vaishali', 'Vasundhara', 'Kaushambi', 'Raj Nagar', 'Raj Nagar Extension', 'Crossings Republik', 'Kavi Nagar', 'Govindpuram', 'Mohan Nagar', 'Ghaziabad Railway Station']],
    ],
    'extras_strip' => true,
    'guide' => [],
    'highlights' => [
        'Ghaziabad to Haridwar & Rishikesh via Meerut Expressway (about 190–215 km)',
        'Ghaziabad to Mussoorie & Dehradun (about 250 km)',
        'Ghaziabad to Nainital & Jim Corbett (about 230–280 km)',
        'Ghaziabad to Mathura–Vrindavan & Agra',
        'Char Dham Yatra by tempo traveller from Ghaziabad',
        'Wedding baraat and guest transfers across Ghaziabad',
    ],
    'price_rows' => $landing_price_rows(),
    'reviews' => [],
    'faqs' => array_merge([
        ['What is the tempo traveller rent in Ghaziabad?', 'Tempo traveller rent in Ghaziabad starts from <strong>₹30/km</strong> for a 12 seater, ₹35/km for a 16 seater and ₹40/km for a 20 seater. Outstation trips are billed for at least 250 km per day.'],
        ['How far is Haridwar from Ghaziabad by tempo traveller?', 'Haridwar is about 190 km from Ghaziabad via the Delhi–Meerut Expressway, roughly 4 hours by tempo traveller depending on traffic.'],
        ['Do you pick up from Indirapuram, Vaishali and Raj Nagar Extension?', 'Yes. We pick up from every part of Ghaziabad, including Indirapuram, Vaishali, Vasundhara, Raj Nagar Extension and Crossings Republik, at the same rates.'],
    ], $landing_common_faqs),
    'searches' => ['Tempo Traveller on Rent in Ghaziabad', 'Tempo Traveller in Indirapuram', '12 Seater Tempo Traveller Ghaziabad', 'Ghaziabad to Haridwar Tempo Traveller', 'Tempo Traveller Hire Vaishali'],
    'region' => 'uk',
    'calculator' => $landing_calculator('Tempo Traveller on Rent in Ghaziabad', 190, 2),
    'text' => [
        'eyebrow' => 'Tempo Traveller in Ghaziabad',
        'service_type' => 'Tempo traveller rental in Ghaziabad',
        'overview_h2' => 'Tempo Traveller Hire in Ghaziabad',
        'fares_h2' => 'Tempo Traveller Rent in Ghaziabad',
        'highlights_tag' => 'Popular Trips',
        'highlights_h2' => 'Popular Tempo Traveller Trips from Ghaziabad',
        'highlights_intro' => 'Where Ghaziabad groups travel most often with us. Every trip is planned around your group, with the same vehicle and driver throughout.',
        'highlights_alt' => 'tempo traveller hire in Ghaziabad',
        'faq_intro' => 'Quick answers about hiring a tempo traveller in Ghaziabad.',
        'about_tag' => 'Ghaziabad Service Area',
        'about_h2' => 'Tempo Traveller Service Across Ghaziabad',
        'pickup_h3' => 'Tempo traveller pickup points in Ghaziabad',
        'pickup_intro' => 'We pick up from homes, societies, offices and stations, including:',
    ],
];

include 'trip-page.php';
