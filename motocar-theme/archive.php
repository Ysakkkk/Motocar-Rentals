<?php
/**
 * Template: Archive / Blog listing
 * Muestra la lista de posts del blog de MotoCar Rentals.
 * URL típica: /blog/  o  /?cat=X
 */
get_header();
?>

<!-- ==========================================
     BLOG HERO BANNER
     ========================================== -->
<section class="mc-blog-hero">
    <div class="mc-container">
        <h1 class="mc-blog-hero__title">
            <?php
            if (is_category()) {
                echo '<span>' . single_cat_title('', false) . '</span>';
            } elseif (is_tag()) {
                echo '<span>' . single_tag_title('', false) . '</span>';
            } elseif (is_author()) {
                echo '<span>' . get_the_author() . '</span>';
            } else {
                echo 'Blog';
            }
            ?>
        </h1>
        <?php if (is_category() && category_description()) : ?>
            <p class="mc-blog-hero__desc"><?php echo category_description(); ?></p>
        <?php else : ?>
            <p class="mc-blog-hero__desc">Destinos, tips de viaje y novedades de MotoCar Rentals</p>
        <?php endif; ?>
    </div>
</section>

<!-- ==========================================
     BLOG GRID
     ========================================== -->
<section class="mc-blog-archive">
    <div class="mc-container">

        <!-- Filtro de categorías -->
        <div class="mc-blog-cats">
            <a href="<?php echo esc_url(get_post_type_archive_link('post') ?: home_url('/blog/')); ?>"
               class="mc-blog-cats__btn<?php echo (!is_category()) ? ' active' : ''; ?>">
                Todos
            </a>
            <?php
            $blog_cats = get_categories(array('hide_empty' => true, 'orderby' => 'name'));
            foreach ($blog_cats as $cat) :
            ?>
            <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
               class="mc-blog-cats__btn<?php echo (is_category($cat->term_id)) ? ' active' : ''; ?>">
                <?php echo esc_html($cat->name); ?>
            </a>
            <?php endforeach; ?>
        </div>

        <?php if (have_posts()) : ?>

        <div class="mc-blog-grid">
            <?php while (have_posts()) : the_post(); ?>
            <article class="mc-blog-card" id="post-<?php the_ID(); ?>">
                <a href="<?php the_permalink(); ?>" class="mc-blog-card__img-link" tabindex="-1" aria-hidden="true">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium_large', array('class' => 'mc-blog-card__img', 'loading' => 'lazy', 'alt' => get_the_title())); ?>
                    <?php else : ?>
                        <div class="mc-blog-card__img mc-blog-card__img--placeholder">
                            <i class="fas fa-car"></i>
                        </div>
                    <?php endif; ?>
                </a>
                <div class="mc-blog-card__body">
                    <div class="mc-blog-card__meta">
                        <?php
                        $cats = get_the_category();
                        if ($cats) :
                        ?>
                        <a href="<?php echo esc_url(get_category_link($cats[0]->term_id)); ?>" class="mc-blog-card__cat">
                            <?php echo esc_html($cats[0]->name); ?>
                        </a>
                        <?php endif; ?>
                        <span class="mc-blog-card__date">
                            <i class="fas fa-calendar-alt"></i>
                            <?php echo get_the_date('d M Y'); ?>
                        </span>
                    </div>
                    <h2 class="mc-blog-card__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <p class="mc-blog-card__excerpt">
                        <?php echo wp_trim_words(get_the_excerpt(), 22, '…'); ?>
                    </p>
                    <a href="<?php the_permalink(); ?>" class="mc-btn mc-btn--outline mc-btn--sm">
                        Leer más <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>
            <?php endwhile; ?>
        </div>

        <!-- Paginación -->
        <div class="mc-blog-pagination">
            <?php
            the_posts_pagination(array(
                'mid_size'           => 2,
                'prev_text'          => '<i class="fas fa-chevron-left"></i> Anterior',
                'next_text'          => 'Siguiente <i class="fas fa-chevron-right"></i>',
                'before_page_number' => '',
            ));
            ?>
        </div>

        <?php else : ?>

        <div class="mc-blog-empty">
            <i class="fas fa-pen-alt"></i>
            <p>Aún no hay publicaciones. ¡Vuelve pronto!</p>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="mc-btn mc-btn--primary">Volver al inicio</a>
        </div>

        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>
