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
                'meta_key'	=> 'date_and_time',
                'orderby'	=> 'meta_value_num',
                'order'		=> 'ASC'
                )
            );
        ?>

            <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

                <?php 

                    $p = get_field('production');
                    $v = get_field('venue');
                
                ?>
            
                <article class="g-production-preview__list-item clear">
                    <header>
                        <?php if ( get_field('age') ) : ?>
                            <span class="g-production__meta-age" aria-label="Minimum Alter"><?php the_field('age', $p->ID); ?>+</span>
                        <?php endif; ?>
                        <?php if ( get_field('language', $p->ID) ) : ?>

                            <?php

                                $lang = get_field('language', $p->ID);
                                $both_lang = '';

                                if( in_array( 'de', $lang ) !== false && in_array( 'fr', $lang ) !== false) {
                                    $both_lang = 'g-production__meta_lang--both';
                                }

                            ?>

                            <?php if( in_array( 'de', $lang ) !== false) : ?>
                                <img class="g-production__meta_lang--de <?php echo $both_lang; ?>" src="<?php echo get_theme_file_uri( 'assets/img/svg/DE_Vektor_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Produktion in Deutsch"/>
                            <?php endif; ?>
                            <?php if( in_array( 'fr', $lang ) !== false) : ?>
                                <img class="g-production__meta_lang--fr <?php echo $both_lang; ?>" src="<?php echo get_theme_file_uri( 'assets/img/svg/FR_Vektor_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Produktion in Französisch"/>
                            <?php endif; ?>
                        <?php endif; ?>
                        <h2><a href="<?php echo get_permalink( $p->ID ); ?>"><?php echo get_the_title( $p->ID ); ?></a></h2>
                        <p class="g-production-subtitle"><?php the_field('subtitle', $p->ID); ?></p>
                    </header>
                    <aside>
                        <div class="g-production-preview__list-item__address">
                            <div>
                                    <span class="upper">
                                        <img class="g-production-preview__list-item__marker-icon" src="<?php echo get_theme_file_uri( 'assets/img/svg/Icon_Ort_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Dekorativer Marker"/>
                                        <?php echo get_the_title( $v->ID ); ?>
                                    </span>
                                <?php

                                    $content_post = get_post($v->ID);
                                    $content = $content_post->post_content;
                                    $content = apply_filters('the_content', $content);
                                    $content = str_replace(']]>', ']]&gt;', $content);
                                    echo $content;

                                ?>
                            </div>
                        </div>
                        <?php if ( get_field('duration', $p->ID) ) : ?>
                            <span class="g-production__meta-duration" aria-label="Minimum Alter">
                                <span class="g-animation" data-effect="animation" data-animation="<?php echo get_theme_file_uri( 'assets/img/animations/GRE_SANDUHR_'.$GLOBALS['color_scheme'].'.json' ); ?>" data-loop="1"></span>
                                <?php the_field('duration', $p->ID); ?>'
                            </span>
                        <?php endif; ?>
                        <div class="g-production-preview__list-item__school" data-effect="random-rotate">
                            <div>
                                <?php if(get_field('for_school')): ?><h3>Schulvorstellung</h3><?php endif; ?>
                                <?php 
                                    $date = DateTime::createFromFormat('d.m.Y H:i', get_field('date_and_time'));
                                ?>
                                <p>
                                    <?php echo $date->format('l'); ?><br>
                                    <?php echo $date->format('d. F Y'); ?><br>
                                    <?php echo $date->format('H:i'); ?> Uhr
                                </p>
                            </div>
                        </div>
                    </aside>
                </article>

            <?php endwhile; wp_reset_query(); ?>
            
        </main>

        <?php get_template_part( 'shapes' ); ?>

<?php get_footer(); ?>