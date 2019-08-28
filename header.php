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
</head>

<body>

    <div class="g-wrapper">

        <?php get_template_part( 'nav' ); ?>