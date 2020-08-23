<?php if( in_array( 'de', $lang ) !== false && in_array( 'fr', $lang ) !== false): ?>
    <img class="g-production__meta_lang--bi" src="<?php echo get_theme_file_uri( 'assets/img/svg/DEFR_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Produktion bilingues"/>
<?php else if( in_array( 'ded', $lang ) !== false): ?>
    <img class="g-production__meta_lang--ded" src="<?php echo get_theme_file_uri( 'assets/img/svg/Dialekt_'.$GLOBALS['color_scheme'].'.svg' ); ?>" alt="Produktion bilingues"/>
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