<?php

    /*

    Template Name: Agenda
    
    */

    get_header();

?>

        <main class="g-production-preview__list">

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
            
                <article class="g-production-preview__list-item clear">
                    <header>
                        <?php if ( get_field('age') ) : ?>
                            <span class="g-production__meta-age" aria-label="Minimum Alter"><?php the_field('age'); ?>+</span>
                        <?php endif; ?>
                        <?php if ( get_field('language') ) : ?>

                            <?php

                                $lang = get_field('language');
                                $both_lang = '';

                                if( in_array( 'de', $lang ) !== false && in_array( 'fr', $lang ) !== false) {
                                    $both_lang = 'g-production__meta_lang--both';
                                }

                            ?>

                            <?php if( in_array( 'de', $lang ) !== false) : ?>
                                <img class="g-production__meta_lang--de <?php echo $both_lang; ?>" src="<?php echo get_theme_file_uri( 'assets/img/de.svg' ); ?>" alt="Produktion in Deutsch"/>
                            <?php endif; ?>
                            <?php if( in_array( 'fr', $lang ) !== false) : ?>
                                <img class="g-production__meta_lang--fr <?php echo $both_lang; ?>" src="<?php echo get_theme_file_uri( 'assets/img/fr.svg' ); ?>" alt="Produktion in Französisch"/>
                            <?php endif; ?>
                        <?php endif; ?>
                        <h2><?php the_title(); ?></h2>
                        <p><?php the_field('subtitle'); ?></p>
                        <p><a href="<?php the_permalink(); ?>" class="g-link--cta"><?php _e('view', 'grenouille'); ?></a></p>
                    </header>
                    <aside>
                        <div class="g-production-preview__list-item__address">
                            <img class="g-production-preview__list-item__marker-icon" src="<?php echo get_theme_file_uri( 'assets/img/marker.svg' ); ?>" alt="Dekorativer Marker"/>
                            <p>
                                <span class="upper">Theater am Gleis</span><br>
                                Untere Vogelsangstrasse 3<br>
                                8400  Winterthur
                            </p>
                        </div>
                        <?php if ( get_field('duration') ) : ?>
                            <span class="g-production__meta-duration" aria-label="Minimum Alter">
                                <img src="<?php echo get_theme_file_uri( 'assets/img/time.svg' ); ?>" alt="Dekorative Zeituhr"/>
                                <?php the_field('duration'); ?>'
                            </span>
                        <?php endif; ?>
                        <div class="g-production-preview__list-item__school" data-effect="random-rotate">
                            <h3>Schulvorstellung</h3>
                            <p>
                                Donnerstag<br>
                                27. März 2019<br>
                                10:00 Uhr
                            </p>
                        </div>
                    </aside>
                </article>

            <?php endwhile; wp_reset_query(); ?>
            
        </main>

        <?php get_template_part( 'shapes' ); ?>

<?php get_footer(); ?>