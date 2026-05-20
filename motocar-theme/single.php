<?php
/**
 * Template: Single post (entrada de blog individual)
 * Se activa automáticamente cuando se abre un post del blog.
 */
get_header();
?>

<?php while (have_posts()) : the_post(); ?>

<!-- ==========================================
     POST HERO
     ========================================== -->
<section class="mc-post-hero<?php echo has_post_thumbnail() ? ' mc-post-hero--has-img' : ''; ?>">
    <?php if (has_post_thumbnail()) : ?>
        <div class="mc-post-hero__bg" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>');"></div>
        <div class="mc-post-hero__overlay"></div>
    <?php endif; ?>
    <div class="mc-container">
        <div class="mc-post-hero__content">
            <!-- Categorías -->
            <div class="mc-post-hero__cats">
                <?php
                $cats = get_the_category();
                foreach ($cats as $cat) :
                ?>
                <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="mc-post-hero__cat">
                    <?php echo esc_html($cat->name); ?>
                </a>
                <?php endforeach; ?>
            </div>

            <h1 class="mc-post-hero__title"><?php the_title(); ?></h1>

            <div class="mc-post-hero__meta">
                <span><i class="fas fa-calendar-alt"></i> <?php echo get_the_date('d \d\e F, Y'); ?></span>
                <span><i class="fas fa-clock"></i> <?php echo ceil(str_word_count(strip_tags(get_the_content())) / 200); ?> min de lectura</span>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================
     POST CONTENT
     ========================================== -->
<article class="mc-post-article" id="post-<?php the_ID(); ?>">
    <div class="mc-container">
        <div class="mc-post-layout">

            <!-- Contenido principal -->
            <div class="mc-post-content">
                <?php the_content(); ?>

                <!-- Paginación de post largo (<!--nextpage-->) -->
                <?php wp_link_pages(array(
                    'before'      => '<div class="mc-post-pages"><span>Páginas:</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                )); ?>

                <!-- Tags del post -->
                <?php
                $tags = get_the_tags();
                if ($tags) :
                ?>
                <div class="mc-post-tags">
                    <i class="fas fa-tags"></i>
                    <?php foreach ($tags as $tag) : ?>
                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="mc-post-tags__item">
                        <?php echo esc_html($tag->name); ?>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

        </div>

        <!-- Navegación entre posts -->
        <nav class="mc-post-nav" aria-label="Navegación entre entradas">
            <div class="mc-post-nav__prev">
                <?php
                $prev = get_previous_post();
                if ($prev) :
                ?>
                <a href="<?php echo esc_url(get_permalink($prev)); ?>">
                    <span class="mc-post-nav__label"><i class="fas fa-chevron-left"></i> Anterior</span>
                    <span class="mc-post-nav__post-title"><?php echo esc_html(get_the_title($prev)); ?></span>
                </a>
                <?php endif; ?>
            </div>
            <a href="<?php echo esc_url(get_post_type_archive_link('post') ?: home_url('/blog/')); ?>" class="mc-post-nav__back">
                <i class="fas fa-th-large"></i> Ver todos los artículos
            </a>
            <div class="mc-post-nav__next">
                <?php
                $next = get_next_post();
                if ($next) :
                ?>
                <a href="<?php echo esc_url(get_permalink($next)); ?>">
                    <span class="mc-post-nav__label">Siguiente <i class="fas fa-chevron-right"></i></span>
                    <span class="mc-post-nav__post-title"><?php echo esc_html(get_the_title($next)); ?></span>
                </a>
                <?php endif; ?>
            </div>
        </nav>

        <!-- CTA de cotización -->
        <div class="mc-post-cta">
            <div class="mc-post-cta__inner">
                <p class="mc-post-cta__text">¿Listo para tu próxima aventura en Antioquia?</p>
                <a href="<?php echo esc_url(home_url('/#vehiculos')); ?>" class="mc-btn mc-btn--primary">
                    <i class="fas fa-car"></i> Ver vehículos disponibles
                </a>
                <a href="https://wa.me/573202161156?text=Hola%20MotoCar%20Rentals!%20Quiero%20información%20sobre%20alquiler%20de%20vehículos" target="_blank" class="mc-btn mc-btn--whatsapp">
                    <i class="fab fa-whatsapp"></i> Cotizar por WhatsApp
                </a>
            </div>
        </div>

    </div>
</article>

<?php endwhile; ?>

<?php get_footer(); ?>
