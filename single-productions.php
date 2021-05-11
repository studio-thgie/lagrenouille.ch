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
                    <?php if ( get_field('language', get_the_ID()) ) : ?>

                        <?php

                            $lang = get_field('language', get_the_ID());

                        ?>

                        <?php if( in_array( 'de', $lang ) !== false && in_array( 'fr', $lang ) !== false): ?>
                            <img class="g-production__meta_lang--bi" src="<?php echo get_theme_file_uri( 'assets/img/svg/DEFR_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Produktion bilingues"/>
                        <?php elseif( in_array( 'ded', $lang ) !== false): ?>
                            <img class="g-production__meta_lang--de g-production__meta_lang--ded" src="<?php echo get_theme_file_uri( 'assets/img/svg/Dialekt_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Produktion in Deutsch Dialekt"/>
                        <?php else: ?>
                            <?php if( in_array( 'de', $lang ) !== false) : ?>
                                <img class="g-production__meta_lang--de" src="<?php echo get_theme_file_uri( 'assets/img/svg/DE_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Produktion in Deutsch"/>
                            <?php endif; ?>
                            <?php if( in_array( 'fr', $lang ) !== false) : ?>
                                <img class="g-production__meta_lang--fr" src="<?php echo get_theme_file_uri( 'assets/img/svg/FR_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Produktion in Französisch"/>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if( in_array( 'ev', $lang ) !== false ): ?>
                            <img class="g-production__meta_lang--ev" src="<?php echo get_theme_file_uri( 'assets/img/svg/EcouteVoir_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Produktion bilingues"/>
                        <?php endif; ?>

                        <?php if( in_array( 'nv', $lang ) !== false ): ?>
                            <img class="g-production__meta_lang--nv" src="<?php echo get_theme_file_uri( 'assets/img/svg/NonVerbal_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Produktion NonVerbal"/>
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

                <div class="g-production__next-events">

                    <?php
            
                        global $sitepress;
                        $loop = new WP_Query( array(
                            'post_type' => 'Events',
                            'posts_per_page' => 3,
                            'meta_query' 		=> array(
                                array(
                                    'relation' => 'AND',
                                    array(
                                        'key'			=> 'date_and_time',
                                        'compare'		=> '>=',
                                        'value'			=> date('Y-m-d H:i:s'),
                                        'type'			=> 'DATETIME'
                                    ),
                                    array(
                                        'key'			=> 'production',
                                        'compare'		=> 'LIKE',
                                        'value'			=> get_the_ID(),
                                    ),
                                ),
                            ),
                            'order'				=> 'ASC',
                            'orderby'			=> 'meta_value',
                            'meta_key'			=> 'date_and_time',
                            'meta_type'			=> 'DATE'
                        ) );

                    ?>

                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

                        <?php 

                            $p = get_field('production');
                            $v = get_field('venue');

                        ?>

                        <div class="g-next-events__item">

                            <?php if ( get_field('language', $p->ID) ) : ?>

                                <?php

                                    if(get_field('override_language')) {
                                        $lang = get_field('override_language');
                                    } else {
                                        $lang = get_field('language', $p->ID);
                                    }

                                ?>

                                <?php if( in_array( 'ev', $lang ) !== false ): ?>
                                    <img class="g-production__meta_lang g-production__meta_lang--nev" src="<?php echo get_theme_file_uri( 'assets/img/svg/EcouteVoir_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Produktion bilingues"/>
                                <?php endif; ?>

                                <?php if( in_array( 'nv', $lang ) !== false ): ?>
                                    <img class="g-production__meta_lang g-production__meta_lang--nev" src="<?php echo get_theme_file_uri( 'assets/img/svg/NonVerbal_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Produktion NonVerbal"/>
                                <?php endif; ?>

                                <?php if( in_array( 'de', $lang ) !== false && in_array( 'fr', $lang ) !== false): ?>
                                    <img class="g-production__meta_lang" src="<?php echo get_theme_file_uri( 'assets/img/svg/DEFR_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Produktion bilingues"/>
                                    <?php else: ?>
                                    <?php if( in_array( 'de', $lang ) !== false) : ?>
                                        <img class="g-production__meta_lang" src="<?php echo get_theme_file_uri( 'assets/img/svg/DE_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Produktion in Deutsch"/>
                                    <?php endif; ?>
                                    <?php if( in_array( 'fr', $lang ) !== false) : ?>
                                        <img class="g-production__meta_lang" src="<?php echo get_theme_file_uri( 'assets/img/svg/FR_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Produktion in Französisch"/>
                                    <?php endif; ?>
                                <?php endif; ?>
                                
                            <?php endif; ?>

                            <?php get_template_part( 'includes/show-date-mini' ); ?>
                        </div>
                    <?php endwhile; wp_reset_query(); ?>

                    <?php if($loop->have_posts()): ?>

                        <?php 

                            if(ICL_LANGUAGE_CODE == 'fr') {
                                $agenda = '/fr/agenda';
                            } else {
                                $agenda = '/agenda';
                            }

                        ?>

                        <div class="g-next-events__item">
                            <p>
                                <a href="<?php echo $agenda; ?>" class="g-next-events__title">
                                    <?php _e( 'next_events', 'grenouille' ); ?>
                                </a>
                            </p>
                        </div>
                    <?php endif; ?>

                </div>

                <div class="g-production__more-meta-wrapper">
                    <?php if(get_field('genre')) : ?>
                        <div class="g-production__genre" style="background-image: url(<?php echo get_theme_file_uri( 'assets/img/svg/genre-icon_'.$GLOBALS['color_scheme'].'.svg' ); ?>);">
                            <?php echo apply_filters('the_content', get_post_field('post_content', get_field('genre')->ID)); ?>
                        </div>
                    <?php endif; ?>
                    <?php if(get_field('download')) : ?>
                        <div class="g-production__download">
                            <a href="<?php the_field('download'); ?>">
                                <img src="<?php echo get_theme_file_uri( 'assets/img/svg/Downloads_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="">
                            </a>
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
                        <h3 class="g-foldable__title">
                            <?php the_sub_field('title'); ?>
                            <?php if(get_sub_field('foldable')): ?>
                                <button type="button" class="g-button g-button-foldable">
                                    <img src="<?php echo get_theme_file_uri( 'assets/img/svg/foldable-arrow_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Fold block">
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