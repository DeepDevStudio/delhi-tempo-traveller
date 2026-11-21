<?php
// ---------------------------------------------------------------------------
// Enquiry form handler: validates and forwards the enquiry to WhatsApp.
// Works without JavaScript (plain POST → redirect to wa.me).
// ---------------------------------------------------------------------------
$whatsapp_number = '917290885949';
$error_messages = [];
$form = ['name' => '', 'phone' => '', 'email' => '', 'pickup' => '', 'destination' => '', 'travel_date' => '', 'vehicle' => '', 'passengers' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    foreach ($form as $key => $unused) {
        $form[$key] = trim(strip_tags((string) filter_input(INPUT_POST, $key)));
    }
    if (!empty($_POST['honeypot'])) {
        header('Location: contact.php');
        exit;
    }
    if ($form['name'] === '') $error_messages[] = 'Please enter your name.';
    if (!preg_match('/^[0-9+\s-]{10,15}$/', $form['phone'])) $error_messages[] = 'Please enter a valid mobile number.';
    if ($form['email'] !== '' && !filter_var($form['email'], FILTER_VALIDATE_EMAIL)) $error_messages[] = 'Please enter a valid email address, or leave it blank.';
    if ($form['travel_date'] !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $form['travel_date'])) $error_messages[] = 'Please choose a valid travel date.';

    if (empty($error_messages)) {
        $lines = [
            'New Booking Inquiry (Contact Page)',
            'Name: ' . $form['name'],
            'Mobile: ' . $form['phone'],
        ];
        if ($form['email'] !== '') $lines[] = 'Email: ' . $form['email'];
        $lines[] = 'Pickup: ' . ($form['pickup'] !== '' ? $form['pickup'] : 'Not specified');
        $lines[] = 'Destination: ' . ($form['destination'] !== '' ? $form['destination'] : 'Not specified');
        $lines[] = 'Travel Date: ' . ($form['travel_date'] !== '' ? date('d M Y', strtotime($form['travel_date'])) : 'Not decided');
        $lines[] = 'Vehicle: ' . ($form['vehicle'] !== '' ? $form['vehicle'] : 'Please suggest');
        if ($form['passengers'] !== '') $lines[] = 'Passengers: ' . $form['passengers'];
        if ($form['message'] !== '') $lines[] = 'Message: ' . $form['message'];
        header('Location: https://wa.me/' . $whatsapp_number . '?text=' . rawurlencode(implode("\n", $lines)));
        exit;
    }
}

// Page SEO variables
$page_title = 'Contact Us – Book a Tempo Traveller in Delhi | +91 7290885949';
$page_description = 'Contact Delhi Tempo Traveller on Rent to book a 9–20 seater tempo traveller in Delhi NCR. Call or WhatsApp +91 7290885949, 24/7 support, instant quotes.';
$page_css = ['pages.css'];

$contact_faqs = [
    ['How quickly will you reply?', 'We usually reply on WhatsApp within minutes, and our team is available 24/7 on call and WhatsApp.'],
    ['What details should I share for a quote?', 'Your travel date, pickup point, destination or route, number of passengers and number of days. With these we can suggest the right vehicle and send an itemised quote.'],
    ['Which areas do you pick up from?', 'Anywhere in Delhi NCR: Delhi, New Delhi, Noida, Greater Noida, Gurugram, Ghaziabad and Faridabad, plus IGI Airport and all major Delhi railway stations.'],
    ['Are toll, tax and parking included in the fare?', 'Toll tax, state tax and driver allowance are included in the fare. Parking and GST are extra, and a driver night charge of ₹500 applies if the driver drives between 10 PM and 6 AM.'],
];
$faq_entities = [];
foreach ($contact_faqs as $f) {
    $faq_entities[] = ['@type' => 'Question', 'name' => $f[0], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f[1]]];
}
$page_schema = '    <script type="application/ld+json">' . json_encode(['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $faq_entities], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "</script>\n";

include 'header.php';
$h = function ($s) { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); };
$vehicle_options = ['12 Seater Tempo Traveller', '16 Seater Tempo Traveller', '20 Seater Tempo Traveller', '25 Seater Tempo Traveller', '9/12 Seater Maharaja Tempo', '16 Seater Maharaja Tempo'];
?>

<main class="pg">

    <!-- ============ HERO ============ -->
    <section class="pg-hero">
        <img class="pg-hero-bg" src="images/manali-hero-bg.webp" alt="contact Delhi tempo traveller on rent" fetchpriority="high">
        <div class="container pg-hero-grid">
            <div>
                <nav class="pg-crumbs" aria-label="Breadcrumb"><a href="index.php">Home</a><i class="fas fa-chevron-right"></i><span>Contact Us</span></nav>
                <span class="pg-tag"><i class="fas fa-headset"></i> 24/7 Support</span>
                <h1>Contact Us to Book a <span>Tempo Traveller</span></h1>
                <p class="pg-lead">We’re here to help! Get a free quote or book your ride. Call, WhatsApp or send an enquiry, and we’ll suggest the right vehicle for your group with a clear, itemised price.</p>
                <div class="pg-actions">
                    <a class="btn btn-primary" href="#enquiry"><i class="fas fa-paper-plane"></i> Send an Enquiry</a>
                    <a class="btn btn-ghost" href="https://wa.me/917290885949?text=Hi%2C%20I%20need%20a%20tempo%20traveller%20quote" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Chat on WhatsApp</a>
                </div>
            </div>
            <div class="pg-quick">
                <a href="tel:+917290885949"><i class="ico fas fa-phone-alt"></i><span><small>Call us 24/7</small><strong>+91 7290885949</strong></span><i class="go fas fa-arrow-right"></i></a>
                <a class="wa" href="https://wa.me/917290885949" target="_blank" rel="noopener"><i class="ico fab fa-whatsapp"></i><span><small>WhatsApp</small><strong>+91 7290885949</strong></span><i class="go fas fa-arrow-right"></i></a>
                <a class="mail" href="mailto:bookingsgetmecab@gmail.com"><i class="ico fas fa-envelope"></i><span><small>Email</small><strong>bookingsgetmecab@gmail.com</strong></span><i class="go fas fa-arrow-right"></i></a>
                <div class="hours"><i class="ico fas fa-clock"></i><span><small>Working hours</small><strong>24/7 Support Available</strong></span></div>
            </div>
        </div>
    </section>

    <!-- ============ INFO + FORM ============ -->
    <section class="pg-sec pg-soft" id="enquiry">
        <div class="container contact-grid">
            <aside class="info-card">
                <h2>Get in Touch</h2>
                <p>Reach out to us for any inquiries, bookings, or support.</p>
                <ul class="info-list">
                    <li><i class="fas fa-map-marker-alt"></i><div><small>Address</small><span>Delhi NCR, India</span></div></li>
                    <li><i class="fas fa-phone-alt"></i><div><small>Phone</small><a href="tel:+917290885949">+91 7290885949</a></div></li>
                    <li><i class="fab fa-whatsapp"></i><div><small>WhatsApp</small><a href="https://wa.me/917290885949" target="_blank" rel="noopener">+91 7290885949</a></div></li>
                    <li><i class="fas fa-envelope"></i><div><small>Email</small><a href="mailto:bookingsgetmecab@gmail.com">bookingsgetmecab@gmail.com</a></div></li>
                    <li><i class="fas fa-clock"></i><div><small>Working Hours</small><span>24/7 Support Available</span></div></li>
                    <li><i class="fas fa-route"></i><div><small>Service Area</small><span>Delhi, Noida, Gurugram, Ghaziabad, Faridabad &amp; IGI Airport</span></div></li>
                </ul>
                <div class="info-social">
                    <a href="https://www.facebook.com/GetMeCabFB" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/delhitempotravelleronrent?stkn=bGZwN2JrMmcwMWVx" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://x.com/getmecab" target="_blank" rel="noopener" aria-label="X (Twitter)"><i class="fab fa-x-twitter"></i></a>
                    <a href="https://www.youtube.com/@getmecab9627" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
            </aside>

            <div class="form-card">
                <div class="form-card-head">
                    <h2>Send an Enquiry</h2>
                    <p>Fill in your trip details and we’ll reply on WhatsApp with the best vehicle and a free quote.</p>
                </div>
                <form class="enquiry" method="post" action="contact.php#enquiry" novalidate>
                    <?php if (!empty($error_messages)): ?>
                        <div class="form-errors" role="alert"><?php echo implode('<br>', array_map($h, $error_messages)); ?></div>
                    <?php endif; ?>
                    <label class="tf"><span>Your name <em>*</em></span><input name="name" type="text" autocomplete="name" placeholder="Full name" required value="<?php echo $h($form['name']); ?>"></label>
                    <label class="tf"><span>Mobile number <em>*</em></span><input name="phone" type="tel" inputmode="tel" autocomplete="tel" placeholder="10-digit mobile" required pattern="[0-9+\s-]{10,15}" value="<?php echo $h($form['phone']); ?>"></label>
                    <label class="tf"><span>Email (optional)</span><input name="email" type="email" autocomplete="email" placeholder="you@example.com" value="<?php echo $h($form['email']); ?>"></label>
                    <label class="tf"><span>Travel date</span><input name="travel_date" type="date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo $h($form['travel_date']); ?>"></label>
                    <label class="tf"><span>Pickup location</span><input name="pickup" type="text" placeholder="e.g. Dwarka, Noida, IGI Airport" value="<?php echo $h($form['pickup']); ?>"></label>
                    <label class="tf"><span>Destination</span><input name="destination" type="text" placeholder="e.g. Manali, Agra, local Delhi" value="<?php echo $h($form['destination']); ?>"></label>
                    <label class="tf"><span>Vehicle</span>
                        <select name="vehicle">
                            <option value="">Help me choose</option>
                            <?php foreach ($vehicle_options as $v): ?><option<?php echo $form['vehicle'] === $v ? ' selected' : ''; ?>><?php echo $v; ?></option><?php endforeach; ?>
                        </select>
                    </label>
                    <label class="tf"><span>Passengers</span><input name="passengers" type="number" min="1" max="60" inputmode="numeric" placeholder="e.g. 14" value="<?php echo $h($form['passengers']); ?>"></label>
                    <label class="tf full"><span>Message</span><textarea name="message" placeholder="Tell us your requirements: number of days, places to visit, luggage…"><?php echo $h($form['message']); ?></textarea></label>
                    <div class="hp-field" aria-hidden="true"><input name="honeypot" type="text" tabindex="-1" autocomplete="off"></div>
                    <button class="btn btn-primary btn-block full" type="submit" name="contact_submit" value="1"><i class="fab fa-whatsapp"></i> Send Enquiry on WhatsApp</button>
                    <p class="form-foot full"><i class="fas fa-lock"></i> We only use your details to send your quote. Toll, state tax &amp; driver allowance included. Parking, GST &amp; ₹500 driver night charge (10 PM – 6 AM) extra.</p>
                </form>
            </div>
        </div>
    </section>

    <!-- ============ MAP ============ -->
    <section class="pg-sec">
        <div class="container">
            <div class="map-card">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d224346.48134659047!2d77.068899!3d28.527554!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfd5b347eb62d%3A0x52c2b7494e204dce!2sNew%20Delhi%2C%20Delhi%2C%20India!5e0!3m2!1sen!2sus!4v1700000000000" title="Delhi NCR service area map" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div class="map-label"><i class="fas fa-location-dot"></i><div><strong>Serving all of Delhi NCR</strong><span>Doorstep pickup · Airport · Railway stations · Hotels</span></div></div>
            </div>
        </div>
    </section>

    <!-- ============ FAQ ============ -->
    <section class="pg-sec pg-soft">
        <div class="container">
            <div class="pg-head">
                <span class="eyebrow-tag">Quick Answers</span>
                <h2 class="section-title">Before You Contact Us</h2>
            </div>
            <div class="mini-faq">
                <?php foreach ($contact_faqs as $i => $f): ?>
                    <details<?php echo $i === 0 ? ' open' : ''; ?>><summary><?php echo $f[0]; ?></summary><div><?php echo $f[1]; ?></div></details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php include 'seo_keywords.php'; ?>
<?php include 'footer.php'; ?>
