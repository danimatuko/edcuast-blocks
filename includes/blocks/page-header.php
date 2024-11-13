<?php

function educast_page_header_render_cb($atts)
{
    $heading = isset($atts['content']) ? esc_html($atts['content']) : '';

    if (!empty($atts['showCategory'])) {
        $heading = get_the_archive_title();
    }

    ob_start(); // Start output buffering
    ?>

    <h1 class="text-4xl text-white text-center py-5 bg-gray-700 mb-5">
        <?php echo $heading; ?>
    </h1>

<?php
        return ob_get_clean(); // Return and clear the buffered output
}
