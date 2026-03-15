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
                <a href="https://maps.google.com/?q=Aeropuerto+Jose+Maria+Cordova" target="_blank" class="mc-topbar__item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Aeropuerto José María Córdova</span>
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
                    <span class="mc-topbar__lang-label">Idioma</span>
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
                    <li><a href="#inicio" class="mc-nav__link active">Inicio</a></li>
                    <li><a href="#vehiculos" class="mc-nav__link">Vehículos</a></li>
                    <li><a href="#lugares" class="mc-nav__link">Lugares de Interés</a></li>
                    <li><a href="#nosotros" class="mc-nav__link">Nosotros</a></li>
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
        <div class="mc-hero__slide" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/slide-2.jpeg');"></div>
        <div class="mc-hero__slide" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/slide-3.jpg');"></div>
        <div class="mc-hero__slide" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/slide-4.jpeg');"></div>
    </div>
    <div class="mc-hero__overlay"></div>
    <div class="mc-hero__content">
        <h1 class="mc-hero__title">
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
     BUSCADOR / FILTRO
     ========================================== -->
<section class="mc-search">
    <div class="mc-container">
        <div class="mc-search__box">
            <form class="mc-search__form" id="filterForm">
                <div class="mc-search__group">
                    <label class="mc-search__label">Tipo</label>
                    <div class="mc-toggle" id="tipoToggle">
                        <button type="button" class="mc-toggle__btn active" data-value="carro">Carro</button>
                        <button type="button" class="mc-toggle__btn" data-value="moto">Moto</button>
                    </div>
                    <input type="hidden" name="tipo" id="filterTipo" value="carro">
                </div>
                <div class="mc-search__group">
                    <label class="mc-search__label">Precio</label>
                    <select name="precio_rango" id="filterPrecio">
                        <option value="">Todos los precios</option>
                        <option value="0-80000">Hasta $80.000</option>
                        <option value="80000-120000">$80.000 - $120.000</option>
                        <option value="120000-200000">$120.000 - $200.000</option>
                        <option value="200000-999999">Más de $200.000</option>
                    </select>
                </div>
                <div class="mc-search__group mc-search__group--disponibilidad">
                    <label class="mc-search__label">Disponibilidad</label>
                    <input type="text" id="filterFechas" name="fechas" placeholder="Seleccionar fechas" readonly>
                    <input type="hidden" id="filterFechaInicio" name="fecha_inicio">
                    <input type="hidden" id="filterFechaFin" name="fecha_fin">
                </div>
                <div class="mc-search__group mc-search__group--btn">
                    <button type="submit" class="mc-btn mc-btn--primary mc-btn--filter" id="filterBtn">
                        Filtrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- ==========================================
     CATÁLOGO DE VEHÍCULOS
     ========================================== -->
<section class="mc-catalogo" id="vehiculos">
    <div class="mc-container">
        <div class="mc-section-header">
            <h2 class="mc-section-title mc-section-title--script">Revisa nuestro catálogo</h2>
            <p class="mc-section-subtitle">MotoCar tu mejor opción</p>
        </div>

        <div class="mc-catalogo__grid" id="vehiculosGrid">
            <?php
            $vehicles = new WP_Query(array(
                'post_type'      => 'vehiculo',
                'posts_per_page' => -1,
                'post_status'    => 'publish',
                'meta_key'       => '_precio_dia',
                'orderby'        => 'meta_value_num',
                'order'          => 'ASC',
            ));

            // Sort by subcategory hierarchy then price
            $subcat_order = array('moto' => 1, 'hatchback' => 2, 'sedan' => 3, 'camioneta' => 4);
            $sorted_posts = array();
            if ($vehicles->have_posts()) {
                while ($vehicles->have_posts()) {
                    $vehicles->the_post();
                    $sorted_posts[] = array(
                        'post'  => get_post(),
                        'subcat' => get_post_meta(get_the_ID(), '_subcategoria', true),
                        'precio' => (int) get_post_meta(get_the_ID(), '_precio_dia', true),
                    );
                }
                wp_reset_postdata();
                usort($sorted_posts, function($a, $b) use ($subcat_order) {
                    $oa = $subcat_order[$a['subcat']] ?? 99;
                    $ob = $subcat_order[$b['subcat']] ?? 99;
                    if ($oa !== $ob) return $oa - $ob;
                    return $a['precio'] - $b['precio'];
                });
            }

            if (!empty($sorted_posts)) :
                foreach ($sorted_posts as $item) :
                    setup_postdata($item['post']);
                    $id = $item['post']->ID;
                    $precio_dia = get_post_meta($id, '_precio_dia', true);
                    $modelo = get_post_meta($id, '_modelo', true);
                    $ano = get_post_meta($id, '_ano', true);
                    $transmision = get_post_meta($id, '_transmision', true);
                    $pasajeros = get_post_meta($id, '_pasajeros', true);
                    $cilindrada = get_post_meta($id, '_cilindrada', true);
                    $aire = get_post_meta($id, '_aire_acondicionado', true);
                    $subcategoria = get_post_meta($id, '_subcategoria', true);
                    $tipos = wp_get_post_terms($id, 'tipo_vehiculo', array('fields' => 'slugs'));
                    $tipo_class = !empty($tipos) ? $tipos[0] : '';
                    $thumbnail = get_the_post_thumbnail_url($id, 'medium');
                    $precio_usd = $precio_dia ? number_format($precio_dia / 3690, 2, ',', '.') : '0';
                    $es_moto = ($tipo_class === 'moto');
            ?>
                <div class="mc-card" data-vehicle-id="<?php echo $id; ?>" data-tipo="<?php echo esc_attr($tipo_class); ?>" data-subcategoria="<?php echo esc_attr($subcategoria); ?>" data-precio="<?php echo esc_attr($precio_dia); ?>">
                    <span class="mc-card__badge"><?php echo esc_html($pasajeros ?: '5'); ?> Personas</span>
                    <h3 class="mc-card__title"><?php the_title(); ?></h3>
                    <div class="mc-card__image">
                        <?php if ($thumbnail) : ?>
                            <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title(); ?>" loading="lazy">
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder.jpg" alt="<?php the_title(); ?>" loading="lazy">
                        <?php endif; ?>
                    </div>
                    <div class="mc-card__pricing">
                        <?php if ($precio_dia) : ?>
                            <span class="mc-card__price">Desde $<?php echo number_format($precio_dia, 0, ',', '.'); ?> <small>COP/día</small></span>
                            <span class="mc-card__price-usd">$<?php echo $precio_usd; ?> <small>USD/día</small></span>
                        <?php endif; ?>
                    </div>
                    <div class="mc-card__specs">
                        <div class="mc-card__spec">
                            <span class="mc-card__spec-label">Motor</span>
                            <span class="mc-card__spec-value"><?php echo esc_html($cilindrada ?: '2000 cc'); ?></span>
                        </div>
                        <div class="mc-card__spec">
                            <span class="mc-card__spec-label">Caja</span>
                            <span class="mc-card__spec-value"><?php echo ucfirst(esc_html($transmision ?: 'Mecánica')); ?></span>
                        </div>
                        <div class="mc-card__spec">
                            <span class="mc-card__spec-label"><?php echo $es_moto ? 'ABS' : 'Aire'; ?></span>
                            <span class="mc-card__spec-value"><?php echo $es_moto ? 'Sí' : 'acondicionado'; ?></span>
                        </div>
                    </div>
                    <button class="mc-btn mc-btn--primary mc-btn--card" onclick="openVehicleModal(<?php echo $id; ?>)">
                        Reserva Ahora
                    </button>
                </div>
            <?php
                endforeach;
                wp_reset_postdata();
            else :
            ?>
                <!-- VEHÍCULOS DE DEMO (orden: Motos, Hatchbacks, Sedan, Camionetas — por precio) -->
                <div class="mc-card" data-vehicle-id="demo-5" data-tipo="moto" data-subcategoria="moto" data-precio="55000">
                    <span class="mc-card__badge">2 Personas</span>
                    <h3 class="mc-card__title">Yamaha Aerox</h3>
                    <div class="mc-card__image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/aerox.png" alt="Yamaha Aerox" loading="lazy">
                    </div>
                    <div class="mc-card__pricing">
                        <span class="mc-card__price">Desde $80.000 <small>COP/día</small></span>
                        <span class="mc-card__price-usd">$21,70 <small>USD/día</small></span>
                    </div>
                    <div class="mc-card__specs">
                        <div class="mc-card__spec"><span class="mc-card__spec-label">Motor</span><span class="mc-card__spec-value">155 cc</span></div>
                        <div class="mc-card__spec"><span class="mc-card__spec-label">Caja</span><span class="mc-card__spec-value">Automática</span></div>
                        <div class="mc-card__spec"><span class="mc-card__spec-label">ABS</span><span class="mc-card__spec-value">Sí</span></div>
                    </div>
                    <button class="mc-btn mc-btn--primary mc-btn--card" onclick="openVehicleModalDemo('Yamaha Aerox', '2024', 'Automática', '2', 'Gasolina', 'No', '155 cc', '80000', '<?php echo get_template_directory_uri(); ?>/assets/img/aerox.png', 'La Yamaha Aerox 155 es un scooter deportivo, ágil y moderno.')">
                        Reserva Ahora
                    </button>
                </div>

                <div class="mc-card" data-vehicle-id="demo-4" data-tipo="moto" data-subcategoria="moto" data-precio="75000">
                    <span class="mc-card__badge">2 Personas</span>
                    <h3 class="mc-card__title">Fz - 250</h3>
                    <div class="mc-card__image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/fz250.png" alt="FZ-250" loading="lazy">
                    </div>
                    <div class="mc-card__pricing">
                        <span class="mc-card__price">Desde $100.000 <small>COP/día</small></span>
                        <span class="mc-card__price-usd">$27,10 <small>USD/día</small></span>
                    </div>
                    <div class="mc-card__specs">
                        <div class="mc-card__spec"><span class="mc-card__spec-label">Motor</span><span class="mc-card__spec-value">250 cc</span></div>
                        <div class="mc-card__spec"><span class="mc-card__spec-label">Caja</span><span class="mc-card__spec-value">Mecánica</span></div>
                        <div class="mc-card__spec"><span class="mc-card__spec-label">ABS</span><span class="mc-card__spec-value">Sí</span></div>
                    </div>
                    <button class="mc-btn mc-btn--primary mc-btn--card" onclick="openVehicleModalDemo('Yamaha FZ-250', '2024', 'Manual', '2', 'Gasolina', 'No', '250 cc', '100000', '<?php echo get_template_directory_uri(); ?>/assets/img/fz250.png', 'La Yamaha FZ-250 es una moto deportiva con excelente rendimiento.')">
                        Reserva Ahora
                    </button>
                </div>

                <div class="mc-card" data-vehicle-id="demo-3" data-tipo="carro" data-subcategoria="sedan" data-precio="95000">
                    <span class="mc-card__badge">5 Personas</span>
                    <h3 class="mc-card__title">Renault Logan</h3>
                    <div class="mc-card__image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/renault-logan.png" alt="Renault Logan" loading="lazy">
                    </div>
                    <div class="mc-card__pricing">
                        <span class="mc-card__price">Desde $200.000 <small>COP/día</small></span>
                        <span class="mc-card__price-usd">$54,20 <small>USD/día</small></span>
                    </div>
                    <div class="mc-card__specs">
                        <div class="mc-card__spec"><span class="mc-card__spec-label">Motor</span><span class="mc-card__spec-value">1600 cc</span></div>
                        <div class="mc-card__spec"><span class="mc-card__spec-label">Caja</span><span class="mc-card__spec-value">Mecánica</span></div>
                        <div class="mc-card__spec"><span class="mc-card__spec-label">Aire</span><span class="mc-card__spec-value">acondicionado</span></div>
                    </div>
                    <button class="mc-btn mc-btn--primary mc-btn--card" onclick="openVehicleModalDemo('Renault Logan', '2024', 'Manual', '5', 'Gasolina', 'Sí', '1600 cc', '200000', '<?php echo get_template_directory_uri(); ?>/assets/img/renault-logan.png', 'El Renault Logan es un sedán confiable y económico.')">
                        Reserva Ahora
                    </button>
                </div>

                <div class="mc-card" data-vehicle-id="demo-2" data-tipo="carro" data-subcategoria="sedan" data-precio="135000">
                    <span class="mc-card__badge">5 Personas</span>
                    <h3 class="mc-card__title">Volkswagen</h3>
                    <div class="mc-card__image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/volkswagen.png" alt="Volkswagen" loading="lazy">
                    </div>
                    <div class="mc-card__pricing">
                        <span class="mc-card__price">Desde $200.000 <small>COP/día</small></span>
                        <span class="mc-card__price-usd">$54,20 <small>USD/día</small></span>
                    </div>
                    <div class="mc-card__specs">
                        <div class="mc-card__spec"><span class="mc-card__spec-label">Motor</span><span class="mc-card__spec-value">2000 cc</span></div>
                        <div class="mc-card__spec"><span class="mc-card__spec-label">Caja</span><span class="mc-card__spec-value">Mecánica</span></div>
                        <div class="mc-card__spec"><span class="mc-card__spec-label">Aire</span><span class="mc-card__spec-value">acondicionado</span></div>
                    </div>
                    <button class="mc-btn mc-btn--primary mc-btn--card" onclick="openVehicleModalDemo('Volkswagen', '2024', 'Manual', '5', 'Gasolina', 'Sí', '2000 cc', '200000', '<?php echo get_template_directory_uri(); ?>/assets/img/volkswagen.png', 'El Volkswagen ofrece confort, seguridad y eficiencia.')">
                        Reserva Ahora
                    </button>
                </div>

                <div class="mc-card" data-vehicle-id="demo-1" data-tipo="carro" data-subcategoria="camioneta" data-precio="135000">
                    <span class="mc-card__badge">5 Personas</span>
                    <h3 class="mc-card__title">Kia Sportage</h3>
                    <div class="mc-card__image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/kia-sportage.png" alt="Kia Sportage" loading="lazy">
                    </div>
                    <div class="mc-card__pricing">
                        <span class="mc-card__price">Desde $200.000 <small>COP/día</small></span>
                        <span class="mc-card__price-usd">$54,20 <small>USD/día</small></span>
                    </div>
                    <div class="mc-card__specs">
                        <div class="mc-card__spec"><span class="mc-card__spec-label">Motor</span><span class="mc-card__spec-value">2000 cc</span></div>
                        <div class="mc-card__spec"><span class="mc-card__spec-label">Caja</span><span class="mc-card__spec-value">Mecánica</span></div>
                        <div class="mc-card__spec"><span class="mc-card__spec-label">Aire</span><span class="mc-card__spec-value">acondicionado</span></div>
                    </div>
                    <button class="mc-btn mc-btn--primary mc-btn--card" onclick="openVehicleModalDemo('Kia Sportage', '2025', 'Automática', '5', 'Gasolina', 'Sí', '2000 cc', '200000', '<?php echo get_template_directory_uri(); ?>/assets/img/kia-sportage.png', 'La Kia Sportage es una SUV que combina diseño moderno, buen espacio interior y tecnología.')">
                        Reserva Ahora
                    </button>
                </div>
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
            <h2 class="mc-section-title mc-section-title--script">Lo que dicen nuestros clientes</h2>
            <p class="mc-section-subtitle">Reseñas verificadas de Google</p>
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
            <h2 class="mc-section-title mc-section-title--script">Rincones Únicos de<br>Antioquia</h2>
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
                                <p>Santa Fe de Antioquia es un encantador pueblo colonial, Monumento Nacional, famoso por sus calles empedradas, arquitectura conservada (siglos XVI-XVIII) y su cálido clima, ofreciendo un viaje al pasado con iglesias históricas, el emblemático Puente de Occidente, plazas coloniales y tradiciones como el tamarindo y la filigrana, ideal para disfrutar de cultura, historia y naturaleza cercana.</p>
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
                                <p>Guatapé es famoso por la Piedra del Peñol, sus coloridas fachadas de zócalos y el embalse con vistas espectaculares. Ideal para deportes acuáticos, senderismo y disfrutar de la naturaleza.</p>
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
                                <p>Jardín es un pueblo patrimonio de Colombia, rodeado de montañas verdes, cascadas y fincas cafeteras. Su parque principal, la Basílica Menor y la Cueva del Esplendor lo hacen un lugar mágico.</p>
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
                                <p>Jericó es la cuna de la Santa Laura Montoya, un pueblo de calles empinadas, balcones coloniales y paisajes cafeteros. Su riqueza cultural y miradores naturales lo hacen imperdible.</p>
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
                <h2 class="mc-section-title">Conócenos</h2>
                <div class="mc-services__list">
                    <div class="mc-service">
                        <div class="mc-service__icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="mc-service__content">
                            <h4>Atención personalizada</h4>
                            <p>Te brindamos un servicio directo y personalizado para que tu experiencia sea única.</p>
                        </div>
                    </div>

                    <div class="mc-service">
                        <div class="mc-service__icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="mc-service__content">
                            <h4>Disponibilidad 24/7</h4>
                            <p>Estamos disponibles las 24 horas, los 7 días de la semana para ti.</p>
                        </div>
                    </div>

                    <div class="mc-service">
                        <div class="mc-service__icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="mc-service__content">
                            <h4>Servicio a domicilio</h4>
                            <p>Llevamos y recogemos el vehículo donde lo necesites sin costo adicional.</p>
                        </div>
                    </div>

                    <div class="mc-service">
                        <div class="mc-service__icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="mc-service__content">
                            <h4>Conductor elegido</h4>
                            <p>Si prefieres, te asignamos un conductor profesional para tu viaje.</p>
                        </div>
                    </div>
                </div>
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
                <h4>Servicios 24/7</h4>
                <ul>
                    <li><i class="fas fa-phone"></i> +57 320 216 1156</li>
                    <li><i class="fas fa-envelope"></i> motocarrentals@gmail.com</li>
                </ul>
            </div>
            <div class="mc-footer__col">
                <h4>Contáctanos</h4>
                <div class="mc-footer__social">
                    <a href="https://www.facebook.com/p/MotoCar-Rentals-61558707917054/" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/motocar_rentals/" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://wa.me/573202161156" target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://www.tiktok.com/@motocar.rentals" target="_blank" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
            <div class="mc-footer__col">
                <h4>¿Quieres que te contactemos?</h4>
                <form class="mc-footer__form">
                    <input type="email" placeholder="Tu correo electrónico" required>
                    <button type="submit" class="mc-btn mc-btn--primary mc-btn--sm">Enviar</button>
                </form>
            </div>
        </div>
        <div class="mc-footer__bottom">
            <p>&copy; <?php echo date('Y'); ?> MotoCar Rentals. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

<!-- ==========================================
     MODAL DE DETALLE / RESERVA
     ========================================== -->
<div class="mc-modal" id="vehicleModal">
    <div class="mc-modal__overlay" onclick="closeVehicleModal()"></div>
    <div class="mc-modal__content">
        <button class="mc-modal__close" onclick="closeVehicleModal()" aria-label="Cerrar">
            <i class="fas fa-times"></i>
        </button>
        <div class="mc-modal__body">
            <div class="mc-modal__layout">
                <!-- Columna izquierda: vehículo -->
                <div class="mc-modal__left">
                    <h2 class="mc-modal__title" id="modalTitle">KIA SELTOS 2025</h2>

                    <div class="mc-modal__info-row">
                        <div class="mc-modal__image">
                            <img id="modalImage" src="" alt="Vehículo">
                        </div>
                        <div class="mc-modal__description">
                            <p id="modalDescripcion"></p>
                        </div>
                    </div>

                    <!-- Specs bar -->
                    <div class="mc-modal__specs-bar">
                        <button class="mc-modal__specs-arrow" id="specsLeft" aria-label="Anterior">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <div class="mc-modal__specs-list">
                            <div class="mc-modal__spec-item">
                                <span class="mc-modal__spec-title">MOTOR</span>
                                <div class="mc-modal__spec-detail">
                                    <i class="fas fa-engine"></i>
                                    <span id="modalMotor">2000 CC</span>
                                </div>
                            </div>
                            <div class="mc-modal__spec-item">
                                <span class="mc-modal__spec-title">ABS</span>
                                <div class="mc-modal__spec-detail">
                                    <span class="mc-modal__spec-abs">(ABS)</span>
                                    <span id="modalABS">Sí</span>
                                </div>
                            </div>
                            <div class="mc-modal__spec-item">
                                <span class="mc-modal__spec-title">PASAJEROS</span>
                                <div class="mc-modal__spec-detail">
                                    <i class="fas fa-users"></i>
                                    <span id="modalPasajeros">5</span>
                                </div>
                            </div>
                            <div class="mc-modal__spec-item">
                                <span class="mc-modal__spec-title">TIPO</span>
                                <div class="mc-modal__spec-detail">
                                    <i class="fas fa-cog"></i>
                                    <span id="modalTransmision">Automática</span>
                                </div>
                            </div>
                        </div>
                        <button class="mc-modal__specs-arrow" id="specsRight" aria-label="Siguiente">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Columna derecha: formulario cotización -->
                <div class="mc-modal__right">
                    <form class="mc-cotizar-form" id="reservationForm">
                        <input type="hidden" name="vehicle_name" id="reserveVehicleName">

                        <div class="mc-cotizar__field">
                            <label>Definir Fechas de renta</label>
                            <input type="text" id="modalFechas" placeholder="Seleccionar fechas" readonly required>
                        </div>

                        <div class="mc-cotizar__field">
                            <label>Lugar de Entrega</label>
                            <input type="text" name="lugar_entrega" placeholder="Elegir Lugar...">
                        </div>

                        <div class="mc-cotizar__field">
                            <label>Lugar de Devolución</label>
                            <input type="text" name="lugar_devolucion" placeholder="Elegir Lugar...">
                        </div>

                        <div class="mc-cotizar__field">
                            <label>Hora de Entrega</label>
                            <div class="mc-cotizar__time">
                                <input type="time" name="hora_entrega" value="11:10">
                            </div>
                        </div>

                        <div class="mc-cotizar__field">
                            <label>Hora de Devolución</label>
                            <div class="mc-cotizar__time">
                                <input type="time" name="hora_devolucion" value="11:10">
                            </div>
                        </div>

                        <button type="submit" class="mc-btn mc-btn--primary mc-btn--cotizar">
                            Ir a Cotizar <i class="fab fa-whatsapp"></i>
                        </button>
                    </form>
                </div>
            </div>
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
