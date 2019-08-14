<header class="g-header">
    <nav class="g-nav">
        <button class="g-btn__mobile-nav" type="button" aria-label="Button für Navigation auf kleinen Bildschirmen">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <?php wp_nav_menu('main'); ?>
    </nav>
    <a href="<?php echo get_home_url(); ?>" aria-label="Zur Startseite" class="g-logo g-logo--small">
        <img src="<?php echo get_theme_file_uri( 'assets/img/logo.svg' ); ?>" alt="Grenouille Logo">
    </a>
</header>