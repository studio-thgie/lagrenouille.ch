<?php

    /*

    Template Name: Reservation
    
    */

    get_header();

?>

        <main>
            <section>

                <?php

                    $event = get_post($_GET['id']);

                    $p = get_field('production', $event->ID);
                    $v = get_field('venue', $event->ID);

                ?>

                <article class="g-production-preview__list-item clear">
                    <a href="<?php echo get_permalink( $p->ID ); ?>" class="g-production-preview__link">
                        <header>
                            <div class="g-production-preview__meta-wrapper">
                                <?php if ( get_field('age', $p->ID ) ) : ?>
                                    <span class="g-production__meta-age" aria-label="Minimum Alter"><?php the_field('age', $p->ID); ?>+</span>
                                <?php endif; ?>
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
                                    <?php else: ?>
                                        <?php if( in_array( 'de', $lang ) !== false) : ?>
                                            <img class="g-production__meta_lang--de" src="<?php echo get_theme_file_uri( 'assets/img/svg/DE_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Produktion in Deutsch"/>
                                        <?php endif; ?>
                                        <?php if( in_array( 'fr', $lang ) !== false) : ?>
                                            <img class="g-production__meta_lang--fr" src="<?php echo get_theme_file_uri( 'assets/img/svg/FR_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Produktion in Französisch"/>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            
                            <?php if(get_field('override_title')): ?>
                                <h2><?php echo get_field('override_title'); ?></h2>
                            <?php else: ?>
                                <h2><?php echo get_the_title( $p->ID ); ?></h2>
                            <?php endif; ?>
                            <?php if(get_field('override_subtitle')): ?>
                                <p class="g-production-subtitle"><?php the_field('override_subtitle'); ?></p>
                            <?php else: ?>
                                <p class="g-production-subtitle"><?php the_field('subtitle', $p->ID); ?></p>
                            <?php endif; ?>
                        </header>
                        <aside>
                            <div class="g-production-preview__list-item__address">
                                <div>
                                    <p class="upper">
                                        <img class="g-production-preview__list-item__marker-icon" src="<?php echo get_theme_file_uri( 'assets/img/svg/Icon_Ort_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Dekorativer Marker"/>
                                        <?php echo get_the_title( $v->ID ); ?><br>
                                        <?php the_field('street', $v->ID ); ?><br>
                                        <?php the_field('zip', $v->ID ); ?> <?php the_field('city', $v->ID ); ?> 
                                    </p>
                                </div>
                            </div>
                            <?php if ( get_field('duration', $p->ID) ) : ?>
                                <span class="g-production__meta-duration" aria-label="Minimum Alter">
                                    <span class="g-animation" data-effect="animation" data-animation="<?php echo get_theme_file_uri( 'assets/img/animations/GRE_SANDUHR_'.$GLOBALS['color_scheme'].'.json' ); ?>"></span>
                                    <?php the_field('duration', $p->ID); ?>
                                </span>
                            <?php endif; ?>
                            <div class="g-production-preview__list-item__school" data-effect="random-rotate">
                                <div>
                                    <h3><?php if(get_field('for_school')): ?>
                                    
                                    <?php _e( 'school', 'grenouille' ); ?>
                                    
                                    <?php else: ?>&nbsp;<?php endif; ?></h3>
                                    <?php 
                                        $date = strtotime(get_field('date_and_time'));
                                        $from = strtotime(get_field('time_start'));
                                        $until = strtotime(get_field('time_end'));
                                    ?>
                                    <p>
                                        <?php echo date_i18n('l', $date); ?><br>
                                        
                                        <?php if(ICL_LANGUAGE_CODE == 'de'): ?>
                                            <?php echo date_i18n('d. F Y', $date); ?><br>
                                        <?php else: ?>
                                            <?php echo date_i18n('d F Y', $date); ?><br>
                                        <?php endif; ?>

                                        <?php if(get_field('time_start')): ?>
                                        
                                            <?php echo date_i18n('H:i', $from); ?> 

                                            <?php if(get_field('time_end')): ?>
                                                &nbsp;-&nbsp;<?php echo date_i18n('H:i', $until); ?> 
                                            <?php endif; ?>
                                            
                                            <?php if(ICL_LANGUAGE_CODE == 'de'): ?>
                                                Uhr
                                            <?php endif; ?>

                                        <?php else: ?>

                                            <?php echo date_i18n('H:i', $date); ?>

                                            <?php if(ICL_LANGUAGE_CODE == 'de'): ?>
                                                Uhr
                                            <?php endif; ?>

                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                        </aside>
                    </a>
                </article>

                <script>
                
                    var reservation_event = '<?php echo get_the_title( $p->ID ) . ', ' . date_i18n('d. F Y', $date) . ' - ' . date_i18n('H:i', $date); ?>';
                
                </script>

                <br><br>
            
                <article class="g-production__article">
                    <div class="g-production__description g-one-col">
                        <?php the_content(); ?>
                    </div>
                </article>

            </section>

            <?php get_template_part( 'shapes' ); ?>

        </main>

<?php get_footer(); ?>