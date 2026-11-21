<?php
// Tempo Traveller on Rent in Faridabad — city landing page, rendered by trip-page.php (kind 'local').
require_once 'landing-common.php';
$page_title = 'Tempo Traveller on Rent in Faridabad – ₹30/km | 12–20 Seater';
$page_description = 'Tempo traveller on rent in Faridabad & Ballabgarh from ₹30/km. 12, 16, 20 seater AC and Maharaja tempo with driver for Mathura, Agra & Jaipur trips. Call +91 7290885949.';
$canonical_url = 'https://www.delhitempotravelleronrent.com/tempo-traveller-on-rent-in-faridabad.php';

$trip = [
    'kind' => 'local',
    'place' => 'Faridabad',
    'name' => 'Tempo Traveller on Rent in Faridabad',
    'h1' => 'Tempo Traveller on Rent in Faridabad',
    'hero_image' => 'images/agra-hero-bg.webp',
    'hero_alt' => 'tempo traveller on rent in Faridabad',
    'price_from' => '₹30',
    'price_unit' => '/km',
    'lead' => 'Hire a 12, 16 or 20 seater AC tempo traveller in Faridabad with a professional driver. Pickup from NIT, Sector 15–21, Greater Faridabad and Ballabgarh, from ₹30/km.',
    'facts' => [
        ['From ₹30/km', 'Starting Fare', 'fas fa-tags'],
        ['12–25 Seats', 'Vehicle Options', 'fas fa-users'],
        ['All Faridabad', 'Pickup Area', 'fas fa-location-dot'],
        ['24/7', 'Booking Support', 'fas fa-headset'],
    ],
    'intro' => [
        'Looking for a <strong>tempo traveller on rent in Faridabad</strong>? We send clean AC tempo travellers with verified drivers to homes, offices and hotels across Faridabad and Ballabgarh for family trips, pilgrimages, weddings and company outings.',
        'Faridabad lies on NH-19, the direct highway to <strong>Mathura, Vrindavan and Agra</strong>, so these are the most booked trips from here. The KMP Expressway also links Faridabad straight to the Jaipur highway, which makes Jaipur, Khatu Shyam and Salasar Balaji easy weekend trips without entering Delhi.',
    ],
    'features' => $landing_features,
    'about' => [
        'From Faridabad, Mathura is about 120 km (2–3 hours), Vrindavan about 130 km and Agra about 180 km along NH-19. Our drivers know the sector roads, Greater Faridabad societies and the Badarpur border traffic, and plan pickups so you are on the highway quickly.',
        'Fares follow our Delhi rate card: ₹30/km for a 12 seater, ₹35/km for a 16 seater and ₹40/km for a 20 seater, billed on the round-trip distance or 250 km a day, whichever is higher.',
    ],
    'localities' => [
        'Faridabad' => ['icon' => 'fa-city', 'items' => ['NIT Faridabad', 'Sector 15–21', 'Sector 28–37', 'Old Faridabad', 'Neharpar (Greater Faridabad)', 'Sector 75–89', 'Surajkund', 'Ballabgarh', 'Faridabad Railway Station']],
    ],
    'extras_strip' => true,
    'guide' => [],
    'highlights' => [
        'Faridabad to Mathura–Vrindavan via NH-19 (about 120–130 km)',
        'Faridabad to Agra & Taj Mahal day trip (about 180 km)',
        'Faridabad to Jaipur via the KMP Expressway',
        'Faridabad to Khatu Shyam & Salasar Balaji darshan',
        'Faridabad to Haridwar, Rishikesh & Himachal hill trips',
        'Wedding and event guest transfers across Faridabad',
    ],
    'price_rows' => $landing_price_rows(),
    'reviews' => [],
    'faqs' => array_merge([
        ['What is the tempo traveller rent in Faridabad?', 'Tempo traveller rent in Faridabad starts from <strong>₹30/km</strong> for a 12 seater, ₹35/km for a 16 seater and ₹40/km for a 20 seater. Outstation trips are billed for at least 250 km per day.'],
        ['How far is Mathura–Vrindavan from Faridabad?', 'Mathura is about 120 km and Vrindavan about 130 km from Faridabad on NH-19, roughly 2–3 hours by tempo traveller, so it is an easy same-day trip.'],
        ['Do you pick up from Greater Faridabad and Ballabgarh?', 'Yes. We pick up from all sectors of Faridabad, Greater Faridabad (Neharpar) and Ballabgarh at the same rates.'],
    ], $landing_common_faqs),
    'searches' => ['Tempo Traveller on Rent in Faridabad', 'Tempo Traveller in Ballabgarh', '12 Seater Tempo Traveller Faridabad', 'Faridabad to Mathura Tempo Traveller', 'Tempo Traveller Hire Faridabad'],
    'region' => 'up',
    'calculator' => $landing_calculator('Tempo Traveller on Rent in Faridabad', 130, 1),
    'text' => [
        'eyebrow' => 'Tempo Traveller in Faridabad',
        'service_type' => 'Tempo traveller rental in Faridabad',
        'overview_h2' => 'Tempo Traveller Hire in Faridabad',
        'fares_h2' => 'Tempo Traveller Rent in Faridabad',
        'highlights_tag' => 'Popular Trips',
        'highlights_h2' => 'Popular Tempo Traveller Trips from Faridabad',
        'highlights_intro' => 'Where Faridabad groups travel most often with us. Every trip is planned around your group, with the same vehicle and driver throughout.',
        'highlights_alt' => 'tempo traveller hire in Faridabad',
        'faq_intro' => 'Quick answers about hiring a tempo traveller in Faridabad.',
        'about_tag' => 'Faridabad Service Area',
        'about_h2' => 'Tempo Traveller Service Across Faridabad',
        'pickup_h3' => 'Tempo traveller pickup points in Faridabad',
        'pickup_intro' => 'We pick up from homes, societies, offices and stations, including:',
    ],
];

include 'trip-page.php';
