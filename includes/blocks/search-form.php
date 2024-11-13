<?php

function educast_search_form_render_cb($attributes)
{
    $formColor = esc_attr($attributes['formColor']);
    $placeholder = esc_attr($attributes['placeholder']);


    ob_start();
    ?>

    <form action="<?php echo esc_url(home_url()) ?>"
        class="bg-white flex px-1 py-1 rounded-full border border-blue-500 overflow-hidden max-w-md mx-auto font-[sans-serif] mb-5"
        style="border-color: <?php echo $formColor; ?>">
        <input
            type="text"
            placeholder="<?php echo $placeholder; ?>"
            class="w-full outline-none bg-white pl-4 text-sm"
            name="s"
            value="<?php echo esc_html(the_search_query()); ?>" />
        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 transition-all text-white text-sm rounded-full px-5 py-2.5"
            style="word-break: initial; background-color: <?php echo $formColor; ?>">

            <span><?php esc_html_e('Search', 'educast-blocks') ?></span>
        </button>
    </form>


<?php

        $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
