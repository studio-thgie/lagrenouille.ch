<?php

    /*

    Template Name: Overview
    
    */

    get_header();

?>

        <main>
            <section aria-label="Vorschau der Unter-Seiten" class="g-production-preview__wrapper">
            
            <article class="g-production__article">
                <div class="g-production__description <?php if ( get_field('one_column') ) { echo 'g-one-col'; } ?>">
                    <?php the_content(); ?>
                </div>
            </article>

            <?php
                $loop = new WP_Query(array(
                    'post_type'      => 'page',
                    'posts_per_page' => -1,
                    'post_parent'    => $post->ID,
                    'order'          => 'ASC',
                    'orderby'        => 'menu_order'
                 ));
            ?>

                <?php $count = 0; while ( $loop->have_posts() ) : $loop->the_post(); $count++; ?>

                    <article class="g-production-preview <?php echo ($count % 2 ? 'even' : 'odd');?>" data-effect="random-padding">
                        <a href="<?php the_permalink(); ?>" class="g-production-preview__article">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="g-production-preview__image">
                                    <?php the_post_thumbnail( 'event-preview', array( 'class'  => 'g-production__image' ) ); ?>
                                </div>
                            <?php endif; ?>
                            <h2><?php the_title(); ?></h2>
                            <p class="g-production-preview__lead"><?php the_field('subtitle'); ?></p>
                            <!-- <p><a href="<?php the_permalink(); ?>" class="g-link--cta"><?php _e('view', 'grenouille'); ?></a></p> -->
                        </a>
                    </article>

                <?php endwhile; wp_reset_query(); ?>

            </section>

            <?php get_template_part( 'shapes' ); ?>

        </main>

<?php get_footer(); ?>