<?php
// Page SEO variables
$page_title = 'Tempo Traveller Services in Delhi – Outstation, Airport & Weddings';
$page_description = 'Tempo traveller services in Delhi NCR: outstation trips, airport transfers, weddings, corporate outings, pilgrimages and tour packages. 12–20 seater AC and Maharaja tempos with drivers.';

include 'header.php';
?>

<main>
    <style>
        .services-page {
            padding: 80px 0;
            background: white;
        }

        .services-page h1 {
            text-align: center;
            font-size: 3rem;
            margin-bottom: 15px;
            background: linear-gradient(135deg, #f97316, #d00000);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .services-subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 50px;
        }

        .services-grid-full {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }

        .service-item {
            padding: 35px;
            background: #faf9f8;
            border-radius: 20px;
            transition: transform 0.3s;
        }

        .service-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.05);
        }

        .service-item i {
            font-size: 3rem;
            background: linear-gradient(135deg, #f97316, #d00000);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
        }

        .service-item h3 {
            font-size: 1.8rem;
            margin-bottom: 15px;
        }

        .service-item p {
            color: #666;
            line-height: 1.8;
        }

        .service-item ul {
            list-style: none;
            margin-top: 15px;
        }

        .service-item ul li {
            margin: 8px 0;
            color: #555;
        }

        .service-item ul li i {
            font-size: 1rem;
            margin-right: 8px;
            -webkit-text-fill-color: #f97316;
        }

        /* City Routes Table Section */
        .city-routes {
            margin-top: 60px;
            padding-top: 60px;
            border-top: 2px solid #f0f0f0;
        }

        .city-routes h2 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 15px;
            background: linear-gradient(135deg, #f97316, #d00000);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .city-routes-subtitle {
            text-align: center;
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 40px;
        }

        /* 3 Column Table */
        .city-table-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin: 30px 0;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .city-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            min-width: 500px;
        }

        .city-table thead {
            background: linear-gradient(135deg, #f97316, #d00000);
            color: white;
        }

        .city-table thead th {
            padding: 18px 20px;
            text-align: left;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.5px;
        }

        .city-table tbody tr {
            border-bottom: 1px solid #f0f0f0;
            transition: background 0.2s ease;
        }

        .city-table tbody tr:hover {
            background: #fef6ee;
        }

        .city-table tbody td {
            padding: 15px 20px;
            vertical-align: middle;
        }

        .city-table .city-link {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: color 0.3s;
        }

        .city-table .city-link:hover {
            color: #f97316;
        }

        .city-table .city-link i {
            color: #f97316;
            font-size: 1rem;
            flex-shrink: 0;
        }

        /* ============================================
           MOBILE RESPONSIVE CSS
           ============================================ */

        /* Tablets and smaller desktops (992px and down) */
        @media (max-width: 992px) {
            .services-page {
                padding: 50px 0;
            }

            .services-page h1 {
                font-size: 2.5rem;
            }

            .services-subtitle {
                font-size: 1.1rem;
                margin-bottom: 35px;
            }

            .services-grid-full {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
                margin-bottom: 40px;
            }

            .service-item {
                padding: 25px 20px;
            }

            .service-item i {
                font-size: 2.5rem;
            }

            .service-item h3 {
                font-size: 1.5rem;
            }

            .service-item p {
                font-size: 0.95rem;
            }

            .service-item ul li {
                font-size: 0.9rem;
            }

            .city-routes {
                margin-top: 40px;
                padding-top: 40px;
            }

            .city-routes h2 {
                font-size: 2.2rem;
            }

            .city-routes-subtitle {
                font-size: 1rem;
                margin-bottom: 30px;
            }

            .city-table-wrapper {
                margin: 20px 0;
            }

            .city-table {
                min-width: 450px;
            }

            .city-table thead th {
                padding: 14px 16px;
                font-size: 0.9rem;
            }

            .city-table tbody td {
                padding: 12px 16px;
            }

            .city-table .city-link {
                font-size: 0.9rem;
            }
        }

        /* Mobile devices (768px and down) */
        @media (max-width: 768px) {
            .services-page {
                padding: 40px 0;
            }

            .services-page h1 {
                font-size: 2rem;
            }

            .services-subtitle {
                font-size: 1rem;
                margin-bottom: 25px;
            }

            .services-grid-full {
                grid-template-columns: 1fr;
                gap: 15px;
                margin-bottom: 30px;
                max-width: 500px;
                margin-left: auto;
                margin-right: auto;
            }

            .service-item {
                padding: 20px;
                border-radius: 15px;
            }

            .service-item i {
                font-size: 2.2rem;
                margin-bottom: 15px;
            }

            .service-item h3 {
                font-size: 1.3rem;
                margin-bottom: 10px;
            }

            .service-item p {
                font-size: 0.9rem;
            }

            .service-item ul li {
                font-size: 0.85rem;
                margin: 6px 0;
            }

            .city-routes {
                margin-top: 30px;
                padding-top: 30px;
            }

            .city-routes h2 {
                font-size: 1.8rem;
            }

            .city-routes-subtitle {
                font-size: 0.95rem;
                margin-bottom: 20px;
            }

            .city-table-wrapper {
                border-radius: 10px;
                margin: 15px 0;
            }

            .city-table {
                min-width: 400px;
            }

            .city-table thead th {
                padding: 12px 14px;
                font-size: 0.8rem;
            }

            .city-table tbody td {
                padding: 10px 14px;
            }

            .city-table .city-link {
                font-size: 0.82rem;
                gap: 8px;
            }

            .city-table .city-link i {
                font-size: 0.85rem;
            }

            .btn-primary {
                padding: 10px 24px;
                font-size: 0.9rem;
            }
        }

        /* Small mobile devices (576px and down) */
        @media (max-width: 576px) {
            .services-page {
                padding: 30px 0;
            }

            .services-page h1 {
                font-size: 1.7rem;
            }

            .services-subtitle {
                font-size: 0.9rem;
                margin-bottom: 20px;
            }

            .services-grid-full {
                gap: 12px;
                margin-bottom: 25px;
                max-width: 100%;
            }

            .service-item {
                padding: 16px;
                border-radius: 12px;
            }

            .service-item i {
                font-size: 1.8rem;
                margin-bottom: 10px;
            }

            .service-item h3 {
                font-size: 1.1rem;
                margin-bottom: 8px;
            }

            .service-item p {
                font-size: 0.85rem;
            }

            .service-item ul li {
                font-size: 0.8rem;
                margin: 5px 0;
            }

            .service-item ul li i {
                font-size: 0.8rem;
            }

            .city-routes {
                margin-top: 25px;
                padding-top: 25px;
            }

            .city-routes h2 {
                font-size: 1.5rem;
            }

            .city-routes-subtitle {
                font-size: 0.85rem;
                margin-bottom: 15px;
            }

            .city-table-wrapper {
                border-radius: 8px;
                margin: 10px 0;
                padding: 0;
            }

            .city-table {
                min-width: 320px;
            }

            .city-table thead th {
                padding: 10px 10px;
                font-size: 0.7rem;
                letter-spacing: 0.3px;
            }

            .city-table tbody td {
                padding: 8px 10px;
            }

            .city-table .city-link {
                font-size: 0.72rem;
                gap: 6px;
            }

            .city-table .city-link i {
                font-size: 0.75rem;
            }

            .btn-primary {
                padding: 8px 18px;
                font-size: 0.85rem;
                display: inline-block;
            }

            .city-routes .btn-primary {
                width: 100%;
                max-width: 280px;
                text-align: center;
            }

            .city-routes p {
                font-size: 1rem !important;
            }
        }

        /* Extra small devices (400px and down) */
        @media (max-width: 400px) {
            .services-page h1 {
                font-size: 1.4rem;
            }

            .services-subtitle {
                font-size: 0.85rem;
            }

            .service-item {
                padding: 14px;
            }

            .service-item i {
                font-size: 1.6rem;
            }

            .service-item h3 {
                font-size: 1rem;
            }

            .service-item p {
                font-size: 0.8rem;
            }

            .service-item ul li {
                font-size: 0.75rem;
            }

            .city-routes h2 {
                font-size: 1.3rem;
            }

            .city-table {
                min-width: 280px;
            }

            .city-table thead th {
                padding: 8px 8px;
                font-size: 0.65rem;
            }

            .city-table tbody td {
                padding: 6px 8px;
            }

            .city-table .city-link {
                font-size: 0.68rem;
            }

            .city-table .city-link i {
                font-size: 0.7rem;
            }

            .btn-primary {
                padding: 6px 14px;
                font-size: 0.8rem;
            }
        }

        /* Landscape phones */
        @media (max-height: 600px) and (orientation: landscape) {
            .services-page {
                padding: 20px 0;
            }

            .services-grid-full {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .service-item {
                padding: 14px;
            }

            .service-item i {
                font-size: 1.6rem;
                margin-bottom: 8px;
            }

            .service-item h3 {
                font-size: 1rem;
            }

            .service-item p {
                font-size: 0.8rem;
            }

            .service-item ul li {
                font-size: 0.75rem;
                margin: 4px 0;
            }

            .city-table {
                min-width: 400px;
            }
        }

        /* Tablet landscape */
        @media (min-width: 769px) and (max-width: 992px) and (orientation: landscape) {
            .services-grid-full {
                grid-template-columns: repeat(2, 1fr);
            }

            .service-item {
                padding: 25px;
            }

            .city-table {
                min-width: 500px;
            }
        }
    </style>

    <section class="services-page">
        <div class="container">
            <h1>Tempo Traveller Services in Delhi</h1>
            <p class="services-subtitle">Comprehensive travel solutions for every need</p>

            <div class="services-grid-full">
                <div class="service-item">
                    <i class="fas fa-plane-departure"></i>
                    <h3>Airport Transfers</h3>
                    <p>Reliable and punctual airport pickup and drop services. We monitor flight schedules to ensure timely pickups.</p>
                    <ul>
                        <li><i class="fas fa-check-circle"></i> Flight tracking included</li>
                        <li><i class="fas fa-check-circle"></i> Meet & greet service</li>
                        <li><i class="fas fa-check-circle"></i> Luggage assistance</li>
                    </ul>
                </div>

                <div class="service-item">
                    <i class="fas fa-briefcase"></i>
                    <h3>Corporate Outings</h3>
                    <p>Professional transport solutions for company events, team building, and business meetings.</p>
                    <ul>
                        <li><i class="fas fa-check-circle"></i> Multiple pickup points</li>
                        <li><i class="fas fa-check-circle"></i> Customized routes</li>
                        <li><i class="fas fa-check-circle"></i> Wi-Fi equipped vehicles</li>
                    </ul>
                </div>

                <div class="service-item">
                    <i class="fas fa-ring"></i>
                    <h3>Wedding Packages</h3>
                    <p>Special packages for wedding guests, including multiple vehicle bookings and decorative options.</p>
                    <ul>
                        <li><i class="fas fa-check-circle"></i> Guest transportation</li>
                        <li><i class="fas fa-check-circle"></i> Family coordination</li>
                        <li><i class="fas fa-check-circle"></i> Flexible scheduling</li>
                    </ul>
                </div>

                <div class="service-item">
                    <i class="fas fa-umbrella-beach"></i>
                    <h3>Tour Packages</h3>
                    <p>Complete tour packages with transportation to popular destinations like Agra, Jaipur, and more.</p>
                    <ul>
                        <li><i class="fas fa-check-circle"></i> Customizable itineraries</li>
                        <li><i class="fas fa-check-circle"></i> Experienced tour guides</li>
                        <li><i class="fas fa-check-circle"></i> Package deals available</li>
                    </ul>
                </div>

                <div class="service-item">
                    <i class="fas fa-user-friends"></i>
                    <h3>Family Trips</h3>
                    <p>Comfortable and safe transportation for family vacations, reunions, and group get-togethers.</p>
                    <ul>
                        <li><i class="fas fa-check-circle"></i> Family-friendly vehicles</li>
                        <li><i class="fas fa-check-circle"></i> Extra luggage space</li>
                        <li><i class="fas fa-check-circle"></i> Child safety seats available</li>
                    </ul>
                </div>

                <div class="service-item">
                    <i class="fas fa-clock"></i>
                    <h3>Hourly Rentals</h3>
                    <p>Flexible rental options for local travel, shopping trips, and city tours within Delhi NCR.</p>
                    <ul>
                        <li><i class="fas fa-check-circle"></i> Hourly billing available</li>
                        <li><i class="fas fa-check-circle"></i> Local knowledge drivers</li>
                        <li><i class="fas fa-check-circle"></i> No hidden charges</li>
                    </ul>
                </div>
            </div>

            <!-- City Routes Table Section -->
            <div class="city-routes">
                <h2>Popular Tempo Traveller Routes from Delhi</h2>
                <p class="city-routes-subtitle">Click on any route to view details and book your ride</p>

                <div class="city-table-wrapper">
                    <table class="city-table">
                        <thead>
                            <tr>
                                <th>Most Popular Destinations</th>
                                <th>Famous Routes</th>
                                <th>Family Tour Packages</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <a href="delhi-to-agra-tempo-on-rent.php" class="city-link">
                                        <i class="fas fa-route"></i>
                                        Delhi to Agra Tempo on Rent
                                    </a>
                                </td>
                                <td>
                                    <a href="delhi-to-jaipur-tempo-on-rent.php" class="city-link">
                                        <i class="fas fa-arrow-right"></i>
                                        Delhi to Jaipur Tempo on Rent
                                    </a>
                                </td>
                                <td>
                                    <a href="chardham-tempo-package.php" class="city-link">
                                        <i class="fas fa-pray"></i>
                                        Char Dham Tempo Package
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="delhi-to-haridwar-tempo-on-rent.php" class="city-link">
                                        <i class="fas fa-route"></i>
                                        Delhi to Haridwar Tempo on Rent
                                    </a>
                                </td>
                                <td>
                                    <a href="delhi-to-chandigarh-tempo-on-rent.php" class="city-link">
                                        <i class="fas fa-arrow-right"></i>
                                        Delhi to Chandigarh Tempo on Rent
                                    </a>
                                </td>
                                <td>
                                    <a href="himachal-tempo-package.php" class="city-link">
                                        <i class="fas fa-mountain"></i>
                                        Himachal Tempo Package
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="delhi-to-manali-tempo-on-rent.php" class="city-link">
                                        <i class="fas fa-route"></i>
                                        Delhi to Manali Tempo on Rent
                                    </a>
                                </td>
                                <td>
                                    <a href="delhi-to-rishikesh-tempo-on-rent.php" class="city-link">
                                        <i class="fas fa-arrow-right"></i>
                                        Delhi to Rishikesh Tempo on Rent
                                    </a>
                                </td>
                                <td>
                                    <a href="kashmir-tempo-package.php" class="city-link">
                                        <i class="fas fa-snowflake"></i>
                                        Kashmir Tempo Package
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="delhi-to-dharamshala-tempo-on-rent.php" class="city-link">
                                        <i class="fas fa-route"></i>
                                        Delhi to Dharamshala Tempo on Rent
                                    </a>
                                </td>
                                <td>
                                    <a href="delhi-to-dehradun-tempo-on-rent.php" class="city-link">
                                        <i class="fas fa-arrow-right"></i>
                                        Delhi to Dehradun Tempo on Rent
                                    </a>
                                </td>
                                <td>
                                    <a href="leh-ladakh-tempo-package.php" class="city-link">
                                        <i class="fas fa-road"></i>
                                        Leh-Ladakh Tempo Package
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="delhi-to-nainital-tempo-on-rent.php" class="city-link">
                                        <i class="fas fa-route"></i>
                                        Delhi to Nainital Tempo on Rent
                                    </a>
                                </td>
                                <td>
                                    <a href="delhi-to-shimla-tempo-on-rent.php" class="city-link">
                                        <i class="fas fa-arrow-right"></i>
                                        Delhi to Shimla Tempo on Rent
                                    </a>
                                </td>
                                <td>
                                    <a href="rajasthan-tempo-package.php" class="city-link">
                                        <i class="fas fa-flag"></i>
                                        Rajasthan Tempo Package
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="delhi-to-amritsar-tempo-on-rent.php" class="city-link">
                                        <i class="fas fa-route"></i>
                                        Delhi to Amritsar Tempo on Rent
                                    </a>
                                </td>
                                <td>
                                    <a href="delhi-to-mussoorie-tempo-on-rent.php" class="city-link">
                                        <i class="fas fa-arrow-right"></i>
                                        Delhi to Mussoorie Tempo on Rent
                                    </a>
                                </td>
                                <td>
                                    <a href="uttarakhand-tempo-package.php" class="city-link">
                                        <i class="fas fa-tree"></i>
                                        Uttarakhand Tempo Package
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="delhi-to-jaipur-tempo-on-rent.php" class="city-link">
                                        <i class="fas fa-route"></i>
                                        Delhi to Jaipur Tempo on Rent
                                    </a>
                                </td>
                                <td>
                                    <a href="delhi-to-agra-tempo-on-rent.php" class="city-link">
                                        <i class="fas fa-arrow-right"></i>
                                        Delhi to Agra Tempo on Rent
                                    </a>
                                </td>
                                <td>
                                    <a href="golden-triangle-tempo-package.php" class="city-link">
                                        <i class="fas fa-star"></i>
                                        Golden Triangle Tempo Package
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="delhi-to-udaipur-tempo-on-rent.php" class="city-link">
                                        <i class="fas fa-route"></i>
                                        Delhi to Udaipur Tempo on Rent
                                    </a>
                                </td>
                                <td>
                                    <a href="delhi-to-jodhpur-tempo-on-rent.php" class="city-link">
                                        <i class="fas fa-arrow-right"></i>
                                        Delhi to Jodhpur Tempo on Rent
                                    </a>
                                </td>
                                <td>
                                    <a href="wildlife-tempo-package.php" class="city-link">
                                        <i class="fas fa-paw"></i>
                                        Wildlife Tempo Package
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="delhi-to-lucknow-tempo-on-rent.php" class="city-link">
                                        <i class="fas fa-route"></i>
                                        Delhi to Lucknow Tempo on Rent
                                    </a>
                                </td>
                                <td>
                                    <a href="delhi-to-varanasi-tempo-on-rent.php" class="city-link">
                                        <i class="fas fa-arrow-right"></i>
                                        Delhi to Varanasi Tempo on Rent
                                    </a>
                                </td>
                                <td>
                                    <a href="pilgrimage-tempo-package.php" class="city-link">
                                        <i class="fas fa-temple"></i>
                                        Pilgrimage Tempo Package
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div style="text-align: center; margin-top: 50px;">
                    <p style="font-size: 1.2rem; margin-bottom: 20px;">Need a customized route? We're here to help!</p>
                    <a href="contact.php" class="btn btn-primary">Contact Us Now</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'seo_keywords.php'; ?>
<?php include 'footer.php'; ?>