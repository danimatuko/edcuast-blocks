<?php


function educast_blocks_rest_api_init()
{
    register_rest_route('edb/v1', '/signup', [
        'methods' => 'POST',
        'callback' => 'educast_blocks_signup',
        'permission_callback' => '__return_true'
    ]);


    register_rest_route('edb/v1', '/signin', [
        'methods' => 'POST',
        'callback' => 'educast_blocks_signin',
        'permission_callback' => '__return_true'
    ]);
}

add_action('rest_api_init', 'educast_blocks_rest_api_init');
