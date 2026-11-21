<?php
// Testimonials page SEO variables
$page_title = 'Customer Testimonials - Real Reviews for Delhi Tempo Traveller';
$page_description = 'Read real customer reviews and testimonials for Delhi Tempo Traveller. See what our happy customers say about our tempo traveller rental service.';
$page_keywords = 'customer testimonials, tempo traveller reviews, Delhi tempo traveller feedback, customer satisfaction, group travel reviews';

include 'header.php';
?>

<main>
    <style>
        /* ============================================
        TESTIMONIALS PAGE STYLES - FULLY RESPONSIVE
        ============================================ */
        
        /* Reset and Base */
        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        .testimonials-page {
            padding: 60px 0;
            background: white;
            overflow-x: hidden;
            width: 100%;
            max-width: 100%;
        }

        .testimonials-page .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .testimonials-page .section-title {
            text-align: center;
            font-size: clamp(1.8rem, 5vw, 2.5rem);
            font-weight: 700;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #f97316, #d00000);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            word-wrap: break-word;
        }

        .testimonials-page .section-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 40px;
            font-size: clamp(0.95rem, 2vw, 1.1rem);
            padding: 0 10px;
            word-wrap: break-word;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            width: 100%;
        }

        .testimonial-card {
            background: #faf9f8;
            padding: 30px 28px;
            border-radius: 18px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.04);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #f0f0f0;
            position: relative;
            width: 100%;
            overflow: hidden;
            -webkit-tap-highlight-color: transparent;
        }

        .testimonial-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.08);
            border-color: #f97316;
        }

        /* Touch-friendly active state */
        .testimonial-card:active {
            transform: scale(0.98);
            transition-duration: 0.1s;
        }

        .testimonial-card .quote-icon {
            font-size: clamp(2rem, 4vw, 2.5rem);
            color: #f97316;
            opacity: 0.15;
            position: absolute;
            top: 15px;
            right: 20px;
        }

        .testimonial-card .stars {
            color: #ffc107;
            font-size: clamp(0.85rem, 1.5vw, 1rem);
            margin-bottom: 12px;
            letter-spacing: 2px;
            white-space: nowrap;
        }

        .testimonial-card .testimonial-text {
            color: #555;
            font-size: clamp(0.9rem, 1.2vw, 1rem);
            line-height: 1.7;
            margin-bottom: 18px;
            font-style: italic;
            word-wrap: break-word;
        }

        .testimonial-card .testimonial-text .kw {
            background: #fef6ee;
            padding: 1px 8px;
            border-radius: 4px;
            font-weight: 600;
            color: #d00000;
            font-style: normal;
            display: inline-block;
        }

        .testimonial-card .author {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .testimonial-card .author .author-avatar {
            width: clamp(44px, 8vw, 52px);
            height: clamp(44px, 8vw, 52px);
            border-radius: 50%;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            background: #0f172a;
            color: #fff;
            font-weight: 700;
            font-size: 0.95rem;
            border: 2px solid #f97316;
        }

        .testimonial-card .author img {
            width: clamp(44px, 8vw, 52px);
            height: clamp(44px, 8vw, 52px);
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #f97316;
            background: #f0f0f0;
            flex-shrink: 0;
        }

        .testimonial-card .author-info {
            flex: 1;
            min-width: 120px;
        }

        .testimonial-card .author-info h5 {
            font-size: clamp(0.95rem, 1.4vw, 1.05rem);
            font-weight: 600;
            color: #1a1a2e;
            margin: 0 0 2px 0;
            word-wrap: break-word;
        }

        .testimonial-card .author-info span {
            font-size: clamp(0.75rem, 1.1vw, 0.85rem);
            color: #888;
            display: block;
            word-wrap: break-word;
        }

        .testimonial-card .author-info .location-badge {
            display: inline-block;
            background: #fef6ee;
            padding: 2px 12px;
            border-radius: 50px;
            font-size: clamp(0.65rem, 0.9vw, 0.7rem);
            color: #f97316;
            font-weight: 500;
            margin-top: 2px;
            white-space: nowrap;
        }

        /* Rating Summary Section */
        .rating-summary {
            background: linear-gradient(135deg, #faf9f8, #fef9f4);
            padding: 40px 20px;
            border-radius: 18px;
            margin-bottom: 40px;
            border: 1px solid #f0f0f0;
            width: 100%;
        }

        .rating-summary .rating-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            text-align: center;
            width: 100%;
        }

        .rating-summary .rating-item {
            padding: 15px 10px;
            min-width: 0;
        }

        .rating-summary .rating-item .number {
            font-size: clamp(1.8rem, 4vw, 2.5rem);
            font-weight: 800;
            color: #f97316;
            line-height: 1.2;
        }

        .rating-summary .rating-item .stars {
            color: #ffc107;
            font-size: clamp(0.9rem, 1.5vw, 1.1rem);
            white-space: nowrap;
        }

        .rating-summary .rating-item .label {
            color: #666;
            font-size: clamp(0.75rem, 1.1vw, 0.9rem);
            margin-top: 5px;
            word-wrap: break-word;
        }

        /* CTA Section */
        .cta-section {
            text-align: center;
            margin-top: 50px;
            padding: clamp(30px, 5vw, 40px) clamp(20px, 4vw, 40px);
            background: linear-gradient(135deg, #fef9f4, #faf9f8);
            border-radius: 18px;
            border: 1px solid #f0f0f0;
            width: 100%;
        }

        .cta-section h3 {
            font-size: clamp(1.2rem, 3vw, 1.5rem);
            color: #1a1a2e;
            margin-bottom: 15px;
            word-wrap: break-word;
        }

        .cta-section p {
            color: #666;
            margin-bottom: 20px;
            font-size: clamp(0.9rem, 1.2vw, 1rem);
            padding: 0 10px;
        }

        .cta-section .cta-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
            width: 100%;
        }

        .cta-section .cta-buttons a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: clamp(12px, 2vw, 14px) clamp(25px, 5vw, 40px);
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: clamp(0.9rem, 1.2vw, 1rem);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-width: 160px;
            justify-content: center;
            -webkit-tap-highlight-color: transparent;
        }

        .cta-section .btn-book {
            background: linear-gradient(135deg, #f97316, #d00000);
            color: white;
            box-shadow: 0 8px 25px rgba(249, 115, 22, 0.3);
        }

        .cta-section .btn-book:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(249, 115, 22, 0.4);
        }

        .cta-section .btn-book:active {
            transform: scale(0.96);
        }

        .cta-section .btn-whatsapp {
            background: #25D366;
            color: white;
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.3);
        }

        .cta-section .btn-whatsapp:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(37, 211, 102, 0.4);
        }

        .cta-section .btn-whatsapp:active {
            transform: scale(0.96);
        }

        /* ============================================
        RESPONSIVE BREAKPOINTS
        ============================================ */

        /* Tablets and small laptops */
        @media (max-width: 992px) {
            .testimonials-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 25px;
            }
            
            .rating-summary .rating-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }
            
            .testimonial-card {
                padding: 25px 22px;
            }
        }

        /* Mobile Devices */
        @media (max-width: 768px) {
            .testimonials-page {
                padding: 40px 0;
            }

            .testimonials-page .container {
                padding: 0 12px;
            }

            .testimonials-page .section-title {
                font-size: clamp(1.6rem, 4.5vw, 2rem);
                padding: 0 5px;
            }

            .testimonials-page .section-subtitle {
                font-size: clamp(0.9rem, 2vw, 1rem);
                margin-bottom: 30px;
                padding: 0 5px;
            }

            .testimonials-grid {
                grid-template-columns: 1fr;
                gap: 20px;
                max-width: 100%;
            }

            .testimonial-card {
                padding: 22px 18px;
                border-radius: 15px;
                margin: 0 auto;
                width: 100%;
                max-width: 100%;
            }

            .testimonial-card .quote-icon {
                font-size: 2rem;
                top: 12px;
                right: 15px;
            }

            .testimonial-card .testimonial-text {
                font-size: 0.95rem;
                line-height: 1.6;
            }

            .testimonial-card .author {
                gap: 12px;
            }

            .testimonial-card .author img {
                width: 46px;
                height: 46px;
            }

            .testimonial-card .author-info h5 {
                font-size: 1rem;
            }

            .testimonial-card .author-info span {
                font-size: 0.8rem;
            }

            .rating-summary {
                padding: 30px 15px;
                border-radius: 15px;
                margin-bottom: 30px;
            }

            .rating-summary .rating-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .rating-summary .rating-item {
                padding: 10px 5px;
            }

            .rating-summary .rating-item .number {
                font-size: clamp(1.6rem, 5vw, 2rem);
            }

            .rating-summary .rating-item .stars {
                font-size: 1rem;
            }

            .rating-summary .rating-item .label {
                font-size: 0.8rem;
            }

            .cta-section {
                padding: 30px 20px;
                margin-top: 35px;
                border-radius: 15px;
            }

            .cta-section h3 {
                font-size: 1.2rem;
            }

            .cta-section .cta-buttons {
                flex-direction: column;
                align-items: center;
                gap: 12px;
            }

            .cta-section .cta-buttons a {
                width: 100%;
                max-width: 320px;
                padding: 14px 25px;
                font-size: 0.95rem;
            }
        }

        /* Small Mobile Devices */
        @media (max-width: 480px) {
            .testimonials-page {
                padding: 30px 0;
            }

            .testimonials-page .container {
                padding: 0 10px;
            }

            .testimonials-page .section-title {
                font-size: clamp(1.4rem, 5vw, 1.8rem);
            }

            .testimonials-grid {
                gap: 16px;
            }

            .testimonial-card {
                padding: 18px 15px;
                border-radius: 12px;
            }

            .testimonial-card .quote-icon {
                font-size: 1.6rem;
                top: 10px;
                right: 12px;
            }

            .testimonial-card .stars {
                font-size: 0.85rem;
                letter-spacing: 1px;
                margin-bottom: 10px;
            }

            .testimonial-card .testimonial-text {
                font-size: 0.9rem;
                line-height: 1.5;
                margin-bottom: 14px;
            }

            .testimonial-card .testimonial-text .kw {
                padding: 1px 6px;
                font-size: 0.85rem;
            }

            .testimonial-card .author {
                gap: 10px;
            }

            .testimonial-card .author img {
                width: 40px;
                height: 40px;
                border-width: 1.5px;
            }

            .testimonial-card .author-info h5 {
                font-size: 0.9rem;
            }

            .testimonial-card .author-info span {
                font-size: 0.75rem;
            }

            .testimonial-card .author-info .location-badge {
                font-size: 0.6rem;
                padding: 1px 10px;
            }

            .rating-summary {
                padding: 20px 12px;
                border-radius: 12px;
                margin-bottom: 25px;
            }

            .rating-summary .rating-grid {
                gap: 8px;
            }

            .rating-summary .rating-item {
                padding: 8px 3px;
            }

            .rating-summary .rating-item .number {
                font-size: clamp(1.4rem, 6vw, 1.8rem);
            }

            .rating-summary .rating-item .stars {
                font-size: 0.85rem;
            }

            .rating-summary .rating-item .label {
                font-size: 0.7rem;
            }

            .cta-section {
                padding: 25px 15px;
                margin-top: 30px;
                border-radius: 12px;
            }

            .cta-section h3 {
                font-size: 1.1rem;
                margin-bottom: 10px;
            }

            .cta-section p {
                font-size: 0.85rem;
                margin-bottom: 15px;
            }

            .cta-section .cta-buttons a {
                max-width: 280px;
                padding: 12px 20px;
                font-size: 0.9rem;
                min-width: 0;
            }
        }

        /* Very small devices */
        @media (max-width: 360px) {
            .testimonials-page .container {
                padding: 0 8px;
            }

            .testimonial-card {
                padding: 15px 12px;
            }

            .testimonial-card .testimonial-text {
                font-size: 0.85rem;
            }

            .testimonial-card .author img {
                width: 36px;
                height: 36px;
            }

            .testimonial-card .author-info h5 {
                font-size: 0.85rem;
            }

            .rating-summary .rating-item .number {
                font-size: 1.3rem;
            }

            .cta-section .cta-buttons a {
                max-width: 240px;
                font-size: 0.85rem;
                padding: 10px 16px;
            }
        }

        /* Fix for landscape orientation on mobile */
        @media (max-height: 500px) and (orientation: landscape) {
            .testimonials-page {
                padding: 25px 0;
            }
            
            .testimonial-card {
                padding: 16px 14px;
            }
            
            .testimonial-card .testimonial-text {
                font-size: 0.85rem;
                line-height: 1.4;
                margin-bottom: 10px;
            }
        }

        /* High DPI screens */
        @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
            .testimonial-card {
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }
        }

        /* Reduced motion preferences */
        @media (prefers-reduced-motion: reduce) {
            .testimonial-card {
                transition: none !important;
            }
            
            .testimonial-card:hover {
                transform: none !important;
            }
            
            .cta-section .cta-buttons a {
                transition: none !important;
            }
            
            .cta-section .cta-buttons a:hover {
                transform: none !important;
            }
        }

        /* Print styles */
        @media print {
            .testimonials-page {
                padding: 20px 0;
            }
            
            .testimonial-card {
                break-inside: avoid;
                box-shadow: none;
                border: 1px solid #ddd;
            }
            
            .testimonial-card:hover {
                transform: none;
            }
        }
    </style>

    <!-- ============================================
    TESTIMONIALS PAGE
    ============================================ -->
    <section class="testimonials-page">
        <div class="container">
            <h1 class="section-title">⭐ What Our Customers Say</h1>
            <p class="section-subtitle">Real reviews from our happy customers who traveled with us</p>

            <!-- Rating Summary -->
            <div class="rating-summary">
                <div class="rating-grid">
                    <div class="rating-item">
                        <div class="number">4.8</div>
                        <div class="stars">★★★★★</div>
                        <div class="label">Average Rating</div>
                    </div>
                    <div class="rating-item">
                        <div class="number">500+</div>
                        <div class="stars">★★★★★</div>
                        <div class="label">Total Reviews</div>
                    </div>
                    <div class="rating-item">
                        <div class="number">98%</div>
                        <div class="stars">★★★★★</div>
                        <div class="label">Happy Customers</div>
                    </div>
                    <div class="rating-item">
                        <div class="number">10+</div>
                        <div class="stars">★★★★★</div>
                        <div class="label">Years of Service</div>
                    </div>
                </div>
            </div>

            <!-- Testimonials Grid - 9 Testimonials -->
            <div class="testimonials-grid">

                <!-- Testimonial 1 - Indian Customer (Delhi) -->
                <div class="testimonial-card">
                    <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">
                        "Excellent <span class="kw">Delhi to Agra tempo traveller service</span>! The vehicle was spotless and the driver was very professional. Made our Taj Mahal trip comfortable."
                    </p>
                    <div class="author">
                        <span class="author-avatar" aria-hidden="true">RS</span>
                        <div class="author-info">
                            <h5>Rahul Sharma</h5>
                            <span>Delhi</span>
                            <span class="location-badge"><i class="fas fa-map-marker-alt"></i> India</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 - Indian Customer (Gurgaon) -->
                <div class="testimonial-card">
                    <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">
                        "Best rates for <span class="kw">tempo on rent from Delhi to Agra</span>. The 16-seater was perfect for our office outing. Highly recommended!"
                    </p>
                    <div class="author">
                        <span class="author-avatar" aria-hidden="true">PK</span>
                        <div class="author-info">
                            <h5>Priya Kapoor</h5>
                            <span>Gurgaon</span>
                            <span class="location-badge"><i class="fas fa-map-marker-alt"></i> India</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 - Indian Customer (Noida) -->
                <div class="testimonial-card">
                    <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">
                        "Booked a <span class="kw">Maharaja tempo for Agra trip</span>. Luxury experience at affordable price. On-time pickup and smooth drive. Will book again!"
                    </p>
                    <div class="author">
                        <span class="author-avatar" aria-hidden="true">AV</span>
                        <div class="author-info">
                            <h5>Amit Verma</h5>
                            <span>Noida</span>
                            <span class="location-badge"><i class="fas fa-map-marker-alt"></i> India</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 4 - Indian Customer (Hyderabad) -->
                <div class="testimonial-card">
                    <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">
                        "Great experience with <span class="kw">Delhi to Agra tempo on rent</span>. Professional driver, clean vehicle, and transparent pricing. 5-star service!"
                    </p>
                    <div class="author">
                        <span class="author-avatar" aria-hidden="true">SR</span>
                        <div class="author-info">
                            <h5>Sneha Reddy</h5>
                            <span>Hyderabad</span>
                            <span class="location-badge"><i class="fas fa-map-marker-alt"></i> India</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 5 - Indian Customer (Jaipur) -->
                <div class="testimonial-card">
                    <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">
                        "The <span class="kw">tempo traveller service from Delhi to Agra</span> was exceptional. Very comfortable journey with family. Driver was knowledgeable and friendly."
                    </p>
                    <div class="author">
                        <span class="author-avatar" aria-hidden="true">VS</span>
                        <div class="author-info">
                            <h5>Vikram Singh</h5>
                            <span>Jaipur</span>
                            <span class="location-badge"><i class="fas fa-map-marker-alt"></i> India</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 6 - Indian Customer (Mumbai) -->
                <div class="testimonial-card">
                    <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">
                        "Reliable <span class="kw">Delhi to Agra cab service</span>. The vehicle was clean, AC was working perfectly, and the driver was on time. Highly recommend!"
                    </p>
                    <div class="author">
                        <span class="author-avatar" aria-hidden="true">RK</span>
                        <div class="author-info">
                            <h5>Raj Kumar</h5>
                            <span>Mumbai</span>
                            <span class="location-badge"><i class="fas fa-map-marker-alt"></i> India</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 7 - Foreign Customer (USA) -->
                <div class="testimonial-card">
                    <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">
                        "Amazing <span class="kw">Delhi to Agra tempo on rent</span>! The driver was very professional and the vehicle was immaculate. A truly memorable experience in India."
                    </p>
                    <div class="author">
                        <span class="author-avatar" aria-hidden="true">SJ</span>
                        <div class="author-info">
                            <h5>Sarah Johnson</h5>
                            <span>New York, USA</span>
                            <span class="location-badge"><i class="fas fa-globe"></i> USA</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 8 - Foreign Customer (UK) -->
                <div class="testimonial-card">
                    <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">
                        "Excellent <span class="kw">tempo traveller service from Delhi to Agra</span>. The driver was punctual and friendly. Highly recommend for hassle-free group travel."
                    </p>
                    <div class="author">
                        <span class="author-avatar" aria-hidden="true">DW</span>
                        <div class="author-info">
                            <h5>David Williams</h5>
                            <span>London, UK</span>
                            <span class="location-badge"><i class="fas fa-globe"></i> UK</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 9 - Foreign Customer (Australia) -->
                <div class="testimonial-card">
                    <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">
                        "Fantastic <span class="kw">Delhi to Agra tempo on rent</span> service! The vehicle was comfortable and the driver was very professional. A smooth ride to the Taj Mahal."
                    </p>
                    <div class="author">
                        <span class="author-avatar" aria-hidden="true">EW</span>
                        <div class="author-info">
                            <h5>Emma Wilson</h5>
                            <span>Sydney, Australia</span>
                            <span class="location-badge"><i class="fas fa-globe"></i> Australia</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- CTA Section -->
            <div class="cta-section">
                <h3>Ready to Experience Our Service?</h3>
                <p>Join our happy customers and book your comfortable ride today</p>
                <div class="cta-buttons">
                    <a href="contact.php" class="btn-book">
                        <i class="fas fa-calendar-check"></i> Book Now
                    </a>
                    <a href="https://wa.me/917290885949" target="_blank" rel="noopener noreferrer" class="btn-whatsapp">
                        <i class="fab fa-whatsapp"></i> WhatsApp Us
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>


<?php include 'footer.php'; ?>