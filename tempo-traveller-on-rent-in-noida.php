<?php
// Tempo Traveller on Rent in Noida — city landing page, rendered by trip-page.php (kind 'local').
require_once 'landing-common.php';
$page_title = 'Tempo Traveller on Rent in Noida – ₹30/km | 12–20 Seater';
$page_description = 'Tempo traveller on rent in Noida & Greater Noida from ₹30/km. 12, 16, 20 seater AC and Maharaja tempo with driver, doorstep pickup. Call +91 7290885949.';
$canonical_url = 'https://www.delhitempotravelleronrent.com/tempo-traveller-on-rent-in-noida.php';

$trip = [
    'kind' => 'local',
    'place' => 'Noida',
    'name' => 'Tempo Traveller on Rent in Noida',
    'h1' => 'Tempo Traveller on Rent in Noida',
    'hero_image' => 'images/maintempotraveller.jpg',
    'hero_alt' => 'tempo traveller on rent in Noida',
    'price_from' => '₹30',
    'price_unit' => '/km',
    'lead' => 'Hire a 12, 16 or 20 seater AC tempo traveller in Noida and Greater Noida with an experienced driver. Doorstep pickup from any sector, society or office, for outstation trips, weddings and corporate travel, from ₹30/km.',
    'facts' => [
        ['From ₹30/km', 'Starting Fare', 'fas fa-tags'],
        ['12–25 Seats', 'Vehicle Options', 'fas fa-users'],
        ['All Sectors', 'Noida & Gr. Noida', 'fas fa-location-dot'],
        ['24/7', 'Booking Support', 'fas fa-headset'],
    ],
    'intro' => [
        'Looking for a <strong>tempo traveller on rent in Noida</strong>? We send clean AC tempo travellers with verified drivers to every part of Noida, Greater Noida and Noida Extension, so your group starts the trip from its own doorstep instead of meeting somewhere in Delhi.',
        'Noida groups mostly book us for weekend trips down the <strong>Yamuna Expressway</strong> to Agra and Mathura–Vrindavan, hill trips to Haridwar, Rishikesh and Nainital, office offsites from the IT parks on Sector 62, 125–144 and the Noida–Greater Noida Expressway, and wedding guest transfers. Choose a 12, 16 or 20 seater, or a luxury Maharaja tempo for a more comfortable ride.',
    ],
    'features' => $landing_features,
    'about' => [
        'Noida sits right next to the Yamuna Expressway and the Delhi–Meerut Expressway, which makes it one of the quickest starting points in NCR for Agra (about 200 km, 3–4 hours), Mathura (about 150 km) and the Uttarakhand hills. Our drivers know the society gates, sector roads and office campuses, and they plan pickups around the DND, Chilla and Kalindi Kunj traffic.',
        'Fares are the same as our Delhi rate card: ₹30/km for a 12 seater, ₹35/km for a 16 seater and ₹40/km for a 20 seater, billed on the round-trip distance or 250 km a day, whichever is higher.',
    ],
    'localities' => [
        'Noida' => ['icon' => 'fa-city', 'items' => ['Sector 18', 'Sector 62', 'Sector 50', 'Sector 76', 'Sector 104', 'Sector 125–137', 'Sector 150', 'Noida City Centre', 'Botanical Garden']],
        'Greater Noida' => ['icon' => 'fa-building', 'items' => ['Noida Extension (Greater Noida West)', 'Pari Chowk', 'Knowledge Park', 'Alpha & Beta Sectors', 'Gaur City', 'Jewar / Noida International Airport area']],
    ],
    'extras_strip' => true,
    'guide' => [],
    'highlights' => [
        'Noida to Agra tempo traveller via Yamuna Expressway (about 200 km)',
        'Noida to Mathura–Vrindavan day trip (about 150 km)',
        'Noida to Haridwar & Rishikesh (about 210–240 km)',
        'Noida to Jim Corbett & Nainital weekend trips',
        'Corporate offsites and staff transport from Noida IT parks',
        'Wedding and event guest transfers across Noida & Greater Noida',
    ],
    'price_rows' => $landing_price_rows(),
    'reviews' => [],
    'faqs' => array_merge([
        ['What is the tempo traveller rent in Noida?', 'Tempo traveller rent in Noida starts from <strong>₹30/km</strong> for a 12 seater, ₹35/km for a 16 seater and ₹40/km for a 20 seater. Outstation trips are billed for at least 250 km per day.'],
        ['Do you pick up from Greater Noida and Noida Extension?', 'Yes. We pick up from every sector of Noida, Greater Noida, Noida Extension (Greater Noida West) and the Yamuna Expressway societies at the same rates.'],
        ['How far is Agra from Noida by tempo traveller?', 'Agra is about 200 km from Noida via the Yamuna Expressway, roughly 3–4 hours by tempo traveller, so a same-day Agra trip from Noida is easy.'],
    ], $landing_common_faqs),
    'searches' => ['Tempo Traveller on Rent in Noida', 'Tempo Traveller in Greater Noida', '12 Seater Tempo Traveller Noida', 'Noida to Agra Tempo Traveller', 'Tempo Traveller Hire Noida Extension'],
    'region' => 'up',
    'calculator' => $landing_calculator('Tempo Traveller on Rent in Noida', 200, 1),
    'text' => [
        'eyebrow' => 'Tempo Traveller in Noida',
        'service_type' => 'Tempo traveller rental in Noida',
        'overview_h2' => 'Tempo Traveller Hire in Noida & Greater Noida',
        'fares_h2' => 'Tempo Traveller Rent in Noida',
        'highlights_tag' => 'Popular Trips',
        'highlights_h2' => 'Popular Tempo Traveller Trips from Noida',
        'highlights_intro' => 'Where Noida groups travel most often with us. Every trip is planned around your group, with the same vehicle and driver throughout.',
        'highlights_alt' => 'tempo traveller hire in Noida',
        'faq_intro' => 'Quick answers about hiring a tempo traveller in Noida and Greater Noida.',
        'about_tag' => 'Noida Service Area',
        'about_h2' => 'Tempo Traveller Service Across Noida & Greater Noida',
        'pickup_h3' => 'Tempo traveller pickup points in Noida',
        'pickup_intro' => 'We pick up from homes, societies, offices, hotels and metro stations, including:',
    ],
];

include 'trip-page.php';
