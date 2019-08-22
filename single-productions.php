<?php

    /*

        This is the Event Template.
    
    */

    get_header();

?>

        <main>
            <article class="g-production__article">
                <header>
                    <h1><?php the_title(); ?></h1>
                    <p class="g-production-subtitle"><?php the_field('subtitle'); ?></p>
                </header>

                <aside class="g-production__meta-wrapper">
                    <?php if ( get_field('duration') ) : ?>
                        <span class="g-production__meta-duration" aria-label="Minimum Alter">
                            <span class="g-animation" data-effect="animation" data-animation="<?php echo get_theme_file_uri( 'assets/img/animations/GRE_SANDUHR_'.$GLOBALS['color_scheme'].'.json' ); ?>" data-loop="1"></span>
                            <?php the_field('duration'); ?>'
                        </span>
                    <?php endif; ?>
                    <?php

                        $lang = get_field('language');
                        $both_lang = '';

                        if( in_array( 'de', $lang ) !== false && in_array( 'fr', $lang ) !== false) {
                            $both_lang = 'g-production__meta_lang--both';
                        }

                    ?>

                    <?php if( in_array( 'fr', $lang ) !== false) : ?>
                        <img class="g-production__meta_lang--fr <?php echo $both_lang; ?>" src="<?php echo get_theme_file_uri( 'assets/img/svg/FR_Vektor_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Produktion in Französisch"/>
                    <?php endif; ?>
                    <?php if( in_array( 'de', $lang ) !== false) : ?>
                        <img class="g-production__meta_lang--de <?php echo $both_lang; ?>" src="<?php echo get_theme_file_uri( 'assets/img/svg/DE_Vektor_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Produktion in Deutsch"/>
                    <?php endif; ?>
                    <?php if ( get_field('age') ) : ?>
                        <span class="g-production__meta-age" aria-label="Minimum Alter"><?php the_field('age'); ?>+</span>
                    <?php endif; ?>
                </aside>

                <?php if ( has_post_thumbnail() ) : ?>
                    <figure class="g-production__impression">       
                        <div class="g-production__image-wrapper">
                            <?php the_post_thumbnail( 'event-header', array( 'class'  => 'g-production__image' ) ); ?>
                        </div>
                        <?php if (get_post( get_post_thumbnail_id() )->post_excerpt) : ?>
                            <figcaption>
                                <?php echo wp_kses_post(get_post( get_post_thumbnail_id() )->post_excerpt ); ?>
                            </figcaption>
                        <?php endif; ?>
                    </figure>
                <?php endif; ?>

                <div class="g-production__description">
                    <?php the_content(); ?>
                </div>
                <div class="g-production__information">
                <?php the_field('information'); ?>
                </div>
            </article>
            
        </main>

        <?php get_template_part( 'shapes' ); ?>

<?php get_footer(); ?>