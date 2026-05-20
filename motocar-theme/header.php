<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Dark mode: aplicar clase antes de que cargue el CSS para evitar FOUC -->
    <script>
    (function(){
        try {
            var t = localStorage.getItem('mc-theme');
            if (t === 'dark' || (!t && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark-mode');
            }
        } catch(e) {}
    })();
    </script>
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
                <span class="mc-topbar__item mc-topbar__item--static">
                    <i class="fas fa-headset"></i>
                    <span data-i18n="topbar_247">Atención 24/7</span>
                </span>
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
                <button class="mc-dark-toggle" id="darkModeToggle" aria-label="Cambiar tema oscuro/claro">
                    <i class="fas fa-moon"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================
     HEADER / NAVEGACIÓN
     ========================================== -->
<header class="mc-header mc-header--blog" id="header">
    <div class="mc-container">
        <div class="mc-header__inner">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="mc-header__logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="MotoCar Rentals" class="mc-logo-img">
                <?php endif; ?>
            </a>

            <nav class="mc-nav" id="mainNav">
                <ul class="mc-nav__list">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>" class="mc-nav__link" data-i18n="nav_inicio">Inicio</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#vehiculos')); ?>" class="mc-nav__link" data-i18n="nav_vehiculos">Vehículos</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#lugares')); ?>" class="mc-nav__link" data-i18n="nav_lugares">Lugares de Interés</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#nosotros')); ?>" class="mc-nav__link" data-i18n="nav_nosotros">Nosotros</a></li>
                    <li><a href="<?php echo esc_url(get_post_type_archive_link('post') ?: home_url('/blog/')); ?>" class="mc-nav__link<?php echo (is_home() || is_singular('post') || is_category()) ? ' active' : ''; ?>">Blog</a></li>
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
