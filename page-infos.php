<?php

    /*

    Template Name: Infos
    
    */

    get_header();

?>

        <main class="g-info__list">

        <?php if( have_rows('row') ): ?>

            <?php while( have_rows('row') ): the_row(); ?>

                <article class="g-info__list-item">
                    <header>
                        <h2><?php the_sub_field('title'); ?></h2>
                    </header>
                    <section class="g-info__list-item__body">
                        <?php the_sub_field('text'); ?>
                    </section>
                </article>

            <?php endwhile; ?>

        <?php endif; ?>

        <?php get_template_part( 'shapes' ); ?>

        </main>

<?php get_footer(); ?>