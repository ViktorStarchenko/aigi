<?php

if (function_exists('acf_register_block_custom_accordion')) {
    add_action('acf/init', 'acf_register_block_custom_accordion');
}

function acf_register_block_custom_accordion() {
    acf_register_block_type(
        array(
            'name' => 'custom accordion',
            'title' => __('Custom Accordion'),
            'description' => __('Custom Accordion'),
            'render_template' => 'template-parts/custom-gutenberg/gutenberg-custom-accordion.php',
            'icon' => 'editor-paste-text',
            'keywords' => array('hero_block', 'product', 'post', 'page'),
        )
    );
}





