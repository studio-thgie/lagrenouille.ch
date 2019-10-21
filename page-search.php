<?php

    /*

    Template Name: Search
    
    */

    get_header();

?>

        <main>
            <section>
                <article class="g-search">
                <?php
                    $args = array(
                        'posts_per_page'  => -1,
                        's' => $_GET['q']
                    );
                    $loop = new WP_Query( $args );
                ?>

                <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
                    <div>
                        <h3>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                    </div>
                <?php endwhile; else : ?>
                    <div>
                        <h3><?php _e('nothing_found', 'grenouille'); ?></h3>
                    </div>
                <?php endif; ?>
                </article>
            </section>
        </main>

<?php get_footer(); ?>