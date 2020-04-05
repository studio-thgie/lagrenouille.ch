<?php

    /*

    Template Name: Espace Pro Details
    
    */

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

                <div class="g-production__description">
                    <?php the_content(); ?>
                </div>

                <div class="g-espace-downloads">
                    <?php
                        if( have_rows('categories') ):
                            while ( have_rows('categories') ) : the_row();
                    ?>
                        <div class="g-espace-downloads-category">
                            <h3><?php the_sub_field('title'); ?></h3>
                            
                            <?php
								if(get_sub_field('preview')){
									$preview = true;
								} else {
									$preview = false;
								}
							?>

                            <?php
                                if( have_rows('files') ):
                                    while ( have_rows('files') ) : the_row();
                            ?>
                                <a class="g-espace-downloads-file<?php if($preview): ?> g-espace-downloads-preview<?php endif; ?>" href="<?php echo get_sub_field('file')['url'] ?>" target="_blank">
									<?php if($preview): ?>
										<img src="<?php echo get_sub_field('file')['sizes']['event-preview']; ?>" class="g-espace-downloads-file-preview"/>
									<?php endif; ?>
                                    <span><?php the_sub_field('title'); ?></span>
                                    <img src="<?php echo get_theme_file_uri( 'assets/img/svg/download_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Fold block"  class="g-espace-downloads-icon">
                                </a>
                                <?php ; ?>
                            <?php
                                    endwhile; 
                                endif; 
                            ?>
                        </div>
                    <?php 
                            endwhile;
                        endif;
                    ?>
                </div>

            </article>

            <?php get_template_part( 'shapes' ); ?>
            
        </main>

<?php get_footer(); ?>