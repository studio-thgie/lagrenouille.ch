<?php

    /*

    Template Name: Homepage
    
    */

    get_header();

?>

        <main>
            <a href="spielplan.html" class="g-link--large" data-effect="random-rotate">Nächste Produktionen</a>

            <section aria-label="Vorschau der nächsten Produktionen" class="g-production-preview__wrapper">

            <?php
                $loop = new WP_Query( array(
                    'post_type' => 'Events',
                    'posts_per_page' => -1,
                    'meta_key'	=> 'start_date',
                    'orderby'	=> 'meta_value_num',
                    'order'		=> 'ASC'
                    )
                );
            ?>

                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

                    <article class="g-production-preview even" data-effect="random-padding">
                        <div class="g-production-preview__article">
                            <?php if ( get_field('age') ) : ?>
                                <span class="g-production__meta-age" aria-label="Minimum Alter"><?php the_field('age'); ?>+</span>
                            <?php endif; ?>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="g-production-preview__image">
                                    <?php the_post_thumbnail( 'event-preview', array( 'class'  => 'g-production__image' ) ); ?>
                                </div>
                            <?php endif; ?>
                            <h2><?php the_title(); ?></h2>
                            <p class="g-production-preview__lead"><?php the_field('subtitle'); ?></p>
                            <p><a href="<?php the_permalink(); ?>" class="g-link--cta">Ansehen</a></p>
                        </div>
                    </article>

                <?php endwhile; wp_reset_query(); ?>

            </section>

            <a href="spielplan.html" class="g-link--large" data-effect="random-rotate">Kompletter Spielplan</a>
        </main>

<?php get_footer(); ?>