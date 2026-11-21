<?php
// Fleet page SEO variables
$page_title = 'Tempo Traveller Fleet & Rates in Delhi – 12, 16, 20, 25 Seater';
$page_description = 'Our tempo traveller fleet in Delhi: 12 seater ₹30/km, 16 seater ₹35/km, 20 seater ₹40/km, 25 seater ₹43/km and Maharaja tempos, all with drivers. Call +91 7290885949.';
$page_keywords = 'tempo traveller fleet, luxury tempo traveller, group travel vehicle, 12 seater tempo, 16 seater tempo, 20 seater tempo, 25 seater tempo, Maharaja tempo, tempo traveller on rent, Delhi tempo traveller';

include 'header.php';
?>

<main>
    <style>
        /* ============================================
        FLEET PAGE STYLES
           ============================================ */
        .fleet-page {
            padding: 60px 0;
            background: white;
        }

        .fleet-page .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #f97316, #d00000);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .fleet-page .section-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 40px;
            font-size: 1.1rem;
        }

        .fleet-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }

        .fleet-card {
            background: #faf9f8;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
            transition: all 0.35s;
            border: 1px solid #f0f0f0;
        }

        .fleet-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.1);
            border-color: #f97316;
        }

        .fleet-image {
            height: 220px;
            overflow: hidden;
            background: #e8e8e8;
            position: relative;
        }

        .fleet-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .fleet-card:hover .fleet-image img {
            transform: scale(1.05);
        }

        .fleet-image .badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, #f97316, #d00000);
            color: white;
            padding: 4px 16px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .fleet-details {
            padding: 25px;
        }

        .fleet-details h3 {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: #1a1a2e;
        }

        .fleet-details .subtitle {
            color: #888;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .fleet-details .price {
            font-size: 1.8rem;
            font-weight: 800;
            color: #d00000;
            margin: 10px 0;
        }

        .fleet-details .price span {
            font-size: 1rem;
            font-weight: 400;
            color: #888;
        }

        .fleet-details ul {
            list-style: none;
            padding: 0;
            margin: 15px 0 20px;
        }

        .fleet-details ul li {
            padding: 6px 0;
            color: #555;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
        }

        .fleet-details ul li i {
            color: #f97316;
            width: 18px;
        }

        .fleet-details .btn-book {
            display: inline-block;
            padding: 10px 30px;
            background: linear-gradient(135deg, #f97316, #d00000);
            color: white;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s;
            box-shadow: 0 8px 25px rgba(249, 115, 22, 0.2);
        }

        .fleet-details .btn-book:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(249, 115, 22, 0.35);
        }

        /* ============================================
           INCLUSION / EXCLUSION SECTION (UPDATED)
           ============================================ */
        .inclusion-exclusion {
            padding: 60px 0;
            background: linear-gradient(135deg, #faf9f8, #fef9f4);
            border-top: 2px solid #f0f0f0;
            border-bottom: 2px solid #f0f0f0;
        }

        .inclusion-exclusion .section-title {
            text-align: center;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #f97316, #d00000);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .inclusion-exclusion .section-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 40px;
            font-size: 1.05rem;
        }

        .ie-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            max-width: 1100px;
            margin: 0 auto;
        }

        .ie-box {
            background: white;
            padding: 35px 30px;
            border-radius: 18px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.04);
            border: 2px solid transparent;
            transition: all 0.3s;
        }

        .ie-box:hover {
            border-color: #f97316;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.06);
        }

        .ie-box h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .ie-box.inclusion h3 {
            color: #2e7d32;
        }

        .ie-box.inclusion h3 i {
            color: #2e7d32;
            font-size: 1.8rem;
        }

        .ie-box.exclusion h3 {
            color: #c62828;
        }

        .ie-box.exclusion h3 i {
            color: #c62828;
            font-size: 1.8rem;
        }

        .ie-box ul {
            list-style: none;
            padding: 0;
        }

        .ie-box ul li {
            padding: 12px 0;
            border-bottom: 1px solid #f5f5f5;
            display: flex;
            align-items: flex-start;
            gap: 14px;
            color: #555;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .ie-box ul li:last-child {
            border-bottom: none;
        }

        .ie-box ul li i {
            margin-top: 2px;
            flex-shrink: 0;
        }

        .ie-box.inclusion ul li i {
            color: #2e7d32;
        }

        .ie-box.exclusion ul li i {
            color: #c62828;
        }

        .ie-box ul li strong {
            color: #1a1a2e;
        }

        .ie-box .highlight {
            background: #fef6ee;
            padding: 1px 8px;
            border-radius: 4px;
            font-weight: 600;
            color: #d00000;
        }

        /* ============================================
           MOBILE RESPONSIVE CSS
           ============================================ */

        /* Tablets and smaller desktops (992px and down) */
        @media (max-width: 992px) {
            .fleet-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 25px;
            }

            .fleet-page .section-title {
                font-size: 2.2rem;
            }

            .fleet-page .section-subtitle {
                font-size: 1rem;
                margin-bottom: 30px;
            }

            .fleet-image {
                height: 200px;
            }

            .fleet-details {
                padding: 20px;
            }

            .fleet-details h3 {
                font-size: 1.4rem;
            }

            .fleet-details .price {
                font-size: 1.6rem;
            }

            .ie-grid {
                gap: 25px;
            }

            .ie-box {
                padding: 30px 25px;
            }
        }

        /* Mobile devices (768px and down) */
        @media (max-width: 768px) {
            .fleet-page {
                padding: 40px 0;
            }

            .fleet-grid {
                grid-template-columns: 1fr;
                gap: 20px;
                margin-bottom: 40px;
                max-width: 450px;
                margin-left: auto;
                margin-right: auto;
            }

            .fleet-page .section-title {
                font-size: 1.8rem;
            }

            .fleet-page .section-subtitle {
                font-size: 0.95rem;
                margin-bottom: 25px;
            }

            .fleet-image {
                height: 180px;
            }

            .fleet-image .badge {
                font-size: 0.6rem;
                padding: 3px 12px;
                top: 10px;
                right: 10px;
            }

            .fleet-details {
                padding: 18px;
            }

            .fleet-details h3 {
                font-size: 1.3rem;
            }

            .fleet-details .subtitle {
                font-size: 0.85rem;
                margin-bottom: 10px;
            }

            .fleet-details .price {
                font-size: 1.4rem;
                margin: 8px 0;
            }

            .fleet-details .price span {
                font-size: 0.9rem;
            }

            .fleet-details ul {
                margin: 10px 0 15px;
            }

            .fleet-details ul li {
                font-size: 0.85rem;
                padding: 4px 0;
            }

            .fleet-details ul li i {
                width: 16px;
                font-size: 0.9rem;
            }

            .fleet-details .btn-book {
                padding: 8px 20px;
                font-size: 0.85rem;
                display: block;
                text-align: center;
                width: 100%;
            }

            /* Inclusion/Exclusion Section */
            .inclusion-exclusion {
                padding: 40px 0;
            }

            .inclusion-exclusion .section-title {
                font-size: 1.7rem;
            }

            .inclusion-exclusion .section-subtitle {
                font-size: 0.95rem;
                margin-bottom: 25px;
            }

            .ie-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .ie-box {
                padding: 25px 20px;
                border-radius: 15px;
            }

            .ie-box h3 {
                font-size: 1.2rem;
                margin-bottom: 15px;
            }

            .ie-box h3 i {
                font-size: 1.4rem;
            }

            .ie-box ul li {
                padding: 10px 0;
                font-size: 0.88rem;
                gap: 12px;
            }

            .ie-box ul li i {
                font-size: 0.9rem;
            }
        }

        /* Small mobile devices (576px and down) */
        @media (max-width: 576px) {
            .fleet-page {
                padding: 30px 0;
            }

            .fleet-page .section-title {
                font-size: 1.6rem;
            }

            .fleet-page .section-subtitle {
                font-size: 0.9rem;
                margin-bottom: 20px;
            }

            .fleet-grid {
                gap: 15px;
                margin-bottom: 30px;
                max-width: 100%;
            }

            .fleet-image {
                height: 160px;
            }

            .fleet-image .badge {
                font-size: 0.5rem;
                padding: 2px 10px;
                top: 8px;
                right: 8px;
            }

            .fleet-details {
                padding: 15px;
            }

            .fleet-details h3 {
                font-size: 1.15rem;
            }

            .fleet-details .subtitle {
                font-size: 0.8rem;
            }

            .fleet-details .price {
                font-size: 1.2rem;
            }

            .fleet-details .price span {
                font-size: 0.8rem;
            }

            .fleet-details ul li {
                font-size: 0.8rem;
                padding: 3px 0;
            }

            .fleet-details ul li i {
                width: 14px;
                font-size: 0.8rem;
            }

            .fleet-details .btn-book {
                padding: 8px 16px;
                font-size: 0.8rem;
            }

            /* Inclusion/Exclusion Section */
            .inclusion-exclusion {
                padding: 30px 0;
            }

            .inclusion-exclusion .section-title {
                font-size: 1.4rem;
            }

            .inclusion-exclusion .section-subtitle {
                font-size: 0.85rem;
                margin-bottom: 20px;
            }

            .ie-box {
                padding: 20px 15px;
                border-radius: 12px;
            }

            .ie-box h3 {
                font-size: 1.1rem;
            }

            .ie-box h3 i {
                font-size: 1.2rem;
            }

            .ie-box ul li {
                padding: 8px 0;
                font-size: 0.82rem;
                gap: 10px;
            }

            .ie-box ul li i {
                font-size: 0.8rem;
            }

            .ie-box .highlight {
                padding: 1px 6px;
                font-size: 0.8rem;
            }
        }

        /* Extra small devices (400px and down) */
        @media (max-width: 400px) {
            .fleet-page .section-title {
                font-size: 1.4rem;
            }

            .fleet-image {
                height: 140px;
            }

            .fleet-details h3 {
                font-size: 1rem;
            }

            .fleet-details .price {
                font-size: 1.1rem;
            }

            .fleet-details ul li {
                font-size: 0.75rem;
            }

            .fleet-details .btn-book {
                padding: 6px 14px;
                font-size: 0.75rem;
            }

            .inclusion-exclusion .section-title {
                font-size: 1.2rem;
            }

            .ie-box h3 {
                font-size: 1rem;
            }

            .ie-box ul li {
                font-size: 0.78rem;
            }
        }

        /* Landscape phones */
        @media (max-height: 600px) and (orientation: landscape) {
            .fleet-page {
                padding: 20px 0;
            }

            .fleet-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .fleet-image {
                height: 130px;
            }

            .fleet-details {
                padding: 12px;
            }

            .fleet-details h3 {
                font-size: 1rem;
            }

            .fleet-details .price {
                font-size: 1rem;
                margin: 5px 0;
            }

            .fleet-details ul {
                margin: 5px 0 10px;
            }

            .fleet-details ul li {
                font-size: 0.75rem;
                padding: 2px 0;
            }

            .fleet-details .btn-book {
                padding: 5px 14px;
                font-size: 0.75rem;
            }

            .inclusion-exclusion {
                padding: 20px 0;
            }

            .ie-grid {
                grid-template-columns: 1fr 1fr;
                gap: 15px;
            }

            .ie-box {
                padding: 15px;
            }

            .ie-box ul li {
                padding: 6px 0;
                font-size: 0.75rem;
            }
        }

        /* Tablet landscape */
        @media (min-width: 769px) and (max-width: 992px) and (orientation: landscape) {
            .fleet-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .fleet-image {
                height: 180px;
            }
        }
    </style>

    <!-- ============================================
    FLEET GRID
    ============================================ -->
    <section class="fleet-page">
        <div class="container">
            <h1 class="section-title">🚐 Our Tempo Traveller Fleet in Delhi</h1>
            <p class="section-subtitle">Choose from our range of well-maintained tempo travellers for your group travel needs</p>
            <p class="section-subtitle">Details and prices by size: <a href="12-seater-tempo-traveller-on-rent-in-delhi.php">12 seater tempo traveller</a> · <a href="16-seater-tempo-traveller-on-rent-in-delhi.php">16 seater tempo traveller</a> · <a href="20-seater-tempo-traveller-on-rent-in-delhi.php">20 seater tempo traveller</a> · <a href="maharaja-tempo-traveller-on-rent-in-delhi.php">Maharaja tempo traveller</a></p>

            <div class="fleet-grid">
                <!-- 12 Seater -->
                <div class="fleet-card">
                    <div class="fleet-image">
                        <img loading="lazy" src="images/tempo12.webp" alt="12 Seater tempo traveller on rent in Delhi">
                        <span class="badge">⭐ Most Popular</span>
                    </div>
                    <div class="fleet-details">
                        <h3>12 Seater</h3>
                        <div class="subtitle">Perfect for family trips and small groups</div>
                        <div class="price">₹30 <span>/km</span></div>
                        <ul>
                            <li><i class="fas fa-check-circle"></i> Pushback seats</li>
                            <li><i class="fas fa-check-circle"></i> Music system</li>
                            <li><i class="fas fa-check-circle"></i> Extra luggage space</li>
                            <li><i class="fas fa-check-circle"></i> Air conditioned</li>
                            <li><i class="fas fa-check-circle"></i> Charging points</li>
                        </ul>
                        <a href="contact.php" class="btn-book"><i class="fas fa-calendar-check"></i> Book Now</a>
                    </div>
                </div>

                <!-- 16 Seater -->
                <div class="fleet-card">
                    <div class="fleet-image">
                        <img loading="lazy" src="images/tempo12.webp" alt="16 Seater tempo traveller on rent in Delhi">
                        <span class="badge">⭐ Best Value</span>
                    </div>
                    <div class="fleet-details">
                        <h3>16 Seater</h3>
                        <div class="subtitle">Ideal for corporate outings and events</div>
                        <div class="price">₹35 <span>/km</span></div>
                        <ul>
                            <li><i class="fas fa-check-circle"></i> Pushback seats</li>
                            <li><i class="fas fa-check-circle"></i> WiFi/Charging points</li>
                            <li><i class="fas fa-check-circle"></i> Large windows</li>
                            <li><i class="fas fa-check-circle"></i> Air conditioned</li>
                            <li><i class="fas fa-check-circle"></i> Music system</li>
                        </ul>
                        <a href="contact.php" class="btn-book"><i class="fas fa-calendar-check"></i> Book Now</a>
                    </div>
                </div>

                <!-- 20 Seater -->
                <div class="fleet-card">
                    <div class="fleet-image">
                        <img loading="lazy" src="images/tempo12.webp" alt="20 Seater tempo traveller on rent in Delhi">
                        <span class="badge">⭐ Luxury</span>
                    </div>
                    <div class="fleet-details">
                        <h3>20 Seater</h3>
                        <div class="subtitle">For large groups and special occasions</div>
                        <div class="price">₹40 <span>/km</span></div>
                        <ul>
                            <li><i class="fas fa-check-circle"></i> Luxury interiors</li>
                            <li><i class="fas fa-check-circle"></i> WiFi / Charging points</li>
                            <li><i class="fas fa-check-circle"></i> Refrigerator</li>
                            <li><i class="fas fa-check-circle"></i> Air conditioned</li>
                            <li><i class="fas fa-check-circle"></i> Music system</li>
                        </ul>
                        <a href="contact.php" class="btn-book"><i class="fas fa-calendar-check"></i> Book Now</a>
                    </div>
                </div>

                <!-- 25 Seater -->
                <div class="fleet-card">
                    <div class="fleet-image">
                        <img loading="lazy" src="images/tempo12.webp" alt="25 Seater tempo traveller on rent in Delhi">
                        <span class="badge">⭐ Big Groups</span>
                    </div>
                    <div class="fleet-details">
                        <h3>25 Seater</h3>
                        <div class="subtitle">Best for weddings, school trips and large groups</div>
                        <div class="price">₹43 <span>/km</span></div>
                        <ul>
                            <li><i class="fas fa-check-circle"></i> Pushback seats</li>
                            <li><i class="fas fa-check-circle"></i> Extra luggage space</li>
                            <li><i class="fas fa-check-circle"></i> Air conditioned</li>
                            <li><i class="fas fa-check-circle"></i> Music system</li>
                            <li><i class="fas fa-check-circle"></i> Charging points</li>
                        </ul>
                        <a href="contact.php" class="btn-book"><i class="fas fa-calendar-check"></i> Book Now</a>
                    </div>
                </div>

                <!-- 9/12 Seater Maharaja -->
                <div class="fleet-card">
                    <div class="fleet-image">
                        <img loading="lazy" src="images/tempo12.webp" alt="9 Seater and 12 Seater Maharaja tempo traveller on rent in Delhi">
                        <span class="badge">⭐ Premium</span>
                    </div>
                    <div class="fleet-details">
                        <h3>9/12 Seater Maharaja</h3>
                        <div class="subtitle">Premium travel experience</div>
                        <div class="price">₹35 <span>/km</span></div>
                        <ul>
                            <li><i class="fas fa-check-circle"></i> Luxury interiors</li>
                            <li><i class="fas fa-check-circle"></i> Music system</li>
                            <li><i class="fas fa-check-circle"></i> Refrigerator</li>
                            <li><i class="fas fa-check-circle"></i> Premium seating</li>
                            <li><i class="fas fa-check-circle"></i> WiFi</li>
                        </ul>
                        <a href="contact.php" class="btn-book"><i class="fas fa-calendar-check"></i> Book Now</a>
                    </div>
                </div>

                <!-- 16 Seater Maharaja -->
                <div class="fleet-card">
                    <div class="fleet-image">
                        <img loading="lazy" src="images/tempo12.webp" alt="16 Seater Maharaja tempo traveller on rent in Delhi">
                        <span class="badge">⭐ Premium</span>
                    </div>
                    <div class="fleet-details">
                        <h3>16 Seater Maharaja</h3>
                        <div class="subtitle">Ultimate luxury for large groups</div>
                        <div class="price">₹40 <span>/km</span></div>
                        <ul>
                            <li><i class="fas fa-check-circle"></i> Luxury interiors</li>
                            <li><i class="fas fa-check-circle"></i> Music system</li>
                            <li><i class="fas fa-check-circle"></i> Refrigerator</li>
                            <li><i class="fas fa-check-circle"></i> Premium seating</li>
                            <li><i class="fas fa-check-circle"></i> WiFi</li>
                        </ul>
                        <a href="contact.php" class="btn-book"><i class="fas fa-calendar-check"></i> Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
    INCLUSION / EXCLUSION SECTION (UPDATED)
    ============================================ -->
    <section class="inclusion-exclusion">
        <div class="container">
            <h2 class="section-title">📋 What's Included & What's Not</h2>
            <p class="section-subtitle">Transparent pricing with clear inclusions and exclusions for your peace of mind</p>
            <p class="section-subtitle">Smaller group? Book an <a href="https://innovacrystarent.com/" target="_blank" rel="noopener">Innova Crysta on rent in Delhi</a>. Want a premium van? See our <a href="https://urbaniaonrentdelhi.co.in/" target="_blank" rel="noopener">Force Urbania on rent in Delhi</a>. Just 2–4 people? <a href="https://www.getmecab.com/" target="_blank" rel="noopener">Book an outstation cab with GetMeCab</a>.</p>

            <div class="ie-grid">
                <!-- Inclusion Box -->
                <div class="ie-box inclusion">
                    <h3><i class="fas fa-check-circle"></i> Inclusions</h3>
                    <ul>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <div><strong>Vehicle &amp; Driver</strong> - AC tempo traveller with an <span class="highlight">experienced professional driver</span></div>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <div><strong>Fuel</strong> - <span class="highlight">Fuel charges</span> included in the per km rate</div>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <div><strong>Toll Tax</strong> - <span class="highlight">included</span> in the fare</div>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <div><strong>State Tax / Permit</strong> - <span class="highlight">included</span> in the fare</div>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <div><strong>Driver Allowance</strong> - <span class="highlight">included</span> in the fare</div>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <div><strong>250 KM/Day</strong> - <span class="highlight">250 kilometres per day</span> included on outstation trips (minimum billing)</div>
                        </li>
                    </ul>
                </div>

                <!-- Exclusion Box -->
                <div class="ie-box exclusion">
                    <h3><i class="fas fa-times-circle"></i> Exclusions (extra)</h3>
                    <ul>
                        <li>
                            <i class="fas fa-times-circle"></i>
                            <div><strong>Parking Charges</strong> - <span class="highlight">extra, on actual basis</span></div>
                        </li>
                        <li>
                            <i class="fas fa-times-circle"></i>
                            <div><strong>GST</strong> - <span class="highlight">Government taxes</span> as applicable</div>
                        </li>
                        <li>
                            <i class="fas fa-times-circle"></i>
                            <div><strong>Driver Night Charge</strong> - <span class="highlight">₹500</span> if the driver drives between 10 PM and 6 AM</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

</main>

<script>
    // Add smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
</script>

<?php include 'seo_keywords.php'; ?>
<?php include 'footer.php'; ?>