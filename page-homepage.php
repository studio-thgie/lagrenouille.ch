<?php

    /*

    Template Name: Homepage
    
    */

    get_header();

    /*ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);*/

?>

        <style>
            .g-logo span {
                width: 700px;
            }

            @media (max-width: 768px) {
                .g-logo span {
                    width: 100%;
                }
            }
        </style>

        <main>

            <?php if(get_field('link_top')): ?>
            <a href="<?php the_field('link_top'); ?>" class="g-link--large" data-effect="random-rotate">
                <?php the_field('link_top_label'); ?>
            </a>
            <?php endif; ?>

            <section aria-label="Vorschau der nächsten Produktionen" class="g-production-preview__wrapper">

            <?php
                $query = array(
                    'post_type' => 'Productions',
                    'posts_per_page' => -1,
                );

                if(get_field('filter_productions')){
                    $query['meta_query'] = array(
                        array(
                            'key'			=> 'event_category',
                            'compare'		=> 'LIKE',
                            'value'			=> get_field('filter_productions'),
                        ),
                    );
                }

                $loop = new WP_Query( $query );
            ?>

                <?php $count = 0; while ( $loop->have_posts() ) : $loop->the_post(); $count++; ?>

                    <article class="g-production-preview <?php echo ($count % 2 ? 'even' : 'odd');?>" data-effect="random-padding">
                        <a href="<?php the_permalink(); ?>" class="g-production-preview__article">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="g-production-preview__image">
                                    <?php if ( get_field('age') ) : ?>
                                        <span class="g-production__meta-age" aria-label="Minimum Alter"><?php the_field('age'); ?>+</span>
                                    <?php endif; ?>
                                    <?php the_post_thumbnail( 'event-preview', array( 'class'  => 'g-production__image' ) ); ?>
                                </div>
                            <?php else: ?>

                            <?php if ( get_field('age') ) : ?>
                                <span class="g-production__meta-age" aria-label="Minimum Alter"><?php the_field('age'); ?>+</span>
                            <?php endif; ?>
                            <?php endif; ?>
                            <h2><?php the_title(); ?></h2>
                            <p class="g-production-preview__lead"><?php the_field('subtitle'); ?></p>
                            <!-- <p><a href="<?php the_permalink(); ?>" class="g-link--cta"><?php _e('view', 'grenouille'); ?></a></p> -->
                        </a>
                    </article>

                <?php endwhile; wp_reset_query(); ?>

            </section>

            <?php if(get_field('link_bottom')): ?>
            <a href="<?php the_field('link_bottom'); ?>" class="g-link--large" data-effect="random-rotate">
                <?php the_field('link_bottom_label'); ?>
            </a>
            <?php endif; ?>

            <?php get_template_part( 'shapes' ); ?>

        </main>

<?php get_footer(); ?>