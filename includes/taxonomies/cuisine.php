<?php

// Register the Cuisine Taxonomy
function educast_blocks_register_taxonomy()
{
    register_taxonomy('cuisine', 'recipe', [
        'labels' => [
            'name'              => _x('Cuisines', 'taxonomy general name', 'educast-blocks'),
            'singular_name'     => _x('Cuisine', 'taxonomy singular name', 'educast-blocks'),
            'search_items'      => __('Search Cuisines', 'educast-blocks'),
            'all_items'         => __('All Cuisines', 'educast-blocks'),
            'parent_item'       => __('Parent Cuisine', 'educast-blocks'),
            'parent_item_colon' => __('Parent Cuisine:', 'educast-blocks'),
            'edit_item'         => __('Edit Cuisine', 'educast-blocks'),
            'update_item'       => __('Update Cuisine', 'educast-blocks'),
            'add_new_item'      => __('Add New Cuisine', 'educast-blocks'),
            'new_item_name'     => __('New Cuisine Name', 'educast-blocks'),
            'menu_name'         => __('Cuisines', 'educast-blocks'),
        ],
        'hierarchical' => true,
        'public'       => true,
        'show_ui'      => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'rewrite'      => ['slug' => 'cuisine'],
    ]);
}
add_action('init', 'educast_blocks_register_taxonomy');

// Add custom URL field to the "Add New Cuisine" form
function educast_blocks_add_cuisine_meta_field_add_new()
{
?>
    <div class="form-field">
        <label for="more_info_url"><?php _e('More Info URL', 'educast-blocks'); ?></label>
        <input type="url" name="more_info_url" id="more_info_url" value="">
        <p><?php _e('Enter a URL with more information about this cuisine.', 'educast-blocks'); ?></p>
    </div>
<?php
}
add_action('cuisine_add_form_fields', 'educast_blocks_add_cuisine_meta_field_add_new');

// Add custom URL field to the "Edit Cuisine" form
function educast_blocks_add_cuisine_meta_field_edit($term)
{
    // Initialize value
    $value = get_term_meta($term->term_id, 'more_info_url', true);

?>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="more_info_url"><?php _e('More Info URL', 'educast-blocks'); ?></label>
        </th>
        <td>
            <input type="url" name="more_info_url" id="more_info_url" value="<?php echo esc_url($value); ?>">
            <p class="description"><?php _e('Enter a URL with more information about this cuisine.', 'educast-blocks'); ?></p>
        </td>
    </tr>
<?php
}
add_action('cuisine_edit_form_fields', 'educast_blocks_add_cuisine_meta_field_edit');

// Save or update the "More Info URL" when a term is created or updated
function educast_blocks_save_or_update_cuisine_meta_field($term_id)
{
    // Early return if 'more_info_url' is not set in the POST request
    if (empty($_POST['more_info_url'])) {
        return;
    }

    // Sanitize the URL input
    $value = sanitize_url($_POST['more_info_url']);

    // Check if the term meta exists using get_term_meta
    if (get_term_meta($term_id, 'more_info_url', true)) {
        // If it exists, update the meta
        update_term_meta($term_id, 'more_info_url', $value);
    } else {
        // If it does not exist, add the term meta
        add_term_meta($term_id, 'more_info_url', $value, true);
    }
}
add_action('create_cuisine', 'educast_blocks_save_or_update_cuisine_meta_field');
add_action('edited_cuisine', 'educast_blocks_save_or_update_cuisine_meta_field'); // For updating

?>
