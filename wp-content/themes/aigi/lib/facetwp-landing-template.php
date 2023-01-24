
<?php while ( have_posts() ): the_post(); ?>
    <?php
    $post_type = get_post_type( get_the_ID() );

    if($post_type == 'event') {


        $terms =  wp_get_post_terms( get_the_ID(), 'event_group');

        if ($terms[0]->slug == 'event' || $terms[0]->slug == 'webinar' || $terms[0]->slug == 'indigenous-governance-award') {
            include( get_stylesheet_directory() . '/template-parts/post-tiles/events-tile.php' );
        }
        if ($terms[0]->slug == 'masterclass') {
            include( get_stylesheet_directory() . '/template-parts/post-tiles/events-tile.php' );
        }
    } else if ($post_type == 'news') {

        include( get_stylesheet_directory() . '/template-parts/post-tiles/news-tile.php' );

    } else if ($post_type == 'resource') {
        include( get_stylesheet_directory() . '/template-parts/post-tiles/resource-tile.php' );

    } else if ($post_type == 'toolkit') {
        include( get_stylesheet_directory() . '/template-parts/post-tiles/toolkit-tile.php' );

    } else if ($post_type == 'case_studies') {
        include( get_stylesheet_directory() . '/template-parts/post-tiles/cstudies-tile.php' );

    } else if ($post_type == 'governance-stories') {
        include( get_stylesheet_directory() . '/template-parts/post-tiles/cstudies-tile.php' );

    } else if($post_type == 'people' || $post_type == 'post' || $post_type == 'page' || $post_type == 'partners') {
        continue;
    }

    ?>
<?php endwhile; ?>