/* Get Instant Quote calculator (route pages, package pages and home page).
   Reads its settings from data-* attributes on #calculator. */
(function () {
    var box = document.getElementById('calculator');
    if (!box) return;
    var whatsapp = box.getAttribute('data-whatsapp') || '917290885949';
    var vehicle = document.getElementById('calcVehicle'),
        distance = document.getElementById('calcDistance'),
        days = document.getElementById('calcDays'),
        trip = document.getElementById('calcTrip'),
        dest = document.getElementById('calcDest'),
        totalEl = document.getElementById('calcTotal'),
        kmEl = document.getElementById('calcKm'),
        errorEl = document.getElementById('calcError');

    function mode() { return box.getAttribute('data-mode'); }

    // Minimum billing per day on outstation trips
    var DAY_LIMIT_KM = 250;
    var billableKm = 0;

    // Vehicles marked data-quote (Maharaja) have no public price: quote on WhatsApp only
    function isQuoteOnly() { return vehicle.options[vehicle.selectedIndex].hasAttribute('data-quote'); }
    var currency = totalEl.parentNode.firstChild;

    function calculatePrice() {
        var price = parseFloat(vehicle.value) || 0;
        var d = parseFloat(distance.value) || 0;
        var n = Math.max(1, parseInt(days.value, 10) || 1);
        // Routes take the one-way distance (always billed as a round trip);
        // packages take the estimated distance of the whole tour.
        var tripKm = mode() === 'package' ? d : d * 2;
        // Billable km = round trip km or days × daily limit, whichever is greater.
        // Only fuel is included in the per km rate; toll, state tax, parking, driver allowance etc. are extra.
        billableKm = Math.round(Math.max(tripKm, n * DAY_LIMIT_KM));
        var total = Math.round(billableKm * price);
        var quote = isQuoteOnly();
        if (currency && currency.nodeType === 3) currency.nodeValue = quote ? '' : '₹';
        totalEl.textContent = quote ? 'Price on WhatsApp' : total.toLocaleString('en-IN');
        if (kmEl) kmEl.textContent = quote ? billableKm.toLocaleString('en-IN') + ' km' : billableKm.toLocaleString('en-IN') + ' km × ₹' + price + '/km';
        return total;
    }

    function title() {
        if (dest && dest.value) return 'Delhi to ' + dest.options[dest.selectedIndex].text + ' Tempo on Rent';
        return box.getAttribute('data-title');
    }

    function sendWhatsAppQuote() {
        var phoneEl = document.getElementById('calcPhone');
        var phone = phoneEl.value.trim();
        var name = document.getElementById('calcName').value.trim() || 'Customer';
        if (!phone) {
            errorEl.hidden = false;
            phoneEl.focus();
            return;
        }
        errorEl.hidden = true;
        var pkg = mode() === 'package';
        var total = calculatePrice().toLocaleString('en-IN');
        var lines = [
            '🚐 *' + title() + ' - New Booking Inquiry*', '',
            '👤 *Name:* ' + name,
            '📱 *Phone:* ' + phone,
            '🚐 *Vehicle:* ' + vehicle.options[vehicle.selectedIndex].text,
            '📏 *' + (pkg ? 'Estimated Tour Distance' : 'One-way Distance') + ':* ' + distance.value + ' km',
            '📆 *Number of Days:* ' + days.value,
            '🛣️ *Billable Distance:* ' + billableKm.toLocaleString('en-IN') + ' km (round trip, min ' + DAY_LIMIT_KM + ' km/day)',
            isQuoteOnly() ? '💰 *Price:* Please share your best quote' : '💰 *Estimated Total:* ₹' + total + ' (only fuel included; toll tax, state tax, parking, driver allowance, driver night charge & GST extra; AC switched off in hilly areas)', '',
            '📅 *Travel Date:* (Please specify)',
            '📍 *Pickup Location:* (Please specify)'
        ];
        if (trip) lines.splice(6, 0, '🔄 *Package Type:* ' + trip.options[trip.selectedIndex].text);
        if (!pkg) lines.push('⏰ *Pickup Time:* (Please specify)');
        lines.push('👥 *Number of Passengers:* (Please specify)');
        var extraLabel = box.getAttribute('data-extra-label');
        if (extraLabel) lines.push('📌 *' + extraLabel + ':* (' + box.getAttribute('data-extra-value') + ')');
        lines.push('', '*Looking forward to your response!* 🙏');
        window.open('https://wa.me/' + whatsapp + '?text=' + encodeURIComponent(lines.join('\n')), '_blank');
    }

    if (dest) {
        dest.addEventListener('change', function () {
            var km = dest.options[dest.selectedIndex].getAttribute('data-km');
            if (km) distance.value = km;
            calculatePrice();
        });
    }
    [vehicle, distance, days].forEach(function (el) {
        el.addEventListener('input', calculatePrice);
        el.addEventListener('change', calculatePrice);
    });
    document.getElementById('calcSend').addEventListener('click', sendWhatsAppQuote);
    calculatePrice();
})();
