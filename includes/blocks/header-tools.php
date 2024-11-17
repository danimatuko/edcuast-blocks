<?php

function educast_header_tools_render_cb($attributres)
{
    if (!$attributres['showAuth']) {
        return;
    }

    $user = wp_get_current_user();
    $name = $user->exists() ? $user->user_login : 'Sign in';

    ob_start();
?>
    <div class="wp-block-udemy-plus-header-tools">
        <a class="signin-link open-modal" href="#signin-modal">
            <div class="signin-icon">
                <i class="bi bi-person-circle"></i>
            </div>
            <div class="signin-text">
                <small>Hello, <?php echo $name ?></small>
                My Account
            </div>
        </a>
    </div>
<?php
    return ob_get_clean();
}
