<?php

    /*

    Template Name: Espace Pro Overview
    
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

            </section>

            <div>

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

                    <a href="<?php the_permalink(); ?>" class="g-espace-preview">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="g-espace-preview__image">
                                <?php the_post_thumbnail( 'event-preview', array( 'class'  => 'g-espace__image' ) ); ?>
                            </div>
                        <?php endif; ?>
                        <span><?php the_title(); ?></span>
                    </a>

                <?php endwhile; wp_reset_query(); ?>
            </div>

        </main>

<?php get_footer(); ?>