<?php if (basename($_SERVER['SCRIPT_FILENAME']) === 'footer.php') { header('Location: index.php', true, 301); exit; } ?>
<!-- footer.php -->
    <!-- Call-to-action band -->
    <section class="footer-cta">
        <div class="container">
            <div>
                <h2>Planning a group trip from Delhi?</h2>
                <p>Tell us your dates and route. We will reply with the right tempo traveller and a clear, itemised quote.</p>
            </div>
            <div class="cta-actions">
                <a class="btn btn-light" href="tel:+917290885949"><i class="fas fa-phone-alt"></i> +91 7290885949</a>
                <a class="btn btn-wa" href="https://wa.me/917290885949?text=Hi%2C%20I%20need%20a%20tempo%20traveller%20quote" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                <a class="btn btn-dark" href="<?php echo isset($quote_link) ? $quote_link : 'index.php#quote'; ?>"><i class="fas fa-file-invoice"></i> Get Free Quote</a>
            </div>
        </div>
    </section>

    <footer class="site-footer">
        <div class="container footer-main">
            <div class="footer-brand">
                <a class="logo" href="index.php" style="display:inline-flex;align-items:center;gap:11px;text-decoration:none;">
                    <img src="images/logo-icon.svg" alt="tempo traveller on rent in Delhi" width="44" height="44" loading="lazy">
                    <span class="logo-text"><strong>Delhi <span style="color:var(--brand)">Tempo</span></strong><small>Traveller on Rent</small></span>
                </a>
                <p>Delhi NCR’s trusted tempo traveller rental service. 12, 16 &amp; 20 seater AC tempo travellers and luxury Maharaja tempos with experienced drivers, for local trips, outstation tours, weddings and corporate travel.</p>
                <div class="footer-social">
                    <a href="https://www.facebook.com/GetMeCabFB" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/delhitempotravelleronrent?stkn=bGZwN2JrMmcwMWVx" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://x.com/getmecab" target="_blank" rel="noopener" aria-label="X (Twitter)"><i class="fab fa-x-twitter"></i></a>
                    <a href="https://www.youtube.com/@getmecab9627" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="https://wa.me/917290885949" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <div>
                <h3>Company</h3>
                <ul class="footer-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="fleet.php">Our Fleet</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="testimonials.php">Customer Reviews</a></li>
                    <li><a href="blog.php">Travel Blog</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
            </div>

            <div>
                <h3>Popular Routes</h3>
                <ul class="footer-links">
                    <?php
                    $footer_routes = isset($nav_routes) ? array_slice($nav_routes, 0, 8, true) : [];
                    foreach ($footer_routes as $slug => $name): ?>
                        <li><a href="delhi-to-<?php echo $slug; ?>-tempo-on-rent.php">Delhi to <?php echo $name; ?> Tempo</a></li>
                    <?php endforeach; ?>
                    <li><a href="destinations.php">All Destinations</a></li>
                </ul>
            </div>

            <div>
                <h3>Tour Packages</h3>
                <ul class="footer-links">
                    <?php if (isset($nav_packages)) foreach ($nav_packages as $file => $pkg): ?>
                        <li><a href="<?php echo $file; ?>"><?php echo $pkg[0]; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="footer-contact-col">
                <h3>Contact Us</h3>
                <ul class="footer-contact">
                    <li><i class="fas fa-map-marker-alt"></i><div><small>Address</small><span>Delhi NCR, India</span></div></li>
                    <li><i class="fas fa-phone-alt"></i><div><small>Phone</small><a href="tel:+917290885949">+91 7290885949</a></div></li>
                    <li><i class="fab fa-whatsapp"></i><div><small>WhatsApp</small><a href="https://wa.me/917290885949" target="_blank" rel="noopener">+91 7290885949</a></div></li>
                    <li><i class="fas fa-envelope"></i><div><small>Email</small><a href="mailto:bookingsgetmecab@gmail.com">bookingsgetmecab@gmail.com</a></div></li>
                    <li><i class="fas fa-clock"></i><div><small>Working Hours</small><span>24/7 Support Available</span></div></li>
                </ul>
            </div>
        </div>

        <div class="container footer-areas">
            <strong><i class="fas fa-location-dot" style="color:var(--brand);margin-right:6px;"></i>We serve:</strong>
            <span>Delhi</span><span>New Delhi</span><a href="tempo-traveller-on-rent-in-noida.php">Noida</a><a href="tempo-traveller-on-rent-in-noida.php">Greater Noida</a><a href="tempo-traveller-on-rent-in-gurgaon.php">Gurugram</a><a href="tempo-traveller-on-rent-in-ghaziabad.php">Ghaziabad</a><a href="tempo-traveller-on-rent-in-faridabad.php">Faridabad</a><a href="tempo-traveller-on-rent-near-delhi-airport.php">IGI Airport</a>
        </div>

        <div class="container footer-areas footer-network">
            <strong><i class="fas fa-van-shuttle" style="color:var(--brand);margin-right:6px;"></i>Vehicles:</strong>
            <a href="12-seater-tempo-traveller-on-rent-in-delhi.php">12 Seater Tempo Traveller</a>
            <a href="16-seater-tempo-traveller-on-rent-in-delhi.php">16 Seater Tempo Traveller</a>
            <a href="20-seater-tempo-traveller-on-rent-in-delhi.php">20 Seater Tempo Traveller</a>
            <a href="maharaja-tempo-traveller-on-rent-in-delhi.php">Maharaja Tempo Traveller</a>
        </div>

        <div class="container footer-areas footer-network">
            <strong><i class="fas fa-link" style="color:var(--brand);margin-right:6px;"></i>Our travel network:</strong>
            <a href="https://www.getmecab.com/" target="_blank" rel="noopener">GetMeCab – Outstation Cabs</a>
            <a href="https://www.getmeyatra.com/" target="_blank" rel="noopener">GetMeYatra – Group Yatras &amp; Tours</a>
            <a href="https://innovacrystarent.com/" target="_blank" rel="noopener">Innova Crysta on Rent in Delhi</a>
            <a href="https://urbaniaonrentdelhi.co.in/" target="_blank" rel="noopener">Force Urbania on Rent in Delhi</a>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <span>&copy; <?php echo date('Y'); ?> Delhi Tempo Traveller on Rent. All rights reserved.</span>
                <span>
                    <a href="contact.php">Contact</a>
                    <a href="blog.php">Blog</a>
                    <a href="sitemap.xml">Sitemap</a>
                </span>
            </div>
        </div>
    </footer>
</body>
</html>
