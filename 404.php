<?php
// "Page not found" page (ErrorDocument in .htaccess). Kept out of Google with noindex.
http_response_code(404);
$page_title = 'Page Not Found | Delhi Tempo Traveller on Rent';
$page_description = 'The page you were looking for could not be found. Browse tempo traveller routes, tour packages and rates from Delhi, or call +91 7290885949.';
$canonical_url = 'https://www.delhitempotravelleronrent.com/';
$robots_meta = 'noindex, follow';
$page_css = ['pages.css'];
include 'header.php';
?>

<main>
    <section class="pg-sec">
        <div class="container" style="text-align:center;max-width:760px;">
            <span class="eyebrow-tag">Error 404</span>
            <h1>Sorry, this page could not be found</h1>
            <p>The link may be old or mistyped. Here are the pages most people look for:</p>
            <p style="display:flex;flex-wrap:wrap;gap:10px;justify-content:center;margin:24px 0;">
                <a class="btn btn-primary" href="index.php"><i class="fas fa-house"></i> Home</a>
                <a class="btn btn-outline" href="destinations.php"><i class="fas fa-route"></i> All Destinations</a>
                <a class="btn btn-outline" href="fleet.php"><i class="fas fa-van-shuttle"></i> Fleet &amp; Rates</a>
                <a class="btn btn-wa" href="https://wa.me/917290885949?text=Hi%2C%20I%20need%20a%20tempo%20traveller%20on%20rent" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp Us</a>
            </p>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
