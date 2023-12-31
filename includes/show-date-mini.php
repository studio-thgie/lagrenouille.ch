<?php

    $p = get_field('production');

?>
<?php if(get_field('for_school')): ?>
    <img src="<?php echo get_theme_file_uri( 'assets/img/svg/School_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Fold block">
<?php endif; ?>
<?php if(false): ?>
    <?php if(get_field('event_category', $p->ID)): ?>
        <img src="<?php echo get_theme_file_uri( 'assets/img/svg/'.get_field('event_category', $p->ID).'_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Kategorie">
    <?php endif; ?>
<?php endif; ?>

<?php 
    $date = strtotime(get_field('date_and_time'));
    $from = strtotime(get_field('time_start'));
    $until = strtotime(get_field('time_end'));
?>
<p>
    <span class="g-next-events__item-date">
        <?php if(ICL_LANGUAGE_CODE == 'de'): ?>
            <?php echo date_i18n('d.m.Y', $date); ?>
        <?php else: ?>
            <?php echo date_i18n('d.m.Y', $date); ?>
        <?php endif; ?>
    </span>

    <span class="g-next-events__item-time">

        <!-- <span><?php echo date_i18n('l', $date); ?></span> -->

        <?php if(get_field('time_start')): ?>
        
            <span>

                <?php echo date_i18n('H:i', $from); ?> 

                <?php if(get_field('time_end')): ?>
                    &nbsp;-&nbsp;<?php echo date_i18n('H:i', $until); ?> 
                <?php endif; ?>
                
                <?php if(ICL_LANGUAGE_CODE == 'de'): ?>
                    Uhr
                <?php endif; ?>

            </span>

        <?php else: ?>

            <span>

                <?php echo date_i18n('H:i', $date); ?>

                <?php if(ICL_LANGUAGE_CODE == 'de'): ?>
                    Uhr
                <?php endif; ?>

            </span>

        <?php endif; ?>

    </span>

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
        <span class="g-programme__item-reservation"><?php _e('sold', 'grenouille') ?></span>
    <?php endif; ?>

</p>