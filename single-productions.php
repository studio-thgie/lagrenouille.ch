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
                            <span class="g-animation" data-effect="animation" data-animation="<?php echo get_theme_file_uri( 'assets/img/animations/GRE_SANDUHR_'.$GLOBALS['color_scheme'].'.json' ); ?>"></span>
                            <?php the_field('duration'); ?>
                        </span>
                    <?php endif; ?>
                    <?php if ( get_field('language', $p->ID) ) : ?>

                        <?php

                            $lang = get_field('language', $p->ID);

                        ?>

                        <?php if( in_array( 'de', $lang ) !== false && in_array( 'fr', $lang ) !== false): ?>
                            <img class="g-production__meta_lang--bi" src="<?php echo get_theme_file_uri( 'assets/img/svg/DEFR_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Produktion bilingues"/>
                        <?php else: ?>
                            <?php if( in_array( 'de', $lang ) !== false) : ?>
                                <img class="g-production__meta_lang--de" src="<?php echo get_theme_file_uri( 'assets/img/svg/DE_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Produktion in Deutsch"/>
                            <?php endif; ?>
                            <?php if( in_array( 'fr', $lang ) !== false) : ?>
                                <img class="g-production__meta_lang--fr" src="<?php echo get_theme_file_uri( 'assets/img/svg/FR_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Produktion in Französisch"/>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if ( get_field('age') ) : ?>
                        <span class="g-production__meta-age" aria-label="Minimum Alter"><?php the_field('age'); ?>+</span>
                    <?php endif; ?>
                </aside>

                <?php if(get_field('header_slideshow')): ?>
                    <ul class="g-production__slideshow">
                    <?php $i = 0; foreach(get_field('header_slideshow') as $key => $image): $i++; ?>
                        <li>
                            <a href="#slide<?php echo $i; ?>">
                                <div class="g-production__slideshow__image-wrapper">
                                    <img class="g-production__slideshow__image" src="<?php echo $image['sizes']['header-slideshow']; ?>" alt="<?php echo $image['alt']; ?>">
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                <?php else: ?>
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
                <?php endif; ?>

                <div class="g-production__more-meta-wrapper">
                    <?php if(get_field('genre')) : ?>
                        <div class="g-production__genre">
                            <?php echo apply_filters('the_content', get_post_field('post_content', get_field('genre')->ID)); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="g-production__description">
                    <?php the_content(); ?>
                </div>
                <div class="g-production__information">
                    <?php the_field('information'); ?>
                </div>
                <div class="g-production__additional-blocks">
                <?php
                    if( have_rows('content_block') ):
                        while ( have_rows('content_block') ) : the_row();
                ?>

                    <div class="g-production__additional-block">
                        <h3>
                            <?php the_sub_field('title'); ?>
                            <?php if(get_sub_field('foldable')): ?>
                                <button type="button" class="g-button g-button-foldable">
                                    <img src="<?php echo get_theme_file_uri( 'assets/img/svg/foldable-arrow.svg' ); ?>" alt="Fold block">
                                </button>
                            <?php endif; ?>
                        </h3>
                        <div class="production__additional-block__content <?php if(get_sub_field('foldable')): ?>production__additional-block__content--folded<?php endif; ?>">
                            <?php the_sub_field('content'); ?>
                        </div>
                    </div>

                <? 
                        endwhile;
                    endif;
                ?>
                </div>
            </article>

            <?php get_template_part( 'shapes' ); ?>

        </main>

<?php get_footer(); ?>