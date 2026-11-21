<?php
// Tempo Traveller on Rent in Gurgaon (Gurugram) — city landing page, rendered by trip-page.php (kind 'local').
require_once 'landing-common.php';
$page_title = 'Tempo Traveller on Rent in Gurgaon (Gurugram) – ₹30/km';
$page_description = 'Tempo traveller on rent in Gurgaon from ₹30/km. 12, 16, 20 seater AC and Maharaja tempo with driver for corporate, wedding and outstation trips. Call +91 7290885949.';
$canonical_url = 'https://www.delhitempotravelleronrent.com/tempo-traveller-on-rent-in-gurgaon.php';

$trip = [
    'kind' => 'local',
    'place' => 'Gurgaon',
    'name' => 'Tempo Traveller on Rent in Gurgaon',
    'h1' => 'Tempo Traveller on Rent in Gurgaon (Gurugram)',
    'hero_image' => 'images/abouttempotraveller.webp',
    'hero_alt' => 'tempo traveller on rent in Gurgaon',
    'price_from' => '₹30',
    'price_unit' => '/km',
    'lead' => 'Book a 12, 16 or 20 seater AC tempo traveller in Gurgaon (Gurugram) with a professional driver. Pickup from Cyber City, Golf Course Road, Sohna Road, DLF phases and hotels across Gurugram, from ₹30/km.',
    'facts' => [
        ['From ₹30/km', 'Starting Fare', 'fas fa-tags'],
        ['12–25 Seats', 'Vehicle Options', 'fas fa-users'],
        ['All of Gurugram', 'Pickup Area', 'fas fa-location-dot'],
        ['24/7', 'Booking Support', 'fas fa-headset'],
    ],
    'intro' => [
        'Need a <strong>tempo traveller on rent in Gurgaon</strong>? We provide AC tempo travellers with experienced drivers for corporate teams, wedding guests, families and friends travelling from anywhere in Gurugram.',
        'Gurgaon sits on NH-48, the main highway to Rajasthan, so <strong>Jaipur, Neemrana, Alwar and Khatu Shyam</strong> are the most popular trips from here, along with Himachal hill trips via the KMP Expressway. Companies in Cyber City, Udyog Vihar and Golf Course Extension also book us for offsites, client visits and airport runs to IGI Terminal 3, which is only 15–20 km away.',
    ],
    'features' => $landing_features,
    'about' => [
        'Our drivers pick up from offices, condominiums and hotels across Gurugram and Manesar, and they time departures around the Hero Honda Chowk and Rajiv Chowk traffic. For Rajasthan trips you skip Delhi altogether: Jaipur is about 235 km (4–5 hours) straight down NH-48.',
        'Fares follow our Delhi rate card: ₹30/km for a 12 seater, ₹35/km for a 16 seater and ₹40/km for a 20 seater, billed on the round-trip distance or 250 km a day, whichever is higher.',
    ],
    'localities' => [
        'Gurugram' => ['icon' => 'fa-city', 'items' => ['Cyber City / Cyber Hub', 'Golf Course Road', 'Golf Course Extension', 'Sohna Road', 'MG Road', 'DLF Phase 1–5', 'Udyog Vihar', 'Sushant Lok', 'Palam Vihar']],
        'New Gurugram & beyond' => ['icon' => 'fa-building', 'items' => ['Dwarka Expressway sectors', 'Sector 82–95 (New Gurugram)', 'Manesar', 'Sohna', 'Aerocity / IGI Airport T3']],
    ],
    'extras_strip' => true,
    'guide' => [],
    'highlights' => [
        'Gurgaon to Jaipur tempo traveller via NH-48 (about 235 km)',
        'Gurgaon to Neemrana Fort Palace day trip (about 90 km)',
        'Gurgaon to Khatu Shyam & Salasar Balaji (about 250–300 km)',
        'Gurgaon to Shimla, Manali & Kasol hill trips',
        'Corporate offsites and team outings from Cyber City & Udyog Vihar',
        'Wedding guest transfers between Gurugram hotels and venues',
    ],
    'price_rows' => $landing_price_rows(),
    'reviews' => [],
    'faqs' => array_merge([
        ['What is the tempo traveller rent in Gurgaon?', 'Tempo traveller rent in Gurgaon starts from <strong>₹30/km</strong> for a 12 seater, ₹35/km for a 16 seater and ₹40/km for a 20 seater. Outstation trips are billed for at least 250 km per day.'],
        ['Can you pick up from Manesar, Sohna and New Gurugram?', 'Yes. We pick up from all of Gurugram including New Gurugram, Dwarka Expressway, Manesar and Sohna at the same per-km rates.'],
        ['Do you provide tempo travellers for corporate events in Gurgaon?', 'Yes. We regularly run offsites, team outings and client visits for companies in Cyber City, Golf Course Road and Udyog Vihar, with GST invoices on request.'],
    ], $landing_common_faqs),
    'searches' => ['Tempo Traveller on Rent in Gurgaon', 'Tempo Traveller in Gurugram', '12 Seater Tempo Traveller Gurgaon', 'Gurgaon to Jaipur Tempo Traveller', 'Tempo Traveller Hire Gurgaon'],
    'region' => 'raj',
    'calculator' => $landing_calculator('Tempo Traveller on Rent in Gurgaon', 235, 1),
    'text' => [
        'eyebrow' => 'Tempo Traveller in Gurugram',
        'service_type' => 'Tempo traveller rental in Gurgaon',
        'overview_h2' => 'Tempo Traveller Hire in Gurgaon (Gurugram)',
        'fares_h2' => 'Tempo Traveller Rent in Gurgaon',
        'highlights_tag' => 'Popular Trips',
        'highlights_h2' => 'Popular Tempo Traveller Trips from Gurgaon',
        'highlights_intro' => 'Where Gurugram groups travel most often with us. Every trip is planned around your group, with the same vehicle and driver throughout.',
        'highlights_alt' => 'tempo traveller hire in Gurugram',
        'faq_intro' => 'Quick answers about hiring a tempo traveller in Gurgaon (Gurugram).',
        'about_tag' => 'Gurgaon Service Area',
        'about_h2' => 'Tempo Traveller Service Across Gurgaon & Manesar',
        'pickup_h3' => 'Tempo traveller pickup points in Gurgaon',
        'pickup_intro' => 'We pick up from offices, homes, hotels and metro stations, including:',
    ],
];

include 'trip-page.php';
