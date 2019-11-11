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

                <?php if ( $loop->have_posts() ) : ?>
                    <div>
                        <h3>
                            <?php echo $loop->post_count; ?>
                            <?php if($loop->post_count > 1): ?>
                                <?php _e('entries', 'grenouille'); ?>
                            <?php else: ?>
                                <?php _e('entry', 'grenouille'); ?>
                            <?php endif; ?> <span class="g-search__term"><?php echo $_GET['q']; ?></span>
                        </h3>
                    </div>
                    
                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
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