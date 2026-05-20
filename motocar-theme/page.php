<?php
/**
 * Template: Page (páginas genéricas de WordPress)
 * Se activa para cualquier "Página" creada desde WP Admin → Páginas → Añadir nueva.
 * No se aplica a la página de inicio (esa usa front-page.php).
 */
get_header();
?>

<?php while (have_posts()) : the_post(); ?>

<!-- ==========================================
     PAGE HERO
     ========================================== -->
<section class="mc-page-hero<?php echo has_post_thumbnail() ? ' mc-page-hero--has-img' : ''; ?>">
    <?php if (has_post_thumbnail()) : ?>
        <div class="mc-page-hero__bg" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>');"></div>
        <div class="mc-page-hero__overlay"></div>
    <?php endif; ?>
    <div class="mc-container">
        <h1 class="mc-page-hero__title"><?php the_title(); ?></h1>
    </div>
</section>

<!-- ==========================================
     PAGE CONTENT
     ========================================== -->
<section class="mc-page-content">
    <div class="mc-container">
        <div class="mc-page-body">
            <?php the_content(); ?>
            <?php wp_link_pages(array(
                'before' => '<div class="mc-post-pages"><span>Páginas:</span>',
                'after'  => '</div>',
            )); ?>
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
