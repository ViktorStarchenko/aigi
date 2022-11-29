<?php
//Also in the document custom-post-types.php Topic taxonomy is included


add_action( 'init', 'register_cpt_governance_stories' );

function register_cpt_governance_stories() {

    $labels = array(
        'name' => _x( 'Governance Stories', 'governance-stories' ),
        'singular_name' => _x( 'Governance Stories', 'governance-stories' ),
        'add_new' => _x( 'Add Governance Stories', 'governance-stories' ),
        'add_new_item' => _x( 'Add New Governance Stories', 'governance-stories' ),
        'edit_item' => _x( 'Edit Governance Stories', 'governance-stories' ),
        'new_item' => _x( 'New Governance Stories', 'governance-stories' ),
        'view_item' => _x( 'View Governance Stories', 'governance-stories' ),
        'search_items' => _x( 'Search Governance Stories', 'governance-stories' ),
        'not_found' => _x( 'No Governance Stories found', 'governance-stories' ),
        'not_found_in_trash' => _x( 'No Governance Stories found in Trash', 'governance-stories' ),
        'parent_item_colon' => _x( 'Parent Governance Stories:', 'governance-stories' ),
        'menu_name' => _x( 'Governance Stories', 'governance-stories' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,

        'supports' => array( 'title', 'editor', 'custom-fields', 'thumbnail', 'excerpt' ),
        'taxonomies' => array('news_categories', 'post_tag', 'content_tags'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 10,

        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'governance-stories', $args );
}

