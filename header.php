<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <!-- <base href="https://www.theatredelagrenouille.ch/"> -->
    <title><?php the_title(); ?> - <?php bloginfo('name'); ?></title>

	<!-- <link rel="alternate" hreflang="de-CH" href="https://www.theatredelagrenouille.ch/" />
	<link rel="alternate" hreflang="fr-CH" href="https://www.theatredelagrenouille.ch/fr/" />

    <meta property="og:url" content="https://www.theatredelagrenouille.ch/" />
    <meta property="og:title" content="Produktionen – Théâtre de la Grenouille – zweisprachiges Kreationstheater für junges Publikum" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://www.theatredelagrenouille.ch/assets/Productions/RegenSturm/_resampled/CroppedFocusedImageWzEyMDAsNjMwLCJ5Iiw3OV0/goutte-607.jpg" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:locale" content="de_CH" />

    <link rel="apple-touch-icon" sizes="180x180" href="/themes/grenouille/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/themes/grenouille/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/themes/grenouille/icons/favicon-16x16.png">
    <link rel="manifest" href="/themes/grenouille/icons/manifest.json">
    <link rel="mask-icon" href="/themes/grenouille/icons/safari-pinned-tab.svg" color="#000000">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="msapplication-config" content="/themes/grenouille/icons/browserconfig.xml">
    <meta name="theme-color" content="#c7ffc7"> -->

    <?php wp_head(); ?>

    <?php

        $GLOBALS['color_scheme'] = array_rand(['R', 'G', 'V']); 

    ?>

    <link rel="stylesheet" href="<?php echo get_theme_file_uri( 'assets/colors/'.$GLOBALS['color_scheme'].'.css' ); ?>">
</head>

<body>

    <div class="g-wrapper">

        <?php get_template_part( 'nav' ); ?>