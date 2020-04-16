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
            add_image_size( 'event-preview', 900, 9999 );
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

            $events[] = [
                'event_id' => get_the_ID(),
                'event_title' => get_the_title( $p->ID ),
                'subtitle' => get_field('subtitle', $p->ID),
				'event_description' => get_the_content(null, false, $p->ID),
                'event_dates' => [
					[
						'start_date' => date_i18n('Y-m-d H:i', $date)
					]
                ],
                'event_categories' => ['TH'],
                'event_status' => 'PUBLIC',
                'image_url' => get_the_post_thumbnail_url( $p->ID, 'event-header' ),
                'detail_url' => get_permalink( $p->ID ),
                'venue_name' => get_the_title( $v->ID ),
                'venue_address' => get_field('street', $v->ID ),
                'venue_zip' => get_field('zip', $v->ID ),
                'venue_city' => get_field('city', $v->ID )
            ];
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
		if(is_page_template('page-homepage.php')){
            $q->set('orderby', 'menu_order');
            $q->set('order', 'ASC');
        }
    }

    function filter_search($query) {
        if (!$query->is_admin && $query->is_search) {
            $query->set('post_type', array('post', 'page', 'productions'));
        }
        return $query;
    }
    add_filter('pre_get_posts', 'filter_search');


?>