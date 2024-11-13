<?php

// Register blocks with render callbacks
function educast_blocks_register_blocks()
{
    // Define block configurations
    $blocks = [
        ['name'                   => 'fancy-header'],
        [
            'name'                => 'page-header',
            'options'             => [
                'render_callback' => 'educast_page_header_render_cb',
            ],
        ],
        [
            'name'                => 'search-form',
            'options'             => [
                'render_callback' => 'educast_search_form_render_cb',
            ],
        ],
        [
            'name'                => 'header-tools',
            'options'             => [
                'render_callback' => 'educast_header_tools_render_cb',
            ],
        ],
        [
            'name'                => 'auth-modal',
            'options'             => [
                'render_callback' => 'educast_auth_modal_render_cb',
            ],
        ],
    ];

    // Loop through each block and register it
    foreach ($blocks as $block) {
        register_block_type(
            EDUCAST_PLUGIN_DIR . 'build/blocks/' . $block['name'],
            isset($block['options']) ? $block['options'] : []
        );
    }
}

// Hook the block registration function to `init`
add_action('init', 'educast_blocks_register_blocks');
