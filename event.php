<article class="g-production-preview__list-item clear">
    <a href="<?php echo get_permalink( $p->ID ); ?>" class="g-production-preview__link">
        <header>
            <div class="g-production-preview__meta-wrapper">
                <?php if ( get_field('age', $p->ID ) ) : ?>
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
            </div>

            <h2><?php echo get_the_title( $p->ID ); ?></h2>
            <p class="g-production-subtitle"><?php the_field('subtitle', $p->ID); ?></p>
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
                    <?php the_field('duration', $p->ID); ?>'
                </span>
            <?php endif; ?>
            <div class="g-production-preview__list-item__school" data-effect="random-rotate">
                <div>
                    <h3><?php if(get_field('for_school')): ?>Schulvorstellung<?php else: ?>&nbsp;<?php endif; ?></h3>
                    <?php 
                        $date = strtotime(get_field('date_and_time'));
                    ?>
                    <p>
                        <?php echo date_i18n('l', $date); ?><br>
                        <?php echo date_i18n('d. F Y', $date); ?><br>
                        <?php echo date_i18n('H:i', $date); ?> Uhr
                    </p>
                </div>
            </div>
        </aside>
    </a>
</article>