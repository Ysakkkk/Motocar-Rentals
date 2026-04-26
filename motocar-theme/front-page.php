<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MotoCar Rentals - Alquila la emoción, vive la experiencia. Alquiler de carros y motos en Antioquia, Colombia.">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ==========================================
     TOP BAR - INFORMACIÓN DE EMPRESA
     ========================================== -->
<div class="mc-topbar">
    <div class="mc-container">
        <div class="mc-topbar__inner">
            <div class="mc-topbar__info">
                <a href="https://www.google.com/maps/place/MotoCar+Rentals/@6.1762,-75.435,1576m/data=!3m1!1e3!4m6!3m5!1s0x8e469d8d8761cbb1:0xcf88fa157645f16d!8m2!3d6.1755508!4d-75.4348712!16s%2Fg%2F11y2tz0l_5" target="_blank" class="mc-topbar__item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span data-i18n="topbar_location">Rionegro, Antioquia</span>
                </a>
                <a href="mailto:motocarrentals@gmail.com" class="mc-topbar__item">
                    <i class="fas fa-envelope"></i>
                    <span>motocarrentals@gmail.com</span>
                </a>
            </div>
            <div class="mc-topbar__right">
                <div class="mc-topbar__social">
                    <a href="https://www.facebook.com/p/MotoCar-Rentals-61558707917054/" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://wa.me/573202161156" target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://www.instagram.com/motocar_rentals/" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.tiktok.com/@motocar.rentals" target="_blank" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                </div>
                <div class="mc-topbar__lang">
                    <span class="mc-topbar__lang-label" data-i18n="lang_label">Idioma</span>
                    <button class="mc-lang-btn active" data-lang="es" title="Español">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/flag-es.png" alt="Español">
                    </button>
                    <button class="mc-lang-btn" data-lang="en" title="English">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/flag-en.png" alt="English">
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================
     HEADER / NAVEGACIÓN
     ========================================== -->
<header class="mc-header" id="header">
    <div class="mc-container">
        <div class="mc-header__inner">
            <a href="<?php echo home_url(); ?>" class="mc-header__logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="MotoCar Rentals" class="mc-logo-img">
                <?php endif; ?>
            </a>

            <nav class="mc-nav" id="mainNav">
                <ul class="mc-nav__list">
                    <li><a href="#inicio" class="mc-nav__link active" data-i18n="nav_inicio">Inicio</a></li>
                    <li><a href="#vehiculos" class="mc-nav__link" data-i18n="nav_vehiculos">Vehículos</a></li>
                    <li><a href="#lugares" class="mc-nav__link" data-i18n="nav_lugares">Lugares de Interés</a></li>
                    <li><a href="#nosotros" class="mc-nav__link" data-i18n="nav_nosotros">Nosotros</a></li>
                    <li><a href="#quienes-somos" class="mc-nav__link" data-i18n="nav_quienes">Quiénes Somos</a></li>
                </ul>
            </nav>

            <button class="mc-header__toggle" id="menuToggle" aria-label="Abrir menú">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>

<!-- ==========================================
     HERO SLIDER / GALERÍA
     ========================================== -->
<section class="mc-hero" id="inicio">
    <div class="mc-hero__slider" id="heroSlider">
        <div class="mc-hero__slide active" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/slide-1.webp');"></div>
        <div class="mc-hero__slide" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/slide-2.webp');"></div>
        <div class="mc-hero__slide" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/slide-3.webp');"></div>
        <div class="mc-hero__slide" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/slide-4.webp');"></div>
    </div>
    <div class="mc-hero__overlay"></div>
    <div class="mc-hero__content">
        <h1 class="mc-hero__title" data-i18n-html="hero_title">
            ¡Alquila la emoción,<br>
            vive la experiencia!
        </h1>
    </div>
    <div class="mc-hero__dots" id="heroDots">
        <button class="mc-hero__dot active" data-slide="0"></button>
        <button class="mc-hero__dot" data-slide="1"></button>
        <button class="mc-hero__dot" data-slide="2"></button>
        <button class="mc-hero__dot" data-slide="3"></button>
    </div>
</section>

<!-- ==========================================
     VEHICLE CATEGORIES
     ========================================== -->
<section class="mc-categories" id="vehiculos">
    <div class="mc-container">
        <div class="mc-section-header">
            <h2 class="mc-section-title mc-section-title--script" data-i18n="catalog_title">Nuestra Flota</h2>
            <p class="mc-section-subtitle" data-i18n="catalog_subtitle">Elige tu vehículo ideal entre nuestras categorías</p>
        </div>

        <!-- FILTROS -->
        <div class="mc-filter">
            <div class="mc-filter__group">
                <label class="mc-filter__label" data-i18n="filter_type">Tipo de vehículo</label>
                <div class="mc-filter__buttons">
                    <button class="mc-filter__btn active" data-filter="all" data-i18n="filter_all">Todos</button>
                    <button class="mc-filter__btn" data-filter="carro" data-i18n="filter_cars"><i class="fas fa-car"></i> Carros</button>
                    <button class="mc-filter__btn" data-filter="moto" data-i18n="filter_motos"><i class="fas fa-motorcycle"></i> Motos</button>
                </div>
            </div>
            <div class="mc-filter__group">
                <label class="mc-filter__label" data-i18n="filter_availability">Disponibilidad</label>
                <div class="mc-filter__flow">
                    <div class="mc-filter__panel">
                        <p class="mc-filter__panel-title" data-i18n="filter_pickup_block">Recogida</p>
                        <div class="mc-filter__panel-grid">
                            <div class="mc-filter__date-field">
                                <i class="fas fa-calendar-alt"></i>
                                <input type="text" id="filterPickup" placeholder="Fecha de recogida" data-i18n-placeholder="filter_pickup" readonly>
                            </div>
                            <div class="mc-filter__time-field">
                                <i class="fas fa-clock"></i>
                                <select id="filterPickupTime">
                                    <option value="" data-i18n="filter_pickup_time">Hora recogida</option>
                                    <?php for ($hour = 0; $hour < 24; $hour++) : ?>
                                        <?php $time_value = sprintf('%02d:00', $hour); ?>
                                        <option value="<?php echo esc_attr($time_value); ?>" <?php selected($time_value, '10:00'); ?>><?php echo esc_html($time_value); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="mc-filter__location-field mc-filter__field--full">
                                <i class="fas fa-map-marker-alt"></i>
                                <select id="filterPickupLocation" required>
                                    <option value="" data-i18n="filter_pickup_location" selected disabled hidden>Lugar de retirada</option>
                                    <option value="rionegro-airport" data-i18n="location_rionegro_airport">Mall Terranova</option>
                                    <option value="other" data-i18n="location_other">Otro</option>
                                </select>
                            </div>
                            <div class="mc-filter__other-field mc-filter__field--full" id="filterPickupLocationOtherWrap" hidden>
                                <i class="fas fa-pen"></i>
                                <input type="text" id="filterPickupLocationOther" placeholder="¿Cuál lugar?" data-i18n-placeholder="filter_location_other_placeholder">
                            </div>
                        </div>
                    </div>

                    <div class="mc-filter__panel">
                        <p class="mc-filter__panel-title" data-i18n="filter_return_block">Devolución</p>
                        <div class="mc-filter__panel-grid">
                            <div class="mc-filter__date-field">
                                <i class="fas fa-calendar-alt"></i>
                                <input type="text" id="filterReturn" placeholder="Fecha de devolución" data-i18n-placeholder="filter_return" readonly>
                            </div>
                            <div class="mc-filter__time-field">
                                <i class="fas fa-clock"></i>
                                <select id="filterReturnTime">
                                    <option value="" data-i18n="filter_return_time">Hora devolución</option>
                                    <?php for ($hour = 0; $hour < 24; $hour++) : ?>
                                        <?php $time_value = sprintf('%02d:00', $hour); ?>
                                        <option value="<?php echo esc_attr($time_value); ?>" <?php selected($time_value, '10:00'); ?>><?php echo esc_html($time_value); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="mc-filter__location-field mc-filter__field--full">
                                <i class="fas fa-map-marker-alt"></i>
                                <select id="filterReturnLocation" required>
                                    <option value="" data-i18n="filter_return_location" selected disabled hidden>Lugar de devolución</option>
                                    <option value="rionegro-airport" data-i18n="location_rionegro_airport">Mall Terranova</option>
                                    <option value="other" data-i18n="location_other">Otro</option>
                                </select>
                            </div>
                            <div class="mc-filter__other-field mc-filter__field--full" id="filterReturnLocationOtherWrap" hidden>
                                <i class="fas fa-pen"></i>
                                <input type="text" id="filterReturnLocationOther" placeholder="¿Cuál lugar?" data-i18n-placeholder="filter_location_other_placeholder">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mc-filter__actions">
                    <button type="button" class="mc-filter__reset" id="filterReset" data-i18n="filter_reset">
                        <i class="fas fa-rotate-left"></i> Reiniciar filtros
                    </button>
                </div>
                <p class="mc-filter__hint" data-i18n="filter_hint"><i class="fas fa-info-circle"></i> Selecciona las fechas para calcular un precio estimado en COP y USD al ver los vehículos.</p>
            </div>
        </div>

        <div class="mc-categories__grid">
            <?php
            // Get categories from WP taxonomy
            $cat_terms = get_terms(array(
                'taxonomy'   => 'categoria_vehiculo',
                'hide_empty' => false,
                'orderby'    => 'slug',
                'order'      => 'ASC',
            ));

            $cat_order = array('motos' => 1, 'economy' => 2, 'compact' => 3, 'suv' => 4);
            $cat_icons = array(
                'economy' => 'fas fa-car',
                'compact' => 'fas fa-car-side',
                'suv'     => 'fas fa-shuttle-van',
                'motos'   => 'fas fa-motorcycle',
            );
            $cat_types = array(
                'economy' => 'carro',
                'compact' => 'carro',
                'suv'     => 'carro',
                'motos'   => 'moto',
            );
            $cat_labels = array(
                'economy' => array('name' => 'Carro Económico', 'desc' => 'Volkswagen Gol o similar'),
                'compact' => array('name' => 'Carro Compacto', 'desc' => 'Renault Logan o similar'),
                'suv'     => array('name' => 'SUV Compacto', 'desc' => 'Kia Seltos o similar'),
                'motos'   => array('name' => 'Motocicletas', 'desc' => 'Yamaha FZ 150 o similar'),
            );

            if (!empty($cat_terms) && !is_wp_error($cat_terms)) :
                // Sort by defined order
                usort($cat_terms, function($a, $b) use ($cat_order) {
                    $oa = $cat_order[$a->slug] ?? 99;
                    $ob = $cat_order[$b->slug] ?? 99;
                    return $oa - $ob;
                });

                foreach ($cat_terms as $cat) :
                    $display_name = $cat_labels[$cat->slug]['name'] ?? $cat->name;
                    $display_desc = $cat_labels[$cat->slug]['desc'] ?? $cat->description;
                    // Get vehicles in this category for carousel images
                    $cat_vehicles = new WP_Query(array(
                        'post_type'      => 'vehiculo',
                        'posts_per_page' => 6,
                        'post_status'    => 'publish',
                        'tax_query'      => array(array(
                            'taxonomy' => 'categoria_vehiculo',
                            'field'    => 'slug',
                            'terms'    => $cat->slug,
                        )),
                        'meta_key'       => '_precio_dia',
                        'orderby'        => 'meta_value_num',
                        'order'          => 'ASC',
                    ));

                    $images = array();
                    $vehicle_names = array();
                    if ($cat_vehicles->have_posts()) {
                        while ($cat_vehicles->have_posts()) {
                            $cat_vehicles->the_post();
                            $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                            if ($thumb) {
                                $images[] = $thumb;
                                $vehicle_names[] = get_the_title();
                            }
                        }
                        wp_reset_postdata();
                    }

                    $icon = $cat_icons[$cat->slug] ?? 'fas fa-car';
                    $from_price = '';
                    if ($cat_vehicles->have_posts()) {
                        // Get minimum price
                        $min_query = new WP_Query(array(
                            'post_type' => 'vehiculo', 'posts_per_page' => 1, 'post_status' => 'publish',
                            'tax_query' => array(array('taxonomy' => 'categoria_vehiculo', 'field' => 'slug', 'terms' => $cat->slug)),
                            'meta_key' => '_precio_dia', 'orderby' => 'meta_value_num', 'order' => 'ASC',
                        ));
                        if ($min_query->have_posts()) {
                            $min_query->the_post();
                            $min_price = get_post_meta(get_the_ID(), '_precio_dia', true);
                            if ($min_price) $from_price = 'Desde $' . number_format($min_price, 0, ',', '.') . ' COP/día';
                            wp_reset_postdata();
                        }
                    }
            ?>
                <div class="mc-catcard" data-category="<?php echo esc_attr($cat->slug); ?>" data-type="<?php echo esc_attr($cat_types[$cat->slug] ?? 'carro'); ?>">
                    <div class="mc-catcard__carousel" data-carousel>
                        <div class="mc-catcard__slides">
                            <?php if (!empty($images)) : ?>
                                <?php foreach ($images as $i => $img) : ?>
                                    <div class="mc-catcard__slide <?php echo $i === 0 ? 'active' : ''; ?>">
                                        <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($vehicle_names[$i] ?? $display_name); ?>" loading="lazy">
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <div class="mc-catcard__slide active">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder.jpg" alt="<?php echo esc_attr($display_name); ?>" loading="lazy">
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if (count($images) > 1) : ?>
                            <button class="mc-catcard__arrow mc-catcard__arrow--left" aria-label="Previous"><i class="fas fa-chevron-left"></i></button>
                            <button class="mc-catcard__arrow mc-catcard__arrow--right" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
                            <div class="mc-catcard__dots">
                                <?php for ($d = 0; $d < count($images); $d++) : ?>
                                    <span class="mc-catcard__dot <?php echo $d === 0 ? 'active' : ''; ?>" data-index="<?php echo $d; ?>"></span>
                                <?php endfor; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mc-catcard__info">
                        <div class="mc-catcard__badge"><i class="<?php echo esc_attr($icon); ?>"></i></div>
                        <h3 class="mc-catcard__title"><?php echo esc_html($display_name); ?></h3>
                        <p class="mc-catcard__desc"><?php echo esc_html($display_desc); ?></p>
                        <button class="mc-btn mc-btn--primary mc-btn--card" onclick="openCategoryModal('<?php echo esc_attr($cat->slug); ?>', '<?php echo esc_js($display_name); ?>')">
                            Ver Detalles
                        </button>
                    </div>
                </div>
            <?php
                endforeach;
            else :
            ?>
                <!-- DEMO CATEGORIES (no vehicles in WP yet) -->
                <?php
                $demo_categories = array(
                    array(
                        'slug'  => 'motos',
                        'name'  => 'Motocicletas',
                        'desc'  => 'Yamaha FZ 150 o similar',
                        'icon'  => 'fas fa-motorcycle',
                        'vehicles' => array(
                            array('name' => 'Yamaha Aerox', 'img' => 'aerox.png', 'price' => '80,000', 'motor' => '155 cc', 'trans' => 'Automática', 'ac' => 'N/A', 'pax' => '2', 'luggage' => 'N/A'),
                            array('name' => 'Yamaha FZ-250', 'img' => 'fz250.png', 'price' => '100,000', 'motor' => '250 cc', 'trans' => 'Manual', 'ac' => 'N/A', 'pax' => '2', 'luggage' => 'N/A'),
                        ),
                    ),
                    array(
                        'slug'  => 'economy',
                        'name'  => 'Carro Económico',
                        'desc'  => 'Volkswagen Gol o similar',
                        'icon'  => 'fas fa-car',
                        'vehicles' => array(
                            array('name' => 'Volkswagen Gol', 'img' => 'volkswagen.png', 'price' => '150,000', 'motor' => '1600 cc', 'trans' => 'Manual', 'ac' => 'Sí', 'pax' => '5', 'luggage' => '2 medianas'),
                        ),
                    ),
                    array(
                        'slug'  => 'compact',
                        'name'  => 'Carro Compacto',
                        'desc'  => 'Renault Logan o similar',
                        'icon'  => 'fas fa-car-side',
                        'vehicles' => array(
                            array('name' => 'Renault Logan', 'img' => 'renault-logan.png', 'price' => '200,000', 'motor' => '1600 cc', 'trans' => 'Manual', 'ac' => 'Sí', 'pax' => '5', 'luggage' => '2 grandes, 1 mediana'),
                        ),
                    ),
                    array(
                        'slug'  => 'suv',
                        'name'  => 'SUV Compacto',
                        'desc'  => 'Kia Seltos o similar',
                        'icon'  => 'fas fa-shuttle-van',
                        'vehicles' => array(
                            array('name' => 'Kia Sportage', 'img' => 'kia-sportage.png', 'price' => '200,000', 'motor' => '2000 cc', 'trans' => 'Automática', 'ac' => 'Sí', 'pax' => '5', 'luggage' => '2 grandes, 1 mediana'),
                        ),
                    ),
                );

                foreach ($demo_categories as $dcat) :
                ?>
                <div class="mc-catcard" data-category="<?php echo esc_attr($dcat['slug']); ?>" data-type="<?php echo esc_attr($dcat['slug'] === 'motos' ? 'moto' : 'carro'); ?>">
                    <div class="mc-catcard__carousel" data-carousel>
                        <div class="mc-catcard__slides">
                            <?php foreach ($dcat['vehicles'] as $vi => $veh) : ?>
                                <div class="mc-catcard__slide <?php echo $vi === 0 ? 'active' : ''; ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/<?php echo esc_attr($veh['img']); ?>" alt="<?php echo esc_attr($veh['name']); ?>" loading="lazy">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php if (count($dcat['vehicles']) > 1) : ?>
                            <button class="mc-catcard__arrow mc-catcard__arrow--left" aria-label="Previous"><i class="fas fa-chevron-left"></i></button>
                            <button class="mc-catcard__arrow mc-catcard__arrow--right" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
                            <div class="mc-catcard__dots">
                                <?php for ($d = 0; $d < count($dcat['vehicles']); $d++) : ?>
                                    <span class="mc-catcard__dot <?php echo $d === 0 ? 'active' : ''; ?>" data-index="<?php echo $d; ?>"></span>
                                <?php endfor; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mc-catcard__info">
                        <div class="mc-catcard__badge"><i class="<?php echo esc_attr($dcat['icon']); ?>"></i></div>
                        <h3 class="mc-catcard__title"><?php echo esc_html($dcat['name']); ?></h3>
                        <p class="mc-catcard__desc"><?php echo esc_html($dcat['desc']); ?></p>
                        <button class="mc-btn mc-btn--primary mc-btn--card" onclick="openCategoryModal('<?php echo esc_attr($dcat['slug']); ?>', '<?php echo esc_js($dcat['name']); ?>')">
                            Ver Detalles
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>

                <!-- Hidden demo data for modal -->
                <script>
                var DEMO_VEHICLES = <?php echo json_encode($demo_categories); ?>;
                </script>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- ==========================================
     RESEÑAS DE GOOGLE
     ========================================== -->
<section class="mc-reviews" id="resenas">
    <div class="mc-container">
        <div class="mc-section-header">
            <h2 class="mc-section-title mc-section-title--script" data-i18n="reviews_title">Lo que dicen nuestros clientes</h2>
            <p class="mc-section-subtitle" data-i18n="reviews_subtitle">Reseñas verificadas de Google</p>
        </div>
        <div class="mc-reviews__content">
            <?php
            // Pega aquí el shortcode del plugin de Google Reviews.
            // Ejemplo: echo do_shortcode('[google-reviews]');
            // Plugins recomendados: "Jetstagram" o "Widgets for Google Reviews"
            ?>
            <!-- Shortcode de Google Reviews va aquí -->
        </div>
    </div>
</section>

<!-- ==========================================
     RINCONES ÚNICOS DE ANTIOQUIA
     ========================================== -->
<section class="mc-lugares" id="lugares">
    <div class="mc-container">
        <div class="mc-section-header">
            <h2 class="mc-section-title mc-section-title--script" data-i18n-html="lugares_title">Rincones Únicos de<br>Antioquia</h2>
        </div>
        <div class="mc-lugares__slider">
            <button class="mc-lugares__arrow mc-lugares__arrow--left" id="lugarPrev" aria-label="Anterior">
                <i class="fas fa-chevron-left"></i>
            </button>

            <div class="mc-lugares__slides" id="lugaresSlides">
                <div class="mc-lugares__slide active">
                    <div class="mc-lugares__card">
                        <div class="mc-lugares__image" style="grid-column: 1 / -1;">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/santa-fe.jpg" alt="Santa Fé de Antioquia">
                        </div>
                        <div class="mc-lugares__info">
                            <h3 class="mc-lugares__name">Santa Fé de<br>Antioquia</h3>
                            <div class="mc-lugares__text">
                                <p data-i18n="lugar_santa_fe">Santa Fe de Antioquia es un encantador pueblo colonial, Monumento Nacional, famoso por sus calles empedradas, arquitectura conservada (siglos XVI-XVIII) y su cálido clima, ofreciendo un viaje al pasado con iglesias históricas, el emblemático Puente de Occidente, plazas coloniales y tradiciones como el tamarindo y la filigrana, ideal para disfrutar de cultura, historia y naturaleza cercana.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mc-lugares__slide">
                    <div class="mc-lugares__card">
                        <div class="mc-lugares__image" style="grid-column: 1 / -1;">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/guatape.jpg" alt="Guatapé">
                        </div>
                        <div class="mc-lugares__info">
                            <h3 class="mc-lugares__name">Guatapé</h3>
                            <div class="mc-lugares__text">
                                <p data-i18n="lugar_guatape">Guatapé es famoso por la Piedra del Peñol, sus coloridas fachadas de zócalos y el embalse con vistas espectaculares. Es uno de los destinos turísticos más visitados de Antioquia, ideal para deportes acuáticos, senderismo y disfrutar de la naturaleza.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mc-lugares__slide">
                    <div class="mc-lugares__card">
                        <div class="mc-lugares__image" style="grid-column: 1 / -1;">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/jardin.jpg" alt="Jardín">
                        </div>
                        <div class="mc-lugares__info">
                            <h3 class="mc-lugares__name">Jardín</h3>
                            <div class="mc-lugares__text">
                                <p data-i18n="lugar_jardin">Jardín es un pueblo patrimonio de Colombia, rodeado de montañas verdes, cascadas y fincas cafeteras. Su parque principal, la Basílica Menor y la Cueva del Esplendor lo hacen un lugar mágico lleno de encanto paisa.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mc-lugares__slide">
                    <div class="mc-lugares__card">
                        <div class="mc-lugares__image" style="grid-column: 1 / -1;">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/jerico.jpg" alt="Jericó">
                        </div>
                        <div class="mc-lugares__info">
                            <h3 class="mc-lugares__name">Jericó</h3>
                            <div class="mc-lugares__text">
                                <p data-i18n="lugar_jerico">Jericó es la cuna de la Santa Laura Montoya, un pueblo de calles empinadas, balcones coloniales y paisajes cafeteros. Su riqueza cultural, museos y miradores naturales lo hacen un destino imperdible del suroeste antioqueño.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="mc-lugares__arrow mc-lugares__arrow--right" id="lugarNext" aria-label="Siguiente">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <div class="mc-lugares__dots" id="lugaresDots">
            <button class="mc-lugares__dot active" data-slide="0"></button>
            <button class="mc-lugares__dot" data-slide="1"></button>
            <button class="mc-lugares__dot" data-slide="2"></button>
            <button class="mc-lugares__dot" data-slide="3"></button>
        </div>
    </div>
</section>

<!-- ==========================================
     CONÓCENOS / SERVICIOS
     ========================================== -->
<section class="mc-about" id="nosotros">
    <div class="mc-container">
        <div class="mc-about__grid">
            <!-- Columna izquierda - Instagram Embed -->
            <div class="mc-about__cta">
                <div class="mc-about__instagram">
                    <?php
                    // Pega aquí el shortcode del plugin de Instagram.
                    // Ejemplo: echo do_shortcode('[instagram-feed feed=1]');
                    // Plugin recomendado: "Smash Balloon Instagram Feed"
                    ?>
                    <!-- Shortcode de Instagram va aquí -->
                </div>
            </div>

            <!-- Columna derecha - Servicios -->
            <div class="mc-about__services">
                <h2 class="mc-section-title" data-i18n="about_title">Conócenos</h2>
                <div class="mc-services__list">
                    <div class="mc-service">
                        <div class="mc-service__icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="mc-service__content">
                            <h4 data-i18n="srv_atencion_title">Atención personalizada</h4>
                            <p data-i18n="srv_atencion_desc">Te brindamos un servicio directo y personalizado para que tu experiencia sea única.</p>
                        </div>
                    </div>

                    <div class="mc-service">
                        <div class="mc-service__icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="mc-service__content">
                            <h4 data-i18n="srv_247_title">Disponibilidad 24/7</h4>
                            <p data-i18n="srv_247_desc">Estamos disponibles las 24 horas, los 7 días de la semana para ti.</p>
                        </div>
                    </div>

                    <div class="mc-service">
                        <div class="mc-service__icon">
                            <i class="fas fa-shuttle-van"></i>
                        </div>
                        <div class="mc-service__content">
                            <h4 data-i18n="srv_domicilio_title">Servicio a domicilio</h4>
                            <p data-i18n="srv_domicilio_desc">Llevamos y recogemos el vehículo donde lo necesites sin costo adicional.</p>
                        </div>
                    </div>

                    <div class="mc-service">
                        <div class="mc-service__icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="mc-service__content">
                            <h4 data-i18n="srv_conductor_title">Conductor elegido</h4>
                            <p data-i18n="srv_conductor_desc">Si prefieres, te asignamos un conductor profesional para tu viaje.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- ==========================================
     PREGUNTAS FRECUENTES (FAQ)
     ========================================== -->
    <div class="mc-faq" id="faq">
        <div class="mc-container">
            <button class="mc-faq__toggle" id="faqToggle" aria-expanded="false">
                <div class="mc-faq__toggle-text">
                    <h2 class="mc-section-title mc-section-title--script" data-i18n="faq_title">Preguntas Frecuentes</h2>
                    <p class="mc-section-subtitle" data-i18n="faq_subtitle">Resuelve tus dudas antes de reservar</p>
                </div>
                <div class="mc-faq__toggle-icon">
                    <i class="fas fa-plus"></i>
                </div>
            </button>

        <div class="mc-faq__list" id="faqList">
            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q1">¿Cuáles son los procedimientos que debo seguir en el caso de accidente?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a1">
                    <p>En caso de un accidente con el auto o motocicleta alquilado, es crucial informar el incidente de inmediato a MotoCar Rentals llamando al número <strong>+57 3202161156</strong>.</p>
                    <p>Se debe registrar el reporte de la ocurrencia en el organismo correspondiente y presentarlo en un plazo máximo de 48 horas en una agencia de MotoCar Rentals. Además, es necesario completar el Aviso de Reporte de Siniestro en nuestra agencia.</p>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q2">¿Qué pasa si se genera una foto multa mientras rento un vehículo con MotoCar Rentals?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a2">
                    <p>Si durante tu renta se generó una fotomulta, puedes consultar la evidencia en la página web del organismo de tránsito donde ocurrió la infracción. Para aprovechar los descuentos disponibles, debes hacer el cambio de contraventor dentro del tiempo estipulado, tomar el curso de sensibilización (si aplica) y realizar el pago a través del SIMIT o directamente en el organismo de tránsito donde se emitió la fotomulta.</p>
                    <p>Cuando MotoCar Rentals sea notificado, te enviaremos un correo con los documentos necesarios para hacer el cambio de contraventor. Si sabes que cometiste una infracción y no recibes el aviso, escríbenos a <strong>motocarrentals@gmail.com</strong> y te enviaremos la información.</p>
                    <p>Si el pago no se realiza dentro del plazo, MotoCar Rentals SAS lo cobrará automáticamente a la tarjeta de crédito registrada en tu contrato. Por favor, mantén activa tu tarjeta. De lo contrario, no podrás volver a utilizar el servicio hasta que realices el pago.</p>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q3">¿Cuáles son los procedimientos a seguir en el caso de hurto o robo del auto o motocicleta?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a3">
                    <p>Notificar de inmediato a las autoridades a través de los canales designados y presentar una denuncia ante la Fiscalía en caso de un incidente. Debes ampliar la denuncia a MotoCar Rentals al número <strong>+57 3202161156</strong> y enviar los documentos de respaldo a la agencia donde retiraste el vehículo en un plazo de cuarenta y ocho (48) horas desde el suceso.</p>
                    <p>La falta de cumplimiento de este procedimiento podría resultar en la pérdida de las coberturas contratadas. Además, se requiere entregar las constancias necesarias de la Fiscalía en casos de hurto.</p>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q4">¿Qué es necesario para alquilar un vehículo o motocicleta?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a4">
                    <ul>
                        <li><strong>Licencia de Conducir Válida:</strong> Es necesario presentar una licencia de conducir válida y en vigencia al momento de realizar el alquiler. Asegúrate de que tu licencia esté en buen estado y cumpla con los requisitos colombianos.</li>
                        <li><strong>Tarjeta de Crédito:</strong> Se requiere una tarjeta de crédito a nombre del titular de la reserva para cubrir el depósito de seguridad. La tarjeta debe tener suficiente límite de crédito para cubrir posibles cargos adicionales. No se acepta otro método para el pago del carro.</li>
                        <li><strong>Edad Mínima:</strong> Debes cumplir con la edad mínima requerida para alquilar un vehículo, en Colombia es 18 años.</li>
                    </ul>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q5">¿El responsable por el alquiler del auto puede pasar la conducción a otra persona?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a5">
                    <p>Sí. En el momento de la apertura del contrato de alquiler del vehículo, el cliente puede autorizar por un valor extra el número de personas que desee para conducir el auto alquilado, desde que estos conductores obedezcan a los requisitos mínimos establecidos por MotoCar Rentals.</p>
                    <p>Te invitamos a revisar las condiciones detalladas al momento de hacer tu reserva o contactarnos para obtener información específica sobre tus necesidades de alquiler.</p>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q6">¿Es necesario pagar por el combustible utilizado en el alquiler de un auto?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a6">
                    <p>El vehículo o la motocicleta se entregará con el tanque lleno, se debe devolver en el mismo nivel, de lo contrario se hará un cobro por el combustible faltante al momento de la devolución del vehículo.</p>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q7">¿Cómo se hace la reserva para alquilar un auto o una moto?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a7">
                    <p>Se recomienda realizar una reserva previa a través de nuestro sitio web <strong>motocarrentals.com.co</strong> o a través de nuestro centro de Reservas MotoCar vía WhatsApp <strong>+57 3202161156</strong>.</p>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q8">¿Qué es el Pico y Placa en Medellín?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a8">
                    <p>El Pico y Placa es una medida de restricción de circulación que se aplica a carros y motocicletas en el área metropolitana del Valle de Aburrá. Aplica en los municipios de Medellín, Bello, Envigado, Sabaneta, Itagüí, La Estrella, Caldas, Barbosa, Girardota y Copacabana.</p>
                    <p>La restricción se aplica de lunes a viernes, entre las 5:00 a.m. y las 8:00 p.m., y no se aplica en festivos. Las vías exentas, donde se permite circular sin importar la placa, son la Autopista Sur, la Avenida Regional, la Vía Las Palmas, la Avenida 33 y la Transversal de la Montaña.</p>
                    <p>Es importante respetar la restricción, ya que las infracciones conllevan multas y posible inmovilización del vehículo.</p>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q9">¿Es posible alquilar un vehículo o motocicleta con la licencia de conductor extranjera?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a9">
                    <p>Si eres extranjero, se requiere documentación adicional como pasaporte, identificación oficial u otros documentos. Los colombianos residentes en el exterior deben presentar licencia de conducir colombiana vigente.</p>
                    <p>La excepción se dará en los casos en los que este ciudadano colombiano no haya tenido licencia del país en mención en ningún momento. Para estos casos se deberá tramitar la homologación de la licencia extranjera ante las entidades de tránsito de Colombia.</p>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q10">¿Qué hago para reprogramar o cancelar mi reserva?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a10">
                    <p>Puedes comunicarte a nuestra central de reservas vía WhatsApp <strong>+57 320 216 1156</strong>.</p>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q11">¿Qué es cambio de contraventor?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a11">
                    <p>Es el trámite que te permite asumir la responsabilidad de una fotomulta generada mientras conducías un vehículo rentado. Es necesario realizar este proceso si quieres acceder a los descuentos ofrecidos por el organismo de tránsito.</p>
                    <p><strong>Importante:</strong> Si la fotomulta fue en Bogotá, no es necesario hacer el cambio de contraventor. Solo debes acercarte con tu documento de identidad y licencia a la Secretaría Distrital de Movilidad o consultar su página web donde fue impuesta la fotomulta para completar el proceso.</p>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q12">¿Cuál es el plazo máximo para la devolución?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a12">
                    <p>Asegúrate de devolver el vehículo en la fecha y hora acordadas para evitar cargos adicionales por retrasos. Comunica cualquier cambio en los planes de devolución con antelación a través de la Central de Reservas vía WhatsApp <strong>+57 320 216 1156</strong>.</p>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q13">Si no tengo tarjeta de crédito, ¿alguien puede presentarla por mí en otra ciudad o en otra agencia?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a13">
                    <p>El nombre del tarjetahabiente debe verse reflejado en la tarjeta de crédito. Otra persona puede presentar la tarjeta siempre y cuando esté en el momento de la entrega del vehículo.</p>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q14">¿Cuáles son las protecciones ofrecidas en el alquiler?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a14">
                    <p>Ofrecemos la cobertura básica obligatoria que ampara el vehículo, con un deducible del 10% según la categoría.</p>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q15">¿Cuáles deben ser las condiciones de devolución del auto o la motocicleta?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a15">
                    <p>El auto o la motocicleta debe ser entregado en las mismas condiciones que fue retirado: con el depósito de combustible completo, en estado físico igual al verificado en el check-in de entrega y limpio lo suficiente para conferir el estado de la carrocería.</p>
                    <p>Si el vehículo presenta un faltante de combustible, se procederá con el cobro. Esta tarifa es superior a la de una estación de servicio, ya que incluye otros costos como la movilización, seguros, etc.</p>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q16">Al alquilar un auto o motocicleta, ¿cuáles son los adicionales ofrecidos en MotoCar?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a16">
                    <p><strong>Auto:</strong> Silla de bebé, upgrade, devolución en otra ciudad, protección contra terceros, lucro cesante, porta celular y conductor adicional.</p>
                    <p><strong>Motocicleta:</strong> Conductor adicional, upgrade, devolución en otra ciudad, protección contra terceros, lucro cesante, porta celular e impermeables.</p>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q17">¿Qué incluye al rentar una motocicleta en MotoCar?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a17">
                    <p>Cuando alquilas una de nuestras motocicletas te incluye dos cascos certificados, dos chalecos reflectivos y los documentos del automotor.</p>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q18">¿Qué requisitos debo cumplir para alquilar un vehículo?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a18">
                    <p>Los documentos que solicitamos a la hora de alquilar uno de nuestros vehículos son:</p>
                    <ol>
                        <li>Cédula o Pasaporte (si es Extranjero)</li>
                        <li>Licencia de Conducción (Vigente)</li>
                        <li>Tarjeta de Crédito (Visa-Mastercard) con un cupo mínimo de $1'500.000 COP</li>
                    </ol>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q19">¿Cuáles son las tarifas de alquiler?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a19">
                    <p>Las tarifas varían según la temporada y están sujetas a términos y condiciones.</p>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q20">¿Qué se incluye en el precio del alquiler?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a20">
                    <p>Tiempo y kilometraje ilimitado, servicio en carretera 24 horas.</p>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q21">¿Qué opciones de seguro hay disponibles?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a21">
                    <p>Exoneración de daños al vehículo y exoneración de daños a terceros. Estas exoneraciones están sujetas a términos y condiciones específicos y puede requerir el pago de una tarifa adicional.</p>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q22">¿Cómo puedo reservar un vehículo?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a22">
                    <p>Por medio de nuestros canales habilitados:</p>
                    <ul>
                        <li>Página Web</li>
                        <li>Nuestras redes sociales: Instagram, Facebook o vía WhatsApp</li>
                    </ul>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q23">¿Puedo cancelar o modificar mi reserva?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a23">
                    <p>Sí, puedes modificar o cancelar con mínimo 24 horas de anticipación sin incurrir en cargos adicionales, siempre y cuando no sea una reservación pre-pagada.</p>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q24">¿Qué debo hacer si tengo un accidente con el vehículo de alquiler?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a24">
                    <p>Debe contactarse por medio de nuestros números de atención al cliente o vía WhatsApp indicándonos el incidente para enviar la asistencia vial.</p>
                </div>
            </div>

            <div class="mc-faq__item">
                <button class="mc-faq__question" aria-expanded="false">
                    <span data-i18n="faq_q25">¿Desde qué edad se puede alquilar un vehículo?</span>
                    <i class="fas fa-chevron-down mc-faq__icon"></i>
                </button>
                <div class="mc-faq__answer" data-i18n-html="faq_a25">
                    <p>El alquiler está disponible para conductores mayores de 20 hasta los 75 años.</p>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<!-- ==========================================
     QUIÉNES SOMOS
     ========================================== -->
<section class="mc-quienes" id="quienes-somos">
    <div class="mc-container">
        <div class="mc-section-header">
            <h2 class="mc-section-title mc-section-title--script" data-i18n="quienes_title">Quiénes Somos</h2>
            <p class="mc-section-subtitle" data-i18n="quienes_subtitle">Conoce nuestra historia y compromiso</p>
        </div>

        <div class="mc-quienes__intro">
            <p data-i18n-html="quienes_intro1">Desde el <strong>2023</strong>, somos una empresa dedicada al alquiler de vehículos de alta gama, ofreciendo una experiencia única en movilidad y proporcionando una amplia flota que abarca desde motocicletas hasta automóviles Sedan y SUV de última generación.</p>
            <p data-i18n-html="quienes_intro2">Nuestro fin es superar las expectativas de nuestros clientes, ofreciendo no solo vehículos de alto rendimiento, sino también un servicio excepcional. Nos comprometemos a brindar <strong>comodidad, satisfacción y seguridad</strong> en cada trayecto, convirtiendo cada viaje en una experiencia inolvidable.</p>
            <p data-i18n="quienes_intro3">Nuestro equipo altamente capacitado está disponible para asesorarte en la elección del vehículo perfecto según tus necesidades y preferencias. Además, estamos comprometidos a brindar un servicio personalizado que se adapte a tus expectativas y supere tus requerimientos.</p>
            <p data-i18n="quienes_intro4">La excelencia es nuestro estándar, y trabajamos incansablemente para garantizar que cada detalle, desde la reserva hasta la devolución del vehículo, se lleve a cabo de manera impecable.</p>
            <p class="mc-quienes__highlight" data-i18n-html="quienes_highlight">Descubre un nuevo nivel de alquiler de vehículos de alta gama en <strong>Motocar Rentals</strong>. ¡Bienvenido a la excelencia en movilidad!</p>
        </div>

        <div class="mc-quienes__feature">
            <div class="mc-quienes__feature-icon">
                <i class="fas fa-road"></i>
                <i class="fas fa-headset"></i>
            </div>
            <p data-i18n-html="quienes_feature">Nuestro servicio de alquiler incluye <strong>kilometraje ilimitado</strong> y <strong>asistencia en carretera las 24 horas</strong> del día, los 7 días de la semana. Esto significa que puede viajar sin preocupaciones por la distancia recorrida y contar con la tranquilidad de saber que estaremos disponibles para ayudarlo en cualquier momento durante su viaje.</p>
        </div>

        <div class="mc-quienes__mv">
            <div class="mc-quienes__mv-card">
                <div class="mc-quienes__mv-icon">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3 data-i18n="quienes_mision_title">Misión</h3>
                <p data-i18n="quienes_mision">Motocar Rentals es una compañía que facilita la movilidad de las personas, especialmente a la población antioqueña y a los turistas que visitan el país, ofreciendo servicios de renta de vehículos confiables y eficientes, respaldado por un equipo comprometido con la satisfacción y seguridad de sus usuarios, demostrados en la excelencia operativa y la atención personalizada.</p>
            </div>
            <div class="mc-quienes__mv-card">
                <div class="mc-quienes__mv-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h3 data-i18n="quienes_vision_title">Visión</h3>
                <p data-i18n="quienes_vision">Motocar Rentals será al 2028 la empresa líder en el sector de renta de vehículos en el Oriente Antioqueño, reconocida por la calidad de nuestros servicios, la diversidad de nuestra flota y la excelencia en la atención al cliente. Aspirando a contribuir con el desarrollo económico, turístico y social de la región, manteniendo altos estándares de sostenibilidad.</p>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================
     MARCAS
     ========================================== -->
<section class="mc-brands">
    <div class="mc-container">
        <div class="mc-brands__grid">
            <div class="mc-brands__item">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/brand-renault.png" alt="Renault">
            </div>
            <div class="mc-brands__item">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/brand-kia.png" alt="KIA">
            </div>
            <div class="mc-brands__item">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/brand-volkswagen.png" alt="Volkswagen">
            </div>
            <div class="mc-brands__item">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/brand-yamaha.png" alt="Yamaha">
            </div>
            <div class="mc-brands__item">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/brand-toyota.png" alt="Toyota">
            </div>
            <div class="mc-brands__item">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/brand-suzuki.png" alt="Suzuki">
            </div>
        </div>
    </div>
</section>

<!-- ==========================================
     FOOTER
     ========================================== -->
<footer class="mc-footer">
    <div class="mc-container">
        <div class="mc-footer__grid">
            <div class="mc-footer__col">
                <div class="mc-footer__brand-row">
                    <div class="mc-footer__brand">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-footer.png" alt="MotoCar Rentals">
                    </div>
                    <p class="mc-footer__tagline">Moto car Rentals</p>
                </div>
            </div>
            <div class="mc-footer__col">
                <h4 data-i18n="footer_servicios">Servicios 24/7</h4>
                <ul>
                    <li><i class="fas fa-phone"></i> +57 320 216 1156</li>
                    <li><i class="fas fa-envelope"></i> motocarrentals@gmail.com</li>
                </ul>
            </div>
            <div class="mc-footer__col">
                <h4 data-i18n="footer_contactanos">Contáctanos</h4>
                <a href="https://www.google.com/maps/place/MotoCar+Rentals/@6.1762,-75.435,1576m/data=!3m1!1e3!4m6!3m5!1s0x8e469d8d8761cbb1:0xcf88fa157645f16d!8m2!3d6.1755508!4d-75.4348712!16s%2Fg%2F11y2tz0l_5" target="_blank" class="mc-footer__location-link">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Mall Terranova</span>
                </a>
                <div class="mc-footer__social">
                    <a href="https://www.facebook.com/p/MotoCar-Rentals-61558707917054/" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/motocar_rentals/" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://wa.me/573202161156" target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://www.tiktok.com/@motocar.rentals" target="_blank" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
            <div class="mc-footer__col">
                <h4 data-i18n="footer_contactar_title">¿Quieres que te contactemos?</h4>
                <form class="mc-footer__form">
                    <input type="email" placeholder="Tu correo electrónico" data-i18n-placeholder="footer_email_placeholder" required>
                    <button type="submit" class="mc-btn mc-btn--primary mc-btn--sm" data-i18n="footer_enviar">Enviar</button>
                </form>
            </div>
        </div>
        <div class="mc-footer__bottom">
            <p>&copy; <?php echo date('Y'); ?> MotoCar Rentals. <span data-i18n="footer_derechos">Todos los derechos reservados.</span></p>
        </div>
    </div>
</footer>

<!-- ==========================================
     CATEGORY DETAIL MODAL
     ========================================== -->
<div class="mc-catmodal" id="categoryModal">
    <div class="mc-catmodal__overlay" onclick="closeCategoryModal()"></div>
    <div class="mc-catmodal__content">
        <button class="mc-catmodal__close" onclick="closeCategoryModal()" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
        <h2 class="mc-catmodal__title" id="catModalTitle">Category</h2>
        <div class="mc-catmodal__dates-hint" id="catModalDatesHint" style="display:none;">
            <i class="fas fa-calendar-alt"></i>
            <span data-i18n="modal_dates_hint">Selecciona fechas en los filtros para ver el precio estimado en COP y USD de cada vehículo.</span>
        </div>
        <div class="mc-catmodal__grid" id="catModalGrid">
            <!-- Vehicle cards injected via JS -->
        </div>
        <div class="mc-catmodal__cta">
            <i class="fab fa-whatsapp mc-catmodal__cta-icon"></i>
            <p class="mc-catmodal__cta-text" data-i18n="modal_cta_text">¿No ves el vehículo ideal? Te conseguimos una opción en minutos.</p>
            <a id="catModalWhatsApp" href="#" class="mc-btn mc-btn--whatsapp mc-catmodal__cta-btn" target="_blank" data-i18n-html="modal_cta_btn">
                <i class="fab fa-whatsapp"></i> Buscar disponibilidad por WhatsApp
            </a>
        </div>
    </div>
</div>

<!-- WhatsApp Float Button -->
<a href="https://wa.me/573202161156?text=Hola%20MotoCar%20Rentals!%20Quiero%20información%20sobre%20alquiler%20de%20vehículos" class="mc-whatsapp-float" target="_blank" aria-label="WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

<?php wp_footer(); ?>
</body>
</html>
