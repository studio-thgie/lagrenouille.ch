<header class="g-header">
    <nav class="g-nav">
        <button class="g-btn__mobile-nav" type="button" aria-label="Button für Navigation auf kleinen Bildschirmen">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <?php wp_nav_menu('main'); ?>
    </nav>
    <div class="g-logo-wrapper">
        <a href="<?php echo get_home_url(); ?>" aria-label="Zur Startseite" class="g-logo">
            <img src="<?php echo get_theme_file_uri( 'assets/img/logo.svg' ); ?>" alt="Grenouille Logo" class="g-logo__image">
            <img src="<?php echo get_theme_file_uri( 'assets/img/logo_white.svg' ); ?>" alt="Alternatives Grenouille Logo" class="g-logo__image--alt">
        </a>
        <?php if(!is_page_template('page-homepage.php')): ?>
            <h1 class="g-link--large" data-effect="random-rotate"><?php the_title(); ?></h1>
        <?php endif; ?>
    </div> 
    <?php if ( get_field('cta_link') ) : ?><a href="<?php the_field('cta_link') ?>" aria-label="<?php the_field('cta_label') ?>" class="g-header__cta"><?php endif; ?>
        <?php if ( get_field('cta_grafic') ) : ?>

            <?php $cta = $image = get_field('cta_grafic'); ?>

            <img src="<?php echo $cta['url']; ?>" alt="<?php echo $cta['alt']; ?>" data-effect="random-rotate">
        <?php endif; ?>
        <?php if ( get_field('cta_link') ) : ?></a><?php endif; ?>

</header>

<ul aria-label="Sprachwahl" class="g-lang-change">
    <?php foreach(icl_get_languages() as $lang): ?>
        <li class="g-lang-change__item <?php if($lang['active']){ echo 'g-lang-change__item--active'; } ?>" data-effect="random-rotate"><a href="<?php echo $lang['url']; ?>"><?php echo $lang['language_code']; ?></a></li>
    <?php endforeach; ?>
</ul>