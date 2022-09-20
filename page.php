<?php

    get_header();

?>

        <main>
            <article class="g-production__article">
                <header>
                    <h1><?php the_title(); ?></h1>
                    <p><?php the_field('subtitle'); ?></p>
                </header>

                <?php if(get_field('header_slideshow')): ?>
                    <ul class="g-production__slideshow">
                    <?php $i = 0; foreach(get_field('header_slideshow') as $key => $image): $i++; ?>
                        <li>
                            <a href="#slide<?php echo $i; ?>">
                                <img src="<?php echo $image['sizes']['header-slideshow']; ?>" alt="<?php echo $image['alt']; ?>">
                            </a>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                <?php else: ?>
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
                <?php endif; ?>

                <div class="g-production__description <?php if(get_field('two_columns')): ?>two-columns<?php endif; ?>">
                    <?php the_content(); ?>
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
                        <div class="production__additional-block__content <?php if(get_sub_field('foldable')): ?>production__additional-block__content--folded<?php endif; ?> <?php if(get_sub_field('two_columns')): ?>two-columns<?php endif; ?>">
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