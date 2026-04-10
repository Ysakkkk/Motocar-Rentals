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
        var toEN = {
            'Motor': 'Engine', 'Caja': 'Transmission', 'ABS': 'ABS', 'Aire': 'A/C',
            'acondicionado': 'included', 'Automática': 'Automatic', 'Mecánica': 'Manual',
            'Sí': 'Yes', 'No': 'No'
        };
        var toES = {};
        Object.keys(toEN).forEach(function(k) { toES[toEN[k]] = k; });
        var map = (lang === 'en') ? toEN : toES;

        document.querySelectorAll('.mc-card__spec-label, .mc-card__spec-value').forEach(function(el) {
            var text = el.textContent.trim();
            if (map[text]) el.textContent = map[text];
        });

        // Card badges: "X Personas" <-> "X Passengers"
        document.querySelectorAll('.mc-card__badge').forEach(function(badge) {
            if (lang === 'en') {
                badge.textContent = badge.textContent.replace('Personas', 'Passengers');
            } else {
                badge.textContent = badge.textContent.replace('Passengers', 'Personas');
            }
        });

        // Card price "Desde" <-> "From"
        document.querySelectorAll('.mc-card__price').forEach(function(el) {
            if (lang === 'en') {
                el.innerHTML = el.innerHTML.replace('Desde', 'From');
            } else {
                el.innerHTML = el.innerHTML.replace('From', 'Desde');
            }
        });

        // Card buttons "Reserva Ahora" <-> "Book Now"
        document.querySelectorAll('.mc-btn--card').forEach(function(btn) {
            if (lang === 'en') {
                btn.textContent = btn.textContent.replace('Reserva Ahora', 'Book Now');
            } else {
                btn.textContent = btn.textContent.replace('Book Now', 'Reserva Ahora');
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
    // TOGGLE BUTTONS CARRO / MOTO
    // ==========================================
    const tipoToggle = document.getElementById('tipoToggle');
    if (tipoToggle) {
        tipoToggle.querySelectorAll('.mc-toggle__btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (this.classList.contains('active')) {
                    this.classList.remove('active');
                    document.getElementById('filterTipo').value = '';
                } else {
                    tipoToggle.querySelectorAll('.mc-toggle__btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    document.getElementById('filterTipo').value = this.dataset.value;
                }
            });
        });
    }

    // ==========================================
    // FLATPICKR DATE RANGE PICKERS
    // ==========================================
    const fpConfig = {
        mode: 'range',
        showMonths: 2,
        dateFormat: 'Y-m-d',
        altInput: true,
        altFormat: 'd M Y',
        minDate: 'today',
        locale: typeof flatpickr !== 'undefined' && flatpickr.l10ns && flatpickr.l10ns.es ? flatpickr.l10ns.es : 'default',
        disableMobile: true
    };

    // Filter bar date picker
    const filterFechas = document.getElementById('filterFechas');
    if (filterFechas && typeof flatpickr !== 'undefined') {
        flatpickr(filterFechas, Object.assign({}, fpConfig, {
            onChange: function(selectedDates) {
                const inicioInput = document.getElementById('filterFechaInicio');
                const finInput = document.getElementById('filterFechaFin');
                if (selectedDates.length === 2) {
                    const toYMD = d => d.getFullYear() + '-' + String(d.getMonth()+1).padStart(2,'0') + '-' + String(d.getDate()).padStart(2,'0');
                    inicioInput.value = toYMD(selectedDates[0]);
                    finInput.value = toYMD(selectedDates[1]);
                } else {
                    inicioInput.value = '';
                    finInput.value = '';
                }
            }
        }));
    }

    // Modal date picker (initialized when modal opens — global for modal functions)
    window.modalFp = null;

    // ==========================================
    // FILTER FORM (AJAX)
    // ==========================================
    const filterForm = document.getElementById('filterForm');
    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Si hay motocarData (WordPress), usar AJAX
            if (typeof motocarData !== 'undefined') {
                const formData = new FormData(this);
                formData.append('action', 'filter_vehicles');
                formData.append('nonce', motocarData.nonce);

                const filterBtn = document.getElementById('filterBtn');
                filterBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Filtrando...';
                filterBtn.disabled = true;

                fetch(motocarData.ajaxUrl, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        renderVehicles(data.data);
                    }
                    filterBtn.innerHTML = 'Filtrar';
                    filterBtn.disabled = false;
                })
                .catch(error => {
                    console.error('Error:', error);
                    filterBtn.innerHTML = 'Filtrar';
                    filterBtn.disabled = false;
                });
            } else {
                // Filtrado local (para demo sin WP)
                filterLocal();
            }
        });
    }

    // ==========================================
    // FILTRADO LOCAL (DEMO)
    // ==========================================
    function filterLocal() {
        const tipo = document.getElementById('filterTipo').value;
        const precioRango = document.getElementById('filterPrecio').value;
        const cards = document.querySelectorAll('.mc-card');

        cards.forEach(card => {
            const cardTipo = card.getAttribute('data-tipo');
            const cardPrecio = parseInt(card.getAttribute('data-precio') || '0');
            let show = true;

            if (tipo && cardTipo !== tipo) {
                show = false;
            }

            if (precioRango && show) {
                const [min, max] = precioRango.split('-').map(Number);
                if (cardPrecio < min || cardPrecio > max) {
                    show = false;
                }
            }

            card.style.display = show ? '' : 'none';
        });
    }

    // ==========================================
    // RENDER VEHICLES (AJAX Response)
    // ==========================================
    function renderVehicles(vehicles) {
        const grid = document.getElementById('vehiculosGrid');
        if (!grid) return;

        if (vehicles.length === 0) {
            grid.innerHTML = '<div class="mc-empty"><p>No se encontraron vehículos con esos filtros.</p></div>';
            return;
        }

        grid.innerHTML = vehicles.map(v => `
            <div class="mc-card" data-vehicle-id="${v.id}" data-tipo="${v.tipo}" data-precio="${v.precio_dia}">
                <span class="mc-card__badge">${v.pasajeros || '5'} Personas</span>
                <h3 class="mc-card__title">${v.nombre}</h3>
                <div class="mc-card__image">
                    <img src="${v.imagen}" alt="${v.nombre}" loading="lazy">
                </div>
                <div class="mc-card__pricing">
                    <span class="mc-card__price">Desde $${formatNumber(v.precio_dia)} <small>COP/día</small></span>
                    <span class="mc-card__price-usd">$${(parseInt(v.precio_dia) / 3690).toFixed(2)} <small>USD/día</small></span>
                </div>
                <div class="mc-card__specs">
                    <div class="mc-card__spec">
                        <span class="mc-card__spec-label">Motor</span>
                        <span class="mc-card__spec-value">${v.cilindrada || '2000 cc'}</span>
                    </div>
                    <div class="mc-card__spec">
                        <span class="mc-card__spec-label">Caja</span>
                        <span class="mc-card__spec-value">${v.transmision || 'Mecánica'}</span>
                    </div>
                    <div class="mc-card__spec">
                        <span class="mc-card__spec-label">${v.tipo === 'moto' ? 'ABS' : 'Aire'}</span>
                        <span class="mc-card__spec-value">${v.tipo === 'moto' ? 'Sí' : 'acondicionado'}</span>
                    </div>
                </div>
                <button class="mc-btn mc-btn--primary mc-btn--card" onclick="openVehicleModal(${v.id})">
                    Reserva Ahora
                </button>
            </div>
        `).join('');
    }

    // ==========================================
    // RESERVATION FORM SUBMIT (WhatsApp Cotizar)
    // ==========================================
    const reservationForm = document.getElementById('reservationForm');
    if (reservationForm) {
        reservationForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const vehicleName = document.getElementById('reserveVehicleName').value;
            const motor = document.getElementById('modalMotor').textContent;
            const transmision = document.getElementById('modalTransmision').textContent;
            const pasajeros = document.getElementById('modalPasajeros').textContent;
            const abs = document.getElementById('modalABS').textContent;
            const modalFechasInput = document.getElementById('modalFechas');
            let fechaInicio = 'Por definir';
            let fechaFin = 'Por definir';
            if (window.modalFp && window.modalFp.selectedDates.length >= 2) {
                fechaInicio = window.modalFp.formatDate(window.modalFp.selectedDates[0], 'Y-m-d');
                fechaFin = window.modalFp.formatDate(window.modalFp.selectedDates[1], 'Y-m-d');
            } else if (window.modalFp && window.modalFp.selectedDates.length === 1) {
                fechaInicio = window.modalFp.formatDate(window.modalFp.selectedDates[0], 'Y-m-d');
            }
            const lugarEntrega = this.querySelector('input[name="lugar_entrega"]').value;
            const lugarDevolucion = this.querySelector('input[name="lugar_devolucion"]').value;
            const horaEntrega = this.querySelector('input[name="hora_entrega"]').value;
            const horaDevolucion = this.querySelector('input[name="hora_devolucion"]').value;

            const message = `🚗 *¡Hola, MotoCar Rentals!* 🙌%0A%0A` +
                `Estoy interesado en alquilar un vehículo, aquí van los detalles:%0A%0A` +
                `🔹 *Vehículo:* ${vehicleName}%0A` +
                `📅 *Fecha inicio:* ${fechaInicio || 'Por definir'}%0A` +
                `📅 *Fecha fin:* ${fechaFin || 'Por definir'}%0A` +
                `📍 *Lugar de entrega:* ${lugarEntrega || 'Por definir'}%0A` +
                `📍 *Lugar de devolución:* ${lugarDevolucion || 'Por definir'}%0A` +
                `🕐 *Hora de entrega:* ${horaEntrega || 'Por definir'}%0A` +
                `🕐 *Hora de devolución:* ${horaDevolucion || 'Por definir'}%0A%0A` +
                `¡Quedo atento a su respuesta! Muchas gracias 😊`;

            // Número de WhatsApp de MotoCar
            const phone = '573202161156';
            window.open(`https://wa.me/${phone}?text=${message}`, '_blank');
        });
    }
});

// ==========================================
// MODAL FUNCTIONS (Global scope)
// ==========================================

// Abrir modal con datos desde WordPress (AJAX)
function openVehicleModal(vehicleId) {
    if (typeof motocarData !== 'undefined') {
        const formData = new FormData();
        formData.append('action', 'get_vehicle');
        formData.append('nonce', motocarData.nonce);
        formData.append('vehicle_id', vehicleId);

        fetch(motocarData.ajaxUrl, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                populateModal(data.data);
                showModal();
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

// Abrir modal con datos demo (sin WordPress)
function openVehicleModalDemo(nombre, ano, transmision, pasajeros, combustible, aire, motor, precioDia, imagen, descripcion) {
    document.getElementById('modalTitle').textContent = nombre.toUpperCase() + ' ' + ano;
    document.getElementById('modalTransmision').textContent = transmision;
    document.getElementById('modalPasajeros').textContent = pasajeros;
    document.getElementById('modalMotor').textContent = motor.toUpperCase();
    document.getElementById('modalABS').textContent = aire === 'Sí' ? 'Sí' : 'No';
    document.getElementById('modalImage').src = imagen;
    document.getElementById('modalDescripcion').textContent = descripcion || '';
    document.getElementById('reserveVehicleName').value = nombre + ' ' + ano;

    showModal();
}

// Populate modal with data from WP AJAX
function populateModal(data) {
    document.getElementById('modalTitle').textContent = (data.nombre || '').toUpperCase() + ' ' + (data.ano || '');
    document.getElementById('modalTransmision').textContent = data.transmision ? (data.transmision.charAt(0).toUpperCase() + data.transmision.slice(1)) : '';
    document.getElementById('modalPasajeros').textContent = data.pasajeros || '';
    document.getElementById('modalMotor').textContent = (data.cilindrada || '2000 CC').toUpperCase();
    document.getElementById('modalABS').textContent = data.aire === 'si' ? 'Sí' : 'No';
    document.getElementById('modalImage').src = data.imagen;
    document.getElementById('modalDescripcion').textContent = (data.descripcion || '').replace(/<!--[^>]*-->/g, '').replace(/<[^>]*>/g, '').trim();
    document.getElementById('reserveVehicleName').value = data.nombre;
}

function showModal() {
    const modal = document.getElementById('vehicleModal');
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';

    // Initialize Flatpickr on modal date input
    const modalFechasEl = document.getElementById('modalFechas');
    if (modalFechasEl && typeof flatpickr !== 'undefined') {
        if (window.modalFp) window.modalFp.destroy();
        window.modalFp = flatpickr(modalFechasEl, {
            mode: 'range',
            showMonths: 2,
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: 'd M Y',
            minDate: 'today',
            locale: flatpickr.l10ns && flatpickr.l10ns.es ? flatpickr.l10ns.es : 'default',
            disableMobile: true
        });
    }
}

function closeVehicleModal() {
    const modal = document.getElementById('vehicleModal');
    modal.classList.remove('active');
    document.body.style.overflow = '';

    // Destroy Flatpickr and reset form
    if (window.modalFp) { window.modalFp.destroy(); window.modalFp = null; }
    const form = document.getElementById('reservationForm');
    if (form) form.reset();
}

// Cerrar modal con Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeVehicleModal();
    }
});

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
            // Close all open items too
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

        // Close all items
        document.querySelectorAll('.mc-faq__item.active').forEach(function(openItem) {
            openItem.classList.remove('active');
            openItem.querySelector('.mc-faq__question').setAttribute('aria-expanded', 'false');
        });

        // Open clicked item if it was closed
        if (!isActive) {
            item.classList.add('active');
            this.setAttribute('aria-expanded', 'true');
        }
    });
});

// Format number (Colombian style)
function formatNumber(num) {
    return parseInt(num).toLocaleString('es-CO');
}
