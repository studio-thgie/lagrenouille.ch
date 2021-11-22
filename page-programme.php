<?php

    /*

    Template Name: Programme
    
    */

    get_header();

?>

        <main class="g-programme">

        <?php

            echo '<div class="g-programme__categories">';

            echo '<span class="g-programme__categories-label">';
            _e('filter', 'grenouille');
            echo '</span>';
            

            if(ICL_LANGUAGE_CODE == 'de'){
                $field_key = "field_5d5d84522b866";
            } else {
                $field_key = "field_5d5d84e72cb5b";
            }
            
            $field = get_field_object($field_key);

            if( $field ) {
                echo '<div class="select-wrapper"><select id="categories" name="categories" class="categories" autocomplete="off">';

                echo '<option value="all">';
                _e( 'all', 'grenouille' );
                echo '</option>';

                foreach( $field['choices'] as $k => $v ) {
                    echo '<option value="' . $k . '"';

                    if ( $k == $_GET['category'] ) {
                        echo ' selected';
                    }
                    echo '>' . $v . '</option>';
                }

                echo '<option value="school"';

                if ( 'school' == $_GET['category'] ) {
                    echo ' selected';
                }
                echo '>';

                _e( 'school', 'grenouille' );
                echo '</option>';

                echo '</select></div>';
            }

            $query = array(
                'post_type' => 'Saison',
                'posts_per_page' => -1,
            );
        
            $loop = new WP_Query( $query );

            if( $loop->have_posts() ){
                echo '<div class="select-wrapper"><select id="saison" name="saison" class="saison" autocomplete="off">';
                echo '<option value="all">Saison</option>';
                while ( $loop->have_posts() ) {
                    $loop->the_post();
                    echo '<option value="'.get_the_ID().'">'.get_the_title().'</option>';
                }
                echo '</select></div>';
            }

            wp_reset_query();

            echo '</div>';

            $query = array(
                'post_type' => 'Events',
                'posts_per_page' => -1,
                'meta_query' 		=> array(
                    array(
                        'key'			=> 'date_and_time',
                        'compare'		=> '>=',
                        'value'			=> date('Y-m-d H:i:s'),
                        'type'			=> 'DATETIME'
                    ),
                ),
                'order'				=> 'ASC',
                'orderby'			=> 'meta_value',
                'meta_key'			=> 'date_and_time',
                'meta_type'			=> 'DATETIME'
            );

            if(isset($_GET['quand'])) {
                $query['meta_query'] = array(
                    array(
                        'key'			=> 'date_and_time',
                        'compare'		=> '>=',
                        'value'			=> date('Y-m-d H:i:s', strtotime(get_field('from', $_GET['quand']))),
                        'type'			=> 'DATETIME'
                    ),
                    array(
                        'key'			=> 'date_and_time',
                        'compare'		=> '<=',
                        'value'			=> date('Y-m-d H:i:s', strtotime(get_field('to', $_GET['quand']))),
                        'type'			=> 'DATETIME'
                    ),
                );
            }

            $loop = new WP_Query( $query );

        ?>

            <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

                <?php

                    $p = get_field('production');
                    $v = get_field('venue');

                    if(isset($_GET['category'])){
                        if($_GET['category'] != 'school'){
                            $_cat = get_field_object('event_category', $p->ID);
                            if($_cat['value']['value'] !== $_GET['category'] && $_GET['category'] != 'all'){
                                continue;
                            }
                        }
                        if($_GET['category'] == 'school'){
                            if(!get_field('for_school')) {
                                continue;
                            }
                        }
                    }
                
                ?>
            
                <article class="g-programme__item clear">
                    <div class="g-programme__item-date">
                        <div class="g-next-events__item">
                            <?php get_template_part( 'includes/show-date-mini' ); ?>
                        </div>
                        <?php if(get_field('premiere')): ?>
                            <img src="<?php echo get_theme_file_uri( 'assets/img/svg/Premiere_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Premiere" class="g-programme__item-premiere">
                        <?php endif; ?>
                    </div>
                    <div class="g-programme__item-info">
                        <?php if(get_field('override_title')): ?>
                            <h3>
                                <a href="<?php echo get_permalink( $p->ID ); ?>">
                                    <?php echo get_field('override_title'); ?>
                                </a>
                            </h3>
                        <?php else: ?>
                            <h3>
                                <a href="<?php echo get_permalink( $p->ID ); ?>">
                                    <?php echo get_the_title( $p->ID ); ?>
                                </a>
                            </h3>
                        <?php endif; ?>
                        <?php if(get_field('override_subtitle')): ?>
                            <p class="g-production-subtitle"><?php the_field('override_subtitle'); ?></p>
                        <?php else: ?>
                            <p class="g-production-subtitle"><?php the_field('subtitle', $p->ID); ?></p>
                        <?php endif; ?>
                        <div class="g-programme__item__address" style="background-image: url(<?php echo get_theme_file_uri( 'assets/img/svg/Icon_Ort_'.$GLOBALS['color_scheme'].'.svg' ); ?>);">
                            <p class="upper">
                                <?php echo get_the_title( $v->ID ); ?><br>
                                <?php the_field('street', $v->ID ); ?><br>
                                <?php the_field('zip', $v->ID ); ?> <?php the_field('city', $v->ID ); ?> 
                            </p>
                        </div>

                        <?php
					
                            $reservation = true;
                            $link = '/' . ICL_LANGUAGE_CODE . '/reservation?id=' . get_the_ID();
                            $target = '_self';
                        
                            if(!is_null(get_field('reservation_activated'))){
                                $reservation = get_field('reservation_activated');
                            }
                        
                            if(get_field('reservation_extern') != ''){
                                $link = get_field('reservation_extern');
                                $target = '_blank';
                            }
                        
                        ?>

                        <?php if($reservation): ?>
                            <a href="<?php echo $link; ?>" target="<?php echo $target; ?>" class="g-programme__item-reservation">Tickets</a>
                        <?php endif; ?>

                        <?php if(get_field('canceled')): ?>
                            <a class="g-programme__item-reservation"><?php _e('canceled', 'grenouille') ?></a>
                        <?php endif; ?>

                        <?php if(get_field('postponed')): ?>
                            <a class="g-programme__item-reservation"><?php _e('postponed', 'grenouille') ?></a>
                        <?php endif; ?>

                        <?php if(get_field('sold')): ?>
                            <span class="g-programme__item-sold"><?php _e('sold', 'grenouille') ?></span>
                        <?php endif; ?>

                        <?php if(get_field('brunch')): ?>
                            <img class="g-programm_item-brunch" src="<?php echo get_theme_file_uri( 'assets/img/svg/Brunch_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Brunch"/>
                        <?php endif; ?>

                        <?php if(get_field('transport')): ?>
                            <img class="g-programm_item-transport" src="<?php echo get_theme_file_uri( 'assets/img/svg/Transport_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Transport"/>
                        <?php endif; ?>

                        <?php if(get_field('atelier')): ?>
                            <img class="g-programm_item-atelier" src="<?php echo get_theme_file_uri( 'assets/img/svg/Atelier_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Atelier"/>
                        <?php endif; ?>

                        <?php if(get_field('backstage')): ?>
                            <img class="g-programm_item-backstage" src="<?php echo get_theme_file_uri( 'assets/img/svg/Backstage_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Backstage"/>
                        <?php endif; ?>

                    </div>
                    <div class="g-programme__item-meta">

                        <?php if ( get_field('language', $p->ID) ) : ?>

                            <?php

                                if(get_field('override_language')) {
                                    $lang = get_field('override_language');
                                } else {
                                    $lang = get_field('language', $p->ID);
                                }

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
                        <?php if ( get_field('age', $p->ID) ) : ?>
                            <span class="g-production__meta-age" aria-label="Minimum Alter"><?php the_field('age', $p->ID); ?>+</span>
                        <?php endif; ?>

                        <?php if ( get_field('duration', $p->ID) ) : ?>
                            <span class="g-production__meta-duration" aria-label="Dauer">
                                <span class="g-animation" data-effect="animation" data-animation="<?php echo get_theme_file_uri( 'assets/img/animations/GRE_SANDUHR_'.$GLOBALS['color_scheme'].'.json' ); ?>"></span>
                                <?php the_field('duration', $p->ID); ?>
                            </span>
                        <?php endif; ?>

                    </div>
                </article>

            <?php endwhile; wp_reset_query(); ?>

        </main>

<?php get_footer(); ?>