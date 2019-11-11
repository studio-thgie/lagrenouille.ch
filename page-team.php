<?php

    /*

    Template Name: Team
    
    */

    get_header();

?>

        <main class="g-team">

        <?php
        
            global $sitepress;
            $loop = new WP_Query( array(
                'post_type' => 'Member',
                'posts_per_page' => -1
            ) );

        ?>

            <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
            
                <div class="g-team-member">
                    <?php the_post_thumbnail( 'event-preview', array( 'class'  => 'team-member' ) ); ?>
                    <div class="g-team-member__meta-wrapper">
                        <p class="g-team-member__meta">
                            <?php if(get_field('title')): ?><span class="g-team-member__meta-title">
                                <?php the_field('title'); ?>
                            </span><?php endif; ?>
                            <?php if(get_field('function')): ?><span class="g-team-member__meta-function">
                                <?php the_field('function'); ?>
                            </span><?php endif; ?>
                            <?php if(get_field('email')): ?><span class="g-team-member__meta-email">
                                <a href="mailto:<?php the_field('email'); ?>"><?php the_field('email'); ?></a>
                            </span><?php endif; ?>
                            <?php if(get_field('phone')): ?><span class="g-team-member__meta-phone">
                                <a href="tel:<?php the_field('phone'); ?>"><?php the_field('phone'); ?></a>
                            </span><?php endif; ?>
                        </p>
                        <h2><?php the_title(); ?></h2>
                    </div>
                </div>

            <?php endwhile; ?>

            <?php get_template_part( 'shapes' ); ?>

        </main>

<?php get_footer(); ?>