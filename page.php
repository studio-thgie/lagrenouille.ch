<?php

    get_header();

?>

        <main>
            <article class="g-production__article">
                <header>
                    <h1><?php the_title(); ?></h1>
                    <p><?php the_field('subtitle'); ?></p>
                </header>

                <?php if ( has_post_thumbnail() ) : ?>
                    <figure class="g-production__impression">       
                        <?php the_post_thumbnail( 'event-header', array( 'class'  => 'g-production__image' ) ); ?>
                        <?php if (get_post( get_post_thumbnail_id() )->post_excerpt) : ?>
                            <figcaption>
                                <?php echo wp_kses_post(get_post( get_post_thumbnail_id() )->post_excerpt ); ?>
                            </figcaption>
                        <?php endif; ?>
                    </figure>
                <?php endif; ?>

                <div class="g-production__description <?php if ( get_field('one_column') ) { echo 'g-one-col'; } ?>">
                    <?php the_content(); ?>
                </div>
            </article>
            
        </main>

        <?php get_template_part( 'shapes' ); ?>

<?php get_footer(); ?>