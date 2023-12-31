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
                'footer'   => __( 'Footer', 'grenouille' ),
            ) );

            /**
             * Enable support for post thumbnails and featured images.
             */
            add_theme_support( 'post-thumbnails' );

            /**
             * Add Custom Image Sizes
             */
            add_image_size( 'event-preview', 900, 600, true);
            add_image_size( 'header-slideshow', 1280, 500 );
            add_image_size( 'event-header', 1920, 9999 );
            add_image_size( 'team-member', 378, 567 );
            add_image_size( 'downloads', 600, 600 );

            /**
             * Enqueue those pesky sheets and scripts
             */
            wp_enqueue_style( 'normalize', get_template_directory_uri() . '/assets/normalize.css', array(), '8.0.1', 'all');
            wp_enqueue_style( 'style', get_stylesheet_uri() );
            wp_enqueue_style( 'flickity', get_template_directory_uri() . '/assets/flickity.min.css', array(), '2.2.1', 'all');

            wp_deregister_script('jquery');
            wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);

            wp_enqueue_script( 'simpleParallax', get_template_directory_uri() . '/assets/simpleParallax.min.js', array(), '5.1.0', true);
            wp_enqueue_script( 'lottie', get_template_directory_uri() . '/assets/lottie.min.js', array(), '5.5.7', true);
            wp_enqueue_script( 'flickity', get_template_directory_uri() . '/assets/flickity.pkgd.min.js', array(), '2.2.1', true);
            wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/assets/jquery.fitvids.js', array(), '1.1', true);
            wp_enqueue_script( 'grenouille', get_template_directory_uri() . '/assets/grenouille.js', array(), '1.0', true); 
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
        register_rest_route( 'grenouille/v2', 'events',array(
            'methods'  => 'GET',
            'callback' => 'get_events_v2'
        ));
    });
      

    function get_events($request) {

        global $sitepress;
        $sitepress->switch_lang('fr');

        $events_raw = new WP_Query( array(
            'post_type' => 'Events',
            'posts_per_page' => -1,
            'meta_query' 		=> array(
                array(
                    'key'			=> 'date_and_time',
                    'compare'		=> '>=',
                    'value'			=> date('Y-m-d H:i:s'),
                    'type'			=> 'DATETIME'
                ),
            ),
            'order'				=> 'ASC',
            'orderby'			=> 'meta_value',
            'meta_key'			=> 'date_and_time',
            'meta_type'			=> 'DATE'
        ) );
        $events = [];

        if (empty($events_raw)) {
            return new WP_Error( 'no_events', 'no events found', array('status' => 404) );
        }

        while ( $events_raw->have_posts() ) {
            $events_raw->the_post();

            $p = get_field('production');
            $v = get_field('venue');
            $date = strtotime(get_field('date_and_time'));

            if($v->ID != 912 && $v->ID != 224){
                continue;
            }

            $event_exists = false;
            $event_title = get_the_title( $p->ID );

            if(get_field('override_language')) {
                $lang = get_field('override_language');
            } else {
                $lang = get_field('language', $p->ID);
            }

            if( in_array( 'de', $lang ) !== false && in_array( 'fr', $lang ) !== false) {
                $event_lang = 'fr/de';
            } else {
                if( in_array( 'de', $lang ) !== false) {
                    $event_lang = 'de';
                }
                if( in_array( 'fr', $lang ) !== false) {
                    $event_lang = 'fr';
                }
            }

            $date_status = '';
            if(get_field('sold')){
                $date_status = 'SOLDOUT';
            }
            if(get_field('canceled')){
                $date_status = 'CANCELED';
            }
            if(get_field('postponed')){
                $date_status = 'RESCHEDULDED';
            }

            foreach($events as $key => $evt){
                if($evt['event_title'] == $event_title && $evt['event_lang'] == $event_lang){
                    
                    $events[$key]['event_dates'][] = [
                        'start_date' => date_i18n('Y-m-d H:i', $date),
                        'date_status' => $date_status
                    ];

                    $event_exists = true;

                    break;
                }
            }

            if(!$event_exists){

                $events[] = [
                    'event_id' => get_the_ID(),
                    'event_title' => get_the_title( $p->ID ),
                    'event_lang' => $event_lang,
                    'subtitle' => get_field('subtitle', $p->ID),
                    'event_description' => get_the_content(null, false, $p->ID),
                    'event_dates' => [
                        [
                            'start_date' => date_i18n('Y-m-d H:i', $date),
                            'date_status' => $date_status
                        ]
                    ],
                    'event_categories' => ['TH'],
                    'event_status' => 'PUBLIC',
                    'event_canceled' => get_field('canceled'),
                    'event_postponed' => get_field('postponed'),
                    'image_url' => get_the_post_thumbnail_url( $p->ID, 'event-header' ),
                    'detail_url' => get_permalink( $p->ID ),
                    'venue_name' => get_the_title( $v->ID ),
                    'venue_address' => get_field('street', $v->ID ),
                    'venue_zip' => get_field('zip', $v->ID ),
                    'venue_city' => get_field('city', $v->ID )
                ];

            }
        }
    
        $response = new WP_REST_Response(array(
            'api_key' => 'CS-CFfm9zLTcY',
            'events'  => $events
        ));
        $response->set_status(200);
    
        return $response;
    }

    function get_events_v2($request) {

        global $sitepress;
        $sitepress->switch_lang('fr');

        $events_raw = new WP_Query( array(
            'post_type' => 'Events',
            'posts_per_page' => -1,
            'meta_query' 		=> array(
                array(
                    'key'			=> 'date_and_time',
                    'compare'		=> '>=',
                    'value'			=> date('Y-m-d H:i:s'),
                    'type'			=> 'DATETIME'
                ),
            ),
            'order'				=> 'ASC',
            'orderby'			=> 'meta_value',
            'meta_key'			=> 'date_and_time',
            'meta_type'			=> 'DATE'
        ) );
        $events = [];

        if (empty($events_raw)) {
            return new WP_Error( 'no_events', 'no events found', array('status' => 404) );
        }

        while ( $events_raw->have_posts() ) {
            $events_raw->the_post();
            
            if(get_field('for_school')){
                continue;
            }

            $p = get_field('production');
            $v = get_field('venue');
            $date = strtotime(get_field('date_and_time'));

            if($v->ID != 912 && $v->ID != 224){
                continue;
            }

            $event_exists = false;
            $event_title = get_the_title( $p->ID );

            if(get_field('override_language')) {
                $lang = get_field('override_language');
            } else {
                $lang = get_field('language', $p->ID);
            }

            if( in_array( 'de', $lang ) !== false && in_array( 'fr', $lang ) !== false) {
                $event_lang = 'fr/de';
            } else {
                if( in_array( 'de', $lang ) !== false) {
                    $event_lang = 'de';
                }
                if( in_array( 'fr', $lang ) !== false) {
                    $event_lang = 'fr';
                }
            }

            $date_status = '';
            if(get_field('sold')){
                $date_status = 'SOLDOUT';
            }
            if(get_field('canceled')){
                $date_status = 'CANCELED';
            }
            if(get_field('postponed')){
                $date_status = 'RESCHEDULDED';
            }

            foreach($events as $key => $evt){
                if($evt['event_title'] == $event_title && $evt['event_lang'] == $event_lang){
                    
                    $events[$key]['event_dates'][] = [
                        'start_date' => date_i18n('Y-m-d H:i', $date),
                        'date_status' => $date_status
                    ];

                    $event_exists = true;

                    break;
                }
            }

            if(!$event_exists){

                $event = [
                    'event_school' => get_field('for_school'),
                    'event_id' => get_the_ID(),
                    'event_title' => get_the_title( $p->ID ),
                    'event_lang' => $event_lang,
                    'event_subtitle' => get_field('subtitle', $p->ID),
                    'event_description' => get_the_content(null, false, $p->ID),
                    'event_duration' => get_field('duration', $p->ID),
                    'event_age' => get_field('age', $p->ID),
                    'event_dates' => [
                        [
                            'start_date' => date_i18n('Y-m-d H:i', $date),
                            'date_status' => $date_status
                        ]
                    ],
                    'event_categories' => ['TH'],
                    'event_status' => 'PUBLIC',
                    'image_url' => get_the_post_thumbnail_url( $p->ID, 'event-header' ),
                    'detail_url' => get_permalink( $p->ID ),
                    'venue_id' => $v->ID,
                    'venue_name' => get_the_title( $v->ID ),
                    'venue_address' => get_field('street', $v->ID ),
                    'venue_zip' => get_field('zip', $v->ID ),
                    'venue_city' => get_field('city', $v->ID )
                ];

                $p_d = icl_object_id($p->ID, 'productions', false, 'de');

                $event['event_title_d'] = get_the_title( $p_d );
                $event['event_subtitle_d'] = get_field('subtitle', $p_d);
                $event['event_description_d'] = get_the_content(null, false, $p_d);
                $event['detail_url_d'] = get_permalink( $p_d );
                $event['image_url_d'] = get_the_post_thumbnail_url( $p_d, 'event-header' );

                $reservation = false;
            
                if(!is_null(get_field('reservation_activated'))){
                    $reservation = get_field('reservation_activated');
                }

                if($reservation) {
                    if(get_field('reservation_extern') != ''){
                        $link_d = get_field('reservation_extern');
                        $link_f = $link_d;
                    } else {
                        $link_d = 'https://lagrenouille.ch/de/reservation?id=' . get_the_ID();
                        $link_f = 'https://lagrenouille.ch/fr/reservation?id=' . get_the_ID();
                    }
                }

                $event['booking_url_d'] = $link_d;
                $event['booking_url_f'] = $link_f;

                $events[] = $event;
            }
        }
    
        $response = new WP_REST_Response(array(
            'api_key' => 'CS-CFfm9zLTcY',
            'events'  => $events
        ));
        $response->set_status(200);
    
        return $response;
    }

	add_action('parse_query', 'pmg_ex_sort_posts');
	/**
	 * Hooked into `parse_query` this changes the orderby and order arguments of
	 * the query, forcing the post order on post type archives for `your_custom_pt`
	 * and a few taxonomies to follow the menu order.
	 *
	 * @param   object $q The WP_Query object.  This is passed by reference, you
	 *          don't have to return anything.
	 * @return  null
	 */
	function pmg_ex_sort_posts($q)
	{
		/*if(is_page_template('page-homepage.php')){
            $q->set('orderby', 'menu_order');
            $q->set('order', 'ASC');
        }*/
    }

    function filter_search($query) {
        if (!$query->is_admin && $query->is_search) {
            $query->set('post_type', array('post', 'page', 'productions'));
        }
        return $query;
    }
    add_filter('pre_get_posts', 'filter_search');

    /**
 * Like get_template_part() put lets you pass args to the template file
 * Args are available in the tempalte as $template_args array
 * @param string filepart
 * @param mixed wp_args style argument list
 */
function hm_get_template_part( $file, $template_args = array(), $cache_args = array() ) {
    $template_args = wp_parse_args( $template_args );
    $cache_args = wp_parse_args( $cache_args );
    if ( $cache_args ) {
        foreach ( $template_args as $key => $value ) {
            if ( is_scalar( $value ) || is_array( $value ) ) {
                $cache_args[$key] = $value;
            } else if ( is_object( $value ) && method_exists( $value, 'get_id' ) ) {
                $cache_args[$key] = call_user_method( 'get_id', $value );
            }
        }
        if ( ( $cache = wp_cache_get( $file, serialize( $cache_args ) ) ) !== false ) {
            if ( ! empty( $template_args['return'] ) )
                return $cache;
            echo $cache;
            return;
        }
    }
    $file_handle = $file;
    do_action( 'start_operation', 'hm_template_part::' . $file_handle );
    if ( file_exists( get_stylesheet_directory() . '/' . $file . '.php' ) )
        $file = get_stylesheet_directory() . '/' . $file . '.php';
    elseif ( file_exists( get_template_directory() . '/' . $file . '.php' ) )
        $file = get_template_directory() . '/' . $file . '.php';
    ob_start();
    $return = require( $file );
    $data = ob_get_clean();
    do_action( 'end_operation', 'hm_template_part::' . $file_handle );
    if ( $cache_args ) {
        wp_cache_set( $file, $data, serialize( $cache_args ), 3600 );
    }
    if ( ! empty( $template_args['return'] ) )
        if ( $return === false )
            return false;
        else
            return $data;
    echo $data;
}


?>