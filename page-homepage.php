<?php

    /*

    Template Name: Homepage
    
    */

    get_header();

    /*ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);*/

?>

        <?php if(is_null(get_field('show_subpages'))): ?>
        <style>
            .g-logo span {
                width: 700px;
            }

            @media (max-width: 768px) {
                .g-logo span {
                    width: 100%;
                }
            }
        </style>
        <?php endif; ?>

        <main>

            <?php if(get_field('link_top')): ?>
            <a href="<?php the_field('link_top'); ?>" class="g-link--large" data-effect="random-rotate">
                <?php the_field('link_top_label'); ?>
            </a>
            <?php endif; ?>

            <article class="g-production__article">
                <div class="g-production__description <?php if ( get_field('one_column') ) { echo 'g-one-col'; } ?>">
                    <?php the_content(); ?>
                </div>
            </article>

            <section aria-label="Vorschau Produktionen und Unterseiten" class="g-production-preview__wrapper">

            <?php
                $query = array(
                    'post_type' => 'Productions',
                    'posts_per_page' => -1,
                    'orderby'		 => 'menu_order',
                    'order'			 => 'ASC'
                );

                if(get_field('filter_productions') == 'archiv'){
                    $query = array(
                        'post_type' => 'Productions',
                        'posts_per_page' => -1,
                        'meta_key'		 => 'event_category',
                        'orderby'		 => 'meta_value',
                        'order'			 => 'DESC'
                    );
                    $query['meta_query'] = array(
                        array(
                            'key'			=> 'archive',
                            'compare'		=> '=',
                            'value'			=> '1',
                        ),
                    );
                } else if(strpos(get_field('filter_productions'), 'archiv_') !== false){
                    $query = array(
                        'post_type' => 'Productions',
                        'posts_per_page' => -1,
                        'meta_key'		 => 'event_category',
                        'orderby'		 => 'meta_value',
                        'order'			 => 'DESC'
                    );
                    $query['meta_query'] = array(
                        array(
                            'key'			=> 'archive',
                            'compare'		=> '=',
                            'value'			=> '1',
                        ),
                        array(
                            'key'			=> 'event_category',
                            'compare'		=> 'LIKE',
                            'value'			=> explode('_', get_field('filter_productions'))[1],
                        ),
                        arr
                    );
                } else {
                    $query['meta_query'] = array(
                        array(
                            'key'			=> 'event_category',
                            'compare'		=> 'LIKE',
                            'value'			=> get_field('filter_productions'),
                        ),
                        array(
                            'key'			=> 'archive',
                            'compare'		=> '!=',
                            'value'			=> '1',
                        ),
                    );
                }

                if(get_field('show_subpages')){
                    $query = array(
                        'post_type'      => 'page',
                        'posts_per_page' => -1,
                        'post_parent'    => $post->ID,
                        'order'          => 'ASC',
                        'orderby'        => 'menu_order'
                     );
                }
                
                $loop = new WP_Query( $query );

                $current_cat = '';
                $is_archive = get_field('filter_productions');

            ?>

                <?php $count = 0; while ( $loop->have_posts() ) : $loop->the_post(); $count++; ?>

                    <?php 

                        if($is_archive == 'archiv'){
                            if($current_cat != get_field('event_category')){
                                ?>

                                </section>
                                <h2><?php echo get_field('event_category'); ?></h2>
                                <section aria-label="Vorschau Produktionen und Unterseiten" class="g-production-preview__wrapper">

                                <?php
                                $current_cat = get_field('event_category');
                            }
                        }

                    ?>

                    <article class="g-production-preview <?php echo ($count % 2 ? 'even' : 'odd');?>" data-effect="random-padding">
                        <?php if(get_field('new', $p->ID)): ?>
                            <img class="g-production__new" src="<?php echo get_theme_file_uri( 'assets/img/svg/Neu_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Premiere" class="g-programme__item-new">
                        <?php endif; ?>
                        <a href="<?php the_permalink(); ?>" class="g-production-preview__article">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="g-production-preview__image">
                                    <?php if ( get_field('age') ) : ?>
                                        <span class="g-production__meta-age" aria-label="Minimum Alter"><?php the_field('age'); ?>+</span>
                                    <?php endif; ?>
                                    <?php the_post_thumbnail( 'event-preview', array( 'class'  => 'g-production__image' ) ); ?>
                                </div>
                            <?php else: ?>
                                <?php if ( get_field('age') ) : ?>
                                    <span class="g-production__meta-age" aria-label="Minimum Alter"><?php the_field('age'); ?>+</span>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if ( get_field('archive') ) : ?>
                                <span class="g-production__meta-cat" aria-label="Category"><?php the_field('event_category'); ?></span>
                            <?php endif; ?>
                            <h2><?php the_title(); ?></h2>
                            <p class="g-production-preview__lead"><?php the_field('subtitle'); ?></p>
                            <!-- <p><a href="<?php the_permalink(); ?>" class="g-link--cta"><?php _e('view', 'grenouille'); ?></a></p> -->
                        </a>
                    </article>

                <?php endwhile; wp_reset_query(); ?>

            </section>

            <?php if(get_field('link_bottom')): ?>
            <a href="<?php the_field('link_bottom'); ?>" class="g-link--large" data-effect="random-rotate">
                <?php the_field('link_bottom_label'); ?>
            </a>
            <?php endif; ?>

            <?php get_template_part( 'shapes' ); ?>

        </main>

<?php get_footer(); ?>