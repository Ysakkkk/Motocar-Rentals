/**
 * MotoCar Rentals - JavaScript Principal
 * Manejo de filtros, modal de reserva, navegación y WhatsApp
 */

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
            'Carro Econ\u00f3mico': 'Economy Car',
            'Carro Compacto': 'Compact Car',
            'SUV Compacto': 'Compact SUV',
            'Motocicletas': 'Motorcycles'
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

        // Category card prices: "Desde" <-> "From", "COP/día" <-> "COP/day"
        document.querySelectorAll('.mc-catcard__price').forEach(function(el) {
            if (lang === 'en') {
                el.textContent = el.textContent.replace('Desde', 'From').replace('COP/d\u00eda', 'COP/day');
            } else {
                el.textContent = el.textContent.replace('From', 'Desde').replace('COP/day', 'COP/d\u00eda');
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
            }
        });
        var fpReturn = flatpickr('#filterReturn', {
            locale: fpLocale,
            dateFormat: 'd/m/Y',
            minDate: 'today',
            disableMobile: true,
            onChange: syncFilterTimes
        });

        // Expose for language switching
        window._mcFlatpickr = { pickup: fpPickup, return: fpReturn };
    }

    ['filterPickupTime', 'filterReturnTime'].forEach(function(id) {
        var element = document.getElementById(id);
        if (element) {
            element.addEventListener('change', syncFilterTimes);
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

});

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
    var modal = document.getElementById('categoryModal');
    var grid = document.getElementById('catModalGrid');
    var title = document.getElementById('catModalTitle');
    var lang = _getLang();

    // Translate modal title if English
    var titleMap = {
        'Carro Econ\u00f3mico': 'Economy Car',
        'Carro Compacto': 'Compact Car',
        'SUV Compacto': 'Compact SUV',
        'Motocicletas': 'Motorcycles'
    };
    title.textContent = (lang === 'en' && titleMap[name]) ? titleMap[name] : name;

    // Update WhatsApp CTA link with category name
    var waLink = document.getElementById('catModalWhatsApp');
    if (waLink) {
        var displayName = (lang === 'en' && titleMap[name]) ? titleMap[name] : name;
        var rentalContext = buildRentalContext(lang);
        var waMsg = (lang === 'en')
            ? 'Hello, I\'m looking for a vehicle similar to the ones I saw in the ' + displayName + ' category. Do you have availability?'
            : 'Hola, estoy buscando un vehículo similar a los que vi en la categoría ' + displayName + '. ¿Tienen disponibilidad?';
        if (rentalContext.length) {
            waMsg += (lang === 'en' ? ' Details: ' : ' Detalles: ') + rentalContext.join(' | ');
        }
        waLink.href = 'https://wa.me/573202161156?text=' + encodeURIComponent(waMsg);
    }

    // Show/hide dates hint in modal
    var datesHint = document.getElementById('catModalDatesHint');
    if (datesHint) {
        var hasPickup = document.getElementById('filterPickup') && document.getElementById('filterPickup').value;
        var hasReturn = document.getElementById('filterReturn') && document.getElementById('filterReturn').value;
        datesHint.style.display = (hasPickup && hasReturn) ? 'none' : 'flex';
    }

    var loadingText = (lang === 'en') ? 'Loading vehicles...' : 'Cargando veh\u00edculos...';
    grid.innerHTML = '<div class="mc-catmodal__loading"><i class="fas fa-spinner fa-spin"></i> ' + loadingText + '</div>';
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';

    // WordPress AJAX
    if (typeof motocarData !== 'undefined') {
        var formData = new FormData();
        formData.append('action', 'get_category_vehicles');
        formData.append('nonce', motocarData.nonce);
        formData.append('category', slug);

        fetch(motocarData.ajaxUrl, {
            method: 'POST',
            body: formData
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            if (data.success && data.data.length > 0) {
                renderCategoryVehicles(data.data, grid);
            } else {
                var noVeh = (lang === 'en') ? 'No vehicles available in this category yet.' : 'No hay veh\u00edculos disponibles en esta categor\u00eda a\u00fan.';
                grid.innerHTML = '<div class="mc-catmodal__loading">' + noVeh + '</div>';
            }
        })
        .catch(function() {
            var errText = (lang === 'en') ? 'Error loading vehicles.' : 'Error al cargar veh\u00edculos.';
            grid.innerHTML = '<div class="mc-catmodal__loading">' + errText + '</div>';
        });
    }
    // Demo fallback
    else if (typeof DEMO_VEHICLES !== 'undefined') {
        var cat = DEMO_VEHICLES.find(function(c) { return c.slug === slug; });
        if (cat && cat.vehicles.length > 0) {
            var templateDir = '';
            var imgEl = document.querySelector('.mc-catcard__slide img');
            if (imgEl) {
                var src = imgEl.getAttribute('src');
                templateDir = src.substring(0, src.lastIndexOf('/') + 1);
            }
            var demoData = cat.vehicles.map(function(v) {
                return {
                    nombre: v.name,
                    imagen: templateDir + v.img,
                    precio_dia: v.price.replace(/[,.]/g, ''),
                    precio_display: '$' + v.price + ' COP/d\u00eda',
                    cilindrada: v.motor,
                    transmision: v.trans,
                    aire_acondicionado: v.ac,
                    pasajeros: v.pax,
                    maletas: v.luggage
                };
            });
            renderCategoryVehicles(demoData, grid);
        } else {
            var noVehMsg = (lang === 'en') ? 'No vehicles available.' : 'No hay veh\u00edculos disponibles.';
            grid.innerHTML = '<div class="mc-catmodal__loading">' + noVehMsg + '</div>';
        }
    } else {
        var noVehMsg2 = (lang === 'en') ? 'No vehicles available.' : 'No hay veh\u00edculos disponibles.';
        grid.innerHTML = '<div class="mc-catmodal__loading">' + noVehMsg2 + '</div>';
    }
}

function renderCategoryVehicles(vehicles, grid) {
    var phone = '573202161156';
    var lang = _getLang();
    var USD_RATE = 4500; // 1 USD = 4500 COP (configurable)

    // Pickup/return dates and times
    var pickupDate = '';
    var returnDate = '';
    var pickupEl = document.getElementById('filterPickup');
    var returnEl = document.getElementById('filterReturn');
    var pickupTimeEl = document.getElementById('filterPickupTime');
    var returnTimeEl = document.getElementById('filterReturnTime');
    if (pickupEl && pickupEl.value) pickupDate = pickupEl.value;
    if (returnEl && returnEl.value) returnDate = returnEl.value;
    var pickupTime = (pickupTimeEl && pickupTimeEl.value) ? pickupTimeEl.value : '';
    var returnTime = (returnTimeEl && returnTimeEl.value) ? returnTimeEl.value : '';
    var rentalContext = buildRentalContext(lang);

    // Filter out vehicles unavailable on selected dates
    if (pickupDate && returnDate) {
        var pParts = pickupDate.split('/');
        var rParts = returnDate.split('/');
        var filterStart = new Date(parseInt(pParts[2]), parseInt(pParts[1]) - 1, parseInt(pParts[0]));
        var filterEnd = new Date(parseInt(rParts[2]), parseInt(rParts[1]) - 1, parseInt(rParts[0]));

        vehicles = vehicles.filter(function(v) {
            var blocked = v.fechas_no_disponibles;
            if (!blocked || !blocked.length) return true;
            return !blocked.some(function(rango) {
                if (!rango.inicio || !rango.fin) return false;
                var bStart = new Date(rango.inicio); // yyyy-mm-dd from PHP
                var bEnd = new Date(rango.fin);
                // Overlap if filterStart <= bEnd AND filterEnd >= bStart
                return filterStart <= bEnd && filterEnd >= bStart;
            });
        });
    }

    // Calculate rental days
    var rentalDays = 0;
    if (pickupDate && returnDate) {
        rentalDays = calcRentalDays(pickupDate, returnDate, pickupTime, returnTime);
    }

    // Translation maps for specs
    var transMap = {
        'Manual': 'Manual',
        'Autom\u00e1tica': 'Automatic',
        'S\u00ed': 'Yes',
        '2 medianas': '2 medium',
        '2 grandes, 1 mediana': '2 large, 1 medium'
    };

    grid.innerHTML = vehicles.map(function(v) {
        var priceLabel = (lang === 'en') ? 'From' : 'Desde';
        var priceSuffix = (lang === 'en') ? 'COP/day' : 'COP/d\u00eda';
        var usdDaySuffix = (lang === 'en') ? 'USD/day' : 'USD/d\u00eda';
        var pricePerDay = parseInt(String(v.precio_dia).replace(/[,.]/g, '')) || 0;
        var priceUsdPerDay = pricePerDay > 0 ? (pricePerDay / USD_RATE).toFixed(2) : '';
        var priceUsdLine = priceUsdPerDay ? ('~$' + priceUsdPerDay + ' ' + usdDaySuffix) : '';
        var priceFmt = v.precio_display
            ? ((lang === 'en') ? v.precio_display.replace('COP/d\u00eda', 'COP/day') : v.precio_display)
            : (priceLabel + ' $' + formatNumber(v.precio_dia) + ' ' + priceSuffix);
        var disclaimerText = (lang === 'en')
            ? '* Estimated price. Additional charges may apply.'
            : '* Precio estimado. Pueden aplicar costos adicionales.';

        var dateInfo = rentalContext.length
            ? ((lang === 'en' ? ' Details: ' : ' Detalles: ') + rentalContext.join(' | '))
            : '';

        var waMsg;
        if (lang === 'en') {
            waMsg = encodeURIComponent('Hello MotoCar Rentals! I\'m interested in renting the ' + v.nombre + '.' + dateInfo + ' Could you give me more information?');
        } else {
            waMsg = encodeURIComponent('\u00a1Hola MotoCar Rentals! Estoy interesado en alquilar el ' + v.nombre + '.' + dateInfo + ' \u00bfPodr\u00edan darme m\u00e1s informaci\u00f3n?');
        }
        var waLink = 'https://wa.me/' + phone + '?text=' + waMsg;

        // Translate spec values if English
        function specVal(val) {
            if (lang === 'en' && transMap[val]) return transMap[val];
            return val;
        }

        var specs = '';
        if (v.cilindrada) specs += '<span class="mc-catmodal__vspec"><i class="fas fa-tachometer-alt"></i> ' + escapeHtml(v.cilindrada) + '</span>';
        if (v.transmision) specs += '<span class="mc-catmodal__vspec"><i class="fas fa-cog"></i> ' + escapeHtml(specVal(v.transmision)) + '</span>';
        if (v.pasajeros) specs += '<span class="mc-catmodal__vspec"><i class="fas fa-users"></i> ' + escapeHtml(v.pasajeros) + ' pax</span>';
        var acVal = v.aire_acondicionado || v.aire || '';
        if (acVal && acVal !== 'N/A') specs += '<span class="mc-catmodal__vspec"><i class="fas fa-snowflake"></i> A/C: ' + escapeHtml(specVal(acVal)) + '</span>';
        if (v.maletas && v.maletas !== 'N/A') specs += '<span class="mc-catmodal__vspec"><i class="fas fa-suitcase"></i> ' + escapeHtml(specVal(v.maletas)) + '</span>';

        // Price calculator
        var calcHtml = '';
        if (rentalDays > 0 && pricePerDay > 0) {
            var totalCash = pricePerDay * rentalDays;
            var totalCard = Math.round(totalCash * 1.19);
            var totalCashUsd = (totalCash / USD_RATE).toFixed(2);
            var totalCardUsd = (totalCard / USD_RATE).toFixed(2);

            var lblDays = (lang === 'en') ? 'days' : 'días';
            var lblDay = (lang === 'en') ? 'day' : 'día';
            var lblPriceDay = (lang === 'en') ? 'Price/day' : 'Precio/día';
            var lblCash = (lang === 'en') ? 'Cash total' : 'Total efectivo';
            var lblCard = (lang === 'en') ? 'Card total' : 'Total tarjeta';
            var lblIva = (lang === 'en') ? 'incl. 19% IVA' : 'incl. 19% IVA';
            var daysLabel = rentalDays === 1 ? lblDay : lblDays;

            calcHtml = '<div class="mc-calc">' +
                '<div class="mc-calc__header"><i class="fas fa-calculator"></i> ' + rentalDays + ' ' + daysLabel + '</div>' +
                '<div class="mc-calc__row"><span>' + lblPriceDay + '</span><span>$' + formatNumber(pricePerDay) + ' COP</span></div>' +
                '<div class="mc-calc__divider"></div>' +
                '<div class="mc-calc__row mc-calc__row--highlight"><span><i class="fas fa-money-bill-wave"></i> ' + lblCash + '</span><span>$' + formatNumber(totalCash) + ' COP</span></div>' +
                '<div class="mc-calc__row mc-calc__row--sub"><span></span><span>~$' + totalCashUsd + ' USD</span></div>' +
                '<div class="mc-calc__row mc-calc__row--highlight mc-calc__row--card"><span><i class="fas fa-credit-card"></i> ' + lblCard + '</span><span>$' + formatNumber(totalCard) + ' COP</span></div>' +
                '<div class="mc-calc__row mc-calc__row--sub"><span><small>' + lblIva + '</small></span><span>~$' + totalCardUsd + ' USD</span></div>' +
                '<div class="mc-calc__footer">' + ((lang === 'en') ? '* Estimated total based on selected filters. Additional charges may apply.' : '* Total estimado según los filtros seleccionados. Pueden aplicar costos adicionales.') + '</div>' +
            '</div>';
        } else if (pickupDate && !returnDate) {
            var selectReturn = (lang === 'en') ? 'Select return date to see price' : 'Selecciona fecha de devolución para ver precio';
            calcHtml = '<div class="mc-calc mc-calc--hint"><i class="fas fa-info-circle"></i> ' + selectReturn + '</div>';
        }

        var btnText = (lang === 'en') ? 'Book Now' : 'Reservar';

        return '<div class="mc-catmodal__vehicle">' +
            '<div class="mc-catmodal__vimg"><img src="' + escapeHtml(v.imagen) + '" alt="' + escapeHtml(v.nombre) + '" loading="lazy"></div>' +
            '<div class="mc-catmodal__vinfo">' +
                '<h3 class="mc-catmodal__vname">' + escapeHtml(v.nombre) + '</h3>' +
                '<p class="mc-catmodal__vprice">' + escapeHtml(priceFmt) + '</p>' +
                (priceUsdLine ? '<p class="mc-catmodal__vprice-usd">' + escapeHtml(priceUsdLine) + '</p>' : '') +
                '<p class="mc-catmodal__vdisclaimer">' + disclaimerText + '</p>' +
                '<div class="mc-catmodal__vspecs">' + specs + '</div>' +
                calcHtml +
                '<a href="' + waLink + '" target="_blank" class="mc-catmodal__vbtn">' + btnText + ' <i class="fab fa-whatsapp"></i></a>' +
            '</div>' +
        '</div>';
    }).join('');

    if (!vehicles.length) {
        var noAvailMsg = (lang === 'en')
            ? 'No vehicles available for the selected dates.'
            : 'No hay vehículos disponibles para las fechas seleccionadas.';
        grid.innerHTML = '<div class="mc-catmodal__loading"><i class="fas fa-calendar-times"></i> ' + noAvailMsg + '</div>';
    }
}

// Calculate rental days from dd/mm/yyyy strings + optional HH:MM times
function calcRentalDays(pickupStr, returnStr, pickupTime, returnTime) {
    var pParts = pickupStr.split('/');
    var rParts = returnStr.split('/');
    var pickup = new Date(parseInt(pParts[2]), parseInt(pParts[1]) - 1, parseInt(pParts[0]));
    var ret = new Date(parseInt(rParts[2]), parseInt(rParts[1]) - 1, parseInt(rParts[0]));

    if (pickupTime) {
        var pt = pickupTime.split(':');
        pickup.setHours(parseInt(pt[0]), parseInt(pt[1]));
    }
    if (returnTime) {
        var rt = returnTime.split(':');
        ret.setHours(parseInt(rt[0]), parseInt(rt[1]));
    }

    var diffMs = ret.getTime() - pickup.getTime();
    if (diffMs <= 0) return 1;
    var diffHours = diffMs / (1000 * 60 * 60);
    return Math.ceil(diffHours / 24);
}

function closeCategoryModal() {
    var modal = document.getElementById('categoryModal');
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

// Close modal with Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeCategoryModal();
    }
});

document.addEventListener('DOMContentLoaded', function() {
    [
        {
            selectId: 'filterPickupLocation',
            wrapId: 'filterPickupLocationOtherWrap',
            inputId: 'filterPickupLocationOther'
        },
        {
            selectId: 'filterReturnLocation',
            wrapId: 'filterReturnLocationOtherWrap',
            inputId: 'filterReturnLocationOther'
        }
    ].forEach(function(field) {
        var select = document.getElementById(field.selectId);
        var wrap = document.getElementById(field.wrapId);
        var input = document.getElementById(field.inputId);
        if (!select || !wrap || !input) return;

        function toggleOtherField() {
            var showOther = select.value === 'other';
            wrap.hidden = !showOther;
            input.required = showOther;
            if (!showOther) {
                input.value = '';
            }
        }

        select.addEventListener('change', toggleOtherField);
        toggleOtherField();
    });
});

// Utility: escape HTML to prevent XSS
function escapeHtml(str) {
    if (!str) return '';
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(String(str)));
    return div.innerHTML;
}

// Format number (Colombian style)
function formatNumber(num) {
    return parseInt(num).toLocaleString('es-CO');
}
