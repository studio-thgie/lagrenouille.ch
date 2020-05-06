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
</head>

<body>

    <div class="g-wrapper">

        <?php get_template_part( 'nav' ); ?>