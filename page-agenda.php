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
                        <h2><?php the_title(); ?></h2>
                        <p><?php the_field('subtitle'); ?></p>
                    </header>
                    <aside>
                        <div class="g-production-preview__list-item__address">
                            <p>
                                <span class="upper">Theater am Gleis</span><br>
                                Untere Vogelsangstrasse 3<br>
                                8400  Winterthur
                            </p>
                        </div>
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

<?php get_footer(); ?>