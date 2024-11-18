<?php

// Register Custom Post Type: Recipe
function educast_blocks_register_recipe_cpt()
{
    $labels = array(
        'name'                  => _x('Recipes', 'Post Type General Name', 'educast-blocks'),
        'singular_name'         => _x('Recipe', 'Post Type Singular Name', 'educast-blocks'),
        'menu_name'             => __('Recipes', 'educast-blocks'),
        'name_admin_bar'        => __('Recipe', 'educast-blocks'),
        'archives'              => __('Recipe Archives', 'educast-blocks'),
        'attributes'            => __('Recipe Attributes', 'educast-blocks'),
        'parent_item_colon'     => __('Parent Recipe:', 'educast-blocks'),
        'all_items'             => __('All Recipes', 'educast-blocks'),
        'add_new_item'          => __('Add New Recipe', 'educast-blocks'),
        'add_new'               => __('Add New', 'educast-blocks'),
        'new_item'              => __('New Recipe', 'educast-blocks'),
        'edit_item'             => __('Edit Recipe', 'educast-blocks'),
        'update_item'           => __('Update Recipe', 'educast-blocks'),
        'view_item'             => __('View Recipe', 'educast-blocks'),
        'view_items'            => __('View Recipes', 'educast-blocks'),
        'search_items'          => __('Search Recipe', 'educast-blocks'),
        'not_found'             => __('Not found', 'educast-blocks'),
        'not_found_in_trash'    => __('Not found in Trash', 'educast-blocks'),
        'featured_image'        => __('Featured Image', 'educast-blocks'),
        'set_featured_image'    => __('Set featured image', 'educast-blocks'),
        'remove_featured_image' => __('Remove featured image', 'educast-blocks'),
        'use_featured_image'    => __('Use as featured image', 'educast-blocks'),
        'insert_into_item'      => __('Insert into recipe', 'educast-blocks'),
        'uploaded_to_this_item' => __('Uploaded to this recipe', 'educast-blocks'),
        'items_list'            => __('Recipes list', 'educast-blocks'),
        'items_list_navigation' => __('Recipes list navigation', 'educast-blocks'),
        'filter_items_list'     => __('Filter recipes list', 'educast-blocks'),
    );

    $args = array(
        'label'                 => __('Recipe', 'educast-blocks'),
        'description'           => __('A custom post type for recipes', 'educast-blocks'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'comments'),
        'taxonomies'            => array('category', 'post_tag'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-food',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true, // Enable for Gutenberg support
    );

    register_post_type('recipe', $args);
}

add_action('init', 'educast_blocks_register_recipe_cpt');


register_activation_hook(__FILE__, function () {
    educast_blocks_register_recipe_cpt(); // Ensure the CPT is registered first
    flush_rewrite_rules();
});
