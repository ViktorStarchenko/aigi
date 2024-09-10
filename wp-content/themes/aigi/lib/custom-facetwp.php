<?php


if (!is_admin()) {

    $current_slug = $_SERVER['REQUEST_URI'];

    $current_slug = wp_make_link_relative($current_slug);
    $current_slug = stripslashes(str_replace('/', '', $current_slug));
    $post = get_page_by_path($current_slug);




    add_filter( 'facetwp_query_args', function( $query_args, $class ) {

        /*** Add event, news, resource, toolkit to query if the shortcode template is named "search_page_result" ***/
        if ( 'search_page_result' == $class->ajax_params['template'] ) {
            $query_args['post_type'] = ['event', 'news', 'resource', 'toolkit'];
        }
        /*** Add event, news, resource, toolkit, case_studies to query if the shortcode template is named "landing_page_result" ***/
        if ( 'landing_page_result' == $class->ajax_params['template'] ) {
            $query_args['post_type'] = ['event', 'news', 'resource', 'toolkit', 'case_studies', 'governance-stories'];
        }
        return $query_args;
    }, 10, 2 );



    if ('templates/global-search.php' == get_page_template_slug($post)) {

    }


    if ('templates/landing-page.php' == get_page_template_slug($post) || 'templates/landing-page-big-map.php' == get_page_template_slug($post)) {

        /*** Set post type for landing page filter ***/
        add_filter( 'facetwp_preload_url_vars', function( $url_vars ) {

            $post = get_page_by_path(FWP()->helper->get_uri());

            $post_type = get_field('landing_page', $post->ID )['post_type'];
            $url_vars['post_type'] = [$post_type];

            if ( $post_type == 'event' ) {
                $event_group = get_field('landing_page', $post->ID)['event_term'];
                if (!empty($event_group)) {
//                    $url_vars['events_group'] = [$event_group->slug];
                    $url_vars['events_group'] = ['event', 'masterclass'];
                }

                if ( empty( $url_vars['landing_event_type'] ) ) {
//                    $url_vars['landing_event_type'] = [ 'past-events' ];
//                    $url_vars['landing_event_type'] = [ 'upcoming-events' ];
                }
            } else if ( $post_type == 'news' ) {
                $news_group = get_field('landing_page', $post->ID)['news_term'];
                if (!empty($news_group)) {
                    $url_vars['news_group'] = [$news_group->slug];
                }


            }
            return $url_vars;

        } );

    }


}

add_filter( 'facetwp_indexer_query_args', function( $args ) {
    unset ( $args['post_type']['case_studies'] ); // Prevent this post type from being indexed
    unset ( $args['post_type']['post'] ); // Prevent this post type from being indexed
    unset ( $args['post_type']['partners'] ); // Prevent this post type from being indexed
    unset ( $args['post_type']['people'] ); // Prevent this post type from being indexed
    unset ( $args['post_type']['aigi_staff'] ); // Prevent this post type from being indexed
    unset ( $args['post_type']['author'] ); // Prevent this post type from being indexed
    return $args;
});

/*
Plugin Name: FacetWP Schedule Indexer
Plugin URI: https://facetwp.com/
Description: Runs indexer periodically by cron
Version: 1.0
Author: FacetWP, LLC
*/

add_action( 'fwp_scheduled_index', 'fwp_scheduled_index' );
function fwp_scheduled_index() {
    FWP()->indexer->index();
}

register_activation_hook( __FILE__, 'fwp_schedule_indexer_activation' );
function fwp_schedule_indexer_activation() {
    if ( ! wp_next_scheduled( 'fwp_scheduled_index' ) ) {
        wp_schedule_event( time(), 'hourly', 'fwp_scheduled_index' );
    }
}

//strtotime('16:20:00')
register_deactivation_hook( __FILE__, 'fwp_schedule_indexer_deactivation' );
function fwp_schedule_indexer_deactivation() {
    wp_clear_scheduled_hook( 'fwp_scheduled_index' );
}

//var_dump(current_time('H:i:s'));



add_filter( 'cron_schedules', 'wpshout_add_cron_interval' );
function wpshout_add_cron_interval( $schedules ) {
    $schedules['everyminute'] = array(
        'interval'  => 60, // time in seconds
        'display'   => 'Every Minute'
    );
    return $schedules;
}
wp_schedule_event( time(), 'everyminute', 'fwp_scheduled_index' );

//Map type
add_filter( 'facetwp_map_proximity_marker_args', '__return_false' );

add_filter( 'facetwp_map_init_args', function ( $args ) {
    $args['init']['mapTypeId'] = 'satellite'; // valid options are: roadmap, satellite, hybrid, terrain
    return $args;
});

//map pin
add_filter( 'facetwp_map_marker_args', function( $args, $post_id ) {
    $args['icon'] = get_stylesheet_directory_uri() . '/assets/images/custom-marker-1.svg'; // set your theme image path here
    return $args;
}, 10, 2 );

//Set marker cluster to zoom in when clicking on it
//Customize the marker cluster images
//Cluser Using cssClass
add_filter( 'facetwp_map_init_args', function( $args ) {

//    dd(FWP());

    $args['init']['mapTypeControl']    = false; // roadmap / satellite toggle
    $args['init']['streetViewControl'] = false; // street view / yellow man icon
    $args['init']['fullscreenControl'] = false; // full screen icon

    if ( isset( $args['config']['cluster'] ) ) {
        $args['config']['cluster']['imagePath']      = get_stylesheet_directory_uri() . '/assets/img/googlemaps/m'; // set your own image directory in your theme here. Note: the /m at the end is not a directory, but the first part of the image names.
        $args['config']['cluster']['imageExtension'] = 'svg'; // 'svg' will work too

        $args['config']['cluster']['zoomOnClick'] = true; // default: false
        $args['config']['cluster']['maxZoom'] = 14; // default: 15. Level must be between 1 and 20.
        $args['config']['cluster']['minimumClusterSize'] = 2; // default: 2
    }

    $args['config']['spiderfy']['markersWontMove'] = false;
    echo '<br>';
    return $args;
} );

//Customize cluster click behavior
add_action( 'wp_footer', function() {
    ?>
    <script type="text/javascript">
        (function($) {

            ClusterIcon.prototype.triggerClusterClick = function() {


                var markerClusterer = this.cluster_.getMarkerClusterer();

                // Trigger the clusterclick event
                google.maps.event.trigger(markerClusterer, 'clusterclick', this.cluster_);
                var markers = this.cluster_.getMarkers();
                //
                // Your code here. Two examples:
//              Example 2: Put all markers in the clicked cluster into an object
//                 markers.each((marker) => {
//                     console.log(marker);
//                 })
                console.log(this.cluster_.getMarkers())
                // Example 1: Zoom in to bounds of cluster. Does the same as when zoomOnClick is set to true
                this.map_.fitBounds(this.cluster_.getBounds());


            }

        })(jQuery);
    </script>

    <script>
        (function($) {
            document.addEventListener('facetwp-loaded', function() {
                if ('undefined' === typeof FWP_MAP) {
                    return;
                }
                var filterButton = $(".facetwp-map-filtering");
                if (!filterButton.hasClass('enabled') && 'undefined' == typeof FWP_MAP.enableFiltering) {
                    filterButton.text(FWP_JSON['map']['resetText']);
                    FWP_MAP.is_filtering = true;
                    filterButton.addClass('enabled');
                    FWP_MAP.enableFiltering = true;
                }
            });
        })(fUtil);
    </script>

    <script>
        (function($) {
            $(document).on('click', '.post-item', function(e) {
                e.preventDefault(); // Necessary if '.post-item' is an <a> tag and you don't want it to open the post page itself.
                var postid = $(this).attr('data-id');
                var marker = FWP_MAP.get_post_markers(postid);
                $.each( marker, function( key, value ) {

                    FWP_MAP.map.setCenter({
                        lat: value.position.lat(),
                        lng: value.position.lng()
                    });
                    FWP_MAP.is_zooming = true; // Needed if you are using the "Enable map filtering" button
                    FWP_MAP.map.setZoom(5); // Set a zoom level between 1 and 20. Make sure it is higher than the marker clusterer's bottom limit.

                    // google.maps.event.trigger(value, 'click'); // If you don't have spiderfied markers
                    google.maps.event.trigger(value, 'spider_click'); // If you have spiderfied markers. Will also work if you don't have spiderfied markers.

                });
            });
        })(jQuery);
    </script>
    <?php
}, 100 );






