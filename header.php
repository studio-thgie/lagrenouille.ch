<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?php the_title(); ?> - <?php bloginfo('name'); ?></title>

    <?php wp_head(); ?>

    <?php

        $colors = ['W', 'R', 'G', 'V'];
        $GLOBALS['color_scheme'] = $colors[array_rand($colors)]; 

    ?>

    <link rel="stylesheet" href="<?php echo get_theme_file_uri( 'assets/colors/'.$GLOBALS['color_scheme'].'.css' ); ?>">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-161843300-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-161843300-1');
    </script>

    <link rel="apple-touch-icon" sizes="180x180" href="<?= get_template_directory_uri(); ?>/assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= get_template_directory_uri(); ?>/assets/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= get_template_directory_uri(); ?>/assets/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?= get_template_directory_uri(); ?>/assets/favicons/site.webmanifest">
    <link rel="mask-icon" href="<?= get_template_directory_uri(); ?>/assets/favicons/safari-pinned-tab.svg" color="#ffffff">
    <link rel="shortcut icon" href="<?= get_template_directory_uri(); ?>/assets/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="msapplication-config" content="<?= get_template_directory_uri(); ?>/assets/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">


</head>

<body>

    <div class="g-wrapper">

        <?php get_template_part( 'nav' ); ?>