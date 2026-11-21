<?php
// ---------------------------------------------------------------------------
// Quote form handler: validates the enquiry and forwards it to WhatsApp.
// Works without JavaScript (plain POST → 302 redirect to wa.me).
// ---------------------------------------------------------------------------
$whatsapp_number = '917290885949';
$quote_errors = [];
$quote = ['name' => '', 'phone' => '', 'pickup' => '', 'destination' => '', 'travel_date' => '', 'vehicle' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quote_submit'])) {
    foreach ($quote as $key => $unused) {
        $quote[$key] = trim(strip_tags((string) filter_input(INPUT_POST, $key)));
    }
    if (!empty($_POST['website'])) {
        // Honeypot filled in: silently ignore bots.
        header('Location: index.php');
        exit;
    }
    if ($quote['name'] === '') $quote_errors[] = 'Please enter your name.';
    if (!preg_match('/^[0-9+\s-]{10,15}$/', $quote['phone'])) $quote_errors[] = 'Please enter a valid mobile number.';
    if ($quote['pickup'] === '') $quote_errors[] = 'Please enter your pickup location.';
    if ($quote['destination'] === '') $quote_errors[] = 'Please enter your destination.';
    if ($quote['travel_date'] !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $quote['travel_date'])) $quote_errors[] = 'Please choose a valid travel date.';

    if (empty($quote_errors)) {
        $message = "New Tempo Traveller Enquiry\n"
            . "Name: {$quote['name']}\n"
            . "Mobile: {$quote['phone']}\n"
            . "Pickup: {$quote['pickup']}\n"
            . "Destination: {$quote['destination']}\n"
            . 'Travel Date: ' . ($quote['travel_date'] !== '' ? date('d M Y', strtotime($quote['travel_date'])) : 'Not decided') . "\n"
            . 'Vehicle: ' . ($quote['vehicle'] !== '' ? $quote['vehicle'] : 'Please suggest');
        header('Location: https://wa.me/' . $whatsapp_number . '?text=' . rawurlencode($message));
        exit;
    }
}

// Home page SEO variables
$page_title = 'Tempo Traveller on Rent from Delhi | Luxury Hire Services @ Lowest Price';
$meta_title = $page_title;
$page_description = 'Book tempo traveller on rent from Delhi for outstation tours and local sightseeing. 9, 12, 16, 20, 26 seater & Force Urbania with driver at best per km rates.';
$meta_keywords = 'tempo traveller on rent from delhi, tempo traveller hire in delhi, tempo traveller booking delhi, outstation tempo traveller from delhi, luxury tempo traveller hire delhi, force urbania on rent in delhi, tempo traveller rent per km in delhi';
$og_title = 'Tempo Traveller on Rent from Delhi | Luxury Hire Services';
$og_description = 'Book 9 to 26 seater luxury tempo travellers & Force Urbania on rent from Delhi for outstation and local trips at lowest per km rates. Verified drivers.';
$twitter_title = 'Tempo Traveller on Rent from Delhi | Luxury Hire Services';
$twitter_description = 'Affordable & luxury tempo traveller hire in Delhi NCR for outstation tours, family trips, and corporate events with experienced drivers.';
$canonical_url = 'https://www.delhitempotravelleronrent.com/';
$page_css = ['blog.css', 'home.css'];

$home_faqs = [
    ['What seating configurations are available in your fleet?', 'We maintain a wide range of operational fleet models, including 9 seater, 12 seater, 16 seater, 20 seater, and 26 seater tempo travellers, alongside custom Force Urbania and luxury Maharaja recliners.'],
    ['Are your drivers experienced with difficult mountain terrains?', 'Every driver assigned to outstation routes holds a valid commercial driving license, undergoes verified background checks, and possesses extensive experience driving hilly roads across Himachal Pradesh, Uttarakhand, and Jammu & Kashmir.'],
    ['How are interstate taxes, tolls, and parking handled during outstation trips?', 'Interstate passenger permits, highway toll charges, state entry taxes, and local parking fees are billed strictly as per actual government receipts or can be integrated upfront into a customized, all-inclusive package based on your preference.'],
    ['Can we inspect the vehicle in person before confirming our reservation?', 'We welcome client visits to our operational yards across Delhi NCR to inspect vehicle cleanliness, check seating comfort, and test cabin amenities prior to completing your booking deposit.'],
    ['What amenities are included inside your luxury tempo travellers?', 'Our luxury and executive models feature individual pushback recliners, individual mobile charging points, dual-zone air conditioning, LED televisions with multimedia audio, ambient roof lighting, and dedicated rear luggage trunks.'],
];
// Home page structured data, printed in <head> by header.php instead of the shared site schema
$skip_site_schema = true;
$page_schema = <<<'SCHEMA'
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "AutoRental",
      "@id": "https://www.delhitempotravelleronrent.com/#serviceprovider",
      "name": "Delhi Tempo Traveller on Rent",
      "url": "https://www.delhitempotravelleronrent.com/",
      "logo": "https://www.delhitempotravelleronrent.com/images/logo.png",
      "image": "https://www.delhitempotravelleronrent.com/images/maintempotraveller.jpg",
      "telephone": "+91-7290885949",
      "email": "bookingsgetmecab@gmail.com",
      "priceRange": "₹₹",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "Delhi",
        "addressRegion": "Delhi",
        "addressCountry": "IN"
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday"
        ],
        "opens": "00:00",
        "closes": "23:59"
      },
      "areaServed": [
        {
          "@type": "City",
          "name": "Delhi"
        },
        {
          "@type": "City",
          "name": "Noida"
        },
        {
          "@type": "City",
          "name": "Gurgaon"
        },
        {
          "@type": "City",
          "name": "Ghaziabad"
        },
        {
          "@type": "City",
          "name": "Faridabad"
        }
      ],
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Tempo Traveller Rental Services",
        "itemListElement": [
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "9 Seater Luxury Tempo Traveller Hire",
              "description": "Premium 1x1 Maharaja seating tempo traveller for small family trips and outstation travel from Delhi."
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "12 Seater Tempo Traveller on Rent",
              "description": "Comfortable 2x1 seating tempo traveller for family vacations and outstation group tours."
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "16 Seater Luxury Tempo Traveller Delhi",
              "description": "Executive modified pushback seat tempo traveller for weddings, corporate tours, and holiday travel."
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "20 to 26 Seater Tempo Traveller Hire",
              "description": "Large passenger tempo traveller coaches for wedding groups, institutional groups, and events."
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Force Urbania on Rent in Delhi",
              "description": "Modern monocoque luxury passenger van rental with advanced European ride safety and individual AC vents."
            }
          }
        ]
      }
    },
    {
      "@type": "WebPage",
      "@id": "https://www.delhitempotravelleronrent.com/#webpage",
      "url": "https://www.delhitempotravelleronrent.com/",
      "name": "Tempo Traveller on Rent in Delhi | Luxury Fleet Services",
      "description": "Book luxury tempo travellers on rent from Delhi for local sightseeing and outstation trips with experienced drivers at honest rates.",
      "inLanguage": "en",
      "isPartOf": {
        "@type": "WebSite",
        "@id": "https://www.delhitempotravelleronrent.com/#website",
        "url": "https://www.delhitempotravelleronrent.com/",
        "name": "Delhi Tempo Traveller on Rent"
      }
    },
    {
      "@type": "FAQPage",
      "@id": "https://www.delhitempotravelleronrent.com/#faq",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "What seating configurations are available in your fleet?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "We maintain a wide range of operational fleet models, including 9 seater, 12 seater, 16 seater, 20 seater, and 26 seater tempo travellers, alongside custom Force Urbania and luxury Maharaja recliners."
          }
        },
        {
          "@type": "Question",
          "name": "Are your drivers experienced with difficult mountain terrains?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Every driver assigned to outstation routes holds a valid commercial driving license, undergoes verified background checks, and possesses extensive experience driving hilly roads across Himachal Pradesh, Uttarakhand, and Jammu & Kashmir."
          }
        },
        {
          "@type": "Question",
          "name": "How are interstate taxes, tolls, and parking handled during outstation trips?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Interstate passenger permits, highway toll charges, state entry taxes, and local parking fees are billed strictly as per actual government receipts or can be integrated upfront into a customized, all-inclusive package based on your preference."
          }
        },
        {
          "@type": "Question",
          "name": "Can we inspect the vehicle in person before confirming our reservation?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "We welcome client visits to our operational yards across Delhi NCR to inspect vehicle cleanliness, check seating comfort, and test cabin amenities prior to completing your booking deposit."
          }
        },
        {
          "@type": "Question",
          "name": "What amenities are included inside your luxury tempo travellers?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Our luxury and executive models feature individual pushback recliners, individual mobile charging points, dual-zone air conditioning, LED televisions with multimedia audio, ambient roof lighting, and dedicated rear luggage trunks."
          }
        }
      ]
    }
  ]
}
</script>
SCHEMA;
$page_schema .= "\n";

include 'header.php';

$vehicles = [
    ['12 Seater Tempo Traveller', 'Families & small groups', 30, 'Most Booked', false, ['Pushback seats', 'Air conditioned', 'Music system', 'Charging points']],
    ['16 Seater Tempo Traveller', 'Office teams & big families', 35, 'Best Value', false, ['Pushback seats', 'Air conditioned', 'Large windows', 'Luggage carrier']],
    ['20 Seater Tempo Traveller', 'Weddings & large groups', 40, 'Large Groups', false, ['Comfort seating', 'Air conditioned', 'Music system', 'Charging points']],
    ['25 Seater Tempo Traveller', 'School trips & big groups', 43, 'Big Groups', false, ['Pushback seats', 'Air conditioned', 'Extra luggage space', 'Charging points']],
    ['9/12 Seater Maharaja Tempo', 'Premium family & group tours', 35, 'Luxury', true, ['Recliner seats', 'Refrigerator', 'WiFi', 'Luxury interiors']],
    ['16 Seater Maharaja Tempo', 'VIP & corporate groups', 40, 'Luxury', true, ['Recliner seats', 'Refrigerator', 'WiFi', 'Luxury interiors']],
];
$popular_routes = [
    ['manali', 'Manali', '540 km', '12-14 hrs', 30],
    ['agra', 'Agra', '230 km', '4-5 hrs', 30],
    ['jaipur', 'Jaipur', '280 km', '5-6 hrs', 30],
    ['haridwar', 'Haridwar', '220 km', '5-6 hrs', 30],
    ['rishikesh', 'Rishikesh', '240 km', '6-7 hrs', 30],
    ['nainital', 'Nainital', '320 km', '7-8 hrs', 30],
    ['mussoorie', 'Mussoorie', '280 km', '7-8 hrs', 30],
    ['amritsar', 'Amritsar', '450 km', '8-9 hrs', 30],
];
$packages = [
    ['chardham-tempo-package.php', 'Char Dham Yatra', 'chardham', '10-12 Days', '₹8,000/day'],
    ['golden-triangle-tempo-package.php', 'Golden Triangle Tour', 'golden-triangle', '5-7 Days', '₹30/km'],
    ['himachal-tempo-package.php', 'Himachal Tour', 'himachal', '7-9 Days', '₹30/km'],
    ['uttarakhand-tempo-package.php', 'Uttarakhand Tour', 'uttarakhand', '8-10 Days', '₹30/km'],
    ['kashmir-tempo-package.php', 'Kashmir Tour', 'kashmir', '7-9 Days', '₹30/km'],
    ['leh-ladakh-tempo-package.php', 'Leh Ladakh Tour', 'leh-ladakh', '10-12 Days', '₹8,000/day'],
    ['rajasthan-tempo-package.php', 'Rajasthan Tour', 'rajasthan', '10-12 Days', '₹30/km'],
    ['pilgrimage-tempo-package.php', 'Pilgrimage Tours', 'pilgrimage', '10-15 Days', '₹30/km'],
    ['wildlife-tempo-package.php', 'Wildlife Safari Tour', 'wildlife', '5-7 Days', '₹30/km'],
];
$reviews = [
    ['Excellent service! The tempo traveller was spotless and the driver was very professional. Made our family trip to Agra so comfortable.', 'Rahul Sharma', 'Delhi', 'Family trip to Agra'],
    ['Best rates in Delhi and the booking process was smooth. The 16-seater was perfect for our office outing. Highly recommended!', 'Priya Kapoor', 'Gurgaon', 'Office outing'],
    ['On time, clean vehicle, polite driver. Everything was perfect. Will definitely book again for our next trip.', 'Amit Verma', 'Noida', 'Weekend getaway'],
];
$guide_intro = 'Finding comfortable, safe, and dependable group transport in the national capital begins with choosing a proven fleet operator. When planning family vacations, corporate retreats, pilgrimage circuits, or destination weddings, booking individual cabs fragments the journey and creates unnecessary logistical headaches. Choosing a tempo traveller on rent from delhi allows your entire group to travel together seamlessly in pushback comfort, backed by deep luggage space, dedicated charging points, and experienced chauffeurs who know northern Indian highways thoroughly. Our fleet is maintained to rigorous safety benchmarks, providing an effortless door-to-door transit experience from anywhere across Delhi NCR.';
$guide_groups = [
    ['Hire &amp; Booking', [
        ['fa-van-shuttle', 'Tempo Traveller Hire in Delhi', 'Navigating urban traffic or setting off on long highway stretches demands vehicles configured specifically for group comfort. Opting for tempo traveller hire in delhi guarantees vehicles equipped with dual-zone air conditioning, individual AC vents, wide panoramic windows, and ergonomic seating arrangements. Whether your pickup is scheduled at Indira Gandhi International Airport (IGI T3/T1), New Delhi Railway Station, or your doorstep in South, West, North, or East Delhi, our drivers arrive promptly to ensure your trip starts on schedule.'],
        ['fa-file-signature', 'Tempo Traveller Booking Delhi', 'Securing reliable group transportation should never involve complex back-and-forth negotiations or hidden fees. We simplify tempo traveller booking delhi through a verified direct-booking workflow where you receive clear billing breakdowns, transparent per-kilometer rates, driver allowances, and state toll details upfront. Booking in advance guarantees vehicle availability during peak wedding seasons, holiday weekends, and major festival dates.'],
        ['fa-mountain-sun', 'Outstation Tempo Traveller from Delhi', 'Delhi serves as the primary gateway to northern India\'s most sought-after holiday destinations, pilgrim hubs, and business zones. Booking an outstation tempo traveller from delhi gives your travel group the freedom to explore scenic mountain routes like Manali, Shimla, Dharamshala, and Mussoorie, cultural circuits like Jaipur, Agra, and Udaipur, or sacred corridors including Haridwar, Rishikesh, Char Dham, and Mathura-Vrindavan. Every vehicle assigned for outstation journeys undergoes rigorous multi-point mechanical inspections prior to departure, ensuring peak engine performance, crisp braking systems, and dependable hill-climb capabilities.'],
        ['fa-award', 'Best Tempo Traveller Service in Delhi', 'Quality fleet management and genuine customer care define the best tempo traveller service in delhi. We maintain strict hygiene protocols, ensuring every cabin is thoroughly sanitized, deep-cleaned, vacuumed, and scented before every single trip. Combined with punctual pickups, courteous chauffeurs, GPS-monitored vehicles, and 24/7 dedicated fleet support throughout your route, your group enjoys complete peace of mind from pickup until final drop-off.'],
        ['fa-user-tie', 'Tempo Traveller Rental in Delhi with Driver', 'Driving through congested city corridors or navigating steep, hairpin mountain bends requires seasoned highway expertise. Our tempo traveller rental in delhi with driver pairs your chosen vehicle with verified commercial drivers who bring extensive experience navigating hill routes across Himachal Pradesh, Uttarakhand, and Jammu &amp; Kashmir, as well as high-speed expressways like the Yamuna Expressway, Western Peripheral Expressway, and Delhi-Mumbai Expressway. Our chauffeurs prioritize passenger safety, follow lane discipline, and assist with luggage loading and unloading at every stop.'],
        ['fa-crown', 'Luxury Tempo Traveller Hire Delhi', 'Elevate your travel experience with premium executive modifications designed for VIP corporate delegations, royal wedding parties, and luxury family holidays. Choosing luxury tempo traveller hire delhi provides plush leatherette recliner seats, Maharaja captain chairs, personalized LED reading lamps, ambient cabin mood lighting, smart LED television screens with onboard entertainment systems, high-fidelity sound, and motorized footrests. It combines the comfort of private business-class aviation with highway transit.'],
        ['fa-map-location-dot', 'Tempo Traveller on Rent in Delhi NCR', 'Our active operations span the entire National Capital Region, offering timely dispatch across Noida, Greater Noida, Gurgaon (Gurugram), Ghaziabad, and Faridabad. Reserving a tempo traveller on rent in delhi ncr ensures you never have to pay dead-mileage costs or deal with multiple regional transfer vendors. Whether organizing corporate employee transit across Cyber City and Noida Sector 62 or coordinating family pickups across Indirapuram and DLF Phase 5, our widespread network covers your route seamlessly.'],
    ]],
    ['Choose by Seating', [
        ['fa-couch', '9 Seater Tempo Traveller on Rent in Delhi', 'For nuclear families, executive project groups, or close-knit friends traveling together, our 9 seater tempo traveller on rent in delhi is an ideal, compact solution. Configured in an ultra-luxurious 1x1 seating layout, this variant offers expansive legroom, wide armrests, individual recliners, and generous rear trunk space without the bulky footprint of larger commercial coaches. It navigates narrower city streets and hill roads with remarkable agility.'],
        ['fa-people-roof', '12 Seater Tempo Traveller Hire in Delhi', 'The classic favorite for medium-sized family holidays and weekend getaways, our 12 seater tempo traveller hire in delhi features a comfortable 2x1 seating plan. This layout delivers optimal weight balance, comfortable middle aisle clearance, individual bottle holders, and generous overhead parcel racks. It effortlessly accommodates twelve passengers alongside their travel bags for trips to Agra, Jaipur, or Rishikesh.'],
        ['fa-people-group', '16 Seater Luxury Tempo Traveller Delhi', 'Accommodating extended families, wedding entourages, and office departments requires substantial space and superior suspension. Our 16 seater luxury tempo traveller delhi balances generous seating volume with custom executive features, including individual charging points at each row, upgraded air suspension to smooth out rough road stretches, large luggage boots, and surround-sound audio systems that keep long journeys lively and comfortable.'],
        ['fa-van-shuttle', '20 Seater Tempo Traveller on Rent Delhi', 'Eliminating the need to coordinate multiple smaller cabs, our 20 seater tempo traveller on rent delhi delivers significant cost savings and keeps large tour groups together. Perfectly aligned for academic field trips, corporate offsites, and destination wedding transport, this spacious coach variant offers ample headroom, wide gangways, and powerful dual air conditioning blowers that maintain a consistent, cool cabin climate across hot summer drives.'],
        ['fa-bus', '26 Seater Tempo Traveller Hire Delhi', 'The largest configuration available in the light commercial passenger vehicle segment, the 26 seater tempo traveller hire delhi serves as an agile alternative to full-sized buses. It provides generous 2x2 seating, commercial-grade luggage storage compartments, wide viewing windows, and reinforced chassis construction. It comfortably handles large wedding parties and large institutional delegations while retaining permission to traverse mountain highways where heavy 40-seater buses face movement restrictions.'],
        ['fa-shuttle-van', 'Force Urbania on Rent in Delhi', 'Experience next-generation van architecture by booking the cutting-edge force urbania on rent in delhi. Engineered with European-standard safety frameworks, monocoque structural bodies, independent front suspensions, dual front airbags, all-wheel disc brakes with ABS and EBD, and whisper-quiet cabin acoustics, the Force Urbania redefines highway transit. Available in short, medium, and long wheelbase setups, it provides an exceptionally smooth, car-like ride quality for discerning travelers.'],
    ]],
    ['Rates &amp; Pricing', [
        ['fa-road', 'Tempo Traveller Rent Per Km in Delhi', 'Transparency forms the foundation of our billing framework. When calculating your total trip budget, our tempo traveller rent per km in delhi starts with clearly defined baseline rates based on the chosen seating configuration, whether standard, executive, or luxury Maharaja. Outstation charges are computed based on standard daily minimum running distances, allowing you to estimate travel costs accurately without facing surprise bills or hidden add-ons at the end of your tour.'],
        ['fa-calendar-day', 'Tempo Traveller Rate Per Day Delhi', 'For local Delhi sightseeing, multi-day wedding duties, business conferences, or event transit within city boundaries, hiring via fixed daily packages delivers convenience and value. Our tempo traveller rate per day delhi includes pre-packaged 8-Hour / 80-Kilometer and 12-Hour / 120-Kilometer slabs. This structure lets you visit landmarks like Red Fort, Qutub Minar, India Gate, and Akshardham Temple at your own pace without keeping a running meter running in your head.'],
        ['fa-piggy-bank', 'Cheap Tempo Traveller Hire in Delhi', 'Cost-effective group travel does not require sacrificing clean upholstery, working air conditioners, or courteous drivers. Our cheap tempo traveller hire in delhi focuses on practical value, maintaining pristine, mechanically dependable standard-trim vehicles that offer reliable transportation for budget-conscious schools, sports teams, and volunteer organizations seeking the best return on their transportation spend.'],
        ['fa-tags', 'Lowest Price Tempo Traveller Delhi', 'Through direct fleet ownership and proactive internal mechanical maintenance, we eliminate third-party commission middle layers to offer the lowest price tempo traveller delhi. You deal directly with the genuine fleet owner and service provider, ensuring verified vehicle conditions, exact model allocations, and market-competitive pricing for your group itinerary.'],
    ]],
    ['Contact &amp; Booking', [
        ['fa-phone-alt', 'Tempo Traveller Contact Number Delhi', 'Immediate trip consultations, route planning assistance, fleet selection advice, and instant quotations are readily available. Connect directly with our dispatch desk through our official tempo traveller contact number delhi at <a href="tel:+917290885949">+91-7290885949</a> or via instant messaging. Our fleet managers remain available around the clock to assist you with vehicle selection, custom itinerary pricing, and last-minute emergency bookings.'],
        ['fa-laptop', 'Online Tempo Traveller Booking Delhi', 'Complete your transport arrangements anytime from your smartphone or desktop computer. Our portal for online tempo traveller booking delhi enables you to compare vehicle seating configurations, review interior layouts, specify custom pickup and drop points, and receive formal digital booking confirmations with minimal effort. Secure your vehicle today and travel across India with unmatched dependability and comfort.'],
    ]],
];
function wa_link($text) { return 'https://wa.me/917290885949?text=' . rawurlencode($text); }
?>

<main class="home">

    <!-- ============ HERO + QUOTE FORM ============ -->
    <section class="hero-home" id="home">
        <div class="container hero-grid">
            <div class="hero-copy">
                <span class="hero-badge"><b>24/7</b> Delhi NCR’s group travel specialists</span>
                <h1>Tempo Traveller on Rent from <span>Delhi</span></h1>
                <p class="hero-lead">Comfortable, safe and affordable group travel across Delhi NCR and North India. Hire a 12, 16, 20 or 25 seater AC tempo traveller or a luxury Maharaja tempo with an experienced driver, starting at just ₹30/km.</p>
                <ul class="hero-points">
                    <li><i class="fas fa-check"></i>Experienced drivers who know every North India route</li>
                    <li><i class="fas fa-check"></i>Clean, well-maintained AC vehicles from 9 to 20 seats</li>
                    <li><i class="fas fa-check"></i>Transparent pricing: only fuel included, all extras shared upfront</li>
                </ul>
                <div class="hero-actions">
                    <a class="btn btn-primary" href="tel:+917290885949"><i class="fas fa-phone-alt"></i> Call +91 7290885949</a>
                    <a class="btn btn-ghost" href="<?php echo wa_link('Hi, I need a tempo traveller on rent in Delhi'); ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Chat on WhatsApp</a>
                </div>
                <div class="hero-quick">
                    <span>Popular:</span>
                    <a href="delhi-to-agra-tempo-on-rent.php">Agra</a>
                    <a href="delhi-to-manali-tempo-on-rent.php">Manali</a>
                    <a href="delhi-to-rishikesh-tempo-on-rent.php">Rishikesh</a>
                    <a href="delhi-to-jaipur-tempo-on-rent.php">Jaipur</a>
                    <a href="chardham-tempo-package.php">Char Dham</a>
                </div>
            </div>

            <div class="quote-card" id="quote">
                <div class="quote-card-head">
                    <h2>Get a Free Quote</h2>
                    <p><i class="fab fa-whatsapp"></i> Fast reply on WhatsApp, usually within minutes</p>
                </div>
                <form class="quote-form" method="post" action="index.php#quote" novalidate>
                    <?php if (!empty($quote_errors)): ?>
                        <div class="form-errors" role="alert"><?php echo implode('<br>', array_map('htmlspecialchars', $quote_errors)); ?></div>
                    <?php endif; ?>
                    <div class="field">
                        <label for="q-name">Your name</label>
                        <div class="control"><i class="fas fa-user"></i><input id="q-name" name="name" type="text" autocomplete="name" placeholder="Full name" required value="<?php echo htmlspecialchars($quote['name']); ?>"></div>
                    </div>
                    <div class="field">
                        <label for="q-phone">Mobile number</label>
                        <div class="control"><i class="fas fa-phone-alt"></i><input id="q-phone" name="phone" type="tel" inputmode="tel" autocomplete="tel" placeholder="10-digit mobile" required pattern="[0-9+\s-]{10,15}" value="<?php echo htmlspecialchars($quote['phone']); ?>"></div>
                    </div>
                    <div class="field">
                        <label for="q-pickup">Pickup location</label>
                        <div class="control"><i class="fas fa-map-marker-alt"></i><input id="q-pickup" name="pickup" type="text" placeholder="e.g. Dwarka, Noida" required value="<?php echo htmlspecialchars($quote['pickup']); ?>"></div>
                    </div>
                    <div class="field">
                        <label for="q-destination">Destination</label>
                        <div class="control"><i class="fas fa-flag-checkered"></i><input id="q-destination" name="destination" type="text" list="destinations" placeholder="e.g. Manali" required value="<?php echo htmlspecialchars($quote['destination']); ?>"></div>
                        <datalist id="destinations">
                            <?php foreach ($nav_routes as $name): ?><option value="<?php echo $name; ?>"><?php endforeach; ?>
                            <option value="Char Dham Yatra"><option value="Local Delhi NCR"><option value="Airport transfer">
                        </datalist>
                    </div>
                    <div class="field">
                        <label for="q-date">Travel date</label>
                        <div class="control"><i class="fas fa-calendar-alt"></i><input id="q-date" name="travel_date" type="date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo htmlspecialchars($quote['travel_date']); ?>"></div>
                    </div>
                    <div class="field">
                        <label for="q-vehicle">Vehicle</label>
                        <div class="control"><i class="fas fa-van-shuttle"></i>
                            <select id="q-vehicle" name="vehicle">
                                <option value="">Help me choose</option>
                                <?php foreach ($vehicles as $v): ?>
                                    <option<?php echo $quote['vehicle'] === $v[0] ? ' selected' : ''; ?>><?php echo $v[0]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="hp-field" aria-hidden="true"><label for="q-website">Website</label><input id="q-website" name="website" type="text" tabindex="-1" autocomplete="off"></div>
                    <button class="btn btn-primary btn-block full" type="submit" name="quote_submit" value="1"><i class="fab fa-whatsapp"></i> Get My Quote on WhatsApp</button>
                    <p class="form-note full"><i class="fas fa-lock"></i> No spam. We only use your number to send your quote.</p>
                </form>
            </div>
        </div>
    </section>

    <!-- ============ STATS ============ -->
    <div class="container stats-wrap">
        <div class="stats-bar">
            <div class="stat"><span class="ico"><i class="fas fa-award"></i></span><div><strong><span data-count="10">10</span>+ Years</strong><span>In group travel</span></div></div>
            <div class="stat"><span class="ico"><i class="fas fa-users"></i></span><div><strong><span data-count="500">500</span>+</strong><span>Happy clients</span></div></div>
            <div class="stat"><span class="ico"><i class="fas fa-van-shuttle"></i></span><div><strong><span data-count="20">20</span>+</strong><span>Vehicles in fleet</span></div></div>
            <div class="stat"><span class="ico"><i class="fas fa-map-location-dot"></i></span><div><strong><span data-count="25">25</span>+</strong><span>Routes &amp; tours</span></div></div>
        </div>
    </div>

    <!-- ============ POPULAR ROUTES ============ -->
    <section class="sec" id="routes">
        <div class="container">
            <div class="sec-head sec-head-split reveal">
                <div>
                    <span class="eyebrow-tag">Popular Destinations</span>
                    <h2 class="section-title">Top Tempo Traveller Routes from Delhi</h2>
                </div>
                <p>Our most booked outstation trips, with distance, typical driving time and starting fare. <a href="services.php#routes">View all 16 routes →</a></p>
            </div>
            <div class="bento">
                <?php foreach ($popular_routes as $i => $r): ?>
                    <a class="route-card reveal<?php echo $i === 0 ? ' big' : ($i === 7 ? ' wide' : ''); ?>" href="delhi-to-<?php echo $r[0]; ?>-tempo-on-rent.php">
                        <img src="images/<?php echo $r[0]; ?>-hero-bg.webp" alt="Delhi to <?php echo $r[1]; ?> tempo traveller on rent" loading="lazy">
                        <span class="route-price">From ₹<?php echo $r[4]; ?>/km</span>
                        <div class="route-info">
                            <h3>Delhi to <?php echo $r[1]; ?></h3>
                            <div class="route-meta"><span><i class="fas fa-road"></i><?php echo $r[2]; ?></span><span><i class="far fa-clock"></i><?php echo $r[3]; ?></span></div>
                        </div>
                        <span class="go"><i class="fas fa-arrow-right"></i></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ============ FLEET ============ -->
    <section class="sec sec-soft" id="fleet">
        <div class="container">
            <div class="sec-head reveal">
                <span class="eyebrow-tag">Our Fleet</span>
                <h2 class="section-title">Choose Your Tempo Traveller</h2>
                <p class="section-sub">Standard AC tempo travellers for everyday group travel, and luxury Maharaja tempos when comfort matters most.</p>
            </div>
            <div class="fleet-tabs" role="tablist" aria-label="Vehicle type">
                <button type="button" role="tab" class="active" aria-selected="true" data-tab="standard"><i class="fas fa-van-shuttle"></i> Standard AC Tempo</button>
                <button type="button" role="tab" aria-selected="false" data-tab="luxury"><i class="fas fa-crown"></i> Luxury Maharaja</button>
            </div>
            <?php foreach (['standard' => false, 'luxury' => true] as $tab => $lux): ?>
            <div class="fleet-grid" data-panel="<?php echo $tab; ?>" role="tabpanel">
                <?php foreach ($vehicles as $v): if ($v[4] !== $lux) continue; ?>
                    <article class="vehicle<?php echo $lux ? ' lux' : ''; ?>">
                        <div class="vehicle-img">
                            <span class="vehicle-tag<?php echo $lux ? ' lux' : ''; ?>"><?php echo $v[3]; ?></span>
                            <img src="images/tempo12.webp" alt="<?php echo htmlspecialchars($v[0]); ?> on rent in Delhi" width="228" height="150" loading="lazy">
                        </div>
                        <div class="vehicle-body">
                            <div class="vehicle-top">
                                <div><h3><?php echo $v[0]; ?></h3><small><?php echo $v[1]; ?></small></div>
                                <div class="vehicle-price"><small>From</small><strong>₹<?php echo $v[2]; ?><em>/km</em></strong></div>
                            </div>
                            <ul class="vehicle-feats">
                                <?php foreach ($v[5] as $feat): ?><li><i class="fas fa-check-circle"></i><?php echo $feat; ?></li><?php endforeach; ?>
                            </ul>
                            <div class="vehicle-actions">
                                <a class="btn btn-primary" href="<?php echo wa_link('Hi, I want to book a ' . $v[0] . '. Please share availability and price.'); ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Get Quote</a>
                                <a class="btn btn-outline" href="fleet.php">Details</a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
            <p class="fleet-note">Starting per-km rates for outstation trips (minimum 250 km/day). <strong>Only fuel charge is included.</strong> Toll tax, state tax, parking, driver allowance, driver night charge and GST are extra. <strong>AC will be switched off in hilly areas.</strong></p>
        </div>
    </section>

    <!-- ============ INSTANT QUOTE CALCULATOR ============ -->
    <section class="sec" id="instant-quote">
        <div class="container">
            <div class="sec-head reveal">
                <span class="eyebrow-tag">Instant Quote</span>
                <h2 class="section-title">Tempo Traveller Fare Calculator</h2>
                <p class="section-sub">Pick your destination, vehicle and trip type to see an estimated fare instantly, then send it to us on WhatsApp for a confirmed quote.</p>
            </div>
            <?php require_once 'trips-index.php'; ?>
            <div class="calculator" id="calculator" data-whatsapp="917290885949" data-mode="route" data-title="Tempo Traveller on Rent from Delhi" data-extra-label="" data-extra-value="">
                <div class="calc-head">
                    <h3><i class="fas fa-calculator"></i> Get Instant Quote</h3>
                    <span class="calc-badge"><i class="fas fa-bolt"></i> Quick Estimate</span>
                </div>
                <div class="calc-body">
                    <div class="calc-grid four">
                        <label class="tf"><span><i class="fas fa-location-dot"></i> Destination</span>
                            <select id="calcDest">
                                <?php foreach ($trips_index as $file => $t): if ($t['kind'] !== 'route') continue; ?>
                                    <option value="<?php echo htmlspecialchars($file); ?>" data-km="<?php echo (int) $t['fact']; ?>"<?php echo $file === 'delhi-to-agra-tempo-on-rent.php' ? ' selected' : ''; ?>><?php echo htmlspecialchars(substr($t['name'], 9)); ?></option>
                                <?php endforeach; ?>
                                <option value="" data-km="">Other (enter distance)</option>
                            </select>
                        </label>
                        <label class="tf"><span><i class="fas fa-road"></i> One-way Distance (km)</span><input id="calcDistance" type="number" min="1" inputmode="numeric" value="230"></label>
                        <label class="tf"><span><i class="fas fa-van-shuttle"></i> Choose Vehicle</span>
                            <select id="calcVehicle">
                                <?php foreach ($vehicles as $v): ?><option value="<?php echo $v[2]; ?>"><?php echo htmlspecialchars(str_replace(' Tempo Traveller', '', $v[0])); ?> - ₹<?php echo $v[2]; ?>/km</option><?php endforeach; ?>
                            </select>
                        </label>
                        <label class="tf"><span><i class="fas fa-calendar-day"></i> Number of Days</span><input id="calcDays" type="number" min="1" max="60" inputmode="numeric" value="1"></label>
                    </div>
                    <div class="calc-grid two">
                        <label class="tf"><span><i class="fas fa-user"></i> Your Name</span><input id="calcName" type="text" autocomplete="name" placeholder="Enter your name"></label>
                        <label class="tf"><span><i class="fab fa-whatsapp"></i> WhatsApp Number</span><input id="calcPhone" type="tel" inputmode="tel" autocomplete="tel" placeholder="Enter phone number"></label>
                    </div>
                    <p class="calc-error" id="calcError" role="alert" hidden>Please enter your WhatsApp number so we can send your quote.</p>
                    <div class="calc-result">
                        <div>
                            <span class="calc-label">Estimated Total Price</span>
                            <strong class="calc-total">₹<span id="calcTotal">0</span></strong>
                            <small class="calc-extra"><i class="fas fa-road"></i> <span id="calcKm"></span> (round trip, min 250 km/day)</small>
                            <small class="calc-extra"><i class="fas fa-circle-info"></i> Only fuel included. Toll, state tax, parking, driver allowance, night charge &amp; GST extra. AC switched off in hilly areas.</small>
                        </div>
                        <button type="button" class="btn btn-wa" id="calcSend"><i class="fab fa-whatsapp"></i> Get Quote on WhatsApp</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ SERVICES ============ -->
    <section class="sec sec-soft" id="services">
        <div class="container">
            <div class="sec-head reveal">
                <span class="eyebrow-tag">What We Do</span>
                <h2 class="section-title">Tempo Traveller Services in Delhi NCR</h2>
                <p class="section-sub">One trusted operator for every kind of group journey, from a same-day trip to a two-week tour.</p>
            </div>
            <div class="services-grid">
                <a class="service reveal" href="services.php"><span class="ico"><i class="fas fa-road"></i></span><h3>Outstation Trips</h3><p>Hill stations, heritage cities and weekend getaways across North India, with drivers experienced on every route.</p><span class="more">Explore routes <i class="fas fa-arrow-right"></i></span></a>
                <a class="service reveal" href="services.php"><span class="ico"><i class="fas fa-city"></i></span><h3>Local Delhi NCR Hire</h3><p>City tours, shopping trips, family functions and full-day local use across Delhi, Noida, Gurugram and Faridabad.</p><span class="more">View services <i class="fas fa-arrow-right"></i></span></a>
                <a class="service reveal" href="services.php"><span class="ico"><i class="fas fa-plane-arrival"></i></span><h3>Airport Transfers</h3><p>Group pick-ups and drops at IGI Airport with room for all your luggage, day or night.</p><span class="more">View services <i class="fas fa-arrow-right"></i></span></a>
                <a class="service reveal" href="tempo-traveller-for-wedding-and-corporate-events-in-delhi.php"><span class="ico"><i class="fas fa-ring"></i></span><h3>Weddings &amp; Events</h3><p>Guest transfers, baraat movement and hotel–venue shuttles, planned so every guest arrives on time.</p><span class="more">Plan wedding transport <i class="fas fa-arrow-right"></i></span></a>
                <a class="service reveal" href="tempo-traveller-for-wedding-and-corporate-events-in-delhi.php"><span class="ico"><i class="fas fa-briefcase"></i></span><h3>Corporate Travel</h3><p>Offsites, conferences and employee transport with multiple pick-up points and a single consolidated invoice.</p><span class="more">Corporate travel <i class="fas fa-arrow-right"></i></span></a>
                <a class="service reveal" href="pilgrimage-tempo-package.php"><span class="ico"><i class="fas fa-om"></i></span><h3>Pilgrimage Tours</h3><p>Char Dham, Vaishno Devi, Haridwar–Rishikesh and more, with comfortable seating for elders on long journeys.</p><span class="more">Pilgrimage packages <i class="fas fa-arrow-right"></i></span></a>
            </div>
        </div>
    </section>

    <!-- ============ ABOUT / WHY US ============ -->
    <section class="sec sec-dark" id="about">
        <div class="container about-grid">
            <div class="about-media reveal">
                <img src="images/abouttempotraveller.webp" alt="tempo traveller for group tour in Delhi" loading="lazy">
                <div class="about-badge"><strong>10+</strong><span>Years of trusted<br>group travel</span></div>
            </div>
            <div class="about-copy reveal">
                <span class="eyebrow-tag">Why Choose Us</span>
                <h2>About Our Tempo Traveller Rental Service in Delhi</h2>
                <p>With over 10 years of experience, we are one of Delhi’s most trusted tempo traveller rental services. We specialise in group travel: family holidays, pilgrimages, corporate outings, weddings and airport transfers across Delhi NCR and North India.</p>
                <p>Our fleet of well-maintained tempo travellers ranges from 9 to 20 seats, with pushback or recliner seats, powerful AC and charging points. Every vehicle is driven by a professional, courteous driver who knows Delhi NCR and the hills like the back of their hand.</p>
                <div class="why-list">
                    <div class="why-item"><i class="fas fa-user-tie"></i><div><h3>Professional drivers</h3><p>Experienced, polite and route-trained.</p></div></div>
                    <div class="why-item"><i class="fas fa-shield-alt"></i><div><h3>Safe &amp; insured</h3><p>Fully insured fleet with valid permits.</p></div></div>
                    <div class="why-item"><i class="fas fa-receipt"></i><div><h3>Transparent pricing</h3><p>Itemised quotes, no hidden charges.</p></div></div>
                    <div class="why-item"><i class="fas fa-spray-can-sparkles"></i><div><h3>Clean vehicles</h3><p>Sanitised and checked before every trip.</p></div></div>
                    <div class="why-item"><i class="fas fa-clock"></i><div><h3>On-time pickups</h3><p>Punctual, because your time matters.</p></div></div>
                    <div class="why-item"><i class="fas fa-headset"></i><div><h3>24/7 support</h3><p>Call or WhatsApp us any time.</p></div></div>
                </div>
                <a class="btn btn-primary" href="about.php">More About Us <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <!-- ============ HOW IT WORKS ============ -->
    <section class="sec sec-soft" id="how-it-works">
        <div class="container">
            <div class="sec-head">
                <span class="eyebrow-tag">Simple Booking</span>
                <h2 class="section-title">Book Your Tempo Traveller in 4 Easy Steps</h2>
            </div>
            <div class="steps">
                <div class="step reveal"><div class="ico"><i class="fas fa-clipboard-list"></i></div><h3>Share your trip</h3><p>Tell us your dates, route, pickup points and group size.</p></div>
                <div class="step reveal"><div class="ico"><i class="fas fa-file-invoice-dollar"></i></div><h3>Get a clear quote</h3><p>We suggest the right vehicle and send an itemised price.</p></div>
                <div class="step reveal"><div class="ico"><i class="fas fa-circle-check"></i></div><h3>Confirm booking</h3><p>Confirm with a small advance and receive driver details.</p></div>
                <div class="step reveal"><div class="ico"><i class="fas fa-van-shuttle"></i></div><h3>Enjoy the ride</h3><p>Doorstep pickup and a comfortable, stress-free journey.</p></div>
            </div>
        </div>
    </section>

    <!-- ============ PROMO ============ -->
    <section class="promo">
        <div class="container">
            <div class="promo-card reveal">
                <img src="images/chardham-hero-bg.webp" alt="Char Dham Yatra tempo traveller package from Delhi" loading="lazy">
                <div class="promo-copy">
                    <span class="eyebrow-tag light">Pilgrimage Special</span>
                    <h2>Char Dham Yatra by Tempo Traveller</h2>
                    <p>Yamunotri, Gangotri, Kedarnath and Badrinath in one comfortable 10–12 day journey, with a driver experienced on Garhwal hill roads. From ₹8,000/day.</p>
                    <div class="promo-actions">
                        <a class="btn btn-primary" href="chardham-tempo-package.php">View Package <i class="fas fa-arrow-right"></i></a>
                        <a class="btn btn-ghost" href="<?php echo wa_link('Hi, I want a quote for Char Dham Yatra by tempo traveller'); ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Get Quote</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ TOUR PACKAGES ============ -->
    <section class="sec" id="packages">
        <div class="container">
            <div class="sec-head">
                <span class="eyebrow-tag">Tour Packages</span>
                <h2 class="section-title">Tempo Traveller Tour Packages from Delhi</h2>
                <p class="section-sub">Multi-day tours with a dedicated tempo traveller and driver for your group.</p>
            </div>
            <div class="pkg-grid">
                <?php foreach ($packages as $p): ?>
                    <a class="pkg reveal" href="<?php echo $p[0]; ?>">
                        <img src="images/<?php echo $p[2]; ?>-hero-bg.webp" alt="<?php echo $p[1]; ?> tempo traveller package from Delhi" loading="lazy">
                        <div>
                            <h3><?php echo $p[1]; ?></h3>
                            <div class="meta"><span><i class="far fa-calendar"></i><?php echo $p[3]; ?></span><span><i class="fas fa-location-dot"></i>Ex Delhi</span></div>
                            <div class="price">From <strong><?php echo $p[4]; ?></strong></div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ============ REVIEWS ============ -->
    <section class="sec sec-soft" id="reviews">
        <div class="container">
            <div class="sec-head">
                <span class="eyebrow-tag">Customer Reviews</span>
                <h2 class="section-title">What Our Clients Say</h2>
            </div>
            <div class="reviews-grid">
                <?php foreach ($reviews as $rv):
                    $initials = implode('', array_map(function ($w) { return $w[0]; }, explode(' ', $rv[1]))); ?>
                    <figure class="review reveal">
                        <div class="stars" aria-label="5 out of 5 stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        <blockquote>“<?php echo $rv[0]; ?>”</blockquote>
                        <figcaption class="review-author">
                            <span class="avatar"><?php echo $initials; ?></span>
                            <div><strong><?php echo $rv[1]; ?></strong><span><?php echo $rv[2]; ?> · <?php echo $rv[3]; ?></span></div>
                        </figcaption>
                    </figure>
                <?php endforeach; ?>
            </div>
            <div class="center-cta"><a class="btn btn-outline" href="testimonials.php">Read more reviews <i class="fas fa-arrow-right"></i></a></div>
        </div>
    </section>

    <!-- ============ TEMPO TRAVELLER GUIDE ============ -->
    <section class="sec" id="guide">
        <div class="container">
            <div class="sec-head">
                <span class="eyebrow-tag">Complete Guide</span>
                <h2 class="section-title">Tempo Traveller on Rent from Delhi</h2>
                <p class="section-sub guide-intro"><?php echo $guide_intro; ?></p>
            </div>
            <?php foreach ($guide_groups as $group): ?>
                <p class="guide-label"><?php echo $group[0]; ?></p>
                <div class="guide-grid">
                    <?php foreach ($group[1] as $item): ?>
                        <article class="guide-card">
                            <h2><i class="fas <?php echo $item[0]; ?>"></i><?php echo $item[1]; ?></h2>
                            <p><?php echo $item[2]; ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            <div class="center-cta guide-cta">
                <a class="btn btn-primary" href="#quote"><i class="fas fa-file-invoice"></i> Book Online</a>
                <a class="btn btn-outline" href="tel:+917290885949"><i class="fas fa-phone-alt"></i> Call +91 7290885949</a>
            </div>
        </div>
    </section>

    <!-- ============ FAQ ============ -->
    <section class="sec sec-soft" id="faq">
        <div class="container">
            <div class="sec-head">
                <span class="eyebrow-tag">FAQs</span>
                <h2 class="section-title">Frequently Asked Questions</h2>
            </div>
            <div class="faq-wrap">
                <?php foreach ($home_faqs as $i => $faq): ?>
                    <details class="faq-item"<?php echo $i === 0 ? ' open' : ''; ?>>
                        <summary><?php echo htmlspecialchars($faq[0]); ?></summary>
                        <div class="answer"><?php echo htmlspecialchars($faq[1]); ?></div>
                    </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ============ LATEST BLOG POSTS ============ -->
    <section class="related-posts sec-soft-bg">
        <div class="container">
            <div class="sec-head">
                <span class="eyebrow-tag">Travel Guides</span>
                <h2 class="section-title">Latest Travel Guides</h2>
                <p class="section-sub">Prices, vehicle guides and complete trip plans for travelling by tempo traveller from Delhi.</p>
            </div>
            <div class="blog-grid">
                <?php require_once 'blog-data.php'; foreach (array_slice($blog_posts, 0, 3, true) as $slug => $p): ?>
                    <a class="blog-card" href="<?php echo $slug; ?>.php">
                        <div class="thumb">
                            <img src="<?php echo $p['image']; ?>" alt="<?php echo htmlspecialchars($p['image_alt']); ?>" loading="lazy">
                            <span class="cat"><?php echo htmlspecialchars($p['category']); ?></span>
                        </div>
                        <div class="body">
                            <div class="meta"><span><i class="far fa-clock"></i><?php echo $p['read_time']; ?></span></div>
                            <h3><?php echo htmlspecialchars($p['title']); ?></h3>
                            <p><?php echo htmlspecialchars($p['excerpt']); ?></p>
                            <span class="more">Read guide <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="center-cta"><a href="blog.php" class="btn btn-outline">View All Travel Guides <i class="fas fa-arrow-right"></i></a></div>
        </div>
    </section>
</main>
<script src="calculator.js?v=1" defer></script>

<script>
    (function () {
        // Fleet tabs
        var tabs = document.querySelectorAll('.fleet-tabs button');
        var panels = document.querySelectorAll('.fleet-grid[data-panel]');
        function show(name) {
            tabs.forEach(function (t) { var on = t.getAttribute('data-tab') === name; t.classList.toggle('active', on); t.setAttribute('aria-selected', on ? 'true' : 'false'); });
            panels.forEach(function (p) { p.hidden = p.getAttribute('data-panel') !== name; });
        }
        tabs.forEach(function (t) { t.addEventListener('click', function () { show(t.getAttribute('data-tab')); }); });
        show('standard');

        // Reveal on scroll + counters (content stays visible if JS or IntersectionObserver is unavailable)
        if (!('IntersectionObserver' in window)) return;
        document.documentElement.classList.add('js-reveal');
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (en) {
                if (!en.isIntersecting) return;
                en.target.classList.add('in');
                io.unobserve(en.target);
            });
        }, { rootMargin: '0px 0px -8% 0px' });
        document.querySelectorAll('.reveal').forEach(function (el) { io.observe(el); });
        // Safety net: never leave content hidden if the observer does not fire
        setTimeout(function () { document.querySelectorAll('.reveal:not(.in)').forEach(function (el) { el.classList.add('in'); }); }, 2500);

        var co = new IntersectionObserver(function (entries) {
            entries.forEach(function (en) {
                if (!en.isIntersecting) return;
                var el = en.target, target = parseInt(el.getAttribute('data-count'), 10), start = null;
                function step(ts) {
                    if (!start) start = ts;
                    var p = Math.min(1, (ts - start) / 1200);
                    el.textContent = Math.round(target * (1 - Math.pow(1 - p, 3)));
                    if (p < 1) requestAnimationFrame(step);
                }
                requestAnimationFrame(step);
                co.unobserve(el);
            });
        });
        document.querySelectorAll('[data-count]').forEach(function (el) { co.observe(el); });
    })();
</script>

<?php include 'seo_keywords.php'; ?>
<?php include 'footer.php'; ?>
