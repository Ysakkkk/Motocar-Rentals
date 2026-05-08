/**
 * MotoCar Rentals - JavaScript Principal
 * Manejo de filtros, modal de reserva, navegación y WhatsApp
 */

// ==========================================
// TABLAS DE DESCUENTO POR DÍAS
// ==========================================
var DISCOUNT_TABLES = {
    default: [
        { min: 2,  max: 3,  pct: 5  },
        { min: 4,  max: 6,  pct: 10 },
        { min: 7,  max: 14, pct: 15 },
        { min: 15, max: 29, pct: 20 },
        { min: 30, max: Infinity, pct: 30 }
    ],
    suv7: [
        { min: 2,  max: 3,          pct: 7  },
        { min: 4,  max: 6,          pct: 13 },
        { min: 7,  max: 14,         pct: 20 },
        { min: 15, max: 29,         pct: 27 },
        { min: 30, max: Infinity,   pct: 33 }
    ]
};

function getDiscountPct(dias, slug) {
    var table = (DISCOUNT_TABLES[slug] !== undefined) ? DISCOUNT_TABLES[slug] : DISCOUNT_TABLES.default;
    for (var i = 0; i < table.length; i++) {
        if (dias >= table[i].min && dias <= table[i].max) return table[i].pct;
    }
    return 0;
}

document.addEventListener('DOMContentLoaded', function() {

    // ==========================================
    // HERO SLIDER AUTOMÁTICO (cada 5 segundos)
    // ==========================================
    const slides = document.querySelectorAll('.mc-hero__slide');
    const dots = document.querySelectorAll('.mc-hero__dot');
    let currentSlide = 0;
    let slideInterval;

    function goToSlide(index) {
        // Remover active de todos
        slides.forEach(s => s.classList.remove('active'));
        dots.forEach(d => d.classList.remove('active'));

        // Activar el slide correspondiente
        currentSlide = index;
        if (currentSlide >= slides.length) currentSlide = 0;
        if (currentSlide < 0) currentSlide = slides.length - 1;

        slides[currentSlide].classList.add('active');
        if (dots[currentSlide]) dots[currentSlide].classList.add('active');
    }

    function nextSlide() {
        goToSlide(currentSlide + 1);
    }

    function startSlider() {
        slideInterval = setInterval(nextSlide, 5000);
    }

    function resetSliderTimer() {
        clearInterval(slideInterval);
        startSlider();
    }

    // Click en los dots
    dots.forEach(dot => {
        dot.addEventListener('click', function() {
            const slideIndex = parseInt(this.getAttribute('data-slide'));
            goToSlide(slideIndex);
            resetSliderTimer();
        });
    });

    // Iniciar slider si hay slides
    if (slides.length > 0) {
        startSlider();
    }

    // ==========================================
    // HEADER & TOPBAR SCROLL EFFECT
    // ==========================================
    const header = document.getElementById('header');
    const topbar = document.querySelector('.mc-topbar');

    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
            if (topbar) topbar.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
            if (topbar) topbar.classList.remove('scrolled');
        }
    });

    // ==========================================
    // LANGUAGE SWITCHER
    // ==========================================
    var currentLang = 'es';

    // Store original Spanish text on first load
    function storeOriginalText() {
        document.querySelectorAll('[data-i18n]').forEach(function(el) {
            if (!el.hasAttribute('data-i18n-es')) {
                el.setAttribute('data-i18n-es', el.textContent);
            }
        });
        document.querySelectorAll('[data-i18n-html]').forEach(function(el) {
            if (!el.hasAttribute('data-i18n-es-html')) {
                el.setAttribute('data-i18n-es-html', el.innerHTML);
            }
        });
        document.querySelectorAll('[data-i18n-placeholder]').forEach(function(el) {
            if (!el.hasAttribute('data-i18n-es-ph')) {
                el.setAttribute('data-i18n-es-ph', el.placeholder);
            }
        });
    }

    function applyTranslations(lang) {
        if (lang === 'es') {
            // Restore original Spanish
            document.querySelectorAll('[data-i18n-es]').forEach(function(el) {
                el.textContent = el.getAttribute('data-i18n-es');
            });
            document.querySelectorAll('[data-i18n-es-html]').forEach(function(el) {
                el.innerHTML = el.getAttribute('data-i18n-es-html');
            });
            document.querySelectorAll('[data-i18n-es-ph]').forEach(function(el) {
                el.placeholder = el.getAttribute('data-i18n-es-ph');
            });
            // Restore card repeated elements
            translateCardElements('es');
            document.documentElement.lang = 'es';
            return;
        }

        var t = (typeof MC_TRANSLATIONS !== 'undefined') ? MC_TRANSLATIONS[lang] : null;
        if (!t) return;

        // Translate data-i18n (textContent)
        document.querySelectorAll('[data-i18n]').forEach(function(el) {
            var key = el.getAttribute('data-i18n');
            if (t[key]) el.textContent = t[key];
        });

        // Translate data-i18n-html (innerHTML)
        document.querySelectorAll('[data-i18n-html]').forEach(function(el) {
            var key = el.getAttribute('data-i18n-html');
            if (t[key]) el.innerHTML = t[key];
        });

        // Translate data-i18n-placeholder
        document.querySelectorAll('[data-i18n-placeholder]').forEach(function(el) {
            var key = el.getAttribute('data-i18n-placeholder');
            if (t[key]) el.placeholder = t[key];
        });

        // Translate repeated card elements by class
        translateCardElements(lang);

        // Update html lang attribute
        document.documentElement.lang = lang;
    }

    function translateCardElements(lang) {
        // Category card buttons: "Ver Detalles" <-> "Show Details"
        document.querySelectorAll('.mc-catcard__info .mc-btn--card').forEach(function(btn) {
            if (lang === 'en') {
                btn.textContent = btn.textContent.replace('Ver Detalles', 'Show Details');
            } else {
                btn.textContent = btn.textContent.replace('Show Details', 'Ver Detalles');
            }
        });

        // Category card titles
        var titleMap = {
            'Hatchback':          'Hatchback',
            'Sedan':              'Sedan',
            'SUV Compacto':       'Compact SUV',
            'SUV 7 Puestos':      'SUV 7 Seats',
            'Motocicletas':       'Motorcycles',
            'Motos Autom\u00e1ticas': 'Automatic Motorcycles'
        };
        var titleMapReverse = {};
        Object.keys(titleMap).forEach(function(k) { titleMapReverse[titleMap[k]] = k; });
        document.querySelectorAll('.mc-catcard__title').forEach(function(el) {
            var map = lang === 'en' ? titleMap : titleMapReverse;
            var txt = el.textContent.trim();
            if (map[txt]) el.textContent = map[txt];
        });

        // Category card descriptions: "o similar" <-> "or similar"
        document.querySelectorAll('.mc-catcard__desc').forEach(function(el) {
            if (lang === 'en') {
                el.textContent = el.textContent.replace(' o similar', ' or similar');
            } else {
                el.textContent = el.textContent.replace(' or similar', ' o similar');
            }
        });

        // Category card prices: handled by updateCategoryCardPrices()
        document.querySelectorAll('.mc-catcard__price').forEach(function(el) {
            var textEl = el.querySelector('.mc-catcard__price-text');
            var usdEl  = el.querySelector('.mc-catcard__price-usd');
            if (!textEl || !usdEl) return;
            if (lang === 'en') {
                textEl.textContent = textEl.textContent.replace('Desde', 'From').replace('COP/día', 'COP/day').replace('~$', '~$');
                usdEl.textContent  = usdEl.textContent.replace('día', 'day');
            } else {
                textEl.textContent = textEl.textContent.replace('From', 'Desde').replace('COP/day', 'COP/día');
                usdEl.textContent  = usdEl.textContent.replace('/day', '/día');
            }
        });

        // Filter buttons
        var filterMap = {
            'Todos': 'All', 'Carros': 'Cars', 'Motos': 'Motorcycles'
        };
        var filterMapReverse = {};
        Object.keys(filterMap).forEach(function(k) { filterMapReverse[filterMap[k]] = k; });
        document.querySelectorAll('.mc-filter__btn').forEach(function(btn) {
            var map = lang === 'en' ? filterMap : filterMapReverse;
            // Get only text node (preserve icon)
            var icon = btn.querySelector('i');
            var txt = btn.textContent.trim();
            if (map[txt]) {
                if (icon) {
                    btn.textContent = '';
                    btn.appendChild(icon);
                    btn.appendChild(document.createTextNode(' ' + map[txt]));
                } else {
                    btn.textContent = map[txt];
                }
            }
        });
    }

    // Store originals and apply listener
    storeOriginalText();

    document.querySelectorAll('.mc-lang-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var lang = this.dataset.lang;
            if (lang === currentLang) return;
            document.querySelectorAll('.mc-lang-btn').forEach(function(b) { b.classList.remove('active'); });
            this.classList.add('active');
            currentLang = lang;
            applyTranslations(lang);

            // Update WhatsApp float link message
            var waFloat = document.querySelector('.mc-whatsapp-float');
            if (waFloat) {
                var msg = (lang === 'en')
                    ? 'Hello%20MotoCar%20Rentals!%20I%20want%20information%20about%20vehicle%20rental'
                    : 'Hola%20MotoCar%20Rentals!%20Quiero%20información%20sobre%20alquiler%20de%20vehículos';
                waFloat.href = 'https://wa.me/573202161156?text=' + msg;
            }

            // Update Flatpickr locale
            if (window._mcFlatpickr && typeof flatpickr !== 'undefined') {
                var fpLoc = (lang === 'en') ? 'default' : 'es';
                window._mcFlatpickr.pickup.set('locale', fpLoc);
                window._mcFlatpickr.return.set('locale', fpLoc);
            }
        });
    });

    // ==========================================
    // MOBILE MENU TOGGLE
    // ==========================================
    const menuToggle = document.getElementById('menuToggle');
    const mainNav = document.getElementById('mainNav');

    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function() {
            mainNav.classList.toggle('open');
            this.classList.toggle('active');
        });

        // Cerrar menú al hacer clic en un enlace
        document.querySelectorAll('.mc-nav__link').forEach(link => {
            link.addEventListener('click', function() {
                mainNav.classList.remove('open');
                menuToggle.classList.remove('active');
            });
        });
    }

    // ==========================================
    // SMOOTH SCROLL & ACTIVE NAV
    // ==========================================
    document.querySelectorAll('.mc-nav__link').forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href.startsWith('#')) {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }

                // Actualizar clase activa
                document.querySelectorAll('.mc-nav__link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            }
        });
    });

    // Active nav on scroll
    const sections = document.querySelectorAll('section[id]');
    window.addEventListener('scroll', function() {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 100;
            if (window.scrollY >= sectionTop) {
                current = section.getAttribute('id');
            }
        });

        document.querySelectorAll('.mc-nav__link').forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + current) {
                link.classList.add('active');
            }
        });
    });

    // ==========================================
    // SEARCH TABS
    // ==========================================
    // (Removed - replaced by toggle buttons)

    // ==========================================
    // LUGARES / RINCONES SLIDER
    // ==========================================
    const lugarSlides = document.querySelectorAll('.mc-lugares__slide');
    const lugarDots = document.querySelectorAll('.mc-lugares__dot');
    const lugarPrev = document.getElementById('lugarPrev');
    const lugarNext = document.getElementById('lugarNext');
    let currentLugar = 0;
    let lugarInterval;

    function goToLugar(index) {
        lugarSlides.forEach(s => s.classList.remove('active'));
        lugarDots.forEach(d => d.classList.remove('active'));

        currentLugar = index;
        if (currentLugar >= lugarSlides.length) currentLugar = 0;
        if (currentLugar < 0) currentLugar = lugarSlides.length - 1;

        lugarSlides[currentLugar].classList.add('active');
        if (lugarDots[currentLugar]) lugarDots[currentLugar].classList.add('active');
    }

    function nextLugar() {
        goToLugar(currentLugar + 1);
    }

    function startLugarSlider() {
        lugarInterval = setInterval(nextLugar, 6000);
    }

    function resetLugarTimer() {
        clearInterval(lugarInterval);
        startLugarSlider();
    }

    if (lugarPrev) {
        lugarPrev.addEventListener('click', function() {
            goToLugar(currentLugar - 1);
            resetLugarTimer();
        });
    }

    if (lugarNext) {
        lugarNext.addEventListener('click', function() {
            goToLugar(currentLugar + 1);
            resetLugarTimer();
        });
    }

    lugarDots.forEach(dot => {
        dot.addEventListener('click', function() {
            const slideIndex = parseInt(this.getAttribute('data-slide'));
            goToLugar(slideIndex);
            resetLugarTimer();
        });
    });

    if (lugarSlides.length > 0) {
        startLugarSlider();
    }

    // ==========================================
    // CATEGORY CARD CAROUSELS
    // ==========================================
    function initCategoryCarousels() {
        document.querySelectorAll('.mc-catcard__carousel').forEach(function(carousel) {
            var slides = carousel.querySelectorAll('.mc-catcard__slide');
            var dots = carousel.querySelectorAll('.mc-catcard__dot');
            var leftArrow = carousel.querySelector('.mc-catcard__arrow--left');
            var rightArrow = carousel.querySelector('.mc-catcard__arrow--right');
            var current = 0;
            var autoTimer = null;

            if (slides.length <= 1) return;

            function goTo(index) {
                slides.forEach(function(s) { s.classList.remove('active'); });
                dots.forEach(function(d) { d.classList.remove('active'); });
                current = ((index % slides.length) + slides.length) % slides.length;
                slides[current].classList.add('active');
                if (dots[current]) dots[current].classList.add('active');
            }

            function startAuto() {
                autoTimer = setInterval(function() { goTo(current + 1); }, 4000);
            }

            function resetAuto() {
                clearInterval(autoTimer);
                startAuto();
            }

            if (leftArrow) leftArrow.addEventListener('click', function(e) { e.stopPropagation(); goTo(current - 1); resetAuto(); });
            if (rightArrow) rightArrow.addEventListener('click', function(e) { e.stopPropagation(); goTo(current + 1); resetAuto(); });

            dots.forEach(function(dot) {
                dot.addEventListener('click', function(e) {
                    e.stopPropagation();
                    goTo(parseInt(this.getAttribute('data-index')));
                    resetAuto();
                });
            });

            startAuto();
        });
    }

    initCategoryCarousels();

    // ==========================================
    // VEHICLE TYPE FILTER
    // ==========================================
    var filterButtons = document.querySelectorAll('.mc-filter__btn');
    filterButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
            filterButtons.forEach(function(b) { b.classList.remove('active'); });
            this.classList.add('active');
            var filter = this.getAttribute('data-filter');
            document.querySelectorAll('.mc-catcard').forEach(function(card) {
                if (filter === 'all' || card.getAttribute('data-type') === filter) {
                    card.classList.remove('mc-catcard--hidden');
                } else {
                    card.classList.add('mc-catcard--hidden');
                }
            });
        });
    });

    // ==========================================
    // FLATPICKR DATE PICKERS
    // ==========================================
    function parseFilterDate(value) {
        if (!value) return null;
        var parts = value.split('/');
        if (parts.length !== 3) return null;
        return new Date(parseInt(parts[2], 10), parseInt(parts[1], 10) - 1, parseInt(parts[0], 10));
    }

    function isSameDay(dateA, dateB) {
        return dateA && dateB &&
            dateA.getFullYear() === dateB.getFullYear() &&
            dateA.getMonth() === dateB.getMonth() &&
            dateA.getDate() === dateB.getDate();
    }

    function getCurrentMinimumHour(dateValue) {
        var selectedDate = parseFilterDate(dateValue);
        var now = new Date();
        if (!selectedDate || !isSameDay(selectedDate, now)) return 0;
        return now.getHours() + ((now.getMinutes() > 0 || now.getSeconds() > 0) ? 1 : 0);
    }

    function syncTimeSelect(selectEl, minHour) {
        if (!selectEl) return;

        var firstEnabledValue = '';
        Array.prototype.forEach.call(selectEl.options, function(option, index) {
            if (!option.value) {
                option.disabled = false;
                return;
            }

            var hour = parseInt(option.value.split(':')[0], 10);
            option.disabled = hour < minHour;
            if (!option.disabled && !firstEnabledValue && index > 0) {
                firstEnabledValue = option.value;
            }
        });

        if (selectEl.value) {
            var selectedOption = selectEl.options[selectEl.selectedIndex];
            if (selectedOption && selectedOption.disabled) {
                selectEl.value = firstEnabledValue;
            }
        } else if (firstEnabledValue && minHour > 0) {
            selectEl.value = firstEnabledValue;
        }
    }

    function syncFilterTimes() {
        var pickupDateEl = document.getElementById('filterPickup');
        var returnDateEl = document.getElementById('filterReturn');
        var pickupTimeEl = document.getElementById('filterPickupTime');
        var returnTimeEl = document.getElementById('filterReturnTime');
        var pickupDateValue = pickupDateEl ? pickupDateEl.value : '';
        var returnDateValue = returnDateEl ? returnDateEl.value : '';

        var pickupMinHour = getCurrentMinimumHour(pickupDateValue);
        syncTimeSelect(pickupTimeEl, pickupMinHour);

        var returnMinHour = getCurrentMinimumHour(returnDateValue);
        var pickupDate = parseFilterDate(pickupDateValue);
        var returnDate = parseFilterDate(returnDateValue);
        if (pickupDate && returnDate && isSameDay(pickupDate, returnDate) && pickupTimeEl && pickupTimeEl.value) {
            returnMinHour = Math.max(returnMinHour, parseInt(pickupTimeEl.value.split(':')[0], 10));
        }
        syncTimeSelect(returnTimeEl, returnMinHour);
    }

    if (typeof flatpickr !== 'undefined') {
        var fpLocale = (typeof flatpickr.l10ns !== 'undefined' && flatpickr.l10ns.es) ? 'es' : 'default';
        var fpPickup = flatpickr('#filterPickup', {
            locale: fpLocale,
            dateFormat: 'd/m/Y',
            minDate: 'today',
            disableMobile: true,
            onChange: function(selectedDates) {
                if (selectedDates.length > 0) {
                    fpReturn.set('minDate', selectedDates[0]);
                }
                syncFilterTimes();
                updateCategoryCardPrices();
                checkCategoryAvailability();
            }
        });
        var fpReturn = flatpickr('#filterReturn', {
            locale: fpLocale,
            dateFormat: 'd/m/Y',
            minDate: 'today',
            disableMobile: true,
            onChange: function() { syncFilterTimes(); updateCategoryCardPrices(); checkCategoryAvailability(); }
        });

        // Expose for language switching
        window._mcFlatpickr = { pickup: fpPickup, return: fpReturn };
    }

    ['filterPickupTime', 'filterReturnTime'].forEach(function(id) {
        var element = document.getElementById(id);
        if (element) {
            element.addEventListener('change', syncFilterTimes);
            element.addEventListener('change', updateCategoryCardPrices);
        }
    });

    syncFilterTimes();

    // Reset all visible filters to their default state
    var filterResetBtn = document.getElementById('filterReset');
    if (filterResetBtn) {
        filterResetBtn.addEventListener('click', function() {
            var allButton = document.querySelector('.mc-filter__btn[data-filter="all"]');
            if (allButton) {
                filterButtons.forEach(function(b) { b.classList.remove('active'); });
                allButton.classList.add('active');
            }
            document.querySelectorAll('.mc-catcard').forEach(function(card) {
                card.classList.remove('mc-catcard--hidden');
            });

            var pickupEl = document.getElementById('filterPickup');
            var returnEl = document.getElementById('filterReturn');
            if (pickupEl) pickupEl.value = '';
            if (returnEl) returnEl.value = '';

            if (window._mcFlatpickr) {
                window._mcFlatpickr.pickup.clear();
                window._mcFlatpickr.return.clear();
                window._mcFlatpickr.return.set('minDate', 'today');
            }

            var pickupTimeEl = document.getElementById('filterPickupTime');
            var returnTimeEl = document.getElementById('filterReturnTime');
            if (pickupTimeEl) pickupTimeEl.value = '10:00';
            if (returnTimeEl) returnTimeEl.value = '10:00';

            ['filterPickupLocation', 'filterReturnLocation'].forEach(function(id) {
                var select = document.getElementById(id);
                if (select) {
                    select.value = '';
                    select.dispatchEvent(new Event('change'));
                }
            });

            syncFilterTimes();
            updateCategoryCardPrices();
            checkCategoryAvailability();
        });
    }

    var filterSubmitBtn = document.getElementById('filterSubmit');
    if (filterSubmitBtn) {
        filterSubmitBtn.addEventListener('click', function() {
            var grid = document.getElementById('categoriesGrid');
            if (grid) {
                var offset = 80; // account for sticky header
                var top = grid.getBoundingClientRect().top + window.pageYOffset - offset;
                window.scrollTo({ top: top, behavior: 'smooth' });
            }
        });
    }

    // ==========================================
    // FAQ SECTION TOGGLE (show/hide all questions)
    // ==========================================
    var faqToggle = document.getElementById('faqToggle');
    var faqList = document.getElementById('faqList');
    if (faqToggle && faqList) {
        faqToggle.addEventListener('click', function() {
            var isOpen = faqList.classList.contains('open');
            if (isOpen) {
                faqList.classList.remove('open');
                faqToggle.classList.remove('active');
                faqToggle.setAttribute('aria-expanded', 'false');
                document.querySelectorAll('.mc-faq__item.active').forEach(function(item) {
                    item.classList.remove('active');
                    item.querySelector('.mc-faq__question').setAttribute('aria-expanded', 'false');
                });
            } else {
                faqList.classList.add('open');
                faqToggle.classList.add('active');
                faqToggle.setAttribute('aria-expanded', 'true');
            }
        });
    }

    // ==========================================
    // FAQ ACCORDION (individual questions)
    // ==========================================
    document.querySelectorAll('.mc-faq__question').forEach(function(button) {
        button.addEventListener('click', function() {
            var item = this.closest('.mc-faq__item');
            var isActive = item.classList.contains('active');

            document.querySelectorAll('.mc-faq__item.active').forEach(function(openItem) {
                openItem.classList.remove('active');
                openItem.querySelector('.mc-faq__question').setAttribute('aria-expanded', 'false');
            });

            if (!isActive) {
                item.classList.add('active');
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });

    // ==========================================
    // FOOTER CONTACT FORM
    // ==========================================
    var footerForm = document.getElementById('footerContactForm');
    if (footerForm) {
        footerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            var input  = document.getElementById('footerContactInput');
            var msgEl  = document.getElementById('footerContactMsg');
            var btn    = footerForm.querySelector('button[type="submit"]');
            var contact = input ? input.value.trim() : '';
            if (!contact) return;

            // WordPress AJAX
            if (typeof motocarData !== 'undefined') {
                btn.disabled = true;
                var fd = new FormData();
                fd.append('action',  'footer_contact');
                fd.append('nonce',   motocarData.nonce);
                fd.append('contact', contact);
                fetch(motocarData.ajaxUrl, { method: 'POST', body: fd })
                    .then(function(r) { return r.json(); })
                    .then(function(data) {
                        btn.disabled = false;
                        msgEl.style.display = 'block';
                        if (data.success) {
                            msgEl.style.color = '#1a9e40';
                            msgEl.textContent = '¡Mensaje enviado! Pronto nos pondremos en contacto contigo.';
                            input.value = '';
                        } else {
                            msgEl.style.color = '#c0392b';
                            msgEl.textContent = 'Hubo un error al enviar. Por favor intenta de nuevo.';
                        }
                    })
                    .catch(function() {
                        btn.disabled = false;
                        msgEl.style.display = 'block';
                        msgEl.style.color = '#c0392b';
                        msgEl.textContent = 'Error de conexión. Por favor intenta de nuevo.';
                    });
            } else {
                // Fallback para preview estático: abre mailto
                var mailSubject = 'Solicitud de contacto desde motocarrentals.com.co';
                var mailBody = 'Hola MotoCar Rentals,\n\n'
                    + 'Los encontré desde su página web y me gustaría ser contactado para obtener más información sobre sus servicios de alquiler de vehículos.\n\n'
                    + 'Mi información de contacto es: ' + contact + '\n\n'
                    + '¡Gracias!';
                window.location.href = 'mailto:motocarrentals@gmail.com?subject=' + encodeURIComponent(mailSubject) + '&body=' + encodeURIComponent(mailBody);
            }
        });
    }

});

// ==========================================
// UTILITY FUNCTIONS (Global scope)
// ==========================================

/**
 * Calculate rental days between two DD/MM/YYYY date strings.
 * Takes pickup/return times into account: if return time < pickup time,
 * an extra day is charged (same logic as most rental companies).
 */
function calcRentalDays(pickupDate, returnDate, pickupTime, returnTime) {
    if (!pickupDate || !returnDate) return 0;
    var p = pickupDate.split('/');
    var r = returnDate.split('/');
    if (p.length !== 3 || r.length !== 3) return 0;
    var pickup = new Date(parseInt(p[2], 10), parseInt(p[1], 10) - 1, parseInt(p[0], 10));
    var ret    = new Date(parseInt(r[2], 10), parseInt(r[1], 10) - 1, parseInt(r[0], 10));
    var diffDays = Math.round((ret.getTime() - pickup.getTime()) / (1000 * 60 * 60 * 24));
    if (diffDays <= 0) return 0;
    // If return time is before pickup time, charge an extra day
    if (pickupTime && returnTime) {
        var ph = parseInt(pickupTime.split(':')[0], 10);
        var rh = parseInt(returnTime.split(':')[0], 10);
        if (rh < ph) diffDays += 1;
    }
    return diffDays;
}

/** Format a number with dots as thousands separator (Colombian style: 150.000) */
function formatNumber(n) {
    return String(Math.round(n)).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

/** Escape HTML special characters to prevent XSS */
function escapeHtml(str) {
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;');
}

/** Close the category detail modal */
function closeCategoryModal() {
    var modal = document.getElementById('categoryModal');
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
}

// ==========================================
// CATEGORY MODAL FUNCTIONS (Global scope)
// ==========================================
function _getLang() {
    return document.documentElement.lang || 'es';
}

function getLocationFieldValue(selectId, otherInputId) {
    var select = document.getElementById(selectId);
    if (!select || !select.value) return '';

    if (select.value === 'other') {
        var otherInput = document.getElementById(otherInputId);
        return otherInput && otherInput.value ? otherInput.value.trim() : '';
    }

    return select.options[select.selectedIndex] ? select.options[select.selectedIndex].textContent.trim() : '';
}

function buildRentalContext(lang) {
    var details = [];
    var pickupDateEl = document.getElementById('filterPickup');
    var returnDateEl = document.getElementById('filterReturn');
    var pickupLocation = getLocationFieldValue('filterPickupLocation', 'filterPickupLocationOther');
    var returnLocation = getLocationFieldValue('filterReturnLocation', 'filterReturnLocationOther');

    if (pickupDateEl && pickupDateEl.value) {
        details.push((lang === 'en' ? 'Pick-up date: ' : 'Fecha de recogida: ') + pickupDateEl.value);
    }
    if (returnDateEl && returnDateEl.value) {
        details.push((lang === 'en' ? 'Return date: ' : 'Fecha de devolución: ') + returnDateEl.value);
    }
    if (pickupLocation) {
        details.push((lang === 'en' ? 'Pick-up location: ' : 'Lugar de retirada: ') + pickupLocation);
    }
    if (returnLocation) {
        details.push((lang === 'en' ? 'Return location: ' : 'Lugar de devolución: ') + returnLocation);
    }

    return details;
}

function openCategoryModal(slug, name) {
    var modal  = document.getElementById('categoryModal');
    var layout = document.getElementById('catModalLayout');
    var lang   = _getLang();

    var loadingText = lang === 'en' ? 'Loading...' : 'Cargando...';
    layout.innerHTML = '<div class="mc-catmodal__loading"><i class="fas fa-spinner fa-spin"></i> ' + loadingText + '</div>';
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';

    // WordPress AJAX
    if (typeof motocarData !== 'undefined') {
        var fd = new FormData();
        fd.append('action', 'get_category_data');
        fd.append('nonce', motocarData.nonce);
        fd.append('category', slug);
        fetch(motocarData.ajaxUrl, { method: 'POST', body: fd })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.success) {
                    data.data.slug = slug;
                    renderCategoryModal(data.data, layout, lang);
                } else {
                    var err = lang === 'en' ? 'Error loading category.' : 'Error cargando categor\u00eda.';
                    layout.innerHTML = '<div class="mc-catmodal__loading">' + err + '</div>';
                }
            })
            .catch(function() {
                var errText = lang === 'en' ? 'Connection error.' : 'Error de conexi\u00f3n.';
                layout.innerHTML = '<div class="mc-catmodal__loading">' + errText + '</div>';
            });
    }
    // Demo fallback
    else if (typeof DEMO_VEHICLES !== 'undefined') {
        var cat = DEMO_VEHICLES.find(function(c) { return c.slug === slug; });
        if (cat) {
            var templateDir = '';
            var imgEl = document.querySelector('.mc-catcard__slide img');
            if (imgEl) {
                var src = imgEl.getAttribute('src');
                templateDir = src.substring(0, src.lastIndexOf('/') + 1);
            }
            var minPrice = cat.price
                ? parseInt(String(cat.price).replace(/[,.]/g, ''))
                : (cat.vehicles[0] ? parseInt(String(cat.vehicles[0].price).replace(/[,.]/g, '')) : 0);
            var catData = {
                slug:            slug,
                nombre:          cat.name,
                descripcion:     cat.descripcion    || '',
                descripcion_en:  cat.descripcion_en || '',
                precio_dia:      minPrice,
                motor:        cat.motor        || (cat.vehicles[0] ? cat.vehicles[0].motor  : ''),
                transmision:  cat.trans        || (cat.vehicles[0] ? cat.vehicles[0].trans  : ''),
                pasajeros:    cat.pax          || (cat.vehicles[0] ? cat.vehicles[0].pax    : ''),
                abs:          cat.abs          || '',
                maletas:      cat.maletas      || (cat.vehicles[0] ? cat.vehicles[0].luggage : ''),
                imagenes:     cat.vehicles.map(function(v) { return templateDir + v.img; }),
                fechas_no_disponibles: []
            };
            renderCategoryModal(catData, layout, lang);
        } else {
            layout.innerHTML = '<div class="mc-catmodal__loading">' + (lang === 'en' ? 'No data available.' : 'Sin datos disponibles.') + '</div>';
        }
    } else {
        layout.innerHTML = '<div class="mc-catmodal__loading">' + (lang === 'en' ? 'No data available.' : 'Sin datos disponibles.') + '</div>';
    }
}

// ==========================================
// RENDER NEW CATEGORY MODAL
// ==========================================
function renderCategoryModal(catData, layout, lang) {
    var titleMap = {
        'Hatchback':          'Hatchback',
        'Sedan':              'Sedan',
        'SUV Compacto':       'Compact SUV',
        'SUV 7 Puestos':      'SUV 7 Seats',
        'Motocicletas':       'Motorcycles',
        'Motos Autom\u00e1ticas': 'Automatic Motorcycles'
    };
    var displayName = (lang === 'en' && titleMap[catData.nombre]) ? titleMap[catData.nombre] : catData.nombre;
    var placeHolder = (typeof motocarData !== 'undefined' ? motocarData.themeUrl : '') + '/assets/img/placeholder.jpg';
    var images = (catData.imagenes && catData.imagenes.length) ? catData.imagenes : [placeHolder];

    // Gallery
    var galleryNavHtml = images.length > 1
        ? '<button class="mc-catmodal__gallery-prev" onclick="catModalGalleryNav(-1)" aria-label="Anterior"><i class="fas fa-chevron-left"></i></button>' +
          '<button class="mc-catmodal__gallery-next" onclick="catModalGalleryNav(1)"  aria-label="Siguiente"><i class="fas fa-chevron-right"></i></button>'
        : '';
    var thumbsHtml = images.length > 1
        ? '<div class="mc-catmodal__gallery-thumbs">' +
          images.map(function(img, i) {
              return '<img class="mc-catmodal__gallery-thumb' + (i === 0 ? ' active' : '') + '" src="' + escapeHtml(img) + '" alt="" loading="lazy" onclick="catModalGallerySelect(' + i + ')" onerror="this.src=\'' + placeHolder + '\'">';
          }).join('') + '</div>'
        : '';
    var galleryHtml =
        '<div class="mc-catmodal__gallery">' +
            '<div class="mc-catmodal__gallery-main">' +
                '<img id="catModalMainImg" src="' + escapeHtml(images[0]) + '" alt="' + escapeHtml(displayName) + '" loading="lazy" onerror="this.src=\'' + placeHolder + '\'">' +
                galleryNavHtml +
            '</div>' +
        '</div>';

    // Specs bar
    var specDefs = [
        { key: 'motor',       icon: 'fas fa-cog',           label: 'Motor' },
        { key: 'abs',         icon: 'fas fa-circle-notch',  label: 'ABS' },
        { key: 'pasajeros',   icon: 'fas fa-user-friends',  label: lang === 'en' ? 'Passengers' : 'Pasajeros' },
        { key: 'transmision', icon: 'fas fa-sliders-h',     label: lang === 'en' ? 'Type' : 'Tipo' },
        { key: 'maletas',     icon: 'fas fa-suitcase',      label: lang === 'en' ? 'Luggage' : 'Maletas' },
    ];
    var transMap = { 'Autom\u00e1tica': 'Automatic' };
    var activeSpecs = specDefs.filter(function(s) { return !!catData[s.key] && catData[s.key] !== 'N/A'; });
    var specsBarHtml = activeSpecs.length
        ? '<div class="mc-catmodal__specs-bar">' +
          activeSpecs.map(function(s) {
              var val = catData[s.key];
              if (lang === 'en' && transMap[val]) val = transMap[val];
              return '<div class="mc-catmodal__spec-item">' +
                  '<span class="mc-catmodal__spec-label">' + s.label + '</span>' +
                  '<i class="' + s.icon + '"></i>' +
                  '<span class="mc-catmodal__spec-value">' + escapeHtml(String(val)) + '</span>' +
              '</div>';
          }).join('') + '</div>'
        : '';

    var descText = (lang === 'en' && catData.descripcion_en) ? catData.descripcion_en : catData.descripcion;
    var descHtml = descText
        ? '<p class="mc-catmodal__cat-desc">' + escapeHtml(descText) + '</p>'
        : '';

    layout.innerHTML =
        '<div class="mc-catmodal__layout">' +
            '<div class="mc-catmodal__left">' +
                '<h2 class="mc-catmodal__cat-title">' + escapeHtml(displayName) + '</h2>' +
                descHtml +
                galleryHtml +
                specsBarHtml +
            '</div>' +
            '<div class="mc-catmodal__right">' +
                buildBookingPanel(catData, lang) +
            '</div>' +
        '</div>';

    // Store gallery state
    layout._galleryImages = images;
    layout._galleryIndex  = 0;
    layout._placeHolder   = placeHolder;
}

function buildBookingPanel(catData, lang) {
    var phone = '573202161156';
    var USD_RATE = 4500;
    var pickupDate = (document.getElementById('filterPickup')     || {}).value || '';
    var returnDate = (document.getElementById('filterReturn')     || {}).value || '';
    var pickupTime = (document.getElementById('filterPickupTime') || {}).value || '';
    var returnTime = (document.getElementById('filterReturnTime') || {}).value || '';
    var pickupLoc  = getLocationFieldValue('filterPickupLocation', 'filterPickupLocationOther');
    var returnLoc  = getLocationFieldValue('filterReturnLocation', 'filterReturnLocationOther');

    var pricePerDay = catData.precio_dia || 0;
    var rentalDays  = (pickupDate && returnDate) ? calcRentalDays(pickupDate, returnDate, pickupTime, returnTime) : 0;

    // Date/location fields display
    var fieldsHtml = '';
    if (pickupDate) {
        fieldsHtml += '<div class="mc-catmodal__booking-field"><span class="mc-catmodal__booking-label">' + (lang === 'en' ? 'Pick-up date' : 'Fecha de recogida') + '</span>' +
            '<div class="mc-catmodal__booking-val"><i class="fas fa-calendar-alt"></i> ' + escapeHtml(pickupDate) + (pickupTime ? ' &middot; ' + escapeHtml(pickupTime) : '') + '</div></div>';
    }
    if (returnDate) {
        fieldsHtml += '<div class="mc-catmodal__booking-field"><span class="mc-catmodal__booking-label">' + (lang === 'en' ? 'Return date' : 'Fecha de devoluci\u00f3n') + '</span>' +
            '<div class="mc-catmodal__booking-val"><i class="fas fa-calendar-alt"></i> ' + escapeHtml(returnDate) + (returnTime ? ' &middot; ' + escapeHtml(returnTime) : '') + '</div></div>';
    }
    if (!pickupDate && !returnDate) {
        fieldsHtml += '<div class="mc-catmodal__booking-hint"><i class="fas fa-calendar-alt"></i> ' +
            (lang === 'en' ? 'Select dates in the filters above to calculate the total price.' : 'Selecciona las fechas en los filtros para calcular el precio total.') + '</div>';
    }
    if (pickupLoc) {
        fieldsHtml += '<div class="mc-catmodal__booking-field"><span class="mc-catmodal__booking-label">' + (lang === 'en' ? 'Pick-up location' : 'Lugar de Entrega') + '</span>' +
            '<div class="mc-catmodal__booking-val"><i class="fas fa-map-marker-alt"></i> ' + escapeHtml(pickupLoc) + '</div></div>';
    }
    if (returnLoc) {
        fieldsHtml += '<div class="mc-catmodal__booking-field"><span class="mc-catmodal__booking-label">' + (lang === 'en' ? 'Return location' : 'Lugar de Devoluci\u00f3n') + '</span>' +
            '<div class="mc-catmodal__booking-val"><i class="fas fa-map-marker-alt"></i> ' + escapeHtml(returnLoc) + '</div></div>';
    }

    // Price box
    var priceHtml = '';
    if (rentalDays > 0 && pricePerDay > 0) {
        var discPct      = getDiscountPct(rentalDays, catData.slug || '');
        var baseTotal    = pricePerDay * rentalDays;
        var baseDesc     = discPct > 0 ? Math.round(baseTotal * (1 - discPct / 100)) : baseTotal;
        var totalCash    = baseDesc;
        var totalCard    = Math.round(baseDesc * 1.19);
        var totalCashUsd = (totalCash / USD_RATE).toFixed(2);
        var totalCardUsd = (totalCard / USD_RATE).toFixed(2);
        var daysLabel    = rentalDays === 1 ? (lang === 'en' ? 'day' : 'd\u00eda') : (lang === 'en' ? 'days' : 'd\u00edas');
        var sinDescRow   = discPct > 0
            ? '<div class="mc-catmodal__price-row"><span>' + (lang === 'en' ? 'Subtotal' : 'Sin descuento') + '</span><span class="mc-price-strikethrough">$' + formatNumber(baseTotal) + ' COP</span></div>'
            : '<div class="mc-catmodal__price-row"><span>' + (lang === 'en' ? 'Subtotal' : 'Sin descuento') + '</span><span>$' + formatNumber(baseTotal) + ' COP</span></div>';
        var discRow      = discPct > 0
            ? '<div class="mc-catmodal__price-row mc-catmodal__price-row--discount"><span>' +
              (lang === 'en' ? 'Discount (\u2212' + discPct + '%)' : 'Descuento (\u2212' + discPct + '%)') +
              '</span><span class="mc-discount-val">\u2212$' + formatNumber(baseTotal - baseDesc) + ' COP</span></div>'
            : '';
        priceHtml =
            '<div class="mc-catmodal__price-box">' +
                '<div class="mc-catmodal__price-row"><span>' + (lang === 'en' ? 'Price/day' : 'Precio/d\u00eda') + '</span><span>$' + formatNumber(pricePerDay) + ' COP</span></div>' +
                '<div class="mc-catmodal__price-row"><span>' + (lang === 'en' ? 'Duration' : 'Duraci\u00f3n') + '</span><span>' + rentalDays + ' ' + daysLabel + '</span></div>' +
                '<div class="mc-catmodal__price-divider"></div>' +
                sinDescRow +
                discRow +
                '<div class="mc-catmodal__price-row mc-catmodal__price-row--total"><span><i class="fas fa-money-bill-wave"></i> ' + (lang === 'en' ? 'Cash' : 'Efectivo') + '</span><span>$' + formatNumber(totalCash) + ' COP</span></div>' +
                '<div class="mc-catmodal__price-row mc-catmodal__price-row--sub"><span></span><span>~$' + totalCashUsd + ' USD</span></div>' +
                '<div class="mc-catmodal__price-row mc-catmodal__price-row--total mc-catmodal__price-row--card"><span><i class="fas fa-credit-card"></i> ' + (lang === 'en' ? 'Card (+ IVA 19%)' : 'Tarjeta (+ IVA 19%)') + '</span><span>$' + formatNumber(totalCard) + ' COP</span></div>' +
                '<div class="mc-catmodal__price-row mc-catmodal__price-row--sub"><span><small>' + (lang === 'en' ? '+ additional charges may apply' : '+ pueden aplicar costos adicionales') + '</small></span><span>~$' + totalCardUsd + ' USD</span></div>' +
                '<p class="mc-catmodal__price-note">* ' + (lang === 'en' ? 'Estimated total. Final price confirmed at pickup.' : 'Total estimado. Precio final confirmado al momento de la entrega.') + '</p>' +
            '</div>';
    } else if (pricePerDay > 0) {
        var priceUsdDay = (pricePerDay / USD_RATE).toFixed(2);
        var priceSuffix = lang === 'en' ? 'COP/day' : 'COP/d\u00eda';
        priceHtml =
            '<div class="mc-catmodal__price-box">' +
                '<div class="mc-catmodal__price-row mc-catmodal__price-row--total"><span>' + (lang === 'en' ? 'From' : 'Desde') + '</span><span>$' + formatNumber(pricePerDay) + ' ' + priceSuffix + '</span></div>' +
                '<div class="mc-catmodal__price-row mc-catmodal__price-row--sub"><span></span><span>~$' + priceUsdDay + ' USD/' + (lang === 'en' ? 'day' : 'd\u00eda') + '</span></div>' +
                '<p class="mc-catmodal__price-note">' + (lang === 'en' ? 'Select dates to see estimated total.' : 'Selecciona fechas para ver el precio estimado.') + '</p>' +
            '</div>';
    }

    // WhatsApp link — detailed message with prices
    var waMsg;
    if (lang === 'en') {
        waMsg = 'Hello MotoCar Rentals! I found you on your website and I\'m interested in renting a vehicle from the *' + catData.nombre + '* category.\n\n';
        if (pickupDate) waMsg += '\uD83D\uDCC5 Pick-up: '  + pickupDate + (pickupTime ? ' \u00b7 ' + pickupTime : '') + '\n';
        if (returnDate) waMsg += '\uD83D\uDCC5 Return: '   + returnDate + (returnTime ? ' \u00b7 ' + returnTime : '') + '\n';
        if (pickupLoc)  waMsg += '\uD83D\uDCCD Pick-up location: ' + pickupLoc + '\n';
        if (returnLoc)  waMsg += '\uD83D\uDCCD Return location: '  + returnLoc + '\n';
        if (rentalDays > 0 && pricePerDay > 0) {
            waMsg += '\n\uD83D\uDCB0 Price estimate (' + rentalDays + ' ' + (rentalDays === 1 ? 'day' : 'days') + '):\n';
            waMsg += '\u2022 Price/day: $' + formatNumber(pricePerDay) + ' COP\n';
            if (discPct > 0) waMsg += '\u2022 Discount (\u2212' + discPct + '%): \u2212$' + formatNumber(baseTotal - baseDesc) + ' COP\n';

            waMsg += '\u2022 Cash total: $' + formatNumber(totalCash) + ' COP (~$' + totalCashUsd + ' USD)\n';
            waMsg += '\u2022 Card total: $' + formatNumber(totalCard) + ' COP (~$' + totalCardUsd + ' USD)\n';
            waMsg += '\nCould you confirm availability and final price?';
        } else {
            waMsg += '\nCould you provide more information about availability and pricing?';
        }
    } else {
        waMsg = '\u00a1Hola MotoCar Rentals! Los encontr\u00e9 en su p\u00e1gina web y estoy interesado en alquilar un veh\u00edculo de la categor\u00eda *' + catData.nombre + '*.\n\n';
        if (pickupDate) waMsg += '\uD83D\uDCC5 Recogida: '             + pickupDate + (pickupTime ? ' \u00b7 ' + pickupTime : '') + '\n';
        if (returnDate) waMsg += '\uD83D\uDCC5 Devoluci\u00f3n: '      + returnDate + (returnTime ? ' \u00b7 ' + returnTime : '') + '\n';
        if (pickupLoc)  waMsg += '\uD83D\uDCCD Lugar de entrega: '      + pickupLoc + '\n';
        if (returnLoc)  waMsg += '\uD83D\uDCCD Lugar de devoluci\u00f3n: ' + returnLoc + '\n';
        if (rentalDays > 0 && pricePerDay > 0) {
            waMsg += '\n\uD83D\uDCB0 Cotizaci\u00f3n estimada (' + rentalDays + ' ' + (rentalDays === 1 ? 'd\u00eda' : 'd\u00edas') + '):\n';
            waMsg += '\u2022 Precio/d\u00eda: $' + formatNumber(pricePerDay) + ' COP\n';
            if (discPct > 0) waMsg += '\u2022 Descuento (\u2212' + discPct + '%): \u2212$' + formatNumber(baseTotal - baseDesc) + ' COP\n';

            waMsg += '\u2022 Total efectivo: $' + formatNumber(totalCash) + ' COP (~$' + totalCashUsd + ' USD)\n';
            waMsg += '\u2022 Total tarjeta: $' + formatNumber(totalCard) + ' COP (~$' + totalCardUsd + ' USD)\n';
            waMsg += '\n\u00bfPueden confirmarme la disponibilidad y el precio final?';
        } else {
            waMsg += '\n\u00bfPueden darme m\u00e1s informaci\u00f3n sobre disponibilidad y precios?';
        }
    }
    var waLink  = 'https://wa.me/' + phone + '?text=' + encodeURIComponent(waMsg);
    var btnText = lang === 'en' ? 'Get a Quote' : 'Ir a Cotizar';

    // Store quote data for email notification (sent in goToQuote)
    window._mcLastQuoteData = {
        categoria:   catData.nombre,
        slug:        catData.slug || '',
        pickupDate:  pickupDate,
        pickupTime:  pickupTime,
        returnDate:  returnDate,
        returnTime:  returnTime,
        pickupLoc:   pickupLoc,
        returnLoc:   returnLoc,
        rentalDays:  rentalDays,
        pricePerDay: pricePerDay,
        discPct:     (rentalDays > 0 && pricePerDay > 0) ? discPct   : 0,
        totalCash:   (rentalDays > 0 && pricePerDay > 0) ? totalCash : 0,
        totalCard:   (rentalDays > 0 && pricePerDay > 0) ? totalCard : 0,
        waLink:      waLink
    };

    return '<div class="mc-catmodal__booking">' +
        '<h3 class="mc-catmodal__booking-title"><i class="fas fa-clipboard-list"></i> ' + (lang === 'en' ? 'Rental Details' : 'Detalles de Renta') + '</h3>' +
        fieldsHtml +
        priceHtml +
        '<a href="#" class="mc-catmodal__book-btn" onclick="goToQuote(); return false;">' + btnText + ' <i class="fab fa-whatsapp"></i></a>' +
    '</div>';
}

// ==========================================
// CATEGORY AVAILABILITY CHECK BY DATES
// ==========================================
function checkCategoryAvailability() {
    if (typeof motocarData === 'undefined') return; // Demo/preview: skip

    var pickupDate = (document.getElementById('filterPickup') || {}).value || '';
    var returnDate = (document.getElementById('filterReturn') || {}).value || '';

    if (!pickupDate || !returnDate) {
        // No dates selected: restore all cards
        document.querySelectorAll('.mc-catcard').forEach(function(card) {
            card.classList.remove('mc-catcard--unavailable');
        });
        return;
    }

    var fd = new FormData();
    fd.append('action', 'check_categories_availability');
    fd.append('nonce',  motocarData.nonce);
    fd.append('pickup', pickupDate);
    fd.append('return', returnDate);

    fetch(motocarData.ajaxUrl, { method: 'POST', body: fd })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (!data.success) return;
            var avail = data.data;
            document.querySelectorAll('.mc-catcard').forEach(function(card) {
                var slug = card.getAttribute('data-category');
                if (avail.hasOwnProperty(slug) && avail[slug] === false) {
                    card.classList.add('mc-catcard--unavailable');
                } else {
                    card.classList.remove('mc-catcard--unavailable');
                }
            });
        })
        .catch(function() {});
}

// ==========================================
// QUOTE NOTIFICATION — open WhatsApp + email MotoCar
// ==========================================
function goToQuote() {
    var d = window._mcLastQuoteData;
    if (!d || !d.waLink) return;

    // Notify MotoCar by email (fire and forget, does not block WhatsApp)
    if (typeof motocarData !== 'undefined') {
        var fd = new FormData();
        fd.append('action', 'quote_notify');
        fd.append('nonce',  motocarData.nonce);
        fd.append('data',   JSON.stringify(d));
        fetch(motocarData.ajaxUrl, { method: 'POST', body: fd }).catch(function() {});
    }

    // Open WhatsApp
    window.open(d.waLink, '_blank');
}

function catModalGalleryNav(direction) {
    var layout = document.getElementById('catModalLayout');
    if (!layout || !layout._galleryImages) return;
    var n = layout._galleryImages.length;
    layout._galleryIndex = ((layout._galleryIndex || 0) + direction + n) % n;
    catModalGallerySelect(layout._galleryIndex);
}

function catModalGallerySelect(index) {
    var layout = document.getElementById('catModalLayout');
    if (!layout || !layout._galleryImages) return;
    layout._galleryIndex = index;
    var mainImg = document.getElementById('catModalMainImg');
    if (mainImg) {
        mainImg.src = layout._galleryImages[index];
        if (layout._placeHolder) mainImg.onerror = function() { this.src = layout._placeHolder; };
    }
    document.querySelectorAll('.mc-catmodal__gallery-thumb').forEach(function(t, i) {
        t.classList.toggle('active', i === index);
    });
}

function updateCategoryCardPrices() {
    var USD_RATE   = 4500;
    var lang       = _getLang();
    var pickupDate = (document.getElementById('filterPickup')     || {}).value || '';
    var returnDate = (document.getElementById('filterReturn')     || {}).value || '';
    var pickupTime = (document.getElementById('filterPickupTime') || {}).value || '';
    var returnTime = (document.getElementById('filterReturnTime') || {}).value || '';
    var rentalDays = (pickupDate && returnDate) ? calcRentalDays(pickupDate, returnDate, pickupTime, returnTime) : 0;

    document.querySelectorAll('.mc-catcard[data-price-day]').forEach(function(card) {
        var priceDay = parseInt(card.getAttribute('data-price-day')) || 0;
        var priceEl  = card.querySelector('.mc-catcard__price');
        if (!priceEl || !priceDay) return;
        var textEl = priceEl.querySelector('.mc-catcard__price-text');
        var usdEl  = priceEl.querySelector('.mc-catcard__price-usd');
        if (!textEl || !usdEl) return;

        if (rentalDays > 0) {
            var slug     = card.getAttribute('data-category') || '';
            var discPct  = getDiscountPct(rentalDays, slug);
            var baseTotal = priceDay * rentalDays;
            var baseDesc  = discPct > 0 ? Math.round(baseTotal * (1 - discPct / 100)) : baseTotal;
            var total     = baseDesc;
            var totalUsd  = (total / USD_RATE).toFixed(2);
            var daysLbl   = rentalDays === 1 ? (lang === 'en' ? 'day' : 'd\u00eda') : (lang === 'en' ? 'days' : 'd\u00edas');
            var discTag   = discPct > 0 ? ' \u2022 -' + discPct + '%' : '';
            textEl.textContent = '~$' + formatNumber(total) + ' COP (' + rentalDays + ' ' + daysLbl + discTag + ')';
            usdEl.textContent  = '~$' + totalUsd + ' USD';
        } else {
            var usdDay  = (priceDay / USD_RATE).toFixed(2);
            textEl.textContent = (lang === 'en' ? 'From $' : 'Desde $') + formatNumber(priceDay) + (lang === 'en' ? ' COP/day' : ' COP/d\u00eda');
            usdEl.textContent  = '~$' + usdDay + ' USD/' + (lang === 'en' ? 'day' : 'd\u00eda');
        }
    });
}

// ==========================================
// DARK MODE TOGGLE
// ==========================================
(function() {
    var html = document.documentElement;

    function isDarkActive() {
        return html.classList.contains('dark-mode');
    }

    function updateToggleIcon(dark) {
        var btn = document.getElementById('darkModeToggle');
        if (!btn) return;
        var icon = btn.querySelector('i');
        if (icon) {
            icon.className = dark ? 'fas fa-sun' : 'fas fa-moon';
        }
        btn.setAttribute('aria-label', dark ? 'Cambiar a modo claro' : 'Cambiar a modo oscuro');
    }

    function setTheme(dark) {
        html.classList.toggle('dark-mode', dark);
        updateToggleIcon(dark);
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateToggleIcon(isDarkActive());
        var btn = document.getElementById('darkModeToggle');
        if (btn) {
            btn.addEventListener('click', function() {
                var nowDark = !isDarkActive();
                setTheme(nowDark);
                try { localStorage.setItem('mc-theme', nowDark ? 'dark' : 'light'); } catch(e) {}
            });
        }
    });

    try {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
            if (!localStorage.getItem('mc-theme')) { setTheme(e.matches); }
        });
    } catch(e) {}
})();
