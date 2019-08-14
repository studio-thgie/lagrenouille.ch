<?php

    if ( ! isset( $content_width ) )
    $content_width = 1280;
 
    if ( ! function_exists( 'grenouille_setup' ) ) :
        function grenouille_setup() {
        
            /**
             * Make theme available for translation.
             * Translations can be placed in the /languages/ directory.
             */
            load_theme_textdomain( 'grenouille', get_template_directory() . '/languages' );
        
            /**
             * Add support for two custom navigation menus.
             */
            register_nav_menus( array(
                'main'   => __( 'Main Menu', 'grenouille' ),
            ) );

            /**
             * Enable support for post thumbnails and featured images.
             */
            add_theme_support( 'post-thumbnails' );

            /**
             * Add Custom Image Sizes
             */
            add_image_size( 'event-preview', 900, 9999 );
            add_image_size( 'event-header', 1920, 9999 );

            /**
             * Enqueue those pesky sheets and scripts
             */
            wp_enqueue_style( 'normalize', get_template_directory_uri() . '/assets/normalize.css', array(), '8.0.1', 'all');
            wp_enqueue_style( 'style', get_stylesheet_uri() );
            wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/grenouille.js', array ( 'jquery' ), 1.0, true);
        }
    endif;
    add_action( 'after_setup_theme', 'grenouille_setup' );

    /**
     * Flus JSON generation
     */
    add_action('rest_api_init', function () {
    register_rest_route( 'grenouille/v1', 'events',array(
            'methods'  => 'GET',
            'callback' => 'get_events'
        ));
    });
      

    function get_events($request) {

        $events_raw = new WP_Query( array(
            'post_type' => 'Events',
            'posts_per_page' => -1,
            'meta_key'	=> 'start_date',
            'orderby'	=> 'meta_value_num',
            'order'		=> 'ASC'
            )
        );
        $events = [];

        if (empty($events_raw)) {
            return new WP_Error( 'no_events', 'no events found', array('status' => 404) );
        }

        while ( $events_raw->have_posts() ) {
            $events_raw->the_post();
            $events[] = [
                'title' => get_the_title(),
                'subtitle' => get_field('subtitle'),
                'start_date' => get_field('start_date'),
                'end_date' => get_field('end_date'),
            ];
        }
    
        $response = new WP_REST_Response($events);
        $response->set_status(200);
    
        return $response;
    }
    



?>