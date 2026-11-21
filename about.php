<?php
// About page SEO variables
$page_title = 'About Us – Trusted Tempo Traveller Rental Company in Delhi NCR';
$page_description = 'Learn about Delhi Tempo Traveller on Rent – a trusted Delhi NCR company offering clean AC and Maharaja tempo travellers with verified, experienced drivers for local and outstation group travel.';
$page_css = ['pages.css'];

include 'header.php';

$about_reviews = [
    ['Excellent service! The tempo traveller was spotless and the driver was very professional. Made our family trip to Agra so comfortable.', 'Rahul Sharma', 'Delhi'],
    ['Best rates in Delhi and the booking process was smooth. The 16-seater was perfect for our office outing. Highly recommended!', 'Priya Kapoor', 'Gurgaon'],
    ['On time, clean vehicle, polite driver. Everything was perfect. Will definitely book again for our next trip.', 'Amit Verma', 'Noida'],
];
?>

<main class="pg">

    <!-- ============ HERO ============ -->
    <section class="pg-hero">
        <img class="pg-hero-bg" src="images/himachal-hero-bg.webp" alt="about Delhi tempo traveller on rent" fetchpriority="high">
        <div class="container pg-hero-grid">
            <div>
                <nav class="pg-crumbs" aria-label="Breadcrumb"><a href="index.php">Home</a><i class="fas fa-chevron-right"></i><span>About Us</span></nav>
                <span class="pg-tag"><i class="fas fa-building"></i> About Us</span>
                <h1>About Delhi <span>Tempo Traveller</span> on Rent</h1>
                <p class="pg-lead">For over a decade we have helped families, pilgrims, wedding parties and corporate teams travel together across Delhi NCR and North India in clean, comfortable tempo travellers with experienced drivers.</p>
                <div class="pg-actions">
                    <a class="btn btn-primary" href="index.php#quote"><i class="fas fa-file-invoice"></i> Get a Quote Today</a>
                    <a class="btn btn-ghost" href="fleet.php"><i class="fas fa-van-shuttle"></i> View Our Fleet</a>
                </div>
            </div>
            <div class="pg-stats">
                <div class="pg-stat"><i class="fas fa-award"></i><strong>10+</strong><span>Years of experience</span></div>
                <div class="pg-stat"><i class="fas fa-users"></i><strong>500+</strong><span>Happy clients</span></div>
                <div class="pg-stat"><i class="fas fa-van-shuttle"></i><strong>20+</strong><span>Vehicles in fleet</span></div>
                <div class="pg-stat"><i class="fas fa-headset"></i><strong>24/7</strong><span>Booking support</span></div>
            </div>
        </div>
    </section>

    <!-- ============ OUR STORY ============ -->
    <section class="pg-sec">
        <div class="container story">
            <div class="story-media">
                <img src="images/abouttempotraveller.webp" alt="tempo traveller for group tour in Delhi" loading="lazy">
                <div class="story-badge"><i class="fas fa-shield-halved"></i><div><strong>Insured &amp; serviced</strong><span>Every vehicle, every trip</span></div></div>
            </div>
            <div class="story-copy">
                <span class="eyebrow-tag">Our Story</span>
                <h2>Delhi’s trusted name for group travel</h2>
                <p>Welcome to Delhi Tempo Traveller on Rent, your premier choice for group transportation in the National Capital Region. With over a decade of experience in the travel industry, we have established ourselves as a trusted name for <strong>tempo traveller rentals in Delhi</strong>.</p>
                <p>Our journey began with a simple mission: to provide comfortable, reliable, and affordable group travel solutions. Today, we are proud to serve hundreds of satisfied customers, from families and friends to corporate teams and tour groups.</p>
                <p>What sets us apart is our commitment to quality and customer satisfaction. Every vehicle in our fleet is meticulously maintained and equipped with modern amenities to ensure a pleasant journey. Our drivers are not just drivers; they’re experienced professionals who prioritize your safety and comfort.</p>
                <div class="story-sign">
                    <img src="images/logo-icon.svg" alt="Delhi tempo traveller on rent" width="48" height="48" loading="lazy">
                    <div><strong>Delhi Tempo Traveller Team</strong><span>Serving Delhi NCR · 24/7</span></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ MISSION & VISION ============ -->
    <section class="pg-sec pg-soft">
        <div class="container">
            <div class="mv-grid">
                <div class="mv-card">
                    <i class="fas fa-bullseye"></i>
                    <h3>Our Mission</h3>
                    <p>To provide safe, comfortable, and affordable group travel solutions that exceed customer expectations and create memorable journeys.</p>
                </div>
                <div class="mv-card alt">
                    <i class="fas fa-eye"></i>
                    <h3>Our Vision</h3>
                    <p>To become the most trusted and preferred tempo traveller rental service in Delhi NCR, known for excellence, reliability, and customer care.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ VALUES ============ -->
    <section class="pg-sec">
        <div class="container">
            <div class="pg-head">
                <span class="eyebrow-tag">Our Values</span>
                <h2 class="section-title">What We Stand For</h2>
            </div>
            <div class="values">
                <div class="value"><i class="fas fa-shield-halved"></i><h3>Safety First</h3><p>All vehicles are insured and regularly serviced, and driven by experienced professionals.</p></div>
                <div class="value"><i class="fas fa-heart"></i><h3>Customer Focus</h3><p>We tailor every trip to your group, your route and your schedule.</p></div>
                <div class="value"><i class="fas fa-receipt"></i><h3>Transparency</h3><p>No hidden costs, clear pricing from the start. Toll, state tax and driver allowance are included; only parking, GST and a ₹500 driver night charge (10 PM – 6 AM) are extra.</p></div>
                <div class="value"><i class="fas fa-clock"></i><h3>Punctuality</h3><p>We value your time and always aim to arrive on schedule.</p></div>
            </div>
        </div>
    </section>

    <!-- ============ WHAT WE OFFER ============ -->
    <section class="pg-sec pg-soft">
        <div class="container">
            <div class="pg-head">
                <span class="eyebrow-tag">Our Fleet</span>
                <h2 class="section-title">Tempo Travellers for Every Group</h2>
            </div>
            <div class="offer">
                <a href="fleet.php"><small>Families</small><strong>12 Seater Tempo</strong><span>From ₹30/km</span></a>
                <a href="fleet.php"><small>Office teams</small><strong>16 Seater Tempo</strong><span>From ₹35/km</span></a>
                <a href="fleet.php"><small>Large groups</small><strong>20 Seater Tempo</strong><span>From ₹40/km</span></a>
                <a href="maharaja-tempo-traveller-on-rent-in-delhi.php"><small>Luxury</small><strong>Maharaja Tempo</strong><span>9–16 seats · from ₹35/km</span></a>
            </div>
            <p class="offer-note"><i class="fas fa-circle-info"></i> Toll tax, state tax and driver allowance are included. Parking and GST are extra, plus a driver night charge of ₹500 if the driver drives between 10 PM and 6 AM.</p>
        </div>
    </section>

    <!-- ============ AREAS ============ -->
    <section class="pg-sec">
        <div class="container areas">
            <div>
                <span class="eyebrow-tag">Where We Serve</span>
                <h2>Pickup anywhere in Delhi NCR, travel across North India</h2>
                <p>We pick up from homes, offices, hotels, the airport and railway stations across Delhi NCR, and run outstation trips and tours to 25+ destinations.</p>
            </div>
            <div>
                <div class="chip-set" style="margin-bottom:14px;">
                    <span><i class="fas fa-location-dot"></i>Delhi</span><span><i class="fas fa-location-dot"></i>New Delhi</span><span><i class="fas fa-location-dot"></i>Noida</span><span><i class="fas fa-location-dot"></i>Greater Noida</span><span><i class="fas fa-location-dot"></i>Gurugram</span><span><i class="fas fa-location-dot"></i>Ghaziabad</span><span><i class="fas fa-location-dot"></i>Faridabad</span><span><i class="fas fa-plane"></i>IGI Airport</span>
                </div>
                <div class="chip-set">
                    <a href="delhi-to-agra-tempo-on-rent.php">Agra</a><a href="delhi-to-jaipur-tempo-on-rent.php">Jaipur</a><a href="delhi-to-manali-tempo-on-rent.php">Manali</a><a href="delhi-to-shimla-tempo-on-rent.php">Shimla</a><a href="delhi-to-rishikesh-tempo-on-rent.php">Rishikesh</a><a href="delhi-to-haridwar-tempo-on-rent.php">Haridwar</a><a href="chardham-tempo-package.php">Char Dham</a><a href="services.php#routes">All routes →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ NETWORK ============ -->
    <section class="pg-sec pg-soft">
        <div class="container">
            <div class="pg-head">
                <span class="eyebrow-tag">Our Travel Network</span>
                <h2 class="section-title">Part of the GetMeCab travel family</h2>
                <p>Delhi Tempo Traveller on Rent is run by the team behind <a href="https://www.getmecab.com/" target="_blank" rel="noopener"><strong>GetMeCab</strong></a>, which books <a href="https://www.getmecab.com/" target="_blank" rel="noopener">outstation cabs and one-way taxis</a> across India. If a tempo traveller isn't the right fit for your group, our sister services have you covered: a <a href="https://innovacrystarent.com/" target="_blank" rel="noopener">Innova Crysta on rent in Delhi</a> for families of up to 7, a luxury <a href="https://urbaniaonrentdelhi.co.in/" target="_blank" rel="noopener">Force Urbania on rent in Delhi</a> for premium 12–16 seater group travel, and fixed-date <a href="https://www.getmeyatra.com/" target="_blank" rel="noopener">group yatras and pilgrimage tour packages with GetMeYatra</a>. Same team, same 24/7 support on +91 7290885949.</p>
            </div>
        </div>
    </section>

    <!-- ============ REVIEWS ============ -->
    <section class="pg-sec pg-soft">
        <div class="container">
            <div class="pg-head">
                <span class="eyebrow-tag">Customer Reviews</span>
                <h2 class="section-title">What Our Clients Say</h2>
            </div>
            <div class="pg-reviews">
                <?php foreach ($about_reviews as $rv): $ini = implode('', array_map(function ($w) { return strtoupper(substr($w, 0, 1)); }, explode(' ', $rv[1]))); ?>
                    <figure class="pg-review">
                        <div class="stars" aria-label="5 out of 5 stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        <blockquote>“<?php echo $rv[0]; ?>”</blockquote>
                        <figcaption><span class="avatar"><?php echo $ini; ?></span><span><strong><?php echo $rv[1]; ?></strong><small><?php echo $rv[2]; ?></small></span></figcaption>
                    </figure>
                <?php endforeach; ?>
            </div>
            <div class="center"><a class="btn btn-outline" href="testimonials.php">Read more reviews <i class="fas fa-arrow-right"></i></a></div>
        </div>
    </section>
</main>

<?php include 'seo_keywords.php'; ?>
<?php include 'footer.php'; ?>
